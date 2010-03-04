<?php
class ManjuuTextHelper extends TextHelper {
	
	function truncate($text,$limit=25,$tail=''){
		
		$encoding = Configure::read('App.encoding');
		$result = mb_substr($text,0,$limit,$encoding);
		
		if(mb_strlen($text,$encoding) > $limit)
			$result .= $tail;
		
		return $result;
	}
}
?>