<?php 
/**
* Dashboard Controller
*/
class Getdata extends Controller
{
	
	function __construct() {
        parent::__construct();

        // echo "this is login controller"."\n";
    }

    function getList($method, $postData){
//        print_r($method);
        $toSendData = array();
        // getting the user id by using the name
        $user = $this->getIdByName($postData['loggedInUser']);
//        print_r($user);
        $toSendData['userid'] = $user[0]['uid'];
        $toSendData['action'] = "Getting Data";
        $toSendData['data'] = $postData['res'];
                
    	$response = $this->loadModelMethod($method, $toSendData);
//        print_r($response);
        
        echo json_encode($response);
    }
    
}
 ?>