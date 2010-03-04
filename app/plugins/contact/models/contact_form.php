<?php
class ContactForm extends ContactAppModel {

	var $name = 'ContactForm';
	var $useTable = false;

    var $validate = array(
        'name' => array(
            'required' => VALID_NOT_EMPTY
        ),
        'email' => array(
        	'email' => array('rule' => array('email')),
            'required' => VALID_NOT_EMPTY
        ),
        'body' => array(
            'required' => VALID_NOT_EMPTY
        ),
        'magic_number' => array(
        	'wrong_answer' => array('rule' => array('check_answer')),
        )
    );
}
?>