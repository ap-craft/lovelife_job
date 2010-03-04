<?php
class SettingsController extends AppController {

	var $name = 'Settings';
	var $uses = array('Setting');
	var $num_rows = 10;

	function index() {

	}

	function admin_index(){

		if($this->Session->check('message')){
			$this->set('message',$this->Session->read('message'));
			$this->Session->delete('message');
		}
		
		if(empty($this->data)){
			
			//セッティングデータの取得
			$this->data = array('Setting' => $this->Setting->getValues());
			
			
		}
		else{

			$this->Setting->create($this->data);
			$this->Setting->validates();
			
			$validationResult = $this->Setting->validationErrors;
			

			if (empty($validationResult)) {
				
				//値の保存
				$this->Setting->saveValues($this->data);
				
				
			}
			
		}
	}

}
?>