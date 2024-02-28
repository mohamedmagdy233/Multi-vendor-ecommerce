<?php

    return[
        [
            'icon' => 'nav-icon fas fa-tachometer-alt',
            'route' => 'dashboard',
            'title' => 'Dashboard',
            'active' => 'dashboard.dashboard',
        ],
        [
            'icon' => 'fas fa-tags nav-icon',
            'route' => 'categories.index',
            'title' => 'Categories',
            'badge' => 'New',
            'active' => 'dashboard.categories.*',
            'ability' => 'categories.view',
        ],
        [
            'icon' => 'fas fa-box nav-icon',
            'route' => 'products.index',
            'title' => 'Products',
            'active' => 'dashboard.products.*',
            'ability' => 'products.view',
        ],
        [
            'icon' => 'fas fa-receipt nav-icon',
            'route' => 'categories.index',
            'title' => 'Orders',
            'active' => 'dashboard.orders.*',
            'ability' => 'orders.view',
        ],
        [
            'icon' => 'fas fa-shield nav-icon',
            'route' => 'categories.index',
            'title' => 'Roles',
            'active' => 'dashboard.roles.*',
            'ability' => 'roles.view',
        ],
        [
            'icon' => 'fas fa-users nav-icon',
            'route' => 'categories.index',
            'title' => 'Users',
            'active' => 'dashboard.users.*',
            'ability' => 'users.view',
        ],
        [
            'icon' => 'fas fa-users nav-icon',
            'route' => 'categories.index',
            'title' => 'Admins',
            'active' => 'dashboard.admins.*',
            'ability' => 'admins.view',
        ],









    ];
