<?php
class Setting extends AppModel {

	var $name = 'Setting';

    var $validate = array(
        'site_name' => array(
             'required' 	=> 	VALID_NOT_EMPTY
        )
    );

   	function getValue($key){
   		$result = $this->findByKey($key);
   		return $result['Setting']['value'];
   	}
   	
   	function setValue($key,$value){
   		
   		$result = $this->findByKey($key);
   		
   		if(empty($result)){
   			$data = array('key'=>$key,'value'=>$value,'created'=>date("Y-m-d h:i:s"));
   			$this->create($data);
   			$this->save($data);
   		}else{
   			$data = $result['Setting'];
   			$data['modified'] = date("Y-m-d h:i:s");
   			$data['value'] = $value;
   			$this->save($data);
   		}
   		
   	}
   	
   	function readAllValue(){
   		$values = $this->findAll();
   		$data = array();
   		foreach($values as $line){
   			$data[$line['Setting']['key']] = $line['Setting']['value'];
   		}
   		return $data;
   	}
   	
    function getValues(){
    	
    	$data = $this->findAll();
    	
    	$result = array();
    	
    	foreach($data as $row){
    		$result[$row['Setting']['key']] = $row['Setting']['value'];
    	}
    	
    	return $result;
    }
    
    function saveValues($data){
    
    	foreach($data['Setting'] as $key => $value){

    		$savedData = $this->findByKey($key);
    		
    		//新規の値の場合
    		if(!isset($savedData['Setting'])){
    			
    			$data = array(
    				'key' => $key,
    				'value' => $value,
    				'created' => date('Y-m-d H:i:s')
    			);
    			
    			$this->create();
    			$this->save($data);
    		}else{
    			
    			$savedData['Setting']['value'] = $value;
    			$savedData['Setting']['modified'] =date('Y-m-d H:i:s');
    			$this->save($savedData);
    		}
    	}
    }
}
?>