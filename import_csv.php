<?php
// Connect to database
include("db_connect.php");
if (isset($_POST["import"])) {
  
  $fileName = $_FILES["file"]["tmp_name"];
  
  if ($_FILES["file"]["size"] > 0) {
    
    $file = fopen($fileName, "r");
    
    while (($column = fgetcsv($file, 10000, ",")) !== FALSE) {
      $sql = "INSERT into geoip (id,ip_from,ip_to,country_code,country_name,region_name,city_name,latitude,longitude)
           values ('" . $column[0] . "','" . $column[1] . "','" . $column[2] . "','" . $column[3] . "','" . $column[4] . "','" . $column[5] . "','" . $column[6] . "','" . $column[7] . "','" . $column[8] . "')";
      $result = mysqli_query($conn, $sql);
      
      if (! empty($result)) {
        $type = "success";
        $message = "Les Données ont été importées dans la base de données";
      } else {
        $type = "error";
        $message = "Problème lors de l'importation de données CSV";
      }
    }
  }
}
//Retourner à la page index.php
header('Location: index.php');
exit;
?>  