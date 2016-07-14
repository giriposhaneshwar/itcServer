<?php

/**
 * Dashboard Controller
 */
class Reports extends Controller {

    function __construct() {
        parent::__construct();

        // echo "this is login controller"."\n";
    }

    function getAllReports($method, $postData) {
        // getting the user id by using the name
        $user = $this->getIdByName($postData['loggedInUser']);

        $toSendData['userid'] = $user[0]['uid'];
        $toSendData['data'] = $postData['res'];

//        print_r($toSendData);
        // Sending the Object to insert into Database
        $response = $this->loadModelMethod($method, $toSendData);
        $response['userInfo'] = $user[0];
        // print_r($response);
        echo json_encode($response);
    }

    function getCustomerPayList($method, $postData) {
        // getting the user id by using the name
        $user = $this->getIdByName($postData['loggedInUser']);

        $toSendData['userid'] = $user[0]['uid'];
        $toSendData['data'] = $postData['res'];

//        print_r($toSendData);
        // Sending the Object to insert into Database
        $response = $this->loadModelMethod($method, $toSendData);
        $response['userInfo'] = $user[0];
        // print_r($response);
        echo json_encode($response);
    }

    function getCustomerPayLog($method, $postData) {
        // getting the user id by using the name
        $user = $this->getIdByName($postData['loggedInUser']);

        $toSendData['userid'] = $user[0]['uid'];
        $toSendData['data'] = $postData['res'];

//        print_r($toSendData);
        // Sending the Object to insert into Database
        $response = $this->loadModelMethod($method, $toSendData);
        $response['userInfo'] = $user[0];
        // print_r($response);
        echo json_encode($response);
    }

    function addPayment($method, $postData) {
        // getting the user id by using the name
        $user = $this->getIdByName($postData['loggedInUser']);

        $toSendData['userid'] = $user[0]['uid'];
        $toSendData['data'] = $postData['res'];

//        print_r($toSendData);
        // Sending the Object to insert into Database
        $response = $this->loadModelMethod($method, $toSendData);
        $response['userInfo'] = $user[0];
//         print_r($response);
        echo json_encode($response);
    }

    function deleteRecord($method, $postData) {
        // getting the user id by using the name
        $user = $this->getIdByName($postData['loggedInUser']);

        $toSendData['userid'] = $user[0]['uid'];
        $toSendData['data'] = $postData['res'];

//        print_r($toSendData);
        // Sending the Object to insert into Database
        $response = $this->loadModelMethod($method, $toSendData);
        $response['userInfo'] = $user[0];
        // print_r($response);
        echo json_encode($response);
    }

}

?>