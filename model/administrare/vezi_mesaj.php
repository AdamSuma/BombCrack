 <?php
include'verificare.php';
include'admin_barasus.php';
include'admin_logomeniu.php';

$mesaj='';
if(isset($_GET['id_tiket'])){
$id_tiket=$_GET['id_tiket'];
$id_client=$_GET['id_client'];
include_once "conectare.php";
$intrebare_nume_client=mysql_query("SELECT * FROM clienti WHERE id_client='$id_client'");
$client=mysql_fetch_array($intrebare_nume_client);
$nume_client=$client['nume_cumparator'];
$mesaj.='<font size="2"><table border="1" cellspacing="0" cellpadding="4" width="600px">
            <tr bgcolor="lightblue">
			<th colspan=5>Mesaj primit de la '.$nume_client.'</th>
			</tr>
			';
$intrebare_tiket=mysql_query("SELECT * FROM tiket WHERE id_tiket='$id_tiket' and id_client='$id_client' LIMIT 1");
$raspuns_mesaje=mysql_num_rows($intrebare_tiket);
if($raspuns_mesaje==1){
$modificare_stare=mysql_query("UPDATE tiket SET stare='citit' WHERE id_tiket='$id_tiket'");
while($rand_mesaj=mysql_fetch_array($intrebare_tiket)){

$data_tiket=$rand_mesaj['data_tiket'];
$subiect=$rand_mesaj['subiect'];
$continut=$rand_mesaj['comentariu'];
$mesaj.='<tr>
           	<th align="center">Data</th><td>'.$data_tiket.'</td></tr>
<tr>
           	<th align="center">Subiect</th><td>'.$subiect.'</td></tr>
<tr>
         <th>Continut</th><td>'.$continut.'</td></tr>
		 <tr>
         <td align="center"><a href="admin_scrie_mesaj.php?id_client='.$id_client.'&subiect=raspuns('.$subiect.')">Raspunde</a></td><td align="center"><a href="vezi_mesaj.php?id_tiket='.$id_tiket.'&id_client='.$id_client.'&actiune=sterge">Sterge mesaj</a></td></tr>';


}

}
}else{
$mesaj.='A aparut o eroare la afisarea mesajului';

}
if(isset($_GET['actiune'])=='sterge'){
$id_sterge_tiket=$_GET['id_tiket'];
$id_sterge_client=$_GET['id_client'];

$sterge_mesaj=mysql_query("DELETE FROM tiket WHERE id_tiket='$id_sterge_tiket' AND id_client='$id_sterge_client' LIMIT 1");
header('loaction:admin_mesaje_toate.php');
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