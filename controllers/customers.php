<?php

/**
 * Dashboard Controller
 */
class Customers extends Controller {

    function __construct() {
        parent::__construct();

        // echo "this is login controller"."\n";
    }

    function getStats($method, $postData) {
        $this->loadModelMethod($method, $postData);
    }

    function getList($method, $postData) {

        // getting the user id by using the name
        $user = $this->getIdByName($postData['loggedInUser']);

        $toSendData['userid'] = $user[0]['uid'];
        $toSendData['data'] = $postData['res'];


//        print_r($toSendData);
        // Sending the Object to insert into Database
        $response = $this->loadModelMethod($method, $toSendData);
//        print_r($response);

        if ($response['status'] == 'success') {
            echo json_encode($response);
        } else {
            echo json_encode($response);
        }
    }

    function insertCustomer($method, $postData) {
        $toSendData = array();
        // getting the user id by using the name
        $user = $this->getIdByName($postData['loggedInUser']);
//        print_r($user);
        $toSendData['userid'] = $user[0]['uid'];
        $toSendData['action'] = "Inserting";
        $toSendData['data'] = $postData['res'];

        // Sending the Object to insert into Database
        $response = $this->loadModelMethod($method, $toSendData);

//        print_r($response);

        echo json_encode($response);
    }

    function updateCustomer($method, $postData) {
        $toSendData = array();
        // getting the user id by using the name
        $user = $this->getIdByName($postData['loggedInUser']);
//        print_r($user);
        $toSendData['userid'] = $user[0]['uid'];
        $toSendData['action'] = "Updating";
        $toSendData['data'] = $postData['res'];

        // Sending the Object to insert into Database
        $response = $this->loadModelMethod($method, $toSendData);

        echo json_encode($response);
    }

    function deleteCustomer($method, $postData) {
//        echo "DELETE FROM MyGuests WHERE id=3";
        $toSendData = array();
        // getting the user id by using the name
        $user = $this->getIdByName($postData['loggedInUser']);
//        print_r($user);
        $toSendData['userid'] = $user[0]['uid'];
        $toSendData['action'] = "Deleting";
        $toSendData['data'] = $postData['res'];

        // Sending the Object to insert into Database
        $response = $this->loadModelMethod($method, $toSendData);

        echo json_encode($response);
    }

}

?>