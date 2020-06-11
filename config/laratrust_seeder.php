<?php

return [
    'role_structure' => [
        'owner' => [
            'categories' => 'c,r,u,d',
            'languages' => 'c,r,u,d',
            'products' => 'c,r,u,d',
            'roles' => 'c,r,u,d',
            'permissions' => 'c,r,u,d',
            'settings' => 'c,r,u,d',
            'skills' => 'c,r,u,d',
            'translations' => 'c,r,u,d,e',
            'translation-groups' => 'c,r,u,d',
            'users' => 'c,r,u,d',
            'menus' => 'c,r,u,d',
            'pages' => 'c,r,u,d',
            'posts' => 'c,r,u,d',
            'media' => 'r',
            'profile' => 'r,u'
        ],
        'admin' => [
            'categories' => 'c,r,u',
            'languages' => 'c,r,u',
            'products' => 'c,r,u',
            'settings' => 'r',
            'skills' => 'c,r,u,d',
            'translations' => 'c,r,u,d,e',
            'translation-groups' => 'c,r,u,d',
            'users' => 'c,r,u',
            'menus' => 'c,r,u',
            'pages' => 'c,r,u',
            'posts' => 'c,r,u',
            'media' => 'r',
            'profile' => 'r,u'
        ],
        'operator' => [
            'products' => 'c,r,u,d',
            'skills' => 'c,r,u,d',
            'translations' => 'c,r,u,d,e',
            'translation-groups' => 'c,r,u,d',
            'menus' => 'r',
            'pages' => 'r',
            'posts' => 'c,r,u',
            'media' => 'r',
            'profile' => 'r,u'
        ],
    ],
    'permissions_map' => [
        'c' => 'create',
        'r' => 'read',
        'u' => 'update',
        'd' => 'delete',
        'e' => 'export'
    ]
];
