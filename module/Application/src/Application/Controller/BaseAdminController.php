<?php

namespace Application\Controller;

class BaseAdminController extends BaseController
{
	protected $entityManager;
	
    public function onDispatch(\Zend\Mvc\MvcEvent $e)
    {
		return parent::onDispatch($e);
    }
}
