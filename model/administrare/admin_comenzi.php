 <?php
include'verificare.php';
include'admin_barasus.php';
include'admin_logomeniu.php';

$comenzi='';
include_once "conectare.php";

$comenzi.='<font size="2"><table border="1" cellspacing="0" cellpadding="4" width="600px">
            <tr bgcolor="lightblue">
			<th colspan=6>Comenzi</th>
            </tr>
            <tr>
            <th>Data</th>
			<th>Comanda nr.</th>
            <th>Client</th>
			<th>Total</th>
			<th>Stare</th>
			<th>Vezi comanda</th>
		  	</tr>';
$intrebare=mysql_query("SELECT * FROM comanda WHERE stare_comanda='nepreluata' order by id_comanda DESC");
$randuri_comenzi=mysql_num_rows($intrebare);
if($randuri_comenzi>0){
while($rand=mysql_fetch_array($intrebare)){
$id_client=$rand['id_client'];
$data_comanda=$rand['data_comanda'];
$numar_comanda=$rand['id_comanda'];
$total_comanda=$rand['total_comanda'];
$stare_comanda=$rand['stare_comanda'];
$intrebare_nume_client=mysql_query("SELECT * FROM clienti WHERE id_client='$id_client'");
$client=mysql_fetch_array($intrebare_nume_client);
$nume_client=$client['nume_cumparator'];
$comenzi.='<tr onMouseOver="this.bgColor=red" onMouseOut="this.bgColor=">
			<td align="center">'.$data_comanda.'</td>
			<td align="center">'.$numar_comanda.'</td>
            <td align="center">'.$nume_client.'</td>
			<td align="center">'.$total_comanda.'</td>
			<td align="center">'.$stare_comanda.'</td>
			<td align="center"><a href="vezi_comanda.php?id_comanda='.$numar_comanda.'" onmouseover=this.style.color="#ff0000"; return true" onmouseout=this.style.color="#000000"; return true>Vizualizeaza</a></td>
		  	</tr>';

}
}else{
$comenzi.='<tr><td colspan="4" align="center">Nu aveti trimise comenzi catre noi</td><td align="center">-</td></tr>';

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
<div class="spatiu_comenzi"></br></br></br>

	<?php echo $comenzi;?>
 </table>
</div>

<?php
include'admin_barajos.php';
?>