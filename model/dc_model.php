<?php

/**
 * Login Model
 */
class Dc_Model extends Model {

    private $billNow;

    function __construct() {
        parent::__construct();

        // echo "this is login model\n";
    }

    // Login User
    function getStats($postData) {
        echo "Getting the stats of dashboard";
    }

    function getList($postData) {
        echo "Data is able to show the dc model data";
    }

    function dcNumber($postData) {
        $bill = $this->renderBill($postData);
        return $bill;
    }

    function renderBill($postData) {
//        print_r($postData);
        $user = $postData['userid'];

        $sth = $this->db->prepare("SELECT * FROM `billno` WHERE `user_account`= " . $user);
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        $count = $sth->rowCount();

        if ($count > 0) {
            // List of products
            // $getBill = $data;
            $this->billNow = $data[0]['dc'];
            return $this->billNow;
        } else {
            return "No product to show : " . $count;
        }
    }

    function getUserByName($user) {
        $sth = $this->db->prepare("SELECT * FROM `user_accounts` WHERE `username`= '" . $user . "'");
        $sth->execute();
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);
        $count = $sth->rowCount();

        if ($count > 0) {
            // getting the user
            return $data[0];
        } else {
            return "No Records " . $count;
        }
    }

    function addReport($postData) {

        $dataset = $postData['data'];
        $rep = array();

        // var_dump($postData);
        //        print_r($dataset);

        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        try {
//`did`, `customer`, `billno`, `billDate`, `dcItemList`, `grandTotal`,
            //`discount`, `vat`, `totalAmount`, `active`, `createdOn`, `user_account`
            $sth = $this->db->prepare("INSERT INTO  `dcreport` VALUES (
                                                                NULL,
                                                                :customer,
                                                                :billno,
                                                                :billDate,
                                                                :dcItemList,
                                                                :grandTotal,
                                                                :discount,
                                                                :vat,
                                                                :totalAmount,
                                                                :paid,
                                                                :balence,
                                                                :active,
                                                                :createdOn,
                                                                :user_account
								)");
            $sth->bindValue(':customer', $dataset['header']['customer']);
            $sth->bindValue(':billno', $dataset['billno']);
            $sth->bindValue(':billDate', $dataset['header']['date']);
            $sth->bindValue(':dcItemList', json_encode($dataset['productRequirment']));
            $sth->bindValue(':grandTotal', $dataset['grandTotal']);
            $sth->bindValue(':discount', '0');
            $sth->bindValue(':vat', '0');
            $sth->bindValue(':totalAmount', $dataset['grandTotal']);
            $sth->bindValue(':paid', $dataset['paid']);
            $sth->bindValue(':balence', ($dataset['grandTotal'] - $dataset['paid']));
            $sth->bindValue(':active', '1');
            $sth->bindValue(':createdOn', date("Y-m-d H:i:s", time()));
            $sth->bindValue(':user_account', $postData['userid']);

            if ($sth->execute()) {
                // get bill and execute
                $this->dcNumber($postData);

                $billAdd = (int) $this->billNow;

                $bill = $this->db->prepare("UPDATE  `billno` SET  `dc` = :dc WHERE  `user_account` = :user");
                $bill->execute(array(
                    ':dc' => $billAdd + 1,
                    ':user' => $postData['userid'],
                ));

                // Respongin to the client
                $res['status'] = "success";
                $res['message'] = "Record Inserted Successfully";
                $res['bill'] = $this->billNow;

                return $res;
//            echo json_encode($res);
                //            echo gettype($this->billNow);
            } else {
                $res['status'] = "failed";
                $res['message'] = "Failed to Insert Please try again";
                return $res;
            }
        } catch (PDOException $e) {
            // Respongin to the client
            $res['status'] = "failed";
            $res['message'] = $e->getMessage();
//            echo json_encode($res);
            return $res;
        }
    }

}

?>