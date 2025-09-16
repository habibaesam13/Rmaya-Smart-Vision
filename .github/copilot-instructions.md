# Copilot Instructions for Rmaya-Smart-Vision (Laravel Project)

## Project Overview
- This is a Laravel-based web application for managing members, clubs, weapons, and related entities.
- The architecture follows standard Laravel conventions: MVC structure, service layer, and request validation.
- Major domains: Members, Clubs, Weapons, Teams, Roles, and Groups.

## Key Directories & Patterns
- `app/Models/`: Eloquent models for all main entities (e.g., `Sv_member`, `Sv_clubs`, `Sv_weapons`).
- `app/Http/Controllers/`: Handles HTTP requests. Controllers delegate business logic to services.
- `app/Services/`: Contains service classes (e.g., `WeaponService`, `ClubService`) encapsulating business logic. Controllers should not contain business logic directly.
- `app/Http/Requests/`: Form request classes for validation (e.g., `StoreWeaponRequest`).
- `resources/views/`: Blade templates for UI. Organized by feature (e.g., `members/`, `weapon/`).
- `routes/web.php`: Main route definitions. Follows RESTful conventions for resources.

## Conventions & Patterns
- Always inject services into controllers via constructor dependency injection.
- Use form request classes for validation instead of inline validation in controllers.
- Use Eloquent relationships for model associations (e.g., members to clubs).
- Views are organized by feature, not by type.
- Use `compact()` for passing variables to views.
- Use `with('success', ...)` or `with('error', ...)` for flash messages after redirects.

## Workflows
- **Development server:** `php artisan serve`
- **Database migrations:** `php artisan migrate`
- **Seeding:** `php artisan db:seed`
- **Testing:** `php artisan test` or `vendor\bin\pest`
- **Debugging:** Xdebug is supported; see VS Code launch configs for details.
- **Asset build:** `npm run dev` (uses Vite and Tailwind CSS)

## Integration Points
- Uses Laravel's built-in authentication and authorization (see `config/auth.php`, `config/permission.php`).
- Localization via `mcamara/laravel-localization` (see `config/laravellocalization.php`).
- Service providers in `app/Providers/` for app bootstrapping.

## Examples
- To add a new resource (e.g., `Weapon`):
  - Create model in `app/Models/`
  - Create migration in `database/migrations/`
  - Create service in `app/Services/`
  - Create controller in `app/Http/Controllers/`
  - Create request class in `app/Http/Requests/`
  - Add views in `resources/views/weapon/`
  - Register routes in `routes/web.php`

## Special Notes
- Namespace imports in PHP must use backslashes (`use App\Services\WeaponService;`).
- Do not place business logic in controllers—use services.
- Follow Laravel's naming conventions for files, classes, and methods.

---
For more details, see the README.md and explore the `app/` directory structure.
