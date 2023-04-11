<?php
	require_once('db/dbhelper.php');
	require_once('utils/utility.php');
	include_once('layouts/header.php');

	$cart = [];
	if(isset($_COOKIE['cart'])) {
		$json = $_COOKIE['cart'];
		$cart = json_decode($json, true);
	}
    $idList = [];
    foreach($cart as $item){
        $idList[] = $item['id'];
    }
    if(count($idList) > 0){
        $idList = implode(',', $idList);
        $sql = " select * from products where id in ($idList)";
        $cartList = executeResult($sql);
    }else{
        $cartList = [];
    }
    
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SKATESHOP Project</title>
    <link rel="stylesheet" href="css/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" integrity="sha512-9usAa10IRO0HhonpyAIVpjrylPvoDwiPUiKdWk5t3PyolY1cOd4DSE0Ga+ri4AuTroPR5aQvXU9xC6qOPnzFeg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.8.2/css/all.min.css" integrity="sha512-rqQltXRuHxtPWhktpAZxLHUVJ3Eombn3hvk9PHjV/N5DMUYnzKPC1i3ub0mEXgFzsaZNeJcoE0YHq0j/GFsdGg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
    <style>
        .container {
            padding: 0;
        }

        .name-detail-cart,
        .price-detail-cart,
        .number,
        .deleteProduct,
        .total-price-detail-cart {
            margin: 70px 0;
        }

        .number {
            margin: 70px 40px;
        }

        .title_danh_muc_cart .row div {
            text-align: center;
        }

        .detail_danh_muc_cart .row .col-2 {
            text-align: center;
        }

        .deleteProduct button {
            transition: all 0.3s ease-in-out;
            background-color: #fff;
        }

        .deleteProduct button:hover {
            color: rgb(0, 157, 255);
        }

        .number .qtyminus,
        .number .qtyplus,
        .number input {
            font-size: 12px !important;
            height: 30px !important;
            line-height: 30px !important;
        }



    </style>
    <section class="bread-crumb">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="list-inline">
                        <ul>
                            <li>
                                <i class="fa-solid fa-house"></i>
                                <a href="">
                                    <span>Trang chủ</span>
                                </a>
                            </li>
                            <li>
                                <i class="fa-solid fa-angle-right"></i>
                            </li>
                            <li>
                                <span>Giỏ hàng</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="cart_N">
        <div class="container">
            <div class="row">
                <div class="col-12" style="margin-bottom: 30px;">
                    <h1 style="font-size: 25px;">
                        <span>Giỏ hàng của bạn</span>
                    </h1>
                </div>
                < class="col-12">
                    <div class="title_danh_muc_cart" style="border-bottom: 1px solid rgb(215, 215, 215);">
                        <div class="container">
                            <div class="row">
                                <div class="col-5">
                                    <h6>
                                        <span>
                                            <b>Sản phẩm</b>
                                        </span>
                                    </h6>
                                </div>
                                <div class="col-2">
                                    <h6>
                                        <span>
                                            <b>Đơn giá</b>
                                        </span>
                                    </h6>
                                </div>
                                <div class="col-2">
                                    <h6>
                                        <span>
                                            <b>Số lượng</b>
                                        </span>
                                    </h6>
                                </div>
                                <div class="col-2">
                                    <h6>
                                        <span>
                                            <b>Thành tiền</b>
                                        </span>
                                    </h6>
                                </div>
                                <div class="col-1"></div>
                            </div>
                        </div>
                    </div>
                    <div>
                    <?php
                    $count = 0;
                    $total = 0;
                        foreach ($cartList as $item ) {
                            $num = 0;
                            foreach ($cart as $value ) {

                            if($value['id']==$item['id']){
                                $num = $value['num'];
                                break;
                            }
                            }
                            $total +=  $num*$item['price'];
                            echo 
                            '<tr>
                            <td>'.(++$count).'</td>
                            <td><img src="'.$item['thumbnail'].'"style="height:100px"/></td>
                            <td>'.$item['title'].'</td>
                            <td>'.$num.'</td>
                            <td>'.number_format($item['price'], 0, ',', '.').'</td>
                            <td>'.number_format($num*$item['price'], 0, ',', '.').'</td>
                            <td><button class="btn btn-warning" onclick="deleteCart('.$item['id'].')">Delete</button></td>
                            </tr>';
                        }
                    ?>
                    
                  </section>
    <script>
        $(document).ready(function() {
            $('.minus').click(function () {
                var $input = $(this).parent().find('input');
                var count = parseInt($input.val()) - 1;
                count = count < 1 ? 1 : count;
                $input.val(count);
                $input.change();
                return false;
            });
            $('.plus').click(function () {
                var $input = $(this).parent().find('input');
                $input.val(parseInt($input.val()) + 1);
                $input.change();
                return false;
            });
        });
    </script>
</body>
</html>