<?php

if(isset($_GET["id"]))
{
    $id = $_GET["id"];

    $host= "localhost";
    $user= "root";
    $password= "";
    $db = "clientdb";

    $connect = new mysqli($host, $user, $password, $db);

    $sql = "DELETE FROM client WHERE id=$id";
    $connect->query($sql);
}

header("location:../index.php");
exit;

?>