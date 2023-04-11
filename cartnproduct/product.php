<?php
require_once('db/dbhelper.php');
require_once('utils/utility.php');
  include_once('layouts/header.php');
  $productList = executeResult('select * from products');
?>

    <!-- body -->
    <div class="container">
    <div class="row">
      <?php
      foreach($productList as $item){
            echo '<div class="col-md-3 col-6">
            <a href="details.php?id='.$item['id'].'">
            <img src="'.$item['thumbnail'].'" 
            style="width:100px;">
            </a>  
            <a href="details.php?id='.$item['id'].'"><p>'.$item['title'].'</p></a>
              <p style="color:red">'.number_format($item['price'],0,',','.').'đ</p>
        </div>';
      }
        ?>
    </div>
    </div>
<?php
  include_once('layouts/footer.php');
?>

</body>
</html>