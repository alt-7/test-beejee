<?php

return [
    // MainController
	'' => [
		'controller' => 'main',
		'action' => 'index',
	],
	'main/index/{page:\d+}' => [
		'controller' => 'main',
		'action' => 'index',
	],
    '(\?+(sort)\=[a-z-]+)' => [
        'controller' => 'main',
        'action' => 'index',
    ],
    'main/index/{page:\d+}(\?+(sort)\=[a-z-]+)' => [
        'controller' => 'main',
        'action' => 'index',
    ],
	'add' => [
        'controller' => 'main',
        'action' => 'add',
    ],
    'main/list' => [
        'folder' => 'ajax',
        'controller' => 'main',
        'action' => 'list',
    ],
	'sandbox/index' => [
		'controller' => 'sandbox',
		'action' => 'index',
	],
	// AdminController
	'admin/login' => [
		'controller' => 'admin',
		'action' => 'login',
	],
	'admin/logout' => [
		'controller' => 'admin',
		'action' => 'logout',
	],
	'admin/edit/{id:\d+}' => [
		'controller' => 'admin',
		'action' => 'edit',
	],
	'admin/tasks/{page:\d+}' => [
		'controller' => 'admin',
		'action' => 'tasks',
	],
	'admin/tasks' => [
		'controller' => 'admin',
		'action' => 'tasks',
	],
];
