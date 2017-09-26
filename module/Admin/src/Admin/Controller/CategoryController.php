<?php

namespace Admin\Controller;

use Application\Controller\BaseAdminController as BaseController;
use Admin\Form\CategoryCreateForm;
use Admin\Form\CategoryEditForm;
use News\Entity\Category as Category;

class CategoryController extends BaseController
{
	// R - Read
    public function indexAction()
    {
		$query = $this->getEntityManager()->createQuery('SELECT u FROM News\Entity\Category u ORDER BY u.id DESC');
		$rows = $query->getResult();
				
		return array('categories' => $rows);
    }
	
	// C - Create
	public function createAction()
    {
		$form = new CategoryCreateForm;
		$status = $message = '';
		$em = $this->getEntityManager();

		$request = $this->getRequest();		
		if ($request->isPost())
		{
			$form->setData($request->getPost());
			if ($form->isValid())
			{
				$category = new Category();
				$category->exchangeArray($form->getData());
				
				$em->persist($category);
				$em->flush();
				
				$status = 'success';
				$message = 'Категория добавлена';
			}
			else {
				$status = 'error';
				$message = 'Ошибка параметров';
			}
		}
		else {
			return array('form' => $form);
		}
		
		if ($message)
		{
			$this->flashMessenger()
					->setNamespace($status)
					->addMessage($message);
		}
		
		return $this->redirect()->toRoute('admin/category');
    }

	// U - Update
	public function editAction()
    {
		$message = $status = '';
		$em = $this->getEntityManager();
		$form = new CategoryEditForm();

		$id = (int) $this->params()->fromRoute('id', 0);
		
		$category = $em->find('News\Entity\Category', $id);
		if (empty($category))
		{
			$message = 'Категория не найдена';
			$status = 'error';
			$this->flashMessenger()
					->setNamespace($status)
					->addMessage($message);
			return $this->redirect()->toRoute('admin/category');
		}
		
		$form->bind($category);
		
		$request = $this->getRequest();
		if ($request->isPost())
		{
			$form->setData($request->getPost());
			if ($form->isValid())
			{				
				$em->persist($category);
				$em->flush();
				
				$status = 'success';
				$message = 'Категория обновлена';
			}
			else {
				$status = 'error';
				$message = 'Ошибка параметров';
				
				foreach ($form->getInputFilter()->getInvalidInput() as $errors) {
					foreach ($errors->getMessages() as $error) {
						$message .= ' ' . $error;
					}
				}
			}
		}
		else {
			return array('form' => $form, 'id' => $id);
		}
		
		if ($message)
		{
			$this->flashMessenger()
					->setNamespace($status)
					->addMessage($message);
		}
		
		return $this->redirect()->toRoute('admin/category');
	}

	// D - Delete
	public function deleteAction()
    {
		$id = (int) $this->params()->fromRoute('id', 0);
		$em = $this->getEntityManager();
		
		$status = 'success';
		$message = 'Запись удалена';
		
		try	{
			$repo = $em->getRepository('News\Entity\Category');
			$category = $repo->find($id);
			$em->remove($category);
			$em->flush();
		}
		catch (\Exception $ex) {
			$status = 'error';
			$message = 'Ошибка удаления записи: ' . $ex->getMessage();
		}
		
		$this->flashMessenger()
				->setNamespace($status)
				->addMessage($message);				
		
		return $this->redirect()->toRoute('admin/category');
	}
}












