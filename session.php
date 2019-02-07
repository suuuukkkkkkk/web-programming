<?php
setcookie('firstname','Alice',time()+3600);
$_SESSION['firstname']='Alice';
// some other code ...
echo $_SESSION['firstname'];
echo $_COOKIE['firstname'];

?>



if(isset($_SESSION['cart']))
        {
            $itemArrayId=array_column($_SESSION['cart'],"item_id");
            if(!in_array($_POST['id'],$itemArrayId)){
                 $count=count($_SESSION['cart']);
                 $itemArray=array('item_id'=>$_POST['id'],'item_name'=>$_POST['n'],'item_price'=>$_POST['price']);
                 $_SESSION['cart'][$count]=$itemArray;
                 echo '<pre>';
                 print_r($_SESSION['cart']);
                 echo '</pre>';
            }
           
            else{
                echo"item already add";
            }
        }
        else{
            $itemArray=array('item_id'=>$_POST['id'],'item_name'=>$_POST['n'],'item_price'=>$_POST['price']);
            $_SESSION['cart'][0]=$itemArray;
            echo '<pre>';
            print_r($_SESSION['cart']);
            echo '</pre>';
    
        }
        
        
         if(isset($_POST["add"])){
    //check the id
    if($_POST['id']==001 || $_POST['id']==002|| $_POST['id']==003){
        $id=$_POST['id'];
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