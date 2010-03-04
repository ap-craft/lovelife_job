<?php

class IndexController extends ContactAppController
{
    var $name = 'Index';
	var $uses = array('Contact.ContactForm');
	var $components = array('Qdmail');
	
    function index()
    {
    	
       	if(isset($this->data)){

			$this->ContactForm->create($this->data);
			$this->ContactForm->validates();
			
			$validationResult = $this->ContactForm->validationErrors;
			
			if (empty($validationResult)) {
				
				//メールの送信
				$this->_sendMail('コンタクトフォームから送信されました。',$this->settings['contact.emailaddress'],'まんじゅうCMSコンタクトフォーム');
				
				$this->render('finish');
			}
    	}
    	
    	//スパム対策用の数字を決定
		$this->_setMagicWord();
    }
}

?>