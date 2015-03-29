<?php
session_start();

include('verificare_user.php');

?>
<?php
$mesaj='';
include_once "conectare.php";

$mesaj.='<font size="2"><table border="1" cellspacing="0" cellpadding="4" width="600px">
            <tr bgcolor="lightblue">
			<th colspan=4>Mesaje primite</th>
            </tr>
            <tr>
			<th>Data</th>
			<th>Subiect</th>
			<th>Stare</th>
			<th>Vezi mesaj</th>
		  	</tr>';
$intrebare=mysql_query("SELECT * FROM mesaje WHERE id_client='$userid' order by id_mesaj DESC LIMIT 15");
$randuri_mesaje=mysql_num_rows($intrebare);
if($randuri_mesaje>0){
while($rand=mysql_fetch_array($intrebare)){
$id_mesaj=$rand['id_mesaj'];
$data_mesaj=$rand['data_mesaj'];
$subiect_mesaj=$rand['subiect'];
$stare_mesaj=$rand['stare_mesaj'];
$mesaj.='<tr>
			<td align="center">'.$data_mesaj.'</td>
			<td align="center">'.$subiect_mesaj.'</td>
			<td align="center">'.$stare_mesaj.'</td>
			<td align="center"><a href="vizualizare_mesaj.php?id_mesaj='.$id_mesaj.'" onmouseover=this.style.color="#ff0000"; return true" onmouseout=this.style.color="#000000"; return true>Vizualizeaza</a></td>
		  	</tr>';

}
}else{
$mesaj.='<tr><td colspan="3" align="center">Nu aveti mesaje</td><td align="center">-</td></tr>'; 

}
$cere_mesaje=mysql_query("SELECT * FROM mesaje WHERE id_client='$userid' and stare_mesaj='necitit' order by id_mesaj DESC LIMIT 15");
$mesaje_necitite=mysql_num_rows($cere_mesaje);
include'barasus.php';
?>
<title>Mesaje</title>
<?php

include'logomeniu.php';
?>
<div class="spatiu_meniu_client"><br/><br /><br /></br></br>
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