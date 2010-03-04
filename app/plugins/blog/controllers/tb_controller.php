<?php
class TbController extends AppController {

	var $name = 'Tb';
	var $uses = array('Blog.Article','Blog.Trackback');

	function beforeFilter(){
		Configure::write('debug', 0);
		parent::beforeFilter();
	}
	
	function index($article){
		
		$id = trim($id);
		
		$article = $this->Article->findByUrl($article);
		
		//ＩＤがない場合エラーとする。
		if(!isset($article['Article'])){
			$this->returnError("Entry not exist");
		}
		
		$url       = "";//トラックバックの送り元
		$title     = "";//タイトル
		$excerpt   = "";//内容
		$blog_name = "";//その記事について書いたブログ名
		
		//URLの取得
		if( isset( $_POST['url']) ){
			$url = $_POST['url'];
		}else if( isset( $_GET['url']) ){
			$url = $_GET['url'];
		}else{
			$this->returnError("url is empty");
		}
		
		//TITLEの取得
		if( isset( $_POST['title'])){
			$title = $_POST['title'];
		}else if( isset( $_GET['title'])){
			$title = $_GET['title'];
		}else{
			$this->returnError("title is empty");
		}
		$title = mysql_real_escape_string( trim($title));
		
		//本文の取得
		if( isset( $_POST['excerpt'])){
			$excerpt = $_POST['excerpt'];
		}else if( isset( $_GET['excerpt'])){
			$excerpt = $_GET['excerpt'];
		}
		$excerpt = strip_tags($excerpt);
		$excerpt = str_replace("\r\n","",$excerpt);
		$excerpt = str_replace("\n","",$excerpt);
		$excerpt = mysql_real_escape_string(trim($excerpt));
		
		//ブログ名
		if( isset( $_POST['blog_name'])){
			$blog_name = $_POST['blog_name'];
		}else if( isset($_GET['blog_name'])){
			$blog_name = $_GET['blog_name'];
		}
		
		$blog_name = mysql_real_escape_string(trim($blog_name));
		
		//文字コード変換
		$interenc = mb_internal_encoding();
		//internalエンコードが何かをチェック
		//echo $interenc; utf8強制にしてみる。
		mb_convert_variables("UTF-8", "UTF-8,EUC-JP,Shift_JIS,ASCII", $title, $excerpt, $url, $name);
	
		//文字カット
		$title   = mb_strimwidth($title   ,0, 100, "...","utf8");
		$excerpt = mb_strimwidth($excerpt ,0, 240, "...","utf8");
		$url     = mb_strimwidth($url     ,0, 240, "...","utf8");
		$blog_name    = mb_strimwidth($blog_name    ,0, 100, "...","utf8");		
		
		$data = array(
			"article_id"=>$article['Article']['id'],
			"title"=>$title,
			"excerpt"=>$excerpt,
			"url"=>$url,
			"blog_name"=>$blog_name,
			"created"=>date("Y-m-d H:i:s")
		);
		
		$this->Trackback->save($data);
		$this->log("Recieve TB : \n" . var_export($data,true) , LOG_DEBUG);
		
		header("Content-type: application/xml");
		echo "\n";
		echo "\n";
		echo "0\n";
		echo "\n";
		exit();
	}
	
	//エラーＸＭＬを送る
	function returnError( $msg ) {
		header("Content-type: application/xml");
		echo "\n";
		echo "\n";
		echo "1\n";
		echo "".$msg."\n";
		echo "\n";
		exit();
	}
	
}
?>