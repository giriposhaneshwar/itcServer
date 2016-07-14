<?php 
/**
* Dashboard Controller
*/
class Dashboard extends Controller
{
	
	function __construct() {
        parent::__construct();

        // echo "this is login controller"."\n";
    }

    function getStats($method, $postData){
    	$this->loadModelMethod($method, $postData);
    }
    
}
 ?>