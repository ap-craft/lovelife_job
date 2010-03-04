<?php
class AdminAuthComponent extends Object {
  /**
   * before filter
   */
   
  var $is_loggedin = false;
  
  public function startup(&$controller) {

	if (!preg_match("/^" . Configure::read('Routing.admin')  . "_/i", $controller->action)) {
	  return;
	}
	
	$user = env('PHP_AUTH_USER');
	$pass = env('PHP_AUTH_PW');
	
	if (empty($user) || empty($pass)) {
	  $this->unauthorized($controller);
	  
	} else {
	  if (!$this->auth($user, $pass)) {
		$this->forbidden($controller);
	  }else{
	  	$controller->layout = 'admin';
	  	$this->is_loggedin = true;
	  	$controller->is_admin = true;
	  }
	}
  }
  /**
   * unauthorized
   *
   * @param  object Controller $controller
   */
  protected function unauthorized($controller) {
	header("WWW-Authenticate: Basic realm=\"Please Enter Your Password\"");
	$controller->redirect(null, 401, false);
	echo "Authorization Required";
	exit;
  }
  /**
   * forbidden
   *
   * @param  object Controller $controller
   */
  protected function forbidden($controller) {
	$controller->redirect(null, 403, false);
	echo "Authorization Required";
	exit;
  }
  /**
   * auth
   *
   * @param  string $user
   * @param  string $pass
   * @return boolean
   */
  protected function auth($user, $pass) {
	$hash = sha1($user . $pass . Configure::read('Security.salt'));
	//echo $hash;
	return $hash === ADMIN_AUTH_HASH;
  }
}
?>