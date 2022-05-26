<?php
session_start();

if(!isset($_SESSION['cart']))
{ //created an array cart
    $_SESSION['cart']=array();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>
        Products
    </title>
    <link href="style.css" type="text/css" rel="stylesheet">
</head>
<body>
<?php include 'header.php';?>
<?php include 'config.php';?>
    <div id="main">
        <div id="products">
            <?php
          
            foreach($products as $i => $values){ ?>
               <div id="product-101" class="product">
                  <img src="<?php echo $values['image']?>">
                  <h3 class="title"><a href="#">Product <?php echo $values['ID'];?></a></h3>
                  <span><?php echo "Price: $" .$values['price'] ?> </span>
                  <a class="add-to-cart" href="products.php?action=add-to-cart&id=<?php echo $values['ID']; ?>&name=<?php echo $values['name']; ?>&price=<?php echo $values['price']; ?>">Add To Cart</a>
               </div>
            <?php }?>
            
        </div>
       
        <?php

function show_cart(){
     $txt="<table><thead><tr><th>PRODUCT ID</th><th>PRODUCT NAME</th><th>PRODUCT PRICE</th><th>Quantity</th></thead></tr>";
     $txt.= "<tbody>";
     if(isset($_SESSION['cart'])){
     foreach($_SESSION['cart'] as $key => $value){
     $txt.= "<tr>";

     $txt.="<td>".$value['ID']."</td>";

     $txt.="<td>".$value['Name']."</td>";

     $txt.="<td>".$value['Price']."</td>";

     $txt.="<td>".$value['quantity']."</td>";


     $txt.="</tr>";
     }

     $txt.="</tbody></table>";

     echo $txt;   
  }
}

if(isset($_POST['empty'])){

session_start();
session_unset();

show_cart();
}



if(isset($_GET['action']) && $_GET['action']=='add-to-cart')
{  

$id = $_GET['id'] ;

$name = $_GET['name'];

$price = $_GET['price'];

$flag=0;
if(isset($_SESSION['cart'])){
foreach($_SESSION['cart'] as $key => $values){
    if($values['ID']==$id)
    {
        $_SESSION['cart'][$key]['quantity']++;
        $flag=1;
        break;
    }
}
}
    if($flag==0){
     $item=array("ID"=>$id,"Name"=>$name,"Price"=>$price,"quantity"=>1);
     if(isset($_SESSION['cart'])){
        array_push($_SESSION['cart'],$item);
      }
    }
show_cart();


?>
<form method="POST" action="">
   <button class="button-54" name="empty" id ="empty" role="button">Empty your Cart</button>
</form>
<?php   }      ?>

    
    </div>
 
    
    <?php include 'footer.php';?> 
    
        
</body>
</html>

