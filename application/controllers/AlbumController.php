<?php

class AlbumController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function listerAction()
    {
    	$this->view->title = "Albums";
    	
    	$Album = new Application_Model_DbTable_Albums();
    	
    	if ($this->_request->isPost())
    	{
    		$deleteId = $this->_request->getPost('deleteId');
    		$Album->delete(array('id = ?' => $deleteId));
    	}
        
        $this->view->albums = $Album->fetchAll(null, 'id desc');
    }

    public function modifierAction()
    {
    	$this->view->title = "Modifier Album";
    	
    	$Form = new Application_Form_Album();
        $Form->envoyer->setLabel('Modifier');
        $this->view->form = $Form;

        $id = $this->_getParam('id', 0);
        
        $Album = new Application_Model_DbTable_Albums();
        
        if ($this->_request->isPost())
        {
        	$postData = $this->_request->getPost();
        	if ($Form->isValid($postData))
        	{
        		$formData = $Form->getValues();
        		
        		$Album->update($formData, array('id = ?' => $id));
        		
        		$this->_helper->getHelper('Redirector')->gotoSimple('lister', 'album');
        	}
        	else 
        	{
        		$Form->populate($postData);
        	}
        }
        else
       {
        	$data = $Album->find($id)->toArray();
        	$Form->populate($data[0]);	
        }
    }

    public function ajouterAction()
    {
    	$this->view->title = "Ajouter Album";
    	
        $Form = new Application_Form_Album();
        $Form->envoyer->setLabel('Ajouter');
        $this->view->form = $Form;

        if ($this->_request->isPost())
        {
        	$postData = $this->_request->getPost();
        	if ($Form->isValid($postData))
        	{
        		$formData = $Form->getValues();
        		
        		$Album = new Application_Model_DbTable_Albums();
        		$Album->insert($formData);
        		
        		$this->_helper->getHelper('Redirector')->gotoSimple('lister', 'album');
        	}
        	else 
        	{
        		$Form->populate($postData);
        	}
        }
    }


}







