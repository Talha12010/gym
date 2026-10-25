# Muscle Core Gym

A gym management website for **Muscle Core Gym** (Rawalpindi) built with **Laravel 11**. It combines a public marketing site with three role-based portals: members, trainers, and administrators.

## Tech Stack

| Layer | Technology |
| --- | --- |
| Backend | PHP 8.2+ (tested on 8.4), Laravel 11 |
| Database | MySQL (`muscle`) |
| Frontend | Blade templates, custom CSS (`public/css`), Bootstrap 5 + Font Awesome (admin panel, via CDN) |
| Fonts/Assets | Google Fonts (Bebas Neue, Inter), images in `public/images` |
| Build | Vite 5 + Laravel Vite Plugin (`npm run dev` / `npm run build`) |
| Mail | SMTP (Gmail) for password reset/update emails |

## Features

### Public site
- Home (`/`), Why Us (`/whyus`), Services (`/services`), Contact (`/contact`)
- Subscription plans page (`/subscription`) with plan request form
- Feedback submission form
- Contact page with address, hours, and phone

### Member portal (`/account`)
- Register, login, logout, dashboard
- Forgot password / reset password / update password via email links
- Roles: `customer`, `trainer`, `admin` (stored in `users.role`)

### Trainer portal (`/trainer`)
- Trainer registration and login
- Dashboard with member list, class schedule, and attendance marking

### Admin panel (`/admin`)
- Separate login guarded by `admin.auth` / `admin.guest` middleware
- Customer management (add / view / edit / delete / update)
- Trainer management (add / view / edit / delete / search)
- Equipment management with image, description, and search
- Class schedule management (capacity, assigned trainer)
- Subscription plans, payments, and monthly records
- Feedback management
- Pending user approval queue (`/admin/pending-users`) and user deletion
- Site feedback and schedule overviews

## Project Structure

```
app/
  Http/
    Controllers/         # account, dashboard, mail, subscription, feedback, attendance
      admin/             # admin login + dashboard controllers
      trainer/           # trainer login + dashboard controllers
    Middleware/           # AdminAuthenticate, AdminRedirect
resources/
  views/
    partials/            # navbar, footer, scripts
    admin/ auth/ trainer/ emails/
    welcome.blade.php    # home page
public/css/              # site.css, home.css, admin.css, admin-pages.css
routes/web.php           # all web routes
database/migrations/     # schema
start.ps1                # Windows dev startup script
```

## Getting Started

### Requirements
- PHP >= 8.2 with MySQL extension
- Composer
- MySQL
- Node.js 18+ (for Vite assets)

### Installation

```bash
composer install
npm install
cp .env.example .env
php artisan key:generate
```

Configure `DB_DATABASE`, `DB_USERNAME`, `DB_PASSWORD` and `MAIL_*` in `.env`, then:

```bash
php artisan migrate
php artisan serve --host=0.0.0.0 --port=8088
```

On Windows you can run the all-in-one dev script instead:

```powershell
.\start.ps1
```

It starts the Laravel backend on **http://127.0.0.1:8088** and the Vite dev server on **http://localhost:5173**.

### Default admin (local dev)

| Email | Password | Role |
| --- | --- | --- |
| `admin@gmail.com` | `admin123` | admin |

To grant admin access to another account, set `role = admin` on its row in the `users` table. Change the default password before deploying.

## Database Tables

`users` (role + approval status), `equipments`, `equipment_table`, `classes`, `schedule`, `subscriptions`, `sub`, `payments`, `attendances`, `feedback`, `feedbacknew`, plus Laravel's `sessions`, `cache`, `jobs`, and `password_reset_tokens`.

## Common Commands

```bash
php artisan migrate          # apply migrations
php artisan migrate:fresh    # rebuild schema (drops data)
php artisan tinker           # inspect data in the REPL
php artisan view:clear       # clear compiled Blade templates
npm run dev                  # watch assets
npm run build                # compile assets for production
./vendor/bin/pint            # code style fixer
php artisan test             # run tests
```

## Notes

- Em dashes were intentionally removed from all page copy; time/day ranges (e.g. `Monday - Friday`, `6 AM - 11 PM`) keep their separator.
- Admin routes are prefixed with `/admin` and protected by the `admin.auth` middleware alias registered in `bootstrap/app.php`.
