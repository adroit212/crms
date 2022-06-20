<?php
$email = $_GET['email'];
$price = $_GET['price'];
$products = $_GET['products'];
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Reciept</title>
    </head>
    <body>
        <div style="width: 300px; margin: auto;">
            <h3 style="text-align: center;">Customer Electronic Receipt</h3>
            <p><strong>Full Name:</strong> <?php echo $email ?></p>
            <p><strong>Products:</strong><br/><?php echo $products ?></p>
            <p><strong>Price: </strong>NGN <?php echo $price ?></p>
        </div>
    </body>
</html>