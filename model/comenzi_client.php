<?php
session_start();

include('verificare_user.php');
?>
<?php
$comenzi='';
include_once "conectare.php";

$comenzi.='<font size="2"><table border="1" cellspacing="0" cellpadding="4" width="600px">
            <tr bgcolor="lightblue">
			<th colspan=5>Ultimele 5 comenzi</th>
            </tr>
            <tr>
			<th>Data</th>
			<th>Comanda nr.</th>
			<th>Total</th>
			<th>Stare</th>
			<th>Vezi comanda</th>
		  	</tr>';
$intrebare=mysql_query("SELECT * FROM comanda WHERE id_client='$userid' order by id_comanda DESC LIMIT 5");
$randuri_comenzi=mysql_num_rows($intrebare);
if($randuri_comenzi>0){
while($rand=mysql_fetch_array($intrebare)){
$data_comanda=$rand['data_comanda'];
$numar_comanda=$rand['id_comanda'];
$total_comanda=$rand['total_comanda'];
$stare_comanda=$rand['stare_comanda'];
$comenzi.='<tr onMouseOver="this.bgColor=red" onMouseOut="this.bgColor=">
			<td align="center">'.$data_comanda.'</td>
			<td align="center">'.$numar_comanda.'</td>
			<td align="center">'.$total_comanda.'</td>
			<td align="center">'.$stare_comanda.'</td>
			<td align="center"><a href="vizualizare_comanda.php?id_comanda='.$numar_comanda.'" onmouseover=this.style.color="#ff0000"; return true" onmouseout=this.style.color="#000000"; return true>Vizualizeaza</a></td>
		  	</tr>';

}
}else{
$comenzi.='<tr><td colspan="4" align="center">Nu aveti trimise comenzi catre noi</td><td align="center">-</td></tr>'; 

}
$cere_mesaje=mysql_query("SELECT * FROM mesaje WHERE id_client='$userid' and stare_mesaj='necitit' order by id_mesaj DESC LIMIT 15");
$mesaje_necitite=mysql_num_rows($cere_mesaje);
include'barasus.php';
?>
 <title>Comenzi</title>
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
<div class="spatiu_comenzi"></br></br></br>

	<?php echo $comenzi;?>		
 </table>
</div>
<?php
include'barajos.php';
?>