<?php
include'verificare.php';
if(isset($_GET['id_produs'])){

$id_produs=$_GET['id_produs'];

include('conectare.php');

$interogare=mysql_query("UPDATE produse SET stare_produs='ascuns' WHERE id_produs='$id_produs'");

header('location:admin_produse.php');
}else{

header('location:admin_produse.php');
}
?>