<?php
// Start the session
session_start();
?>

<!DOCTYPE html>
<html>
<body>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        body {
            margin: 0;
            font-family: Arial, Helvetica, sans-serif;
        }

        .header {
            padding: 2px;
            text-align: center;
            background: #ce1023;
            color: white;
            font-size: 15px;
        }


        .topnav {
            position: relative;
            overflow: hidden;
            background-color: #333;
        }

        .topnav a {
            float: left;
            color: #f2f2f2;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
            font-size: 17px;
        }

        .topnav a:hover {
            background-color: #ddd;
            color: black;
        }

        .topnav a.active {
            background-color: #ce1023;
            color: white;
        }

        .topnav-centered a {
            float: none;
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
        }

        .topnav-right {
            float: right;
        }

        .topnav input[type=text] {
            float: right;
            padding: 14px 16px;
            border: 2px;
            font-size: 17px;
        }

        .registerbtn {
            background-color: #ce1023;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 15%;
            opacity: 0.9;
        }

        form.search button {
            float: right;
            width: 20%;
            padding:10px;
            background: #ce1023;
            color: white;
            font-size: 17px;
            border: 1px solid grey;
            border-left: none;
            cursor: pointer;
        }

        form.search button:hover {
            background: #ddd;
        }

        form.search::after {
            content: "";
            clear: both;
            display: table;
        }


        /* Responsive navigation menu (for mobile devices) */
        @media screen and (max-width: 600px) {
            .topnav a, .topnav-right {
                float: none;
                display: block;
            }

            .topnav-centered a {
                position: relative;
                top: 0;
                left: 0;
                transform: none;
            }
        }
    </style>
</head>
</body>

<div class="header">
    <h1>Discount Designer DB</h1>
</div>

<!-- Top navigation -->
<div class="topnav">

    <!-- Left-aligned links (default) -->
    <a href="index.php">Home</a>
    <a href="store.php">Stores</a>
    <a href="customer.php">Customers</a>
    <a href="product.php">Products</a>
    <a href="top.php">Tops</a>
    <a href="bottom.php">Bottoms</a>
    <a href="shoe.php">Shoes</a>
    <a href="transactions.php">Transactions</a>
    <a href="cart.php"  class="active">Cart</a>

</div>



</div>


<title>FinalizePurchase</title>
<div style="padding-left:16px">
    <h1>Cart</h1>
</div>


<?php

class TableRows extends RecursiveIteratorIterator
{
    function __construct($it)
    {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current()
    {
        return "<td style='width: 150px; border: 1px solid black;'>" . parent::current() . "</td>";
    }

    function beginChildren()
    {
        echo "<tr>";
    }

    function endChildren()
    {
        echo "</tr>" . "\n";
    }
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clothingdatabase";


$totalPrice = $_GET['id'];

if(isset($_SESSION["currentTransactionID"]))
{
    try {
    $conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

   /* $stmt1 = $conn->prepare("INSERT INTO transaction VALUES(" . $_SESSION["currentTransactionID"] . ", " . $totalPrice .")");
    $stmt2 = $conn->prepare("INSERT INTO CustomerPurchases VALUES(" . $_SESSION["customerID"] . ", " . $_SESSION["currentTransactionID"] .")");

    $stmt1->execute();
    $stmt2->execute();*/


    $stmt6 = $conn->prepare("CALL finalizeCartTransact(" . $_SESSION["currentTransactionID"] . ", " . $_SESSION["customerID"] . ")");
    $stmt6->execute();


    $conn = null;
    unset($_SESSION["currentTransactionID"]);

        } catch (PDOException $e) {
    echo "Error: " . $e->getMessage();
        }
    echo '<br></br>';
    echo "<h2>Transaction successfully processed.</h2>";
    echo '<br></br>';
    echo '<a href="transactions.php" class="registerbtn">Go to Transactions</a>';  
}

else 
{
    header("Location: cart.php");
}

 

?>

</body>
</html>