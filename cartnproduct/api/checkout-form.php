<?php
if(!empty($_POST)) {
	$cart = [];
	if(isset($_COOKIE['cart'])) {
		$json = $_COOKIE['cart'];
		$cart = json_decode($json, true);
	}
	if($cart ==null || count($cart) == 0) {
		header('Location: product.php');
		die();
	}

	$fullname = getPost('fullname');
	$email = getPost('email');
	$phone_number = getPost('phone_number');
	$address = getPost('address');
	$orderDate = date('Y-m-d H:i:s');

	//add order
	$sql = "insert into orders(fullname, email, phone_number, address, order_date) values ('$fullname', '$email', '$phone_number', '$address', '$orderDate')";
	execute($sql);

	$sql = "select * from orders where order_date = '$orderDate'";
	$order = executeResult($sql, true);

	$orderId = $order['id'];

	$idList = [];
	foreach ($cart as $item) {
		$idList[] = $item['id'];
	}
	if(count($idList) > 0) {
		$idList = implode(',', $idList);
		//[2, 5, 6] => 2,5,6

		$sql = "select * from products where id in ($idList)";
		$cartList = executeResult($sql);
	} else {
		$cartList = [];
	}

	foreach ($cartList as $item) {
		$num = 0;
		foreach ($cart as $value) {
			if($value['id'] == $item['id']) {
				$num = $value['num'];
				break;
			}
		}

		$sql = "insert into order_details (order_id, product_id, num, price) values ($orderId, ".$item['id'].", $num, ".$item['price'].")";
		execute($sql);
	}

	header('Location: complete.php');
	setcookie('cart', '[]', time()-1000, '/');
}