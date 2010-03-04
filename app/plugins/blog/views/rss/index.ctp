<?php
	
	$output = $rss->items($article, 'transformRSS');
	
	function transformRSS($data) {
	
		return array(
			'title' => $data['Article']['title'],
			'link' => HOST . '[base]/blog/entry/' . $data['Article']['url'],
			'guid' => $data['Article']['id'],
			'description' => strip_tags($data['Article']['content']),
			'author' => "[blog.author]",
			'pubDate' => $data['Article']['created']
		);
		
	}
	
	//固定値の変換
	$output = str_replace("[blog.description]",$Settings['blog.description'],$output);
	$output = str_replace("[blog.author]",$Settings['blog.description'],$output);
	$output = str_replace("[base]",$manjuuHtml->base,$output);
	
	echo $output;
?>