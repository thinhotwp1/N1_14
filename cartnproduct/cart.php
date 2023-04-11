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

<!-- body -->
<div class="container">
	<div class="row">
        <div class="col-md-12">
            <table class="table table-bordered">
                <thead>
                    <tr>
                    <th>no</th>
                    <th>thumbnail</th>
                    <th>title</th>
                    <th>num</th>
                    <th>price</th>
                    <th>total</th>
                    <th></th>
                    </tr>
                    
                </thead>
                <tbody>
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
                </tbody>
            </table>
            <p style="font-size : 30px; color:blue">
            Total : <?=number_format($total, 0, ',', '.')?>


            </p>
            <a href="checkout.php">
            <button class='btn btn-success' style="width:100%; font-size:32px;">Checkout</button>
            </a>
        </div>
		
	</div>
</div>
<script type="text/javascript">
	function deleteCart(id) {
		$.post('api/cookie.php', {
			'action': 'delete',
			'id': id
		}, function(data) {
			location.reload()
		})
	}
</script>
<?php
	include_once('layouts/footer.php');
?>