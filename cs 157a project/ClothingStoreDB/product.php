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
    <h1>Clothing Designer DB</h1>
</div>

<!-- Top navigation -->
<div class="topnav">

    <!-- Left-aligned links (default) -->
    <a href="index.php">Home</a>
    <a href="store.php">Stores</a>
    <a href="customer.php">Customers</a>
    <a href="product.php" class="active">Products</a>
    <a href="top.php">Tops</a>
    <a href="bottom.php">Bottoms</a>
    <a href="shoe.php">Shoes</a>
    <a href="transactions.php">Transactions</a>
    <a href="cart.php">Cart</a>


    <form class="search" action="productSearch.php" method="post" style="margin:auto;max-width:300px">
        <input type="text" placeholder="Search.." name="query">
        <button type="submit"><i class="fa fa-search"></i></button>
    </form>
</div>



</div>


<title>Product</title>
<div style="padding-left:16px">
    <h1>Product Data</h1>
</div>



<?php
//echo "<div style='padding-left:16px; padding-right: 16px; padding-bottom: 16px'>
  //      <table style='border: solid 1px black;'></div>";
//echo "<tr><th>ProductID</th><th>Color</th><th>Price</th><th>Brand Name</th>
  //  <th>Name</th><th>Type</th><th>Purchase</th></tr>";


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

try {
    //$conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $username, $password);
    //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    //$stmt = $conn->prepare("SELECT * FROM product");
    //$stmt->execute();

    //$result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

    //foreach(new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k=>$v) {
        //echo $v;
    //}
    $db = new mysqli($servername, $username, $password, $dbname);

    $sql = "SELECT * from product";
    if(!$result = $db->query($sql)){
        die('There was an error running the query [' . $db->error . ']');
    }
    echo "
<table class='table'>
    <thead>
        <tr>";

    while ($finfo = $result->fetch_field()) {
        echo "
        <th>" . $finfo->name . "</th>";
    }
    echo "
        </tr>
    </thead>
    <tbody>";
    while($row = $result->fetch_assoc()){
        echo "<tr class='info'>
                <td>" . $row['productID'] . "</td>
                <td>" . $row['color'] . "</td>
                <td>" . $row['price'] . "</td>
                <td>" . $row['brandName'] . "</td>
                <td>" . $row['name'] . "</td>
                <td>" . $row['count'] . "</td>
                <td><a class='btn btn-primary btn-lg'  href='purchase.php?id=".$row['productID']."'>Add to cart</a></td>
                                </td>
                                   </tr>";
    }
    echo "
    </tbody>
</table>";
}
catch(PDOException $e) {
    echo "Error: " . $e->getMessage();
}
$conn = null;
echo "</table>";
?>

</body>
</html>