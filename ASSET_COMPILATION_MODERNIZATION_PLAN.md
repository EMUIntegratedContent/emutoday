# Modernize Frontend Asset Compilation: Laravel Mix → Vite

## Context

EMU Today (Laravel 12 + Vue 3) still compiles its frontend with **Laravel Mix 6
(webpack 5)** via `webpack.mix.js`. Mix is in long-term maintenance mode and is no
longer Laravel's default build tool — **Vite** has been the official default since
Laravel 9 (2022). Moving to Vite gives a fast HMR dev server, native ESM, simpler
config, automatic content-hash cache-busting (replacing the inconsistent manual
`?v=` query strings used today), and removes a large pile of webpack loaders.

The codebase is well-suited to the swap: it's already pure ESM (`import`/`createApp`),
Vue 3 SFCs, and 38 isolated per-page entry points — exactly the multi-page pattern
Vite handles well. Decisions taken: the **idiomatic `@vite` directive** approach
(touching Blade references for real cache-busting + HMR) and a **CKEditor-first spike**
to de-risk the hardest piece before the full rollout.

## Current State (verified)

- `webpack.mix.js` defines **38 JS entries** (36 `vue-*.js` forms/queues +
  `admin-emucustom.js` + the combined public scripts) and **2 CSS bundles**.
- **CSS bundles** are `mix.combine()`/`mix.styles()` of *pre-built* `.css` files
  (no SASS/LESS compilation happens in Mix today): `public-styles.css` (10 files)
  and `admin-styles.css` (3 files).
- **Public scripts** bundle = concat of `jquery.min.js` + `foundation.min.js` +
  `magnific-popup` + `app.js` (legacy jQuery globals, not ESM-friendly).
- Blades reference assets by **hardcoded paths** (`<script src="/js/vue-*.js">`,
  `<link href="/css/*.css">`) with manual `?v=` versioning — the `mix()` helper and
  `mix-manifest.json` are effectively unused.
- **CKEditor 5 v36** (highest risk): custom webpack config with `raw-loader` for SVG
  icons, `style-loader` `singletonStyleTag`, and a postcss `themeImporter`; config in
  `resources/assets/js/components/ckeditor_config.js` (+ `ckeditor_insideemu_config.js`)
  mixes package-root imports and old `/src/...` deep imports. Note `@ckeditor/ckeditor5-html-support`
  is pinned `^47.6.0` while the rest are `^36.0.1` — a pre-existing mismatch the spike will surface.
- Vuetify 3 is used by one entry (`vue-insideemu-queue.js`); Vuex 4 by a few. Both are Vite-friendly.
- App runs in **Docker** at `localhost:8080` (web container is PHP/Apache).

## Recommended Approach

Replace Laravel Mix with **Vite + `laravel-vite-plugin` + `@vitejs/plugin-vue` +
`@ckeditor/vite-plugin-ckeditor5`**. Keep all 38 entries as Vite `input`s, convert the
2 CSS combine-bundles into CSS entry files, wire pages with the `@vite()` directive, and
let Vite produce content-hashed output in `public/build/` with a `manifest.json`.

CKEditor's custom webpack config is **deleted** — `@ckeditor/vite-plugin-ckeditor5` is
purpose-built to replace exactly the raw-loader/singletonStyleTag/themeImporter setup.

---

## Phase 0 — CKEditor Spike (de-risk before committing)

Goal: prove Vite can build and run **one** CKEditor-using entry before converting the rest.
Target: `vue-story-form-wrapper.js` (exercises Vue SFC + Vuex + CKEditor + axios global).

1. Add Vite tooling (Phase 1 deps + minimal `vite.config.js` with just the story entry).
2. Build `npm run build`; load the admin **story form** page (the page including
   `vue-story-form-wrapper.js`) in the Docker app and confirm the editor renders, the
   toolbar/plugins work, and styles inject correctly.
3. If the `/src/...` deep imports in `ckeditor_config.js` fail to resolve under Vite,
   rewrite them to package-root named imports (most imports already use that style) —
   a small, isolated change in `ckeditor_config.js` / `ckeditor_insideemu_config.js`.
4. Only once the editor works end-to-end, proceed to the full rollout.

---

## Phase 1 — Tooling

**`package.json`**
- Remove: `laravel-mix`, `laravel-mix-listen`, `vue-loader`, `vue-template-compiler`,
  `sass-loader`, `css-loader`, `postcss-loader`, `raw-loader`, `style-loader`,
  `resolve-url-loader`, `less-loader`, `browser-sync`, `browser-sync-webpack-plugin`,
  `cross-env`, `@ckeditor/ckeditor5-dev-webpack-plugin`, `@ckeditor/ckeditor5-dev-utils`,
  `@ckeditor/ckeditor5-dev-translations`.
- Add (dev): `vite`, `laravel-vite-plugin`, `@vitejs/plugin-vue`,
  `@ckeditor/vite-plugin-ckeditor5`.
- Keep: `sass` (Vite uses it directly), `postcss`, `autoprefixer`, `vue`, all CKEditor
  feature packages, `@ckeditor/ckeditor5-vue`, Vuetify, Vuex, etc.
- Scripts → `"dev": "vite"`, `"build": "vite build"` (drop `development/watch/hot/prod`).

**`vite.config.js`** (new, repo root) — `laravel()` plugin with all entries as `input`,
`vue()`, and `ckeditor5({ theme: ... })`. Use `createRequire`/`fileURLToPath` for the
theme path resolution in an ESM config. `refresh: true` for Blade/PHP live reload.

**`postcss.config.js`** (new) — `autoprefixer` (replaces the autoprefixer that was a Mix dep).

**`.gitignore`** — add `/public/build` and `/public/hot`.

**Delete** `webpack.mix.js` and `public/mix-manifest.json` (after rollout, not during spike).

---

## Phase 2 — Entry points & CSS restructure

- **CSS bundles → CSS entries**: create `resources/assets/css/public-styles.entry.css`
  that `@import`s the 10 existing public `.css` files, and
  `resources/assets/css/admin-styles.entry.css` that `@import`s the 3 admin files.
  Add both as Vite inputs. (Preserves today's "concatenate pre-built CSS" behavior; no
  SASS/LESS compilation is introduced.)
- **Public scripts (jQuery legacy)**: create `resources/assets/js/public-scripts.entry.js`.
  Because ESM evaluates imported modules in source order *before* the importer body,
  set the jQuery global in a tiny first-imported module so Foundation/Magnific see it:
  ```js
  import './jquery-global.js'   // import jquery from 'jquery'; window.$ = window.jQuery = jquery
  import 'foundation-sites'
  import 'magnific-popup'
  import './app.js'
  ```
  Verify Foundation init + Magnific popups on a public page (second-trickiest piece after CKEditor).
- The 36 `vue-*.js` entries and `admin-emucustom.js` need **no source changes** — they're
  already ESM; `@vitejs/plugin-vue` provides the `.vue()` support Mix gave them.

---

## Phase 3 — CKEditor under Vite

- Delete the entire CKEditor webpack block from `webpack.mix.js` (file is removed anyway).
- `@ckeditor/vite-plugin-ckeditor5` handles SVG icons, CSS, and theme injection.
- Apply any `/src/...` → package-root import fixes identified in the spike to both
  `ckeditor_config.js` and `ckeditor_insideemu_config.js`.
- English (`language: "en"`) is CKEditor's built-in default, so no translation plugin is
  needed (the old `addMainLanguageTranslationsToAllAssets` webpack plugin is dropped).

---

## Phase 4 — Blade wiring (`@vite` directive)

Replace hardcoded tags with `@vite([...])`, reading the manifest automatically (drops `?v=`).

- **Shared assets in layouts**:
  - `resources/views/admin/layouts/adminlte.blade.php`: replace the `/css/admin-styles.css`
    link and shared admin scripts with `@vite(['resources/assets/css/admin-styles.entry.css',
    'resources/assets/js/admin-emucustom.js'])`. Leave hand-managed, non-compiled files
    (`/themes/admin-lte/js/app.js`, `redips-*.js`, `admintools.js`, `emu-ckeditor5-blade-config.js`)
    and external CDN tags untouched.
  - `resources/views/public/layouts/styles.blade.php` + `scriptsfooter.blade.php`: replace
    `/css/public-styles.css` and `/js/public-scripts.js` with `@vite([... public-styles.entry.css,
    public-scripts.entry.js ...])`. Leave CDN tags (Foundation/jQuery/CKEditor CDN/GTM/etc.) as-is.
- **Per-page bundles**: in each admin/public page's script section, replace
  `<script src="/js/vue-foo.js">` with `@vite('resources/assets/js/vue-foo.js')`.
  Pattern repeats across ~36 page blades; representative examples:
  `resources/views/admin/announcement/queue.blade.php` (line 34),
  the story form page (loads `vue-story-form-wrapper.js`),
  `resources/views/public/layouts/scriptsfooter.blade.php` (search forms).
  Multiple `@vite()` calls per request are fine — Laravel dedupes the Vite client injection.

---

## Phase 5 — Docker dev server (HMR)

For `npm run dev` HMR to work from the browser at `localhost:8080`:
- In `vite.config.js` set `server: { host: '0.0.0.0', hmr: { host: 'localhost' } }`.
- Expose port **5173** in `docker-compose.yml` for the web container.
- Production deploys use `npm run build` only (no dev server needed); `@vite` falls back
  to `public/build/manifest.json` when `public/hot` is absent.

---

## Phase 6 — Cleanup & docs

- Remove now-stale Mix-built outputs from `public/js` and `public/css` that Vite now
  produces (the 38 bundles + 2 CSS files). **Keep** hand-managed `public/js` files that
  were never Mix outputs.
- Delete `webpack.mix.js` and `public/mix-manifest.json`.
- Update **`CLAUDE.md`** "Frontend (Laravel Mix / Webpack)" section → Vite
  (`npm run dev`, `npm run build`), and the CKEditor note ("custom webpack config" →
  `@ckeditor/vite-plugin-ckeditor5`).

---

## Files to create / modify / delete

**Create:** `vite.config.js`, `postcss.config.js`,
`resources/assets/css/public-styles.entry.css`, `resources/assets/css/admin-styles.entry.css`,
`resources/assets/js/public-scripts.entry.js`, `resources/assets/js/jquery-global.js`.

**Modify:** `package.json`, `.gitignore`, `docker-compose.yml`, `CLAUDE.md`,
`resources/assets/js/components/ckeditor_config.js` (+ `ckeditor_insideemu_config.js`,
only if the spike requires import fixes), the layout blades
(`admin/layouts/adminlte.blade.php`, `public/layouts/styles.blade.php`,
`public/layouts/scriptsfooter.blade.php`), and ~36 per-page blades.

**Delete:** `webpack.mix.js`, `public/mix-manifest.json`, stale Mix outputs in `public/js` + `public/css`.

---

## Verification

1. **Spike gate (Phase 0):** `npm run build`; in the Docker app load the story form admin
   page — CKEditor renders, toolbar/plugins/source-editing work, styles applied.
2. **Full build:** `npm run build` completes with all 40 inputs in `public/build/manifest.json`.
3. **Public pages:** confirm Foundation behaviors + Magnific popups + search form Vue apps
   work; styles match the previous look.
4. **Admin spot-checks across entry types:** a form (story/event), a queue
   (announcement/event), a Vuetify page (`vue-insideemu-queue`), and an OAuth page —
   each Vue app mounts, axios `$http`/CSRF works, no console errors.
5. **HMR dev (optional):** `npm run dev` with port 5173 exposed; edit a `.vue` file and
   confirm hot update at `localhost:8080`.
6. Grep to confirm no remaining `/js/vue-*.js` / `/css/*-styles.css` hardcoded references
   or leftover `mix(`/`webpack.mix` usage.

## Key Risks

- **CKEditor v36 under Vite** — primary risk, gated by the Phase 0 spike; fallback is
  package-root import rewrites. The `ckeditor5-html-support@47` vs `@36` mismatch may need
  aligning if the build complains.
- **jQuery/Foundation globals** — must set `window.jQuery` before Foundation/Magnific load
  (handled via the first-imported `jquery-global.js`); verify on a real public page.
- **Docker HMR** — needs `server.host` + exposed port; production build path is unaffected.
