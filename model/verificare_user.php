<?php

$linksus= "";
if (isset($_SESSION['id_client'])) {

    $userid = $_SESSION['id_client'];
    $username = $_SESSION['nick_client'];
	$nivel_client=$_SESSION["nivel_client"];
	$mesagerie=$_SESSION['mesagerie'];
	$linksus = 'Bine ai venit &nbsp;' . strtoupper($username) . '</a> &bull;
	<a href="pagina_membrii.php">Contul meu</a> &bull;
	<a href="logout.php">Iesire</a>';
} else {
	$linksus = '&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="logare_user.php">Logare</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="inregistrare.php">Inregistrare</a>';
}
?>