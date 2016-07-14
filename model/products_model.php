<?php

/**
 * Login Model
 */
class Products_Model extends Model {

    function __construct() {
        parent::__construct();

        // echo "this is login model\n";
    }
    
    function getList($postData) {
        // getting the customer list
        $stm = $this->db->prepare('SELECT * FROM `itemmaster` WHERE `user_account`="' . $postData['userid'] . '"');
        $stm->execute();
        $res = $stm->fetchAll(PDO::FETCH_ASSOC);
        $count = $stm->rowCount(PDO::FETCH_ASSOC);
        $resObj = array();

        if ($count > 0) {
            $resObj['data'] = $res;
            $resObj['status'] = 'success';
            return $resObj;
        } else {
            $resObj['status'] = 'failed';
            $resObj['data'] = 'No Result Found';
            return $resObj;
        }
    }

    // Adding Product
    function insertProduct($postData) {
//        print_r($postData);
        // Inserting the data into database
        $resultData = array();


        try {
            $sth = $this->db->prepare("INSERT INTO itemmaster VALUES(NULL, :name, :type, :code, :price, :qty, :unit, :vat, :desc, :active, :addedOn, :user)");
            $sth->bindValue(':name', $postData['data']['name']);
            $sth->bindValue(':type', $postData['data']['type']);
            $sth->bindValue(':code', $postData['data']['code']);
            $sth->bindValue(':price', $postData['data']['price']);
            $sth->bindValue(':qty', $postData['data']['qty']);
            $sth->bindValue(':unit', $postData['data']['unit']);
            $sth->bindValue(':vat', $postData['data']['vat']);
            $sth->bindValue(':desc', $postData['data']['desc']);
            $sth->bindValue(':active', '1');
            $sth->bindValue(':addedOn', date("Y-m-d H:i:s", time()));
            $sth->bindValue(':user', $postData['userid']);

            if ($sth->execute()) {
                $resultData['status'] = "success";
                $resultData['message'] = "Records inserted successfully";
                return $resultData;
            } else {
                $resultData['status'] = "failed";
                $resultData['message'] = "Failed to Insert";
                return $resultData;
            }
        } catch (PDOException $e) {
            $resultData['status'] = "failed";
            $resultData['message'] = "Request failed. Please try again!";
            $resultData['error'] = $e->getMessage();
            echo json_encode($resultData);
            die();
        }
    }

    function updateProduct($postData) {
        try {

//            :name, :type, :code, :price, :qty, :unit, :vat, :desc, :active, :addedOn, :user

            $sth = $this->db->prepare("UPDATE  itemmaster SET  `name` =  :name,
                                        `code` =  :code,
                                        `price` =  :price,
                                        `qty` =  :qty,
                                        `unit` =  :unit,
                                        `type` =  :type,
                                        `vat` =  :vat,
                                        `desc` =  :desc,
                                        `active` =  :active,
                                        `addedOn` =  :addedOn,
                                        `user_account` =  :user  WHERE  `pid` = :pid");


            $sth->bindValue(":pid", $postData['data']['pid']);
            $sth->bindValue(":name", $postData['data']['name']);
            $sth->bindValue(":code", $postData['data']['code']);
            $sth->bindValue(":price", $postData['data']['price']);
            $sth->bindValue(":qty", $postData['data']['qty']);
            $sth->bindValue(":unit", $postData['data']['unit']);
            $sth->bindValue(":vat", $postData['data']['vat']);
            $sth->bindValue(":type", $postData['data']['type']);
            $sth->bindValue(":desc", $postData['data']['desc']);
            $sth->bindValue(":active", $postData['data']['active']);
            $sth->bindValue(":addedOn", date("Y-m-d H:i:s", time()));
            $sth->bindValue(":user", $postData['userid']);
            $res = $sth->execute();

//        print_r($res);

            if ($res) {
                $resultData['status'] = "success";
                $resultData['message'] = "Records Updated successfully";
                return $resultData;
            } else {
                $resultData['status'] = "failed";
                $resultData['message'] = "Failed to Insert";
                return $resultData;
            }
        } catch (PDOException $e) {
            $resultData['status'] = "failed";
            $resultData['message'] = "Request failed. Please try again!";
            $resultData['error'] = $e->getMessage();
            return $resultData;
            die();
        }
    }

    function deleteProduct($postData) {
        $user = $postData['userid'];
        $record = $postData['data']['pid'];
//        print_r($record);

        try {
            // Deleting the record based on the "cid" and "user_account" value
            $stm = $this->db->prepare("DELETE FROM itemmaster WHERE `pid`=:pid AND `user_account` = :user");
            $res = $stm->execute(array(
                ':pid' => $record,
                ':user' => $user
            ));

            if ($res) {
                $resultData['status'] = "success";
                $resultData['message'] = "Records Deleted successfully";
                return $resultData;
            } else {
                $resultData['status'] = "failed";
                $resultData['message'] = "Failed to Insert";
                return $resultData;
            }
        } catch (PDOException $e) {
            $resultData['status'] = "failed";
            $resultData['message'] = "Request failed. Please try again!";
            $resultData['error'] = $e->getMessage();
            return $resultData;
            die();
        }
    }

}

?>