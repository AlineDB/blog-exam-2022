<?php
return [
    [
        'method' => 'POST',
        'action' => 'store',
        'resource' => 'post',
        'controller' => 'PostController',
        'callback' => 'store',
    ],
    [
        'method' => 'GET',
        'action' => 'show',
        'resource' => 'post',
        'controller' => 'PostController',
        'callback' => 'show',
    ],
    [
        'method' => 'GET',
        'action' => 'index',
        'resource' => 'post',
        'controller' => 'PostController',
        'callback' => 'index',
    ],
    [
        'method' => 'GET',
        'action' => 'create',
        'resource' => 'post',
        'controller' => 'PostController',
        'callback' => 'create',
    ],
    //permet d'accéder au form de login
    [
        'method' => 'GET',
        'action' => 'login',
        'resource' => 'auth',
        'controller' => 'SessionController',
        'callback' => 'create',
    ],
    [
        'method' => 'POST',
        'action' => 'login',
        'resource' => 'auth',
        'controller' => 'SessionController',
        'callback' => 'store',
    ],
    [
        'method' => 'POST',
        'action' => 'logout',
        'resource' => 'auth',
        'controller' => 'SessionController',
        'callback' => 'destroy',
    ],
    [
        'method' => 'GET',
        'action' => 'index',
        'resource' => 'rss',
        'controller' => 'RssController',
        'callback' => 'index',
    ],
    [
        'method' => 'GET',
        'action' => 'edit',
        'resource' => 'profile',
        'controller' => 'ProfileController',
        'callback' => 'edit',
    ],
    [
        'method' => 'POST',
        'action' => 'update',
        'resource' => 'profile',
        'controller' => 'ProfileController',
        'callback' => 'update',
    ],
    [
        'method' => 'POST',
        'action' => 'store',
        'resource' => 'api_post',
        'controller' => 'TokenController',
        'callback' => 'store',
    ],
    [
        'method' => 'POST',
        'action' => 'create',
        'resource' => 'api_post',
        'controller' => 'TokenController',
        'callback' => 'create',
    ],
];