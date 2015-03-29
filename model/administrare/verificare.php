
<?php
session_start();
if($_SESSION['key_admin']!=session_id())
{
header('location:logare_admin.php');
exit;
}
include("../conectare.php");
$sql="select * from administrare where user_administrator='".$_SESSION['nume_admin']."' and parola_administrator='".$_SESSION['parola_criptata']."'";
$resursa=mysql_query($sql) or die(mysql_error());
if(mysql_num_rows($resursa)!=1)
	{
		echo 'Acces neautorizat!';
		exit; 
	}
$toplinks=''.$_SESSION['nume_admin'].'';
$intrebare=mysql_query("SELECT * FROM comanda WHERE stare_comanda='nepreluata' order by id_comanda DESC");
$nr_comenzi=mysql_num_rows($intrebare);

$intrebare1=mysql_query("SELECT * FROM tiket WHERE stare='necitit'");
$nr_mesaje=mysql_num_rows($intrebare1);
?>