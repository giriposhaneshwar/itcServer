<?php

/**
 * Model Construction
 */
class Model {

    function __construct() {
        $this->db = new Database(DB_TYPE, DB_HOST, DB_NAME, DB_USER, DB_PASS);
//     $this->db = new Database("mysql", "localhost", "icsitxjx_itdc", "root", "");
    }

    function getIdByName($data) {
        $user = $data['user'];
        $stm = $this->db->prepare('SELECT uid, personName, username, company FROM `user_accounts` WHERE `username`= "' . $user . '"');
        $stm->execute();
        $getData = $stm->fetchAll(PDO::FETCH_ASSOC);

        return $getData;
    }

}

?>