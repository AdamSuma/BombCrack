<?php
session_start();
include('verificare_user.php');
?>
<?php
$mesaj='';
if(isset($_GET['id_mesaj'])){
$id_mesaj=$_GET['id_mesaj'];
include_once "conectare.php";
$mesaj.='<font size="2"><table border="1" cellspacing="0" cellpadding="4" width="600px">
            <tr bgcolor="lightblue">
			<th colspan=5>Mesaj primit de la administrator</th>
			</tr>
			';
$intrebare_mesaj=mysql_query("SELECT * FROM mesaje WHERE id_mesaj='$id_mesaj' and id_client='$userid' LIMIT 1");
$raspuns_mesaje=mysql_num_rows($intrebare_mesaj);
if($raspuns_mesaje==1){
$modificare_stare=mysql_query("UPDATE mesaje SET stare_mesaj='citit' WHERE id_mesaj='$id_mesaj'");
while($rand_mesaj=mysql_fetch_array($intrebare_mesaj)){

$data_mesaj=$rand_mesaj['data_mesaj'];
$subiect=$rand_mesaj['subiect'];
$continut=$rand_mesaj['continut'];
$mesaj.='<tr>
           	<th align="center">Data</th><td>'.$data_mesaj.'</td></tr>
<tr>
           	<th align="center">Subiect</th><td>'.$subiect.'</td></tr>
<tr>
         <th>Continut</th><td>'.$continut.'</td></tr>';


}

}
}else{
$mesaj.='A aparut o eroare la afisarea mesajului';

}
$cere_mesaje=mysql_query("SELECT * FROM mesaje WHERE id_client='$userid' and stare_mesaj='necitit' order by id_mesaj DESC LIMIT 15");
$mesaje_necitite=mysql_num_rows($cere_mesaje);
include'barasus.php';
?>
<title>Vizualizare mesaj</title>
<?php

include'logomeniu.php';
?>
<div class="spatiu_meniu_client"><br/></br></br></br></br>
<ul class="meniu_vertical">
<li><a href="schimba_par.php?id=<?php echo $userid;?>"><img src="poze/lacat.jpg" border="0" alt="" />&nbsp;Schimba parola</a></li>
<li><a href="client.php?id=<?php echo $userid;?>"><img src="poze/document.gif" border="0" alt="" />&nbsp;Modifica date de facturare</a></li>
<li><a href="comenzi_client.php?id=<?php echo $userid;?>"><img src="poze/cos.gif" border="0" alt="" />&nbsp;Comenzi trimise</a></li>
<li><a href="tiket.php"><img src="poze/ticket.gif" border="0" alt="" />&nbsp;Trimite mesaj catre suport</a></li>
<li><a href="raspuns_tiket.php"><img src="poze/ticket.gif" border="0" alt="" />&nbsp;Mesaje(<?php echo $mesaje_necitite;?>)</a></li>
 </ul>
</div>
<div class="spatiu_mesaj"></br></br></br>

	<?php echo $mesaj;?>
 </table>
</div>
<?php
include'barajos.php';
?>