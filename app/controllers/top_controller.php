<?php
class TopController extends AppController {

  var $name = 'Top';
  var $uses = array();

  function index(){

  }

  function login(){
    $this->redirect('/admin/settings');
  }
}
?>