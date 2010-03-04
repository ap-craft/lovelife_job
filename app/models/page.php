<?php
class Page extends AppModel {

	var $name = 'Page';
	
	//メニューに表示されるページ
	const TYPE_MENU = 1;
	
	//メニューからは非表示のページ
	const TYPE_INDIVIDUAL = 2;

	//リンクのみのページ
	const TYPE_LINK = 3;
	
	var $hasMany = array('SubPages' =>
		array('className'  => 'Page',
			'conditions' => '',
			'order'      => 'SubPages.sort',
			'foreignKey' => 'parent_id'
		)
	);
	

    var $validate = array(
        'title' => array(
            'required' => VALID_NOT_EMPTY
        ),
        'content' => array(
            'required' => VALID_NOT_EMPTY
        ),
        'sort' => array(
            'numeric' => array('rule' => array('numeric')),
            'required' => VALID_NOT_EMPTY,
        ),
        'url' => array(
        	'unique' => array('rule' => array('unique')),
            'rule2' => array('rule' => array('minLength', 5)),
            'rule1' => array('rule' => array('custom','/^[0-9a-z-_:\/\.]+$/i')),
            'required' => VALID_NOT_EMPTY
        )
    );

  	function unique($field){

		foreach( $field as $key => $value ){

			$found = $this->query("select * from pages where url = '{$value}'");

			if(count($found) == 0)
				return true;
			else
				return false;
		}
	}
	
	//メニュー作成用のデータ取得
	function generateMenu(){
		$data = $this->find('all',array('conditions'=>"Page.parent_id = 0 and Page.type != 2",'fields'=>array('Page.url', 'Page.title', 'Page.type'),'order'=>'Page.sort asc'));
		return $data;
	}

	//サブメニュー作成用のデータ取得
	function generateSubMenu($parent_id){
		$data = $this->find('all',array('conditions'=>"Page.parent_id = {$parent_id} and Page.type != 2",'fields'=>array('Page.url', 'Page.title', 'Page.type'),'order'=>'Page.sort asc'));
		return $data;
	}
	
	//ページタイプ選択のセレクトボックスデータを返す
	function getTypes(){
		$types = array(
			Page::TYPE_MENU => '通常ページ',
			Page::TYPE_INDIVIDUAL => '独立ページ',
			Page::TYPE_LINK => 'リンクページ',
		);
		
		return $types;
	}
	
	//親記事対象となるページを取得
	function getParents(){
		$pages = $this->find('list',array('conditions'=>"Page.parent_id = 0",'fields'=>array('id','title'),'order'=>'Page.sort asc'));
		$pages[0] = '親なし';
		ksort($pages);
		
		return $pages;
	}
}
?>