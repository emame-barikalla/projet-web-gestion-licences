<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
    border: 1px solid black;
}
</style>
</head>
<body>

<?php
    require 'config.php';
    
    $myDate = date("Y-m-d", strtotime( date( "Y-m-d", strtotime( date("Y-m-d") ) ) . "+1 month" ) );
    $sql = 'SELECT * FROM licences WHERE date_fin ="' . $myDate . '"' ;
   

$result = $con->query($sql);

if ($result->num_rows > 0) {
    echo "<table><tr><th>nom</th><th>date_debut</th><th>date_fin</th><th>type</th></tr>";
    // output data of each row
    while($row = $result->fetch_assoc()) {
        echo "<tr> <td> ".$row['nom'] ."</td> <td>". $row['date_debut']."</td> <td>" . $row['date_fin'] ."</td> <td>" . $row['type'] ."</td></tr>";}
        echo "</table>";}
else {
    echo "0 results";
}


?>

</body>
</html>
  