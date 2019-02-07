<?php
session_start();
?>
<?php
include_once('top.php');
?>
<title>pumps</title>
<?php
include_once('mid.php');
?>
<?php

    if(isset($_POST["add"])){
    
    //check the id and prevent invalid id
        if(checkId($_POST['id'])){
        
        $id=$_POST['id'];
        
        //check if the item in the cart
        
        if(isset($_SESSION['cart'][$id])){
            echo"item already in cart.";
        }
        else{
            $_SESSION['cart'][$id]['name']=$_POST['n'];
            $_SESSION['cart'][$id]['id']=$_POST['id'];
            $_SESSION['cart'][$id]['price']=$_POST['price'];
            
            echo'<pre>';
            print_r($_SESSION['cart']);
            echo'</pre>';
        }
   
   
    }
    
    else {
        echo"invalid id";
    }
    
}

function checkId($pid){
 $products=array(
     1=> array(
    "n" => "product 1",
    "img" => "../../source/1.jpg",    
    "description" => "Impressive size and paint scheme, this Tokheim 39 Tall Signal Gasoline pump signaled that the end of the pre-war, pump era was coming to a close. This magnificent example with it's vintage gas brand is near mint. Completely restored. Correct Tokheim nozzle. Near mint.",
    "id" => "001",
    "price" => "100.00",
),
    2=> array(
    "n" => "product 2",
    "img" => "../../source/2.jpg",    
    "description" => "Classic design, beautifully restored",
    "id" => "002",
    "price" => "200.00",
),
   3=>array(
    "n" => "product 3",
    "img" => "../../source/3.jpg",    
    "description" => "Unusual American (Standard) pump from 1955. Striped paint scheme is authentic. ",
    "id" => "003",
    "price" => "300.00",
),
);
         foreach($products as $key=>$value)
    {
        if($key == $pid)
        {
            return true;
        }
    }
    return false;
}
    
  if(isset($_POST['remove'])){
               foreach($_SESSION['cart'] as $key=>$value){
                   if($value['id']=$_POST['id']){
                       unset($_SESSION['cart'][$key]);
                       unset($_POST['id']);
                   }
               }
                   
                echo '<pre>';
                print_r($_SESSION['cart']);
                echo '</pre>';
     
}




$products=array(
     1=> array(
    "n" => "product 1",
    "img" => "../../source/1.jpg",    
    "description" => "Impressive size and paint scheme, this Tokheim 39 Tall Signal Gasoline pump signaled that the end of the pre-war, pump era was coming to a close. This magnificent example with it's vintage gas brand is near mint. Completely restored. Correct Tokheim nozzle. Near mint.",
    "id" => "001",
    "price" => "100.00",
),
    2=> array(
    "n" => "product 2",
    "img" => "../../source/2.jpg",    
    "description" => "Classic design, beautifully restored",
    "id" => "002",
    "price" => "200.00",
),
   3=>array(
    "n" => "product 3",
    "img" => "../../source/3.jpg",    
    "description" => "Unusual American (Standard) pump from 1955. Striped paint scheme is authentic. ",
    "id" => "003",
    "price" => "300.00",
),
);



foreach ($products as $key=>$value) 
{ 
    echo '<div class="bb">';
    echo '<img src="'.$products[$key]['img'].'" alt="product" style="float:left; padding-right:30px" height="300" width="100">';
    echo $products[$key]['n'].'<br><br>';
    echo $products[$key]['description'].'<br><br>';
    echo $products[$key]['id'].'<br><br>';
    echo '<span>$'.$products[$key]['price'].'</span>';
    
    echo '<form action="pumps.php" method="post" style="display:inline-block; width:300px; padding-left:30px"; >';
    echo '<input type="hidden" name="id" value="'.$products[$key]['id'].'">';
    echo '<input type="hidden" name="n" value="'.$products[$key]['n'].'">';
    echo '<input type="hidden" name="price" value="'.$products[$key]['price'].'">';
    if( $_POST['id'] == $products[$key]['id'] )
    {
    echo '<input type="submit" name="remove" value="Remove from Cart" style="width:200px; height:50px;">';
    }
    else
    {
    echo '<input type="submit" name="add" value="Add to Cart" style="width:200px; height:50px;" >';
    }
    echo '</form>';
    echo '</div>';
    echo '<div style="clear:both"></div>';
    echo '<br>';
    
}


?>

    <br>
<?php 
   if (isset($_POST['check'])) {
 
        if ($_POST['name'] != "") {
            $_POST['name'] = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            if ($_POST['name'] == "") {
                $errors .= 'Please enter a valid name.<br/><br/>';
            }
        } else {
            $errors .= 'Please enter your name.<br/>';
        }
 
        if ($_POST['email'] != "") {
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $errors .= "$email is <strong>NOT</strong> a valid email address.<br/><br/>";
            }
        } else {
            $errors .= 'Please enter your email address.<br/>';
        }
 
 
        if ($_POST['address'] != "") {
            $_POST['address'] = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
            if ($_POST['address'] == "") {
                $errors .= 'Please write your address.<br/>';
            }
        } else {
            $errors .= 'Please write your address.<br/>';
        }
        
        
         if ($_POST['phone'] != "") {
            $_POST['phone'] = filter_var($_POST['phone'],FILTER_SANITIZE_NUMBER_INT);
            if ($_POST['phone'] == "") {
                $errors .= 'invalid phone number.<br/>';
            }
        } else {
            $errors .= 'Please write your phone number.<br/>';
        }
        
        if (!$errors) {
            $_SESSION['user']["name"] = $_POST['name'];
            $_SESSION['user']["email"] = $_POST['email'];
            $_SESSION['user']["address"] = $_POST['address'];
            $_SESSION['user']["phone"] = $_POST['phone'];
            
            
            $fp = fopen('orders.tsv', 'w');
            
            fputcsv($fp, $_SESSION['user'], "\t");
  
            foreach ($_SESSION['cart'] as $fields) {
            fputcsv($fp, $fields,"\t");
            }
            fclose($fp);
            
            
            header('Location: receipts.php');
        } else {
            echo '<div style="color: red">' . $errors . '<br/></div>';
        }
    }
?>


  <form action="pumps.php" method="post" >
            <fieldset>
                <legend>Write your information here</legend>
                <label for="name">Name</label><br>
                <input type="text" name="name" id="name" value="<?php echo $_POST['name']; ?>"><br>
                <label for="email">E-mail</label><br>
                <input type="email" name="email" id="email" value="<?php echo $_POST['email']; ?>"><br>
                <label for="address">Address</label><br>
                <textarea  name="address" id="address" rows="3" cols="40"><?php echo $_POST['address']; ?></textarea>
                <br>
                <label for="replace function">phone</label><br>
                <input type="text"  id="phone" name="phone" value="<?php echo $_POST['phone']; ?>">
                <br>
                <input type="checkbox" name="remember me" id="remember">Remember Me<br>
                <input type="submit" name="check" value="Check Out">
                <input type="reset">
            </fieldset>   
    
        </form>
         
<?php
include_once('end.php');
?>