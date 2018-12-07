<?php
// Start the session
session_start();

?>

<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
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

        .registerbtn:hover {
            opacity: 1;
        }

        .loginbtn {
            background-color: #ce1023;
            color: white;
            padding: 16px 20px;
            margin: 8px 0;
            border: none;
            cursor: pointer;
            width: 15%;
            opacity: 0.9;
        }

        .loginbtn:hover {
            opacity: 1;
        }

    </style>
</head>
<body>

<div class="header">
    <h1>Clothing Designer DB</h1>
</div>

<title>Clothing Designer</title>


<!-- Top navigation -->
<div class="topnav">

    <!-- Left-aligned links (default) -->
    <a href="index.php" class="active">Home</a>
    <a href="store.php">Stores</a>
    <a href="customer.php">Customers</a>
    <a href="product.php">Products</a>
    <a href="top.php">Tops</a>
    <a href="bottom.php">Bottoms</a>
    <a href="shoe.php">Shoes</a>
    <a href="transactions.php">Transactions</a>
    <a href="cart.php">Cart</a>

</div>

</div>

<div style="padding-left:16px">
    <?php 
    if(isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == 1)
    {
        $_SESSION["logged_in"] = 0;
    }
        if (isset($_SESSION["logged_in"]) && $_SESSION["logged_in"] == 0) {
            $servername = "localhost";
            $username = "root";
            $password = "";
            $dbname = "clothingdatabase";

            try{
                $conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $username, $password);
                $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stmt = $conn->prepare("DELETE FROM Cart WHERE customerID = " . $_SESSION["customerID"] . "");
                $stmt->execute();
            }

            catch (PDOException $e) {
                echo "Error: " . $e->getMessage();
            }
            $_SESSION["customerID"] = "";
            $_SESSION["password"] = "";

            echo "<h2>Successfully logged out!</h2>";   
            session_destroy();
            $_SESSION = array(); // Clears the $_SESSION variable
            echo '<br></br>';
            echo '<a href="index.php" class="loginbtn">Home</a>';
        } 
    ?>
    
</div>

</body>
</html>
