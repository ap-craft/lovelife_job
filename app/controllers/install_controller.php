<?php
class InstallController extends AppController {

	var $name = 'Install';
	var $uses = array("Page");

	function index() {
		$query = file_get_contents(ROOT. DS . 'install_sqlite.sql');
		$this->db->query($query);
		exit();
	}


}
?>