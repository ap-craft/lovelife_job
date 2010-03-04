<?php

class OperationController extends ContactAppController
{
    var $name = 'Operation';
  var $uses = array();

  function admin_settings(){

    $message = "";

    if(!empty($this->data)){

      $this->Setting->create($this->data);
      $this->Setting->validates();

      $validationResult = $this->Setting->validationErrors;

      if (empty($validationResult)) {

        $hash = $this->data['contact'];

        foreach($hash as $key => $value){
          $this->Setting->setValue('contact.' . $key,$value);
        }

        $message = "設定が完了しました。";
      }
    }else{
      $tmp = $this->Setting->readAllValue();
      foreach($tmp as $key => $value){
        if(ereg('contact',$key)){
          $key = str_replace('contact.','',$key);
          $this->data['contact'][$key] = $value;
        }
      }
    }

  }

}

?>