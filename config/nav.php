<?php

return [
    [
        'icon' => 'nav-icon fas fa-tachometer-alt',
        'route' => 'dashboard.dashboard',
        'title' => 'Dashboard',
        'url' => 'dashboard',
    ],
    [
        'icon' => 'nav-icon fas fa-list-ul',
        'route' => 'dashboard.categories.index',
        'title' => 'Categories',
        'badge' => 'New',
        'url' => 'dashboard/categories*',
    ],
    [
        'title' => 'Products',
        'icon' => 'nav-icon fas fa-boxes',
        'route' => 'dashboard.products.index',
        'url' => 'dashboard/products*',
    ]
];
