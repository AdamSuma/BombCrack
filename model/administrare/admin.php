
<?php
include'verificare.php';

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



include'admin_barasus.php';
include'admin_logomeniu.php';
?>


<div class="spatiustinga"></br><h3 align="center">&nbsp;&nbsp;&nbsp;ACTIUNI</h3>
</br>
<ul class="meniu_vertical">
<li><a href="admin_modifica_date.php"><img src="../poze/document.gif" border="0" alt="" />Modifica date de facturare</a></li>


</ul>


</div>
<div class="spatiudreapta_comenzi"></br></br></br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Sint <?php echo $numar_clienti; ?> clienti inregistrati,din care <?php echo $numar_clienti_activi; ?> activi.<br /><br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Ultimul client inregistrat:<?php echo $nume_cumparator; ?> inregistrat la <?php echo $data_logare_client; ?><br/><br/>

&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Aveti <?php echo $nr_comenzi; ?> comenzi noi.<br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Aveti <?php echo $nr_mesaje; ?> mesaje  noi.

			

</div>





<?php
include'admin_barajos.php';
?>