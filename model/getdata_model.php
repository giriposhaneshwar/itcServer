<?php

/**
 * Login Model
 */
class Getdata_Model extends Model {

	function __construct() {
		parent::__construct();

// echo "this is getdata model\n";
	}

// Login User
	function getList($postData) {
//        print_r($postData);
		$buildObj = array();
// pulling the product list
		$sth = $this->db->prepare("SELECT * FROM itemmaster WHERE `user_account`= :user");
		$sth->bindValue(':user', $postData['userid']);
		$sth->execute();
		$data = $sth->fetchAll(PDO::FETCH_ASSOC);
		$count = $sth->rowCount();

		if ($count > 0) {
// List of products
			$buildObj['productList'] = $data;
		} else {
			$buildObj['productList'] = $data;
		}

// Pulling the customer list
		$cList = $this->db->prepare("SELECT * FROM customermaster WHERE `user_account`= :user");
		$cList->bindValue(':user', $postData['userid']);
		$cList->execute();
		$customer = $cList->fetchAll(PDO::FETCH_ASSOC);
		$cCount = $cList->rowCount(PDO::FETCH_ASSOC);

		if ($cCount > 0) {
// List of Customers
			$buildObj['customerList'] = $customer;
		} else {
			$buildObj['customerList'] = $customer;
		}

		return $buildObj;

//        echo json_encode($buildObj);
	}
}

?>