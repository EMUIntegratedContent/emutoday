# CLAUDE.md

This file provides guidance to Claude Code (claude.ai/code) when working with code in this repository.

## Project Overview

EMU Today is Eastern Michigan University's public-facing news platform (today.emich.edu). It manages stories, events, announcements, a magazine, an "Inside EMU" staff/faculty submission system, and an Eastern Experts directory.

## Development Commands

### Docker (primary local environment)
```bash
docker compose up --build    # first time
docker compose up            # subsequent starts
```
App runs at `localhost:8080`. Services: PHP 8.5/Apache web container, MariaDB (`emutoday-db-1`), MailHog (SMTP on :1027, UI on :8027).

### Frontend (Laravel Mix / Webpack)
```bash
npm run dev          # compile assets once
npm run watch        # compile + watch for changes
npm run prod         # production build (minified)
```

### Artisan / PHP
```bash
php artisan <command>                    # inside the web container
docker exec -it emutoday-web-1 bash      # shell into container
```

### Tests
```bash
vendor/bin/phpunit                       # run all tests
vendor/bin/phpunit tests/ExampleTest.php # run single test
```
PHPUnit config is in `phpunit.xml`. Test suite is minimal (lives in `tests/`).

## Architecture

**Laravel 12 + Vue 3** with Laravel Mix (webpack.mix.js). The app namespace is `Emutoday\` (PSR-4 mapped to `app/`).

### Routing
All routes are in `app/Http/routes.php` (not `routes/web.php`). Loaded via `RouteServiceProvider` with the `Emutoday\Http\Controllers` namespace. Additional route files are required inline: `experts_redirects.php`, `misc_redirects.php`.

### Controller Structure (app/Http/Controllers/)
- **Today/** — public-facing controllers (stories, events, announcements, calendar, magazine, experts, Inside EMU, RSS feeds)
- **Admin/** — CMS/admin controllers (CRUD for all content types, user/role management)
- **Api/** — internal JSON API consumed by Vue components + external API endpoints (`ExternalApiController`)
- **Auth/** — CAS-based authentication controllers

### Key Directories
- `app/Services/` — CasService (custom CAS auth), ImageCacheService (custom image caching), InsideemuService, MailgunSubscribeService
- `app/Presenters/` — Laracasts Presenter classes for view formatting (dates, URLs, display logic) on models like Story, Event, Announcement, etc.
- `app/Today/Transformers/` — League\Fractal transformers used by API controllers to shape JSON responses
- `app/Helpers/` — Search helper (aggregates FULLTEXT search results across models)
- `app/Repositories/` — Repository pattern (StoryRepository + interfaces)
- `app/Facades/` — Custom facades (notably `Cas`)
- `app/Providers/` — Includes custom CasServiceProvider, SearchServiceProvider, RepositoriesServiceProvider

### Models
Eloquent models live directly in `app/` (not `app/Models/`). Key models: Story, Event, Announcement, Expert, InsideemuPost, InsideemuIdea, Magazine, Page, MediaHighlight, Email, Author. The `Story` model uses table name `storys` (not `stories`).

### Frontend
- Vue 3 components in `resources/assets/js/components/`
- Each admin form/queue has its own JS entry point (e.g., `vue-story-form-wrapper.js`, `vue-event-queue.js`)
- CKEditor 5 is integrated for rich text editing with custom webpack config in `webpack.mix.js`
- Admin UI uses AdminLTE 3 + Bootstrap 5 + Vuetify 3
- Public UI uses Foundation + custom CSS

## Key Patterns

### Presenters
Models use `PresentableTrait` from `laracasts/presenter`. Each presenter (e.g., `StoryPresenter`) formats dates and display values. Access via `$model->present()->methodName`.

### Fractal Transformers
API responses go through `League\Fractal\TransformerAbstract` classes in `app/Today/Transformers/`. These shape model data for Vue component consumption.

### Image Caching
Custom `ImageCacheService` replaces the deprecated `intervention/imagecache` package. Uses Intervention Image v3 with named filter functions (e.g., `avatar160`, `betterthumb`). Images are served through `ImageCacheController`. Image directories: `public/imgs/{story,magazine,user,event,expert,insideemu_posts,placeholder}`.

### FULLTEXT Search
Search uses raw MySQL `MATCH ... AGAINST` queries across multiple tables/columns. Results are scored and aggregated in `app/Helpers/Search.php` using a composite `search_score` field. The Expert model has particularly complex multi-table FULLTEXT joins across education, expertise, languages, and titles.

### Authentication
Custom CAS (Central Authentication Service) implementation in `app/Services/CasService.php` using `apereo/phpcas`. This replaced the deprecated `subfission/cas` package. The `Authenticate` middleware checks CAS, then looks up the user by `{cas_username}@emich.edu` in the local users table. **CAS is planned for replacement with LDAP** (see readme.md).

### Authorization
Role-based access control with `HasRoles` trait on User model. Middleware classes gate access to specific sections (ExpertsMiddleware, InsideemuMiddleware, EmailsMiddleware, etc.).

## External Files (not in repo)

These must be obtained separately and placed manually:
- **`.env`** — environment config with app keys, DB credentials, API keys
- **`app/Http/Requests/oauth.php`** — OAuth configuration file
- **`public/imgs/`** — most image subdirectories are not tracked in git
- **`emutoday.sql`** — database dump for initial local setup
