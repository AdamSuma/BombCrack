<?php
if(($_REQUEST['user']=="") || ($_REQUEST['parola_admin']==""))
	{
		echo 'Toate campurile trebuie completate!<br/>
		<a href="logare_admin.php">Inapoi!</a>';
		exit;
	}
include("../conectare.php");
$parola_criptata=md5($_REQUEST['parola_admin']);
$sql="select * from administrare where user_administrator='".$_REQUEST['user']."' and parola_administrator='".$parola_criptata."'";
$resursa=mysql_query($sql) or die(mysql_error());
if(mysql_num_rows($resursa)!=1)
	{
		echo 'Nume sau parola gresite!<br/>
		<a href="logare_admin.php">Inapoi!</a>';
		exit;
	}
session_start();
$_SESSION['nume_admin']=$_REQUEST['user'];
$_SESSION['parola_criptata']=$parola_criptata;
$_SESSION['key_admin']=session_id();
header("location: admin.php");
?>