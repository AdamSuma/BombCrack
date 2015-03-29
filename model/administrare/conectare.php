<?php
//conectarea la baza de date

$bd_host="localhost"; //numele hostului
$bd_user="root"; //nume user
$bd_parola=""; //parola user
$bd_nume="licenta"; //numele bazei de date

mysql_connect("$bd_host","$bd_user","$bd_parola") or die ("nu m-am putut conecta la baza de date");
mysql_select_db("$bd_nume") or die ("nu exista baza de date");

?>