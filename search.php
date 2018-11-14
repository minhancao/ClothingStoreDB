<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "clothingdatabase";

$conn = mysqli_connect($servername, $username, $password, $dbname);

$query = $_POST['query'];

$min_length = 3;

if(strlen($query) >= $min_length){

    $query = htmlspecialchars($query);

    $query = mysqli_real_escape_string($conn, $query);

    $raw_results = mysqli_query($conn,"SELECT * FROM product
            WHERE (`productID` LIKE '%".$query."%') OR (`color` LIKE '%".$query."%') OR (`brandName` LIKE '%".$query."%')
            OR (`name` LIKE '%".$query."%') OR (`type` LIKE '%".$query."%')") or die(mysqli_error());

    if(mysqli_num_rows($raw_results) > 0){

        echo "<h1>Search results for: $query</h1>";

        while($results = mysqli_fetch_array($raw_results)){

            echo "<p><h3>".$results['name']."</h3>".$results['color']."</p>";
        }

    }
    else{
        echo "No results";
    }

}
else{
    echo "Try being more specific. No match ".$min_length;
}
?>