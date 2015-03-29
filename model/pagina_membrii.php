<?php
session_start();

$linksus = "";
if (isset($_SESSION['id_client'])) {

    $userid = $_SESSION['id_client'];
    $username = $_SESSION['nick_client'];
	$linksus = 'Bine ai venit &nbsp;' . strtoupper($username) . '</a> &bull;
	<a href="pagina_membrii.php">Contul meu</a> &bull;
	<a href="logout.php">Iesire</a>';
} else {
	echo 'Va rugam <a href="logare_user.php">inregistrati-va</a> pentru a accesa contul dumneavoastra';
    exit();
}
?>
<?php
include_once "conectare.php";
$sql = mysql_query("SELECT * FROM clienti WHERE id_client='$userid' LIMIT 1");
while($row = mysql_fetch_array($sql)){
$nume_client = $row["nume_client"];
$nick_client = $row["nick_client"];
$email = $row["email"];
$nivel_acces = $row["nivel_client"];
$cod_fiscal = $row["cod_fiscal"];
$nr_registru_comert=$row["nr_registru_comert"];
$strada_firma = $row["strada_client"];
$judet_firma = $row["judet_client"];
$localitate_firma = $row["localitate_client"];
$nume_firma = $row["nume_cumparator"];
}
if ($nivel_acces == "1") {
	$userOptions = "<img src='poze/user.png' border='0' alt='' />&nbsp;&nbsp;Esti inregistrat ca si<b>Cumparator</b>";
} else if ($nivel_acces == "2") {
	$userOptions = "<img src='poze/user.png' border='0' alt='' />&nbsp;&nbsp;Esti inregistrat ca si <b>Client En-gros</b>";
} else{
     $userOptions = "Eroare la preluare date";
}
$cere_mesaje=mysql_query("SELECT * FROM mesaje WHERE id_client='$userid' and stare_mesaj='necitit' order by id_mesaj DESC LIMIT 15");
$mesaje_necitite=mysql_num_rows($cere_mesaje);

include'barasus.php';

?>
<title>Pagina personala</title>
<?php
include'logomeniu.php';
?>
<div class="spatiu_meniu_client"><br/><br /></br></br></br>
<ul class="meniu_vertical">
<li><a href="schimba_par.php?id=<?php echo $userid;?>"><img src="poze/lacat.jpg" border="0" alt="" />&nbsp;Schimba parola</a></li>
<li><a href="client.php?id=<?php echo $userid;?>"><img src="poze/document.gif" border="0" alt="" />&nbsp;Modifica date de facturare</a></li>
<li><a href="comenzi_client.php?id=<?php echo $userid;?>"><img src="poze/cos.gif" border="0" alt="" />&nbsp;Comenzi trimise</a></li>
<li><a href="tiket.php"><img src="poze/ticket.gif" border="0" alt="" />&nbsp;Trimite mesaj catre suport</a></li>
<li><a href="raspuns_tiket.php"><img src="poze/ticket.gif" border="0" alt="" />&nbsp;Mesaje(<?php echo $mesaje_necitite;?>)</a></li>
 </ul>
</div>
<div class="membrii"></br></br></br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Bine te-am gasit&nbsp;&nbsp;<?php echo"$nume_client";?></b><br/></br><hr color="#000000" size="1" align="left" width="430px"><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="poze/email.gif" border="0" alt="" />&nbsp;&nbsp;Adresa d-voastra de mail este:<b><?php echo"$email";?></b><br /><hr color="#000000" size="1" style="dotted" align="left" width="430px"><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="poze/document.gif" border="0" alt="" />&nbsp;&nbsp;Datele dumneavoastra de facturare sint:<br /><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo strtoupper($nume_firma);?><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo strtoupper($cod_fiscal);?><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo strtoupper($nr_registru_comert);?><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo strtoupper($strada_firma);?><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo strtoupper($localitate_firma);?><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo strtoupper($judet_firma);?><br /><br /><hr color="#000000" size="1" align="left" width="430px"><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $userOptions;?><br /><hr color="#000000" size="1" align="left" width="430px">

</div>
<?php
include'barajos.php';
?>







