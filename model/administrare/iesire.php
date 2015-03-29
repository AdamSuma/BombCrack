<?php
include'verificare.php';
unset($_SESSION['nume_admin']);
unset($_SESSION['parola_criptata']);
unset($_SESSION['key_admin']);
if($_SESSION['key_admin']!=session_id()){
 header('location:logare_admin.php');
} 

?>
