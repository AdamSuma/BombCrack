<?php
include'verificare.php';
include'admin_barasus.php';
include'admin_logomeniu.php';

$mesaj='';
include_once "conectare.php";

$mesaj.='<font size="2"><table border="1" cellspacing="0" cellpadding="4" width="600px">
            <tr bgcolor="lightblue">
			<th colspan=5>Mesaje</th>
            </tr>
            <tr>
			<th>Data</th>
            <th>Primit de la</th>
			<th>Subiect</th>
			<th>Stare</th>
			<th>Vezi mesaj</th>
		  	</tr>';
$intrebare=mysql_query("SELECT * FROM tiket order by id_tiket DESC ");
$randuri_mesaje=mysql_num_rows($intrebare);
if($randuri_mesaje>0){
while($rand=mysql_fetch_array($intrebare)){
$id_mesaj=$rand['id_tiket'];
$data_mesaj=$rand['data_tiket'];
$subiect_mesaj=$rand['subiect'];
$stare_mesaj=$rand['stare'];
$id_client=$rand['id_client'];
$intrebare_nume_client=mysql_query("SELECT * FROM clienti WHERE id_client='$id_client'");
$client=mysql_fetch_array($intrebare_nume_client);
$nume_client=$client['nume_cumparator'];
$mesaj.='<tr>
			<td align="center">'.$data_mesaj.'</td>
            <td align="center">'.$nume_client.'</td>
			<td align="center">'.$subiect_mesaj.'</td>
			<td align="center">'.$stare_mesaj.'</td>
			<td align="center"><a href="vezi_mesaj.php?id_tiket='.$id_mesaj.'&id_client='.$id_client.'" onmouseover=this.style.color="#ff0000"; return true" onmouseout=this.style.color="#000000"; return true>Vizualizeaza</a></td>
		  	</tr>';

}
}else{
$mesaj.='<tr><td colspan="3" align="center">Nu aveti mesaje </td><td align="center">-</td><td align="center">-</td></tr>';

}








?>


<div class="spatiustinga"></br><h3 align="center">&nbsp;&nbsp;&nbsp;Mesaje</h3>
</br>
<ul class="meniu_vertical">
<li><a href="admin_mesaje_toate.php"><img src="../poze/document.gif" border="0" alt="" />Vezi toate mesajele</a></li>
<li><a href="admin_scrie_mesaj.php"><img src="../poze/document.gif" border="0" alt="" />Scrie mesaj</a></li>
</ul>


</div>
 <div class="spatiu_mesaj"></br></br></br>
<?php echo $mesaj;?>
</table>
</div>

<?php
include'admin_barajos.php';
?>