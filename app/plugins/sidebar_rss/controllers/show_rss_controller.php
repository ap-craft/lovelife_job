<?php

class ShowRssController extends SidebarRssAppController
{
    var $name = 'ShowRss';
	var $uses = array('SidebarRss.Rss');

    function index($id = '')
    {
    	$this->layout = false;

    	if($id == ''){
			$this->render('/general/nopage');
			return;
		}
		
		$rss = $this->Rss->findById($id);
		
		if(!isset($rss['Rss'])){
			$this->render('/general/nopage');
			return;
		}
		
		//RSSの読み込み
		App::import('Vendor', 'rss_fetch',array('file' => 'magpierss/rss_fetch.inc'));
		$rss_fetched = fetch_rss($rss['Rss']['url']);
		
		$this->set('rss',$rss);	
		$this->set('rss_fetched',$rss_fetched);
    }
}

?>