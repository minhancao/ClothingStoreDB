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


    $query = $_POST['query'];

    $min_length = 3;

    if(strlen($query) >= $min_length) {

        try {
            $conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $username, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stmt = $conn->prepare("SELECT * FROM product
                WHERE (`productID` LIKE '%" .$query. "%') OR (`color` LIKE '%" .$query. "%') OR (`brandName` LIKE '%" .$query. "%')
                OR (`name` LIKE '%" .$query. "%') OR (`count` LIKE '%" .$query. "%')");
            $count = $conn->query("SELECT count(*) FROM (SELECT * FROM product
                WHERE (`productID` LIKE '%" .$query. "%') OR (`color` LIKE '%" .$query. "%') OR (`brandName` LIKE '%" .$query. "%')
                OR (`name` LIKE '%" .$query. "%') OR (`count` LIKE '%" .$query. "%')) as T")->fetchColumn();
            if ($count > 0){

                echo "<div style='padding-left:16px; padding-bottom: 16px; padding-right: 16px'>
                        <table style='border: solid 1px black;'>
                </div>";
                echo "<tr><th>ProductID</th><th>Color</th><th>Price</th><th>Brand Name</th>
                <th>Name</th><th>Count</th></tr>";

                $stmt->execute();

                // set the resulting array to associative
                $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

                foreach($result as $row) {
                echo "<tr class='info'>
                    <td>" . $row['productID'] . "</td>
                    <td>" . $row['color'] . "</td>
                    <td>" . $row['price'] . "</td>
                    <td>" . $row['brandName'] . "</td>
                    <td>" . $row['name'] . "</td>
                    <td>" . $row['count'] . "</td>
                    <td><a class='btn btn-primary btn-lg'  href='purchase.php?id=".$row['productID']."'>Purchase</a></td>
                                    </td>
                                       </tr>";
                    }

                $conn = null;
                echo "<h2>Search results for: '$query' </h2>";
                echo "</table>";
            }
            else  {
                echo "<div style=\"padding-left:16px\">
                <h2>No results for: '$query'</h2>
                </div>";
                echo  "<div style=\"padding-left:16px\">
                <h3>It does not exist in the database at this time.</h3>
                </div>";
            }

        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }
    else {
        echo "<div style=\"padding-left:16px\">
                <h2>No results can be shown matching your criteria. Try being more specific.</h2>
                </div>";
    }


?>

</body>
</html>