<?php

class OperationController extends SidebarRssAppController
{
    var $name = 'Operation';
	var $uses = array('SidebarRss.Rss');
	
	function admin_list(){
		$this->set('rsses',$this->Rss->findAll());
	}

	function admin_new() {
		if(!empty($this->data)){
		
			$this->Rss->create($this->data);
			$this->Rss->validates();
			
			$validationResult = $this->Rss->validationErrors;
			
			if (empty($validationResult)) {
				
				$this->data['Rss']['created'] = date("Y-m-d H:i:s");
				
				$this->Rss->save($this->data);
				$this->redirect(array('controller'=>'operation','action'=>'list'));
			}
			
		}
	}
	
	function admin_edit($id = null){
		
		if(!empty($id)){
			
			if(empty($this->data))
				$this->data = $this->Rss->findById($id);
			else{
	
				$this->Rss->create($this->data);
				$this->Rss->validates();
				
				$validationResult = $this->Rss->validationErrors;
				
				if (empty($validationResult)) {
					
					$this->data['Rss']['modified'] = date("Y-m-d H:i:s");
					
					$old_data = $this->Rss->findById($id);
					$marged_data = am($old_data['Rss'],$this->data['Rss']);
					
					$this->Rss->save($marged_data,false);
					
					$this->redirect(array('controller'=>'operation','action'=>'list'));
				}else{
					
				}
			}
			
		}
	}

	function admin_delete($id=null){
		if(!empty($id)){
			$this->Rss->delete($id);
			$this->redirect(array('controller'=>'operation','action'=>'list'));
		}
	}
}

?>