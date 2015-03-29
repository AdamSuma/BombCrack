<?php
session_start();

include('verificare_user.php');
?>
<?php
$comanda='';
if(isset($_GET['id_comanda'])){
$id_comanda=$_GET['id_comanda'];
include_once "conectare.php";

$comanda.='<font size="2"><table border="1" cellspacing="0" cellpadding="4" width="600px">
            <tr bgcolor="lightblue">
			<th colspan=5>Comanda nr.'.$id_comanda.'</th>
			</tr>
			<tr>
           	<th align="center">Poza</th>
			<th align="center">Cod</th>
			<th align="center">Produs</th>
			<th align="center">Bucati</th>
			<th align="center">Pret cu TVA</th>
					  	</tr>';
$intrebare_comanda=mysql_query("SELECT * FROM comanda WHERE id_comanda='$id_comanda' AND id_client='$userid'");
$randuri_comanda=mysql_num_rows($intrebare_comanda);
if($randuri_comanda==1){
$rand1=mysql_fetch_array($intrebare_comanda);
$total_comanda=$rand1['total_comanda'];
$data_comanda=$rand1['data_comanda'];
$stare_comanda=$rand1['stare_comanda'];
			
$intrebare=mysql_query("SELECT * FROM vanzari WHERE id_comanda='$id_comanda'");
$randuri_comenzi=mysql_num_rows($intrebare);
if($randuri_comenzi>0){
while($rand=mysql_fetch_array($intrebare)){
$id_produs=$rand['id_produs'];
$bucati=$rand['bucati'];
$adresa_imagine="poze/poze_produse/".$id_produs.".jpg";
				if(file_exists($adresa_imagine))
					{
						$imagine='<img src="'.$adresa_imagine.'" width="60" height="50">';
					}
					else
						{
							$imagine= '<div style="width:60px; height:50px; border:1px black  solid; background-color:#cccccc;">Fara Imagine</div>';
						}


$comanda.='<tr>
			<td align="center">'.$imagine.'</td>
			<td align="center">'.$id_produs.'</td>';
$intrebare1=mysql_query("SELECT * FROM produse WHERE id_produs='$id_produs'");
$rand2=mysql_fetch_array($intrebare1);
			
$comanda.='<td align="center">'.$rand2['denumire_produs'].'</td>
			<td align="center">'.$bucati.'</td>
			<td align="center">'.$rand2['pret_produs'].'</td>
			</tr>';


}
}

$comanda.='</tr>
			<td colspan=4 align="right">TOTAL CU TVA</td><td align="center">'.$total_comanda.'</td>
		  	</tr>';
}
}else{
$comanda.='A aparut o eroare la preluarea comenzii'; 

}
$cere_mesaje=mysql_query("SELECT * FROM mesaje WHERE id_client='$userid' and stare_mesaj='necitit' order by id_mesaj DESC LIMIT 15");
$mesaje_necitite=mysql_num_rows($cere_mesaje);
include'logomeniu.php';
?>
 <title>Comanda nr. <?php echo $id_comanda; ?></title>
<?php
include'barasus.php';

?>
<div class="spatiustinga"><br/><h3 align="center">Gestionare cont:</h3></br></br>
<ul class="meniu_vertical">
<li><a href="schimba_par.php?id=<?php echo $userid;?>"><img src="poze/lacat.jpg" border="0" alt="" />&nbsp;Schimba parola</a></li>
<li><a href="client.php?id=<?php echo $userid;?>"><img src="poze/document.gif" border="0" alt="" />&nbsp;Modifica date de facturare</a></li>
<li><a href="comenzi_client.php?id=<?php echo $userid;?>"><img src="poze/cos.gif" border="0" alt="" />&nbsp;Comenzi trimise</a></li>
<li><a href="tiket.php"><img src="poze/ticket.gif" border="0" alt="" />&nbsp;Trimite mesaj catre suport</a></li>
<li><a href="raspuns_tiket.php"><img src="poze/ticket.gif" border="0" alt="" />&nbsp;Mesaje(<?php echo $mesaje_necitite;?>)</a></li>
 </ul>
</div>
<div class="spatiudreapta_comenzi"></br></br></br>

	<?php echo $comanda;?>		
 </table>
</div>
<?php
include'barajos.php';
?>