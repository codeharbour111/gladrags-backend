<?php

use App\Models\User;
use Diglactic\Breadcrumbs\Breadcrumbs;
use Diglactic\Breadcrumbs\Generator as BreadcrumbTrail;
use Spatie\Permission\Models\Role;

// Home
Breadcrumbs::for('home', function (BreadcrumbTrail $trail) {
    $trail->push('Home', route('dashboard'));
});

Breadcrumbs::for('order', function (BreadcrumbTrail $trail) {
    $trail->push('Order', route('order.list'));
});

// Home > Dashboard
Breadcrumbs::for('dashboard', function (BreadcrumbTrail $trail) {
    $trail->parent('home');
    $trail->push('Dashboard', route('dashboard'));
});

// Home > Products
Breadcrumbs::for('products', function ($trail) {
    $trail->push('Products', route('dashboard'));
});
// Home > Categories
Breadcrumbs::for('categories', function ($trail) {
    $trail->push('Categories', route('dashboard'));
});

Breadcrumbs::for('banner', function ($trail) {
    $trail->push('Banner', route('dashboard'));
});

// Home > Dashboard > User Management
Breadcrumbs::for('user-management.index', function (BreadcrumbTrail $trail) {
    $trail->parent('dashboard');
    $trail->push('User Management', route('user-management.users.index'));
});

// Home > Dashboard > User Management > Users
Breadcrumbs::for('user-management.users.index', function (BreadcrumbTrail $trail) {
    $trail->parent('user-management.index');
    $trail->push('Users', route('user-management.users.index'));
});

// Home > Dashboard > User Management > Users > [User]
Breadcrumbs::for('user-management.users.show', function (BreadcrumbTrail $trail, User $user) {
    $trail->parent('user-management.users.index');
    $trail->push(ucwords($user->name), route('user-management.users.show', $user));
});

// Home > Dashboard > User Management > Roles
Breadcrumbs::for('user-management.roles.index', function (BreadcrumbTrail $trail) {
    $trail->parent('user-management.index');
    $trail->push('Roles', route('user-management.roles.index'));
});

// Home > Dashboard > User Management > Roles > [Role]
Breadcrumbs::for('user-management.roles.show', function (BreadcrumbTrail $trail, Role $role) {
    $trail->parent('user-management.roles.index');
    $trail->push(ucwords($role->name), route('user-management.roles.show', $role));
});

// Home > Dashboard > User Management > Permission
Breadcrumbs::for('user-management.permissions.index', function (BreadcrumbTrail $trail) {
    $trail->parent('user-management.index');
    $trail->push('Permissions', route('user-management.permissions.index'));
});

// Home > Dashboard > Products > All Products
Breadcrumbs::for('products.all-products', function (BreadcrumbTrail $trail) {
    $trail->parent('products');
    $trail->push('All Products', route('all.products'));
});

// Home > Dashboard > Categories > Category List
Breadcrumbs::for('categories.category-list', function (BreadcrumbTrail $trail) {
    $trail->parent('categories');
    $trail->push('Category List', route('category.list'));
});

Breadcrumbs::for('banner.banner-list', function (BreadcrumbTrail $trail) {
    $trail->parent('banner');
    $trail->push('Banner List', route('banner.list'));
});

// Home > Dashboard > Categories > Category List
Breadcrumbs::for('order.order-list', function (BreadcrumbTrail $trail) {
    $trail->parent('order');
    $trail->push('Order List', route('order.list'));
});
