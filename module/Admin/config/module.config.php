<?php

return array(

	'controllers' => array(
		'invokables' => array(
			'Admin\Controller\Index' => 'Admin\Controller\IndexController',
			'category' => 'Admin\Controller\CategoryController',
		),
	), // controllers
	
	'router' => array(
		'routes' => array(		
			'admin' => array(
				'type' => 'literal',
				'options' => array(
					'route' => '/admin/',
					'defaults' => array(
						'controller' => 'Admin\Controller\Index',
						'action' => 'index',
					),
				),
				
				'may_terminate' => true,
			
				'child_routes' => array(
					'category' => array(
						'type' => 'segment',
						'options' => array(
							'route' => 'category/[:action/][:id/]',
							'defaults' => array(
								'controller' => 'category',
								'action' => 'index',
							),
						),
					), // category
				), // child_routes
			), // admin			
		),
	),
	
	'service_manager' => array(
		'factories' => array(
			'navigation' => 'Zend\Navigation\Service\DefaultNavigationFactory',
			'admin_navigation' => 'Admin\Lib\AdminNavigationFactory',
		),
	),
	
	'navigation' => array(
		'default' => array(
			array(
				'label' => 'Главная',
				'route' => 'home',
			),
		),
		'admin_navigation' => array(
			array(
				'label' => 'Панель управления сайтом',
				'route' => 'admin',
				'action' => 'index',
				'resource' => 'Admin\Controller\Index',
				
				'pages' => array(
					array(
						'label' => 'Категории',
						'route' => 'admin/category',
						'action' => 'index',
					),
					array(
						'label' => 'Добавить категорию',
						'route' => 'admin/category',
						'action' => 'create',
					),
				),
			),
		),
	),
	
	'view_manager' => array(
		'template_path_stack' => array(
			__DIR__ . '/../view',
		),
	),
	
);