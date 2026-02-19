# EMU Today - Claude Code Reference

## Build & Development

### Docker
```bash
docker-compose up -d          # Start web (port 8080), MariaDB (3306), MailHog (8027)
docker-compose down           # Stop services
```

### Frontend (Laravel Mix)
```bash
npm run dev                   # Development build
npm run watch                 # Watch for changes
npm run prod                  # Production build (minified)
```

### Backend (Laravel)
```bash
php artisan migrate           # Run migrations
php artisan tinker            # REPL
composer install              # Install PHP dependencies
```

### Testing
```bash
vendor/bin/phpunit            # Run PHP tests
```

## Architecture

**Stack:** Laravel 12 + Vue 3 + AdminLTE 3 + Bootstrap 5 + MariaDB

**Namespace:** `Emutoday\` — maps to `app/` (PSR-4 in composer.json)

### Content Types (Eloquent models in `app/`)
Stories, Events, Announcements, Pages, Experts, Magazine, Emails, MediaHighlights, InsideemuPosts, InsideemuIdeas, StoryIdeas, MiniCalendar

### Controller Organization (`app/Http/Controllers/`)
- `Admin/` — CMS admin controllers (behind CAS auth)
- `Api/` — API endpoints (Mailgun webhooks, data APIs)
- `Auth/` — Authentication controllers
- `Today/` — Public-facing today.emich.edu controllers
- Root — MainController, SearchController, PreviewController, etc.

### Routing
All routes are in a single file: **`app/Http/routes.php`** (not the standard `routes/` directory). Sub-route files are required in (e.g., `experts_redirects.php`).

### Vue Entry Points
Each Vue component has its own entry file in `resources/assets/js/` following the pattern `vue-{feature}-{type}.js`. These are compiled individually via Laravel Mix in `webpack.mix.js`. There is no SPA — each entry point mounts to a specific Blade template.

### Presenters (`app/Presenters/`)
Uses `laracasts/presenter` for view-layer formatting on models (e.g., StoryPresenter, EventPresenter).

## Key Conventions

- **Auth:** Apereo CAS (phpCAS) for admin authentication, Laravel Passport for API OAuth
- **Email:** Mailgun integration with webhook handlers and mailing list management
- **Rich Text:** CKEditor 5 with custom webpack config in `webpack.mix.js`
- **Frontend CSS:** Foundation (public site) + AdminLTE/Bootstrap (admin). Styles combined via Mix from `resources/assets/css/`
- **Helpers:** Global helper functions in `app/helpers.php` (autoloaded via composer)
- **Images:** Intervention Image for processing
- **Role-based access:** Custom `HasRoles` trait on User model with Role/Permission models
