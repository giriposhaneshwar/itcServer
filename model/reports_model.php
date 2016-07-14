<?php

/**
 * Login Model
 */
class Reports_Model extends Model {

    function __construct() {
        parent::__construct();

        // echo "this is login model\n";
    }

    // Login User
    function getAllReports($postData) {
        if (isset($postData['data']['id']) && !empty($postData['data']['id'])) {
            $query = "SELECT * FROM dcreport WHERE `user_account`= :user AND `did` = :id";
            // echo "Getting the stats of products";
            $sth = $this->db->prepare($query);
            $sth->execute(array(':user' => $postData['userid'], ':id' => $postData['data']['id']));
        } else {
            $query = "SELECT * FROM dcreport WHERE `user_account`= :user";
            // echo "Getting the stats of products";
            $sth = $this->db->prepare($query);
            $sth->execute(array(':user' => $postData['userid']));
        }
        $data = $sth->fetchAll(PDO::FETCH_ASSOC);

        // return $data;

        $count = $sth->rowCount();
        if ($count > 0) {
            // Login Success send the data to redirect the page

            foreach ($data as $key => $value) {
                $data[$key]['numWord'] = $this->numToWord($value['grandTotal']);
            }

            foreach ($data as $k => $v) {
                $qry = "SELECT * FROM customermaster WHERE `cid`=" . $v['customer'];
                $getCustomer = $this->db->prepare($qry);
                $getCustomer->execute();
                $res = $getCustomer->fetchAll(PDO::FETCH_ASSOC);
                $data[$k]['customer'] = $res[0];
            }

//                $gCust = $this->db->prepare($qry);
            $buildObj['status'] = "success";
            $buildObj['page'] = "reports";
            $buildObj['data'] = $data;


            return $buildObj;
        } else {
            // header('location: ../login');
            echo "No Data to show : " . $count;
        }
    }

    function getCustomerPayList($postData) {
        $user = $postData['userid'];
        $id = $postData['data']['id'];
        $query = "select * from dcreport where `customer`= :id and `user_account`= :user";
        $sth = $this->db->prepare($query);
        $sth->execute(array(':user' => $user, ':id' => $id));
        $res = $sth->fetchAll(PDO::FETCH_ASSOC);
        $count = $sth->rowCount();
        $buildObj = array();
        if ($count > 0) {
            $buildObj['status'] = "success";
            $buildObj['data'] = $res;
            return $buildObj;
        } else {
            $buildObj['status'] = "No Data to show";
            $buildObj['data'] = "";
            return $buildObj;
        }
    }

    function getCustomerPayLog($postData) {
        $user = $postData['userid'];
        $id = $postData['data']['id'];

        $query = "SELECT * FROM paylog WHERE id=:id";
        $stm = $this->db->prepare($query);
        $stm->execute(array(":id" => $id));

        $res = $stm->fetchAll(PDO::FETCH_ASSOC);

        $count = $stm->rowCount();
        if ($count > 0) {
            $data['status'] = 'success';
            $data['data'] = $res;
            return $data;
        } else {
            $data['status'] = 'failed';
            $data['data'] = "";
            return $data;
        }
    }

    function addPayment($postData) {
//        {amount: "123", mode: "1", chequeno: "24234234234", description: "adfasdf"}
//        print_r($postData);
        echo json_encode($postData);

        if ($postData['data']['mode'] == 1) {
            $mode['paytype'] = 'cheque';
            $mode['num'] = isset($postData['data']['chequeno']) ? $postData['data']['chequeno'] : "";
        } else {
            $mode['paytype'] = "cash";
        }
        $modePay = json_encode($mode);

        $query = "select * from paylog";
        $sth = $this->db->prepare($query);
        $sth->execute();
        $res = $sth->fetchAll(PDO::FETCH_ASSOC);


        $data['status'] = 'success';
        $data['data'] = $res;

        return $data;
    }

    // Deleting a row
    function deleteRecord($postData) {
        // echo "Getting the stats of products";

        $sth = $this->db->prepare("DELETE FROM `dcreport` WHERE `did` = :id");
        $res = $sth->execute(array(':id' => (int) $postData['data']));

        if ($res) {
            $buildObj['status'] = "success";
            $buildObj['message'] = "Record Deleted Successfully";
            // $getData = $this->getAllReports($postData);
            // $buildObj['data'] = $getData;
        } else {
            $buildObj['status'] = "failed";
            $buildObj['message'] = "Failed to delete data! Please try again later.";
            // $getData = $this->getAllReports($postData);
            // $buildObj['data'] = $getData;
        }

        return $buildObj;
    }

    function numToWord($word) {
        $number = $word;
        $no = round($number);
        $point = round($number - $no, 2) * 100;
        $hundred = null;
        $digits_1 = strlen($no);
        $i = 0;
        $str = array();
        $words = array('0' => '', '1' => 'one', '2' => 'two',
            '3' => 'three', '4' => 'four', '5' => 'five', '6' => 'six',
            '7' => 'seven', '8' => 'eight', '9' => 'nine',
            '10' => 'ten', '11' => 'eleven', '12' => 'twelve',
            '13' => 'thirteen', '14' => 'fourteen',
            '15' => 'fifteen', '16' => 'sixteen', '17' => 'seventeen',
            '18' => 'eighteen', '19' => 'nineteen', '20' => 'twenty',
            '30' => 'thirty', '40' => 'forty', '50' => 'fifty',
            '60' => 'sixty', '70' => 'seventy',
            '80' => 'eighty', '90' => 'ninety');
        $digits = array('', 'hundred', 'thousand', 'lakh', 'crore');
        while ($i < $digits_1) {
            $divider = ($i == 2) ? 10 : 100;
            $number = floor($no % $divider);
            $no = floor($no / $divider);
            $i += ($divider == 10) ? 1 : 2;
            if ($number) {
                $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
                $hundred = ($counter == 1 && $str[0]) ? ' and ' : null;
                $str[] = ($number < 21) ? $words[$number] .
                        " " . $digits[$counter] . $plural . " " . $hundred :
                        $words[floor($number / 10) * 10]
                        . " " . $words[$number % 10] . " "
                        . $digits[$counter] . $plural . " " . $hundred;
            } else {
                $str[] = null;
            }
        }
        $str = array_reverse($str);
        $result = implode('', $str);
//        $points = ($point) ? "." . $words[$point / 10] . " " . $words[$point = $point % 10] : '';
        return ucwords($result);
    }

}

?>