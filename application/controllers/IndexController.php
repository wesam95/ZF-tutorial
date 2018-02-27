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
  
        $artist = $this->getRequest()->getPost('artist');
        $title = $this->getRequest()->getPost('title');
        $albums = new Application_Model_DbTable_Albums();
        $albums->addAlbum($artist, $title);
        $id = $albums->getAdapter()->lastInsertId();
        $result = $albums->getAlbum($id);
        $data = '<tr id="'.$result['id'].'">'
          .'<td class= "title">'.$result['title'].'</td>'
          .'<td class= "artist">'.$result['artist'].'</td>'
          .'<td><a id= "edit" role= "button" data-toggle= "modal" data-target= "#updateForm">Edit</a>' 
          .'<a id= "delete" role= "button" data-toggle= "modal" data-target= "#deleteForm">Delete</a></td></tr>' ;
        $this->_helper->json($data);

        
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
        $id = $this->_getParam('id');
        $albums = new Application_Model_DbTable_Albums();
        $result = $albums->getAlbum($id);
        $this->_helper->json($result);      
    }

    public function removeAction()
    {
        $id= $this->_getParam('id');
        $albums = new Application_Model_DbTable_Albums();
        $result= $albums->getAlbum($id);
        $result2= $albums->deleteAlbum($id);
        $this->_helper->json($result);        

    }
}







