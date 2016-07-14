<?php

/**
 * Login Model
 */
class Dashboard_Model extends Model {

    function __construct() {
        parent::__construct();

        // echo "this is login model\n";
    }

    // Login User     
    function getAllData($postData) {
        return $postData;
    }

}

?>