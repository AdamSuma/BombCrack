<?php
session_start();

$toplinks = "";
if (isset($_SESSION['id_client'])) {

    $userid = $_SESSION['id_client'];
    $username = $_SESSION['nick_client'];
	$toplinks = '<a href="member_profile.php?id=' . $userid . '">' . $username . '</a> &bull;
	<a href="pagina_membrii.php">Contul meu</a> &bull;
	<a href="logout.php">Iesire</a>';
} else {
	$toplinks = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="logare_user.php">Logare</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="inregistrare.php">Inregistrare</a>';
}
include_once "conectare.php";
// Get the member id from the URL variable
$id_client = $_REQUEST['id_client'];
$id_client = preg_replace("[^0-9]", "", $id_client); // filter everything but numbers for security
if (!$id_client) {
  	$raspuns="Lipsesc date pentru a continua";
	exit();	
}
// Update the database field named 'email_activated' to 1
$sql = mysql_query("UPDATE clienti SET stare_cont_client='acceptat' WHERE id_client='$id_client'");
// Check the database to see if all is right now 
$sql_doublecheck = mysql_query("SELECT * FROM clienti WHERE id_client='$id_client' AND stare_cont_client='acceptat'");

$doublecheck = mysql_num_rows($sql_doublecheck);

if($doublecheck == 0){
$raspuns= '<br /><br /><div align=\"center\"><h3><strong><font color=red>Contul dumneavoastra nu a putut fi activat!</font></strong><h3><br /></div>';
} else if ($doublecheck > 0) {

$raspuns= '<br /><br /><h3><font color=\"#0066CC\"><strong>Contul dumneavoastra a fost activat!<br /><br />
</strong></font><a href="logare.php">Click aici</a> pentru a va loga.</h3>';
}
include'barasus.php';
include'logomeniu.php';
?>
<div class="spatiustinga"></div>
<div class="spatiudreapta"><br />
<?php echo $raspuns;?>
</div>
<?php
include'barajos.php';

?>