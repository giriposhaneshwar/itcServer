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
    function getStats($postData) {
        echo "Getting the stats of dashboard";
        /* $sth = $this->db->prepare("SELECT * FROM user_accounts WHERE 
          username = :login AND password = :password LIMIT 1");
          $sth->execute(array(
          ':login' => $postData['username'],
          // ':password' => Hash::create('sha256', $_POST['password'], HASH_PASSWORD_KEY)
          ':password' => $postData['password']
          ));

          $data = $sth->fetch();

          $count =  $sth->rowCount();
          if ($count > 0) {
          // Login Success send the data to redirect the page
          $buildObj['result'] = "success";
          $buildObj['page'] = "dashboard";
          $buildObj['data'] = $data;

          echo json_encode($buildObj);
          } else {
          // header('location: ../login');
          echo "No users to show : ".$count;
          } */
    }

}

?>