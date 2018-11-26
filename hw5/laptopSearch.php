<!DOCTYPE html>
<html>
<body>

<form class="search" action="laptopSearch.php" method="post">
    <input type="text" placeholder="Minimum speed" name="speed">
    <input type="text" placeholder="Mimimum RAM" name="ram">
    <input type="text" placeholder="Minimum HD size" name="hd">
    <input type="text" placeholder="Minimum Screen" name="screen">
    <button type="submit"><i class="fa fa-search"></i></button>
</form>

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
$password = "password";
$dbname = "store";


$speed = $_POST['speed'];
$ram = $_POST['ram'];
$hd = $_POST['hd'];
$screen = $_POST['screen'];



try {
        $conn = new PDO("mysql:host=$servername;port=3306;dbname=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $stmt = $conn->prepare("SELECT * FROM laptop, product WHERE speed >= '%" . $speed . "%' AND 
      ram >= '%" . $ram . "%' AND hd >= '%" . $hd . "%' AND screen >= '%" . $screen . "%' AND laptop.model=product.model");
        $count = $conn->query("SELECT count(*) FROM (SELECT * FROM laptop, product WHERE speed >= '%" . $speed . "%' AND 
      ram >= '%" . $ram . "%' AND hd >= '%" . $hd . "%' AND screen >= '%" . $screen . "%' AND laptop.model=product.model) as T")->fetchColumn();
        if ($count > 0) {

            echo "<div style='padding-left:16px; padding-bottom: 16px; padding-right: 16px'>
                        <table style='border: solid 1px black;'>
                </div>";


            $stmt->execute();

            // set the resulting array to associative
            $result = $stmt->setFetchMode(PDO::FETCH_ASSOC);

            foreach (new TableRows(new RecursiveArrayIterator($stmt->fetchAll())) as $k => $v) {
                echo $v;
            }

            $conn = null;
            echo "</table>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
    ?>
</body>
</html>
