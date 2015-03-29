 <?php
include'verificare.php';
include'admin_barasus.php';
include'admin_logomeniu.php';

$facturi='';
$mesaj='';
include('conectare.php');
if(isset($_POST['numar'])){
$numar=$_POST['numar'];
$client=$_POST['nume_client'];
$data_facturii=$_POST['data_facturii'];


$intrebare_nume_client=mysql_query("SELECT * FROM clienti WHERE nume_cumparator LIKE '%".$client."%'") or die (mysql_error());
$raspuns_client=mysql_num_rows($intrebare_nume_client);
if($raspuns_client>0){
while($client=mysql_fetch_array($intrebare_nume_client)){
$id_client=$client['id_client'];
}
}else if($raspuns_client==0){
$id_client='';
}
$facturi.='<font size="2"><table border="1" cellspacing="0" cellpadding="4" width="600px">
            <tr bgcolor="lightblue">
			<th colspan=6>Facturi</th>
            </tr>
            <tr>
            <th>Data</th>
			<th>Factura nr.</th>
            <th>Client</th>
			<th>Total</th>
			<th>Stare</th>
			<th>Vezi factura</th>
		  	</tr>';
if(($raspuns_client>0) &&(strlen($_POST['data_facturii'])>0)&&(strlen($_POST['numar'])==0)){			
$intrebare_factura=mysql_query("SELECT * FROM factura_vanzare WHERE data_factura_vanzare='$data_facturii' " );
}else if(($raspuns_client>0) &&(strlen($_POST['data_facturii'])==0)&&(strlen($_POST['numar'])>0)){			
$intrebare_factura=mysql_query("SELECT * FROM factura_vanzare WHERE numar_factura='$numar'" );
}else if((strlen($_POST['nume_client'])==0) &&(strlen($_POST['data_facturii'])==0)&&(strlen($_POST['numar'])==0)){			
$intrebare_factura=mysql_query("SELECT * FROM factura_vanzare" );
}else if(($raspuns_client>0) &&(strlen($_POST['data_facturii'])==0)&&(strlen($_POST['numar'])==0)){			
$intrebare_factura=mysql_query("SELECT * FROM factura_vanzare WHERE id_client='$id_client' ORDER BY numar_factura ASC" );
}else if((strlen($_POST['nume_client'])==0) &&(strlen($_POST['data_facturii'])==0)&&(strlen($_POST['numar'])==0)){			
$intrebare_factura=mysql_query("SELECT * FROM factura_vanzare ORDER BY numar_factura ASC" );
}else if(($raspuns_client>0) &&(strlen($_POST['data_facturii'])>0)&&(strlen($_POST['numar'])>0)){			
$intrebare_factura=mysql_query("SELECT * FROM factura_vanzare WHERE  numar_factura='$numar' AND id_client='$id_client' AND data_factura_vanzare='$data_facturii' " );
}else if(($raspuns_client==0) &&(strlen($_POST['data_facturii'])==0)&&(strlen($_POST['numar'])>0)){			
$intrebare_factura=mysql_query("SELECT * FROM factura_vanzare WHERE  data_factura_vanzare='$data_facturii' " );
}else if(($raspuns_client==0) &&(strlen($_POST['data_facturii'])==0)&&(strlen($_POST['numar'])==0)){			
$intrebare_factura=mysql_query("SELECT * FROM factura_vanzare WHERE id_client='$id_client' " );
}else if(($raspuns_client>0) &&(strlen($_POST['data_facturii'])==0)&&(strlen($_POST['nume_client'])>0)&&(strlen($_POST['numar'])==0)){			
$intrebare_factura=mysql_query("SELECT * FROM factura_vanzare WHERE id_client='$id_client' " );
}else if(($raspuns_client==0)||($raspuns_client>0) &&(strlen($_POST['data_facturii'])>0)&&(strlen($_POST['numar'])>0)){			
$intrebare_factura=mysql_query("SELECT * FROM factura_vanzare WHERE  numar_factura='$numar' AND id_client='$id_client' AND data_factura_vanzare='$data_facturii' " );
}
$rezultat_intrebare_factura=mysql_num_rows($intrebare_factura);
$mesaj.='S-au gasit '.$rezultat_intrebare_factura.' facturi ';
if($rezultat_intrebare_factura>0){
while($randuri_factura=mysql_fetch_array($intrebare_factura)){
$numar_factura=$randuri_factura['numar_factura'];
$id_clienti=$randuri_factura['id_client'];
$intrebare_nume_client=mysql_query("SELECT * FROM clienti WHERE id_client='$id_clienti'") or die (mysql_error());
$rand_client=mysql_fetch_array($intrebare_nume_client);
$nume_client=$rand_client['nume_cumparator'];
$data=$randuri_factura['data_factura_vanzare'];
$serie_factura=$randuri_factura['serie_factura'];
$mod_plata=$randuri_factura['mod_plata'];
$total_factura=$randuri_factura['total_factura'];
$stare_factura=$randuri_factura['stare_factura'];
$id_factura=$randuri_factura['id_factura_vanzare'];

$facturi.='<tr>
			<td align="center">'.$data.'</td>
			<td align="center">'.$numar_factura.'</td>
            <td align="center">'.$nume_client.'</td>
			<td align="center">'.$total_factura.'</td>
			<td align="center">'.$stare_factura.'</td>
			<td align="center"><a href="tiparire_factura.php?id_factura='.$id_factura.'" onmouseover=this.style.color="#ff0000"; return true" onmouseout=this.style.color="#000000"; return true target="_blank">Vizualizeaza</a></td>
		  	</tr>';
}
}else{

$mesaj.='Nu s-a gasit nici un rezultat';

}


}
?>
<div class="spatiustinga"></br><h3 align="center">&nbsp;&nbsp;&nbsp;ACTIUNI</h3>
</br>
<ul class="meniu_vertical">
<li><a href="cauta_facturi.php"><img src="../poze/document.gif" border="0" alt="" />Cauta Facturi</a></li>
</ul>


</div>
<div class="spatiuprodus">
Cautare factura dupa:
<form method="post" action="cauta_facturi.php" name="formular_cautare_facturi">
Numar factura:<input type="text" name="numar"/><br/>
Nume client:<input type="text" name="nume_client"/><br/>
Data facturii:<input type="text" name="data_facturii"/><br/>
<input type="submit" value="Cauta"/>
</form>


<?php
  echo $mesaj;
?>
<?php
  echo $facturi;
?>
</table>
</div>
<?php
include'admin_barajos.php';
?>