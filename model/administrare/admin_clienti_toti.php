 <?php
include'verificare.php';
include'admin_barasus.php';
include'admin_logomeniu.php';
$clienti='';
$clienti.='<table width="75%" border="0"><tr bgcolor="lightblue"><th align="center" colspan="7">Clienti:</th></tr>';

$clienti_inregistrati_activi=mysql_query("SELECT * FROM clienti WHERE stare_cont_client='acceptat'");
$numar_clienti_activi=mysql_num_rows($clienti_inregistrati_activi);
$clienti_inregistrati=mysql_query("SELECT * FROM clienti");
$numar_clienti=mysql_num_rows($clienti_inregistrati);
while($rand_clienti=mysql_fetch_array($clienti_inregistrati)){
$id_client=$rand_clienti['id_client'];
$nume_client=$rand_clienti['nume_client'];
$nick_client=$rand_clienti['nick_client'];
$nivel_client=$rand_clienti['nivel_client'];
$email=$rand_clienti['email'];
$nume_cumparator=$rand_clienti['nume_cumparator'];
$nr_registru_comert=$rand_clienti['nr_registru_comert'];
$cod_fiscal=$rand_clienti['cod_fiscal'];
$strada_client=$rand_clienti['strada_client'];
$judet_client=$rand_clienti['judet_client'];
$localitate_client=$rand_clienti['localitate_client'];
$telefon=$rand_clienti['telefon'];
$stare_cont_client=$rand_clienti['stare_cont_client'];
$ip_client=$rand_clienti['ip_client'];
$data_logare_client=$rand_clienti['data_logare_client'];
$ultima_logare=$rand_clienti['ultima_logare'];
   
$clienti.='<tr><th align="center">Nume</th><th align="center">Nick</th><th align="center">Email</th><th align="center">Telefon</th><th align="center">Nivel client</th><th align="center">Stare cont</th><th align="center">Actiune</th></tr>
<tr><td align="center">'.$nume_client.'</td><td align="center">'.$nick_client.'</td><td align="center">'.$email.'</td><td align="center">'.$telefon.'</td><td align="center">'.$nivel_client.'</td><td align="center">'.$stare_cont_client.'</td><td align="center"><a href="modifica_client.php?id_client='.$id_client.'" onmouseover=this.style.color="#ff0000"; return true" onmouseout=this.style.color="#000000"; return true>Vizualizeaza</a></td></tr>
<tr height="3px" bgcolor="lightblue"><th colspan="7"></th></tr>';
}





?>

<div class="spatiustinga"></br><h3 align="center">&nbsp;&nbsp;&nbsp;ACTIUNI</h3>
</br>
<ul class="meniu_vertical">
<li><a href="admin_clienti_toti.php"><img src="../poze/document.gif" border="0" alt="" />Toti clientii</a></li>
<li><a href="modifica_client.php"><img src="../poze/document.gif" border="0" alt="" />Modifica client</a></li>

</ul>


</div>
<div class="spatiudreapta_comenzi"></br></br></br>
Sint <?php echo $numar_clienti; ?> clienti inregistrati,din care <?php echo $numar_clienti_activi; ?> activi.<br />
Ultimul client inregistrat:<?php echo $nume_cumparator; ?> inregistrat la <?php echo $data_logare_client; ?><br/>
<?php echo $clienti; ?>
</table>
</div>





<?php
include'admin_barajos.php';
?>