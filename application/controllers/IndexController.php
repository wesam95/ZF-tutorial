<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        $albums = new Application_Model_DbTable_Albums();
        $this->view->albums = $albums->fetchAll();  
    }

    public function addAction()
    {
  
        $artist = $this->_getParam('artist');
        $title = $this->_getParam('title');
        $albums = new Application_Model_DbTable_Albums();
        $albums->addAlbum($artist, $title);
        $id = $albums->getAdapter()->lastInsertId();
        $result = $albums->getAlbum($id);
        $this->_helper->redirector('index');
        $this->_helper->json($result);

        
    }

    public function editAction()
    {

        $id = $this->_getParam('id', 0);
        if ($id > 0) {
        $albums = new Application_Model_DbTable_Albums();
        $result = $albums->getAlbum($id);
        $this->_helper->json($result);        
    }
}

    public function saveAction()
    {
        
        $id = (int)$this->_getParam('id');
        $artist = $this->_getParam('artist');
        $title = $this->_getParam('title');
        $albums = new Application_Model_DbTable_Albums();
        $albums->updateAlbum($id, $artist, $title);
        $result = $albums->getAlbum($id);
        $this->_helper->json($result);
}

    public function deleteAction()
    {
        if ($this->getRequest()->isPost()) {
        $del = $this->getRequest()->getPost('del');
        if ($del == 'Yes') {
        $id = $this->getRequest()->getPost('id');
        $albums = new Application_Model_DbTable_Albums();
        $albums->deleteAlbum($id);
        }
        $this->_helper->redirector('index');
        } else {
        $id = $this->_getParam('id', 0);
        $albums = new Application_Model_DbTable_Albums();
        $this->view->album = $albums->getAlbum($id);
        } 
    }
}







