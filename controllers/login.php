<?php 
/**
* Login Controller
*/
class Login extends Controller
{
	
	function __construct() {
        parent::__construct();

        // echo "this is login controller"."\n";
    }

    function loginUser($method, $postData){
    	$this->loadModelMethod($method, $postData);
    }
    
}
 ?>