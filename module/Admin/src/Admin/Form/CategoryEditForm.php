<?php

namespace Admin\Form;

use Zend\Form\Form;
//use Zend\InputFilter\Factory as InputFactory;
//use Zend\InputFilter\InputFilter;

//use \Admin\Filter\CategoryEditInputFilter;

class CategoryEditForm extends Form
{
    public function __construct($name = null)
    {
		parent::__construct('categoryEditForm');
		$this->setAttribute('method', 'post');
		$this->setAttribute('class', 'bs-example form-horizontal');
		
		//$this->setInputFilter(new CategoryEditInputFilter());
		
		$this->add(array(
			'name' => 'categoryKey',
			'type' => 'Text',
			'options' => array(
				'min' => 3,
				'max' => 100,
				'label' => 'Ключ',
			),
			'attributes' => array(
				'class' => 'form-control',
				'required' => 'required',
			),
		));
		
		$this->add(array(
			'name' => 'categoryName',
			'type' => 'Text',
			'options' => array(
				'min' => 3,
				'max' => 100,
				'label' => 'Наименование',
			),
			'attributes' => array(
				'class' => 'form-control',
				'required' => 'required',
			),
		));
		
		$this->add(array(
			'name' => 'submit',
			'type' => 'Submit',
			'options' => array(
				'label' => ' ',
			),
			'attributes' => array(
				'value' => 'Обновить',
				'id' => 'btn_submit',
				'class' => 'btn btn-primary'
			),
		));
    }
}
