<?php
/*
*
*	PageController
*
*/

class PageController extends AppController {

	var $name = 'page';
	var $uses = array("Page");
	var $helpers = array("Session","Javascript","Text");
	var $components = array('Qdmail');

	function index($url = '',$option = '') {

		if($url == ''){
			$this->render('/general/nopage');
			return;
		}

		$page = $this->Page->findByUrl($url);

		if(!isset($page['Page'])){
			$this->render('/general/nopage');
			return;
		}

		$this->set('page',$page);

		//ページの一部として出力する際に便利（サイドバーとか）こめんと追加
		if($page['Page']['parent_id'] == 0)
			$this->set('sub_menu',$this->Page->generateSubMenu($page['Page']['id']));
		else
			$this->set('sub_menu',$this->Page->generateSubMenu($page['Page']['parent_id']));
	}

	function admin_index($page = 1) {
		$this->set("page_data",$this->Page->findAll("",null,"Page.created",$this->admin_num_rows,$page));

		//ページング関連の処理
		$count = $this->Page->findCount();
		$this->set('pages',ceil($count / $this->admin_num_rows));
		$this->set('page',$page);
		$this->set('page_url','/admin/page/index/');
	}

	function admin_edit($id=null){

		if(empty($this->data))
			$this->data = $this->Page->findById($id);
		else{

			$this->Page->create($this->data);
			$this->Page->validates();

			$validationResult = $this->Page->validationErrors;

			if(!empty($validationResult['url']) && $validationResult['url'] == 'unique'){
				$Page = $this->Page->findByUrl($this->data['Page']['url']);

				if($Page['Page']['id'] == $this->data['Page']['id']){
					unset($validationResult['url']);
				}
			}

			if (empty($validationResult)) {
				$this->data['Page']['modified'] = date("Y-m-d H:i:s");

				//元データとマージする
				$old_data = $this->Page->findById($id);
				$this->data = am($old_data['Page'],$this->data['Page']);
				$this->Page->save($this->data,false);
				$this->redirect(array('controller'=>'page','action'=>'index'));
			}else{

			}

		}

		$this->set('page_types',$this->Page->getTypes());
		$this->set('parents',$this->Page->getParents());
	}

	function admin_delete($id=null){
		if(!empty($id)){
			$this->Page->delete($id);
			$this->redirect(array('controller'=>'page','action'=>'index'));
		}
	}

	function admin_new() {

		if(!empty($this->data)){

			$this->Page->create($this->data);
			$this->Page->validates();

			$validationResult = $this->Page->validationErrors;

			if (empty($validationResult)) {

				$this->data['Page']['created'] = date("Y-m-d H:i:s");

				$this->Page->save($this->data);
				$this->redirect(array('controller'=>'page','action'=>'index'));
			}

		}

		$this->set('page_types',$this->Page->getTypes());
		$this->set('parents',$this->Page->getParents());
	}
}
?>