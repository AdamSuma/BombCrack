<?php
session_start();
include('verificare_user.php');
        unset($_SESSION["id_client"]);
        unset($_SESSION["nick_client"]);
        unset($_SESSION["email"]);
        unset($_SESSION["nivel_client"]);
        unset($_SESSION["parola_client"]);
		unset($_SESSION["mesagerie"]);
if(!isset($_SESSION['id_client'])){
  $msg = "Ai iesit cu succes!";
} else {
  header("location: logout.php");
$msg = "<h2>A aparut o eroare la iesire</h2>";

}
include'barasus.php';

?>
<title>Iesire</title>
<?php
include'logomeniu.php';

?>

<div class="spatiustinga"></div>
<div class="spatiudreapta"><br/><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo "$msg"; ?><br/>
<p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="index.php">Click aici</a> pentru a te reintoarce la prima pagina </p></div>

<?php
include'barajos.php';

?>