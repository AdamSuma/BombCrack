 <?php
include'verificare.php';
include'admin_barasus.php';
include'admin_logomeniu.php';
$clienti_inregistrati=mysql_query("SELECT * FROM clienti");
$numar_clienti=mysql_num_rows($clienti_inregistrati);
$clienti_inregistrati_activi=mysql_query("SELECT * FROM clienti WHERE stare_cont_client=acceptat");
$numar_clienti_activi=mysql_num_rows($clienti_inregistrati);
$ultimul_client_inregistrat=mysql_query("SELECT * FROM clienti ORDER BY data_logare_client DESC LIMIT 1");
while($rand_ult=mysql_fetch_array($ultimul_client_inregistrat)){
$id_client=$rand_ult['id_client'];
$nume_cumparator=$rand_ult['nume_cumparator'];
$data_logare_client=$rand_ult['data_logare_client']; 

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
Ultimul client inregistrat:<?php echo $nume_cumparator; ?> inregistrat la <?php echo $data_logare_client; ?>

</div>





<?php
include'admin_barajos.php';
?>