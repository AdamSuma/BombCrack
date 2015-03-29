<?php
include'verificare.php';
include'admin_barasus.php';
include'admin_logomeniu.php';


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
$intrebare_comanda=mysql_query("SELECT * FROM comanda WHERE id_comanda='$id_comanda'");
$randuri_comanda=mysql_num_rows($intrebare_comanda);
if($randuri_comanda==1){
$rand1=mysql_fetch_array($intrebare_comanda);
$id_client=$rand1['id_client'];
$total_comanda=$rand1['total_comanda'];
$data_comanda=$rand1['data_comanda'];
$stare_comanda=$rand1['stare_comanda'];
if($stare_comanda=='anulata'){
$stare='<a href="vezi_comanda.php?id_comanda='.$id_comanda.'&id_client='.$id_client.'&actiune=sterge">Sterge</a>';
}
if($stare_comanda=='nepreluata'){
$stare='<a href="vezi_comanda.php?id_comanda='.$id_comanda.'&id_client='.$id_client.'&actiune=anuleaza">Anuleaza</a>';
}
$intrebare_nume_client=mysql_query("SELECT * FROM clienti WHERE id_client='$id_client'");
$client=mysql_fetch_array($intrebare_nume_client);
$nume_client=$client['nume_cumparator'];
$telefon=$client['telefon'];			
$intrebare=mysql_query("SELECT * FROM vanzari WHERE id_comanda='$id_comanda'");
$randuri_comenzi=mysql_num_rows($intrebare);
if($randuri_comenzi>0){
while($rand=mysql_fetch_array($intrebare)){
$id_produs=$rand['id_produs'];
$bucati=$rand['bucati'];
$adresa_imagine="../poze/poze_produse/".$id_produs.".jpg";
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
		  	</tr>
			<tr>
			<td align="center"><a href="admin_comenzi.php">Inapoi</td><td colspan=2 align="center">Client:&nbsp;&nbsp;'.$nume_client.'&nbsp;&nbsp;Tel:'.$telefon.'</td><td align="center">'.$stare.'</td><td align="center"><a href="factureaza_comanda.php?id_comanda='.$id_comanda.'&id_client='.$id_client.'">Factureaza</a></td>
			</tr>';
}
}else{
$comanda.='A aparut o eroare la preluarea comenzii'; 

}
if((isset($_GET['actiune']))&&($_GET['actiune']=='anuleaza')){
$id_comanda=$_GET['id_comanda'];
$id_client=$_GET['id_client'];
$anuleaza=mysql_query("UPDATE comanda SET stare_comanda='anulata' WHERE id_comanda='$id_comanda' AND id_client='$id_client'");
header('location:comenzi_anulate.php');
}
if((isset($_GET['actiune']))&&($_GET['actiune']=='sterge')){
$id_comanda=$_GET['id_comanda'];
$id_client=$_GET['id_client'];
$sterge_comanda=mysql_query("DELETE FROM comanda WHERE id_comanda='$id_comanda' AND id_client='$id_client'");
$sterge_pozitii=mysql_query("DELETE FROM vanzari WHERE id_comanda='$id_comanda'");
header('location:admin_comenzi_toate.php');
}


$intrebare_nr_comenzi=mysql_query("SELECT * FROM comanda");
$nr_comenzi=mysql_num_rows($intrebare_nr_comenzi);
$intrebare_nr_comenzi_anulate=mysql_query("SELECT * FROM comanda WHERE stare_comanda='anulata'");
$nr_comenzi_anulate=mysql_num_rows($intrebare_nr_comenzi_anulate);



?>
<div class="spatiustinga"></br><h3 align="center">&nbsp;&nbsp;&nbsp;ACTIUNI</h3>
</br>
<ul class="meniu_vertical">
<li><a href="admin_comenzi_toate.php"><img src="../poze/document.gif" border="0" alt="" />Toate comenzile(<?php echo $nr_comenzi;?>)</a></li>
<li><a href="admin_comenzi_anulate.php"><img src="../poze/document.gif" border="0" alt="" />Comenzi anulate(<?php echo $nr_comenzi_anulate;?>)</a></li>

</ul>


</div>
<div class="spatiudreapta_comenzi"></br></br></br>

	<?php echo $comanda;?>		
 </table>
</div>
<?php
include'admin_barajos.php';
?>