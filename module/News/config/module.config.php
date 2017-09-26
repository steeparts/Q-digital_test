<?php

return array(

	'doctrine' => array(
        'driver' => array(
            'news_entity' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__ . '/../src/News/Entity',
                ),
            ),

            // default metadata driver, aggregates all other drivers into a single one.
            // Override `orm_default` only if you know what you're doing
            'orm_default' => array(
                'drivers' => array(
                    'News\Entity' => 'news_entity',
                ),
            ),
        ),
    ),

	'controllers' => array(
		'invokables' => array(
			'News\Controller\Index' => 'News\Controller\IndexController',
		),
	),
	
	'router' => array(
		'routes' => array(
			'news' => array(
				'type' => 'segment',
				'options' => array(
					'route' => '/[:action/][:id/]',
					'constraints' => array(
						'action' => '[a-zA-Z][a-zA-Z0-9_-]*',
						'id' => '[0-9]+',
					),
					'defaults' => array(
						'controller' => 'News\Controller\Index',
						'action' => 'index',
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