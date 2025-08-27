# Roles and Permissions System Guide

This guide explains how to use the Spatie Laravel Permission package implementation in your e-commerce application.

## Overview

The application uses the Spatie Laravel Permission package to manage roles and permissions. This provides a robust, well-tested solution for role-based access control (RBAC).

## Installation

The package is already installed and configured. If you need to reinstall:

```bash
composer require spatie/laravel-permission
```

## Database Structure

The package creates the following tables:
- `roles` - Stores role information
- `permissions` - Stores permission information
- `model_has_roles` - Pivot table for user-role relationships
- `model_has_permissions` - Pivot table for user-permission relationships
- `role_has_permissions` - Pivot table for role-permission relationships

## Predefined Roles

### 1. Super Administrator (`super_admin`)
- **Description**: Full system access with all permissions
- **Permissions**: All permissions in the system
- **Use Case**: System owner, highest level access

### 2. Administrator (`admin`)
- **Description**: Administrative access to manage the system
- **Permissions**: All permissions except:
  - `roles.delete`
  - `permissions.delete`
  - `users.delete`
- **Use Case**: Senior administrators, system managers

### 3. Manager (`manager`)
- **Description**: Manager access to manage products, orders, and customers
- **Permissions**:
  - Dashboard access
  - Category management (view, create, edit)
  - Product management (view, create, edit)
  - Section management (view, create, edit)
  - Slider management (view, create, edit)
  - Order management (view, create, edit)
  - Review management (view, create, edit)
  - Settings view
  - Reports view
  - User view
  - Contact management (view, edit)
- **Use Case**: Store managers, department heads

### 4. Editor (`editor`)
- **Description**: Editor access to manage content and products
- **Permissions**:
  - Dashboard access
  - Category management (view, create, edit)
  - Product management (view, create, edit)
  - Section management (view, create, edit)
  - Slider management (view, create, edit)
  - Review management (view, edit)
- **Use Case**: Content creators, product managers

### 5. Moderator (`moderator`)
- **Description**: Moderator access to manage reviews and content
- **Permissions**:
  - Dashboard access
  - Review management (view, create, edit)
  - Product view
  - Category view
  - Section view
  - Slider view
- **Use Case**: Content moderators, review managers

### 6. Customer (`user`)
- **Description**: Regular customer access
- **Permissions**: None (frontend access only)
- **Use Case**: Regular customers, end users

## Permission Structure

Permissions follow a dot notation pattern: `{module}.{action}`

### Available Permissions

#### Dashboard
- `dashboard.view` - View admin dashboard

#### User Management
- `users.view` - View users
- `users.create` - Create users
- `users.edit` - Edit users
- `users.delete` - Delete users

#### Role Management
- `roles.view` - View roles
- `roles.create` - Create roles
- `roles.edit` - Edit roles
- `roles.delete` - Delete roles

#### Permission Management
- `permissions.view` - View permissions
- `permissions.create` - Create permissions
- `permissions.edit` - Edit permissions
- `permissions.delete` - Delete permissions

#### Category Management
- `categories.view` - View categories
- `categories.create` - Create categories
- `categories.edit` - Edit categories
- `categories.delete` - Delete categories

#### Product Management
- `products.view` - View products
- `products.create` - Create products
- `products.edit` - Edit products
- `products.delete` - Delete products

#### Section Management
- `sections.view` - View sections
- `sections.create` - Create sections
- `sections.edit` - Edit sections
- `sections.delete` - Delete sections

#### Slider Management
- `sliders.view` - View sliders
- `sliders.create` - Create sliders
- `sliders.edit` - Edit sliders
- `sliders.delete` - Delete sliders

#### Order Management
- `orders.view` - View orders
- `orders.create` - Create orders
- `orders.edit` - Edit orders
- `orders.delete` - Delete orders

#### Review Management
- `reviews.view` - View reviews
- `reviews.create` - Create reviews
- `reviews.edit` - Edit reviews
- `reviews.delete` - Delete reviews

#### Settings
- `settings.view` - View settings
- `settings.edit` - Edit settings

#### Reports
- `reports.view` - View reports
- `reports.export` - Export reports

#### Contact Management
- `contacts.view` - View contacts
- `contacts.edit` - Edit contacts
- `contacts.delete` - Delete contacts

## Usage Examples

### In Controllers

```php
// Check if user has a specific role
if (auth()->user()->hasRole('admin')) {
    // Admin only code
}

// Check if user has any of the given roles
if (auth()->user()->hasAnyRole(['admin', 'manager'])) {
    // Admin or manager code
}

// Check if user has all of the given roles
if (auth()->user()->hasAllRoles(['admin', 'manager'])) {
    // User must have both admin and manager roles
}

// Check if user has a specific permission
if (auth()->user()->hasPermissionTo('users.create')) {
    // User can create users
}

// Check if user has any of the given permissions
if (auth()->user()->hasAnyPermission(['users.create', 'users.edit'])) {
    // User can create or edit users
}

// Check if user has all of the given permissions
if (auth()->user()->hasAllPermissions(['users.create', 'users.edit'])) {
    // User must have both create and edit permissions
}
```

### In Blade Templates

```php
{{-- Check role --}}
@role('admin')
    <div>Admin only content</div>
@endrole

@hasanyrole(['admin', 'manager'])
    <div>Admin or manager content</div>
@endhasanyrole

@hasallroles(['admin', 'manager'])
    <div>User has both admin and manager roles</div>
@endhasallroles

{{-- Check permission --}}
@can('users.create')
    <button>Create User</button>
@endcan

@canany(['users.create', 'users.edit'])
    <button>Create or Edit User</button>
@endcanany

@canall(['users.create', 'users.edit'])
    <button>User has both create and edit permissions</button>
@endcanall
```

### In Routes

```php
// Route with role middleware
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/users', [UserController::class, 'index']);
});

// Route with multiple roles
Route::middleware(['auth', 'role:admin|manager'])->group(function () {
    Route::get('/admin/dashboard', [DashboardController::class, 'index']);
});

// Route with permission middleware
Route::middleware(['auth', 'permission:users.create'])->group(function () {
    Route::post('/admin/users', [UserController::class, 'store']);
});

// Route with multiple permissions
Route::middleware(['auth', 'permission:users.create|users.edit'])->group(function () {
    Route::get('/admin/users/create', [UserController::class, 'create']);
});
```

## Managing Roles and Permissions

### Creating a New Role

```php
use Spatie\Permission\Models\Role;

$role = Role::create([
    'name' => 'content_manager',
    'guard_name' => 'web'
]);

// Assign permissions to role
$role->givePermissionTo(['products.view', 'products.edit', 'categories.view']);
```

### Creating a New Permission

```php
use Spatie\Permission\Models\Permission;

$permission = Permission::create([
    'name' => 'products.duplicate',
    'guard_name' => 'web'
]);
```

### Assigning Roles to Users

```php
// Assign a single role
$user->assignRole('manager');

// Assign multiple roles
$user->assignRole(['admin', 'manager']);

// Sync roles (removes existing roles and assigns new ones)
$user->syncRoles(['editor', 'moderator']);
```

### Assigning Permissions to Users

```php
// Assign a single permission
$user->givePermissionTo('users.create');

// Assign multiple permissions
$user->givePermissionTo(['users.create', 'users.edit']);

// Sync permissions
$user->syncPermissions(['users.view', 'users.create']);
```

### Assigning Permissions to Roles

```php
// Give permission to role
$role->givePermissionTo('users.create');

// Give multiple permissions to role
$role->givePermissionTo(['users.create', 'users.edit']);

// Sync permissions for role
$role->syncPermissions(['users.view', 'users.create', 'users.edit']);
```

## Admin Panel Management

The admin panel includes full CRUD operations for roles and permissions:

### Role Management
- **URL**: `/admin/roles`
- **Features**:
  - List all roles
  - Create new roles
  - Edit existing roles
  - Delete roles (except system roles)
  - Assign permissions to roles
  - View role details and assigned users

### Permission Management
- **URL**: `/admin/permissions`
- **Features**:
  - List all permissions
  - Create new permissions
  - Edit existing permissions
  - Delete permissions (except system permissions)
  - Assign permissions to roles
  - View permission details and assigned roles

## Security Considerations

### System Roles and Permissions
- System roles (`super_admin`, `admin`, `user`) cannot be deleted or edited
- Core system permissions cannot be deleted or edited
- Always validate permissions on both frontend and backend

### Best Practices
1. **Principle of Least Privilege**: Only grant necessary permissions
2. **Regular Audits**: Review roles and permissions regularly
3. **Logging**: Log all permission-related actions
4. **Testing**: Test permission checks thoroughly
5. **Documentation**: Keep permission documentation updated

## Caching

The system uses Laravel's cache system to improve performance:
- Role and permission data is cached
- Cache is automatically cleared when roles/permissions are modified
- Use `php artisan cache:clear` if you encounter caching issues

## Troubleshooting

### Common Issues

1. **Permission not working**
   - Clear cache: `php artisan cache:clear`
   - Check if permission exists in database
   - Verify user has the correct role/permission

2. **Role not working**
   - Clear cache: `php artisan cache:clear`
   - Check if role exists in database
   - Verify user is assigned the role

3. **Middleware not working**
   - Check middleware registration in `app/Http/Kernel.php`
   - Verify route middleware syntax
   - Check authentication status

### Debugging

```php
// Check user's roles
dd(auth()->user()->getRoleNames());

// Check user's permissions
dd(auth()->user()->getAllPermissions()->pluck('name'));

// Check role's permissions
dd($role->getAllPermissions()->pluck('name'));
```

## Migration and Seeding

### Running Migrations
```bash
php artisan migrate
```

### Running Seeders
```bash
php artisan db:seed --class=RolePermissionSeeder
```

### Fresh Installation
```bash
php artisan migrate:fresh --seed
```

## API Usage

For API routes, use the same middleware but with API guard:

```php
Route::middleware(['auth:api', 'role:admin'])->group(function () {
    Route::get('/api/admin/users', [UserController::class, 'index']);
});
```

## Customization

### Adding New Permissions
1. Add permission to the seeder
2. Run the seeder or create permission manually
3. Assign to appropriate roles
4. Update documentation

### Adding New Roles
1. Add role to the seeder
2. Define role permissions
3. Run the seeder
4. Update documentation

### Custom Guards
The system uses the 'web' guard by default. To use different guards:

```php
$role = Role::create([
    'name' => 'api_admin',
    'guard_name' => 'api'
]);
```

## Support

For issues with the Spatie Laravel Permission package:
- [Package Documentation](https://spatie.be/docs/laravel-permission)
- [GitHub Repository](https://github.com/spatie/laravel-permission)
- [Laravel Forums](https://laracasts.com/discuss)

For application-specific issues, check the application documentation or contact the development team.

