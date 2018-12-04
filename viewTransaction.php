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

        .deletebtn {
            background-color: #ce1023;
            color: white;
            padding: 1px 3px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 15%;
            opacity: 0.9;
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
<body>

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
    <a href="transactions.php"  class="active">Transactions</a>
    <a href="cart.php">Cart</a>


</div>



</div>


<title>ViewTransaction</title>
<div style="padding-left:16px">
    <h1>Product Data</h1>
</div>



<?php
echo "<div style='padding-left:16px; padding-right: 16px; padding-bottom: 16px'>
        <table style='border: solid 1px black;'></div>";
echo "<tr><th>TransactionID</th><th>ProductID</th><th>Brand Name</th><th>Name</th><th>Color</th><th>Price</th></tr>";

class TableRows extends RecursiveIteratorIterator {
    function __construct($it) {
        parent::__construct($it, self::LEAVES_ONLY);
    }

    function current() {
        return "<td style='width: 150px; border: 1px solid black;'>" . parent::current(). "</td>";
    }

    function beginChildren() {
        echo "<tr>";
    }

    function endChildren() {
        echo "</tr>" . "\n";
    }
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clothingdatabase";

$transID = $_GET['id'];
$totalPrice = 0;

try {
    $conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $stmt = $conn->prepare("SELECT pur1.transactionID, p1.productID, p1.brandName, p1.name, p1.color, p1.price FROM (purchases pur1 INNER JOIN product p1 ON pur1.productID = p1.productID) WHERE pur1.transactionID = " . $transID . "");
    $stmt->execute();

    // set the resulting array to associative
    $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

    /*foreach (new TableRows(new RecursiveArrayIterator($result)) as $k => $v) {
        echo $v;
    }*/

    foreach($result as $row) {
      echo "<tr class='info'>
                <td>" . $row['transactionID'] . "</td>
                <td>" . $row['productID'] . "</td>
                <td>" . $row['brandName'] . "</td>
                <td>" . $row['name'] . "</td>
                <td>" . $row['color'] . "</td>
                <td>" . $row['price'] . "</td>";
    }

    $stmt1 = $conn->prepare("SELECT price FROM transaction WHERE transactionID = " . $transID . "");
    $stmt1->execute();
    $result2 = $stmt1->fetchAll(PDO::FETCH_ASSOC);
    foreach($result2 as $row2)
    {
        $totalPrice = $row2['price'];
    }
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";

    echo '<br></br>';
    echo "Total Price: $$totalPrice";
    echo '<br></br>';
    echo '<a href="transactions.php" class="registerbtn">Back To Transactions</a>';   
?>

</body>
</html>