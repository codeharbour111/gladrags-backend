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
Breadcrumbs::for('products', function (BreadcrumbTrail $trail) {
    $trail->push('Products', route('dashboard'));
});
// Home > Categories
Breadcrumbs::for('categories', function (BreadcrumbTrail $trail) {
    $trail->push('Categories', route('dashboard'));
});

Breadcrumbs::for('banner', function (BreadcrumbTrail $trail) {
    $trail->push('Banner', route('dashboard'));
});

Breadcrumbs::for('coupon', function (BreadcrumbTrail $trail) {
    $trail->push('Coupon', route('dashboard'));
});

Breadcrumbs::for('shopgram', function (BreadcrumbTrail $trail) {
    $trail->push('Shop By Gram', route('dashboard'));
});

Breadcrumbs::for('user', function (BreadcrumbTrail $trail) {
    $trail->push('Users', route('dashboard'));
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

// Home > Dashboard > Products > All Products > Add New Product
Breadcrumbs::for('products.add.new.product', function (BreadcrumbTrail $trail) {
    $trail->parent('products.all-products'); // Parent breadcrumb
    $trail->push('Add New Product', route('add.new.product')); // Add new breadcrumb
});

// Home > Dashboard > Categories > Category List
Breadcrumbs::for('categories.category-list', function (BreadcrumbTrail $trail) {
    $trail->parent('categories');
    $trail->push('Category List', route('category.list'));
});

// Home > Dashboard > Categories > Category List > Add New Category
Breadcrumbs::for('categories.add.new.category', function (BreadcrumbTrail $trail) {
    $trail->parent('categories.category-list');
    $trail->push('Add New Category', route('add.new.category'));
});

Breadcrumbs::for('banner.banner-list', function (BreadcrumbTrail $trail) {
    $trail->parent('banner');
    $trail->push('Banner List', route('banner.list'));
});

Breadcrumbs::for('banner.add.new.banner', function (BreadcrumbTrail $trail) {
    $trail->parent('banner.banner-list');
    $trail->push('Add New Banner', route('add.new.banner'));
});

Breadcrumbs::for('coupon.coupon-list', function (BreadcrumbTrail $trail) {
    $trail->parent('coupon');
    $trail->push('Coupon List', route('coupon.list'));
});

Breadcrumbs::for('coupon.add.new.coupon', function (BreadcrumbTrail $trail) {
    $trail->parent('coupon.coupon-list');
    $trail->push('Add New Coupon', route('add.new.coupon'));
});

Breadcrumbs::for('shopgram.shopgram-list', function (BreadcrumbTrail $trail) {
    $trail->parent('shopgram');
    $trail->push('Shop By Gram List', route('shopgram.list'));
});

Breadcrumbs::for('shopgram.add.new.shopgram', function (BreadcrumbTrail $trail) {
    $trail->parent('shopgram.shopgram-list');
    $trail->push('Add New Shop By Gram', route('add.new.shopgram'));
});

// Home > Dashboard > Orders > Order List
Breadcrumbs::for('order.order-list', function (BreadcrumbTrail $trail) {
    $trail->parent('order');
    $trail->push('Order List', route('order.list'));
});

// User List
Breadcrumbs::for('user.list', function (BreadcrumbTrail $trail) {
    $trail->parent('user');
    $trail->push('User List', route('user.list'));
});

// Add User
Breadcrumbs::for('add.user', function (BreadcrumbTrail $trail) {
    $trail->parent('user.list');
    $trail->push('Add User', route('add.user'));
});

// User Settings
Breadcrumbs::for('user.settings', function (BreadcrumbTrail $trail) {
    $trail->parent('user');
    $trail->push('User Settings', route('user.settings'));
});
