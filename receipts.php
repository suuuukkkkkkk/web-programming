<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<link rel="stylesheet" type="text/css" href="r.css">

</head>


<body>
<main>
<h1> Bob's garage's receipt</h1>
<img src="../../source/bobsgarage.gif" style="width:50px; height:50px; display: block; margin: 0 auto;">
</div>
<table>
                <tr>
                    <th width=100>Name</th>
                    <th width=100>ID</th>
                    <th width=100>Price</th>
                </tr>

<?php
session_start();
    if(!empty($_SESSION['cart']))
    {   
    
        $total=0;
        foreach ($_SESSION['cart'] as $key=> $values) {
        
        $total+=$values['price'];
        
?>          <tr>
            <td><?php echo $values['name']; ?></td>
            <td><?php echo $values['id'] ; ?></td>
            <td>$<?php echo $values['price']; ?></td>
        </tr>
        
       <?php } ?>
        <tr>
            <td colspan="2" align="right">Total:  </td>
            <td>$<?php echo number_format($total,2); ?></td>
        </tr>
    <?php } ?>
</table>

    <?php
    date_default_timezone_set("Australia/Melbourne");
    echo "The time is " . date("Y-m-d-h:i:sa") ;
?>
<P><strong>If have any issue, please contact us.</strong></P>
<p>Hours of Operation:Office and Showroom: M - F 10 - 4 Saturday by appointment</p>
  <p>
	Our address is:Bob's Garage 4140 JVL Industrial Park Dr. # 102 Marietta, GA 30066 (Just off I-575)<br>
	Phone number  678-494-2996<br>
	Fax           678-494-1076 <br>
	E-mail:bob@bobs-garage.com<br><br>
  </p>
  </main>
</body>

</html>