 <?php
include'verificare.php';
include'admin_barasus.php';
include'admin_logomeniu.php';


$serie_factura='';
$numar_factura='';
$furnizor='';
$pret_total='';
$pret_total_fara_tva='';
$tva_total='';
$data=date( 'd-m-Y' );
$factura='';
$id_produs='';
if(!isset($_SESSION['id_client'])){
$_SESSION['id_client']='';

}


$intrebare_date_furnizor=mysql_query("SELECT * FROM date_firma");
$randuri_date_furnizor=mysql_fetch_array($intrebare_date_furnizor);
$nume_furn=$randuri_date_furnizor['nume_firma'];
$cod_fiscal_furn=$randuri_date_furnizor['cod_fiscal'];
$nr_reg_com_furn=$randuri_date_furnizor['nr_reg_comert'];
$sediu_furn=$randuri_date_furnizor['sediul'];
$judet_furn=$randuri_date_furnizor['judetul'];
$cont_furn=$randuri_date_furnizor['contul'];
$banca_furn=$randuri_date_furnizor['banca'];
$capital_furn=$randuri_date_furnizor['capital_social'];
$nume_client=$cod_client=$nr_reg_com_client=$sediu_client=$judet_client=$cod_client=$id_client='';
if(isset($_GET['id_client'])){
$_SESSION['id_client']=$_GET['id_client'];
$id_client=$_SESSION['id_client'];
}
$intrebare_nume_client=mysql_query("SELECT * FROM clienti WHERE id_client='".$_SESSION['id_client']."'");
$client=mysql_fetch_array($intrebare_nume_client);
$nume_client=$client['nume_cumparator'];
$cod_client=$client['cod_fiscal'];
$nr_reg_com_client=$client['nr_registru_comert'];
$sediu_client=$client['strada_client'];
$judet_client=$client['judet_client'];
$cod_client=$client['cod_fiscal'];


if(isset($_POST['factura_noua'])){
if(isset($_SESSION['nr_factura'])){
unset($_SESSION['nr_factura']);
}
if(isset($_SESSION['serie_factura'])){
unset($_SESSION['serie_factura']);
}
if(isset($_SESSION['id_client'])){
unset($_SESSION['id_client']);
}
if(isset($_SESSION['factura'])){
unset($_SESSION['factura']);
}
$sql_id_factura="SELECT * FROM factura_vanzare ORDER BY numar_factura DESC LIMIT 1";
$raspuns=mysql_query($sql_id_factura)or die(mysql_error());
while($rand=mysql_fetch_array($raspuns)){
$serie_factura=$rand['serie_factura'];
$numar_factura=$rand['numar_factura']+1;
$_SESSION['nr_factura']=$numar_factura;
$_SESSION['serie_factura']=$serie_factura;
header('location:admin_facturi.php');
}
}
$pret_total=0;
$pret_total_fara_tva=0;
$tva_total=0;
if (($pret_total>0)||(isset($_GET['fid_produs']))||($_SESSION['id_client'])!=''){
if(!isset($_SESSION['serie_factura'])){
$_SESSION['serie_factura']='';
}
if(!isset($_SESSION['nr_factura'])){
$_SESSION['nr_factura']='';
}


$factura.='<font size="2"><table border="0" cellspacing="0" cellpadding="4" width="100%">
       <tr>
<td align="right" width="100px"></td><td align="left" width="100px"><font size="1"></td><form action="admin_facturi.php" name="formular" method="POST"><td align="center">&nbsp;&nbsp;&nbsp;&nbsp;<div class="buton_factura_noua"><input type="submit" name="factura_noua" value=""/></div></form></td><td align="center"></td><td align="center"></td><td align="center" width="100px"><a href="admin_adauga_client.php"><img src="../poze/modifica_client.jpg" border="0"></a></td><td width="100px"align="left"></td>
			</tr>
					<tr>
<td align="right" width="100px">Furnizor:</td><td align="left" width="100px"><font size="1">'.$nume_furn.'</td><td align="center"></td><td align="center"></td><td align="center"></td><td align="right" width="100px">Client:</td><td width="100px"align="left"><font size="1">'.$nume_client.'</td>
			</tr>
			<tr>
<td align="right" width="100px">Nr.Reg.Com.:</td><td align="left" width="100px"><font size="1">'.$nr_reg_com_furn.'</td><td align="center" colspan=2>FACTURA FISCALA</td><td align="right"></td><td align="right">Cod fiscal:</td><td width="100px" align="left"><font size="1">'.$cod_client.'</td>
			</tr>
			<tr>
<td align="right" width="100px">Cod fiscal:</td><td align="left" width="100px"><font size="1">'.$cod_fiscal_furn.'</td><td align="center" colspan=2>Serie:'.$_SESSION['serie_factura'].'  Numar:'.$_SESSION['nr_factura'].'</td><td align="right"></td><td width="100px" align="right">Nr.Reg.Com.:</td><td align="left"><font size="1">'.$nr_reg_com_client.'</td>
			</tr>
			<tr>
<td align="right">Sediul:</td><td align="left" width="100px"><font size="1">'.$sediu_furn.'</td><td align="center" colspan=2>Data:&nbsp;'.$data.'</td><td align="right"></td><td align="right">Sediul:</td><td align="left" width="100px"><font size="1">'.$sediu_client.'</td>
			</tr>
			<tr>
<td align="right">Judetul:</td><td align="left" width="100px"><font size="1">'.$judet_furn.'</td><td align="center"></td><td align="center"></td><td align="center"></td><td align="right">Judet:</td><td align="left" width="100px"><font size="1">'.$judet_client.'</td>
			</tr>
			<tr>
<td align="right">Cont:</td><td align="left" width="100px"><font size="1">'.$cont_furn.'</td><td align="center"></td><td align="center"></td><td align="center"></td><td align="right">Cont:</td><td align="left" width="100px"><font size="1"></td>
			</tr>
			<tr>
<td align="right">Banca:</td><td align="left" width="100px"><font size="1">'.$banca_furn.'</td><td align="center"></td><td align="center"></td><td align="center"></td><td align="right">Banca:</td><td align="left"><font size="1"></td>
			</tr>
			<tr>
<td align="right">Cap.Soc.:</td><td align="left" width="100px"><font size="1">'.$capital_furn.'</td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td>

			</tr>
			<tr>
<td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td>

			</tr>
			<tr>
<td align="center"><font size="1">Cota TVA:24%</td><td align="center"><td align="center"></td><td align="center"></td></td><td align="center"></td><td align="center"></td><td align="center"></td>
			</tr>
</table>
			';

if (isset($_GET['fid_produs'])){
   $id_produs=$_GET['fid_produs'];
    } else{
   $id_produs=1;
 }
if (isset($_GET['actiune']))
$actiune=$_GET['actiune'];
	else
 $actiune="sterge";
 switch($actiune)
 {
 case "adauga":
 if(isset($_SESSION['factura'][$id_produs]))
     $_SESSION['factura'][$id_produs]++;
           else
      $_SESSION['factura'][$id_produs]=0;
       header("location:admin_facturi.php");
 break;
  case "scade":

  if((isset($_SESSION['factura'][$id_produs])&&($_SESSION['factura'][$id_produs])>1))
     $_SESSION['factura'][$id_produs]--;
     header("location:admin_facturi.php");
  break;
   case "modifica":
  
  if (isset($_POST["bucati"])) 
  $bucati=$_POST["bucati"];
  if($bucati<0){
$bucati=0;
}
  $_SESSION['factura'][$id_produs]=$bucati;
      break;

   case "sterge":
   unset($_SESSION['factura'][$id_produs]);
    break;

 }

$factura.='<a href="admin_adauga_produse.php"><img src="../poze/buton_adauga_produs.jpg" border="0"></a>';
$factura.='<table border="1" cellspacing="0" cellpadding="1" width="100%">

<tr bgcolor="#DFDFDF">
<th align="center">NrCrt</th>
<th align="center">Cod</th>
<th align="center">Denumire produs</th>
<th align="center" width="80px">Cantitate</th>
<th align="center">Pret unitar</th>
<th align="center">Valoare</th>
<th align="center">Valoaretva</th>
<th align="center">&#10003;</th>
<th align="center">Actiune</th></tr>';
 $i=1;

 if(isset($_SESSION['factura'])){
 foreach($_SESSION['factura']as $id_produs =>$x)
{
$intrebare=mysql_query("SELECT * FROM produse WHERE id_produs=$id_produs");
$rand=mysql_fetch_array($intrebare);
      $denumire_produs=$rand['denumire_produs'];
      $pret=$rand['pret_produs'];
	  $pret_fara_tva=$pret/1.24;
	  $pret_fara_tva=round($pret_fara_tva,2);
      $linie_produs=$pret*$x;
	  $linie_produs_fara_tva=$linie_produs/1.24;
	  $linie_produs_fara_tva=round($linie_produs_fara_tva,2);
      $tva_linie_produs=$linie_produs-$linie_produs_fara_tva;
	  $tva_linie_produs=round($tva_linie_produs,2);
      $pret_total=$pret_total+$linie_produs;
	  $pret_total_fara_tva=$pret_total/1.24;
	  $tva_total=$pret_total-$pret_total_fara_tva;
	  $tva_total=round($tva_total,2);
	  $pret_total_fara_tva=round($pret_total_fara_tva,2);
      $_SESSION['total']=$pret_total;
      $_SESSION['fid_produs']=$rand['id_produs'];
	  $nr_crit=$i++;
     
$factura.='<tr>
<td align="center">'.$nr_crit.'</td>
<td>'.$id_produs.'</td>
<td>'.$denumire_produs.'</td>
<form action="admin_facturi.php?fid_produs='.$id_produs.'&actiune=modifica" name="form" method="POST">
<td align="center">		    
<input type="text" name="bucati" size="3" value="'.$x.'"/>
								</td>
<td align="center">'.$pret_fara_tva.'</td>
<td align="center">'.$linie_produs_fara_tva.'</td>
<td align="center">'.$tva_linie_produs.'</td>
<td align="center">	<input type="submit" value="&#10003;"/></td></form>
<td align="center" ><a href="admin_facturi.php?fid_produs='.$id_produs.'&actiune=sterge" style=color:#000000;text-decoration:none font-family:"Times New Roman" onmouseover=this.style.color="#ff0000"; return true" onmouseout=this.style.color="#000000"; return true">Sterge</a></td>
</tr>';
}
}

$factura.='</table><table border="0" cellspacing="0" cellpadding="1" width="100%"><tr><th colspan="10" align="right">Suma pozitiilor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
</tr>
<tr>
<td align="right">Valoare ftva:&nbsp;<b>'.$pret_total_fara_tva.'</b>&nbsp;&nbsp;&nbsp;Valoare tva:&nbsp;<b>'.$tva_total.'</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
<td></td>
</tr>
<tr>
<td align="right" >Valoare totala &nbsp;&nbsp;<b>'.$pret_total.'</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
</table>
<br/>';

if ($pret_total!=0){
$id_factura_vanzare='';
$intrebare_factura=mysql_query("SELECT * FROM factura_vanzare WHERE numar_factura='".$_SESSION['nr_factura']."' AND serie_factura='".$_SESSION['serie_factura']."' LIMIT 1");
while($randuri_factura=mysql_fetch_array($intrebare_factura)){
$id_factura_vanzare=$randuri_factura['id_factura_vanzare'];
$numar_factura=$randuri_factura['numar_factura'];
}
$intrebare_factura1=mysql_query("SELECT * FROM factura_vanzare WHERE numar_factura='".$_SESSION['nr_factura']."' LIMIT 1");
$randuri_facturi=mysql_num_rows($intrebare_factura1);
if($randuri_facturi!=1){
$buton='<form action="admin_facturi.php" method="post" name="Salveaza" ><input type="submit" name="salveaza" value="Emite"/></td></form>';
}else{
$buton='</td>';
}

$factura.='<table border="0" cellspacing="0" cellpadding="1" width="100%">
<tr>
<td align="right">'.$buton.'<form><td align="right"><a href="tiparire_factura.php?id_factura='.$id_factura_vanzare.'" target="_blank "/>Tipareste&nbsp;&nbsp;<img src="../poze/tipareste.gif" border="0">&nbsp;&nbsp;</a></td></form>
</tr> </table>';
  }

if (isset($_POST['salveaza'])){
$numar_factura=$_SESSION['nr_factura'];
$serie_factura=$_SESSION['serie_factura'];
$data=date('Ymd');
$id_client=$_SESSION['id_client'];
$mod_plata='curierat';
$stare_factura='salvata';
$sql_introducere_factura=mysql_query("INSERT INTO factura_vanzare(numar_factura,data_factura_vanzare,serie_factura,id_client,total_factura,mod_plata,stare_factura,incasare_factura) values('$numar_factura','$data','$serie_factura','$id_client','$pret_total','$mod_plata','$stare_factura','0')") or die (mysql_error());
$id_factura=mysql_insert_id();
header("location:admin_facturi.php");

 foreach($_SESSION['factura']as $id_produs =>$x)
{
      $intrebares=mysql_query("SELECT * FROM produse WHERE id_produs=$id_produs");
      $rands=mysql_fetch_array($intrebares);
	  $stoc_produs=$rands['stoc_produs'];
      $denumire_produs=$rands['denumire_produs'];
      $pret=$rands['pret_produs'];
	  $bucati=$x;
	  $stoc_nou=$stoc_produs-$bucati;
$sql_introducere_pozitii=mysql_query("INSERT INTO pozitii_factura_vanzare (id_factura_vanzare,id_produs,denumire_produs,bucati,pret_produs) VALUES ('$id_factura','$id_produs','$denumire_produs','$bucati','$pret') ");
$sql_scade_stocul=mysql_query("UPDATE produse SET stoc_produs='$stoc_nou' WHERE id_produs=$id_produs");


}
}
}else{
$sql_id_factura="SELECT * FROM factura_vanzare ORDER BY numar_factura DESC LIMIT 1";
$raspuns=mysql_query($sql_id_factura)or die(mysql_error());
while($rand=mysql_fetch_array($raspuns)){
$serie_factura=$rand['serie_factura'];
$numar_factura=$rand['numar_factura']+1;
$_SESSION['nr_factura']=$numar_factura;
$_SESSION['serie_factura']=$serie_factura;
}
 $factura.='<font size="2"><table border="0" cellspacing="0" cellpadding="4" width="100%">
       <tr>
<td align="right" width="100px"></td><td align="left" width="100px"><font size="1"></td><form action="admin_facturi.php" name="formular" method="POST"><td align="center">&nbsp;&nbsp;&nbsp;&nbsp;<div class="buton_factura_noua"><input type="submit" name="factura_noua" value=""/></div></form></td><td align="center"></td><td align="center"></td><td align="center" width="100px"><a href="admin_adauga_client.php"><img src="../poze/adauga_client.jpg" border="0"></a></td><td width="100px"align="left"></td>
			</tr>
					<tr>
<td align="right" width="100px">Furnizor:</td><td align="left" width="100px"><font size="1">'.$nume_furn.'</td><td align="center"></td><td align="center"></td><td align="center"></td><td align="right" width="100px">Client:</td><td width="100px"align="left"><font size="1">'.$nume_client.'</td>
			</tr>
			<tr>
<td align="right" width="100px">Nr.Reg.Com.:</td><td align="left" width="100px"><font size="1">'.$nr_reg_com_furn.'</td><td align="center" colspan=2>FACTURA FISCALA</td><td align="right"></td><td align="right">Cod fiscal:</td><td width="100px" align="left"><font size="1">'.$cod_client.'</td>
			</tr>
			<tr>
<td align="right" width="100px">Cod fiscal:</td><td align="left" width="100px"><font size="1">'.$cod_fiscal_furn.'</td><td align="center" colspan=2>Serie:'.$_SESSION['serie_factura'].'  Numar:'.$_SESSION['nr_factura'].'</td><td align="right"></td><td width="100px" align="right">Nr.Reg.Com.:</td><td align="left"><font size="1">'.$nr_reg_com_client.'</td>
			</tr>
			<tr>
<td align="right">Sediul:</td><td align="left" width="100px"><font size="1">'.$sediu_furn.'</td><td align="center" colspan=2>Data:&nbsp;'.$data.'</td><td align="right"></td><td align="right">Sediul:</td><td align="left" width="100px"><font size="1">'.$sediu_client.'</td>
			</tr>
			<tr>
<td align="right">Judetul:</td><td align="left" width="100px"><font size="1">'.$judet_furn.'</td><td align="center"></td><td align="center"></td><td align="center"></td><td align="right">Judet:</td><td align="left" width="100px"><font size="1">'.$judet_client.'</td>
			</tr>
			<tr>
<td align="right">Cont:</td><td align="left" width="100px"><font size="1">'.$cont_furn.'</td><td align="center"></td><td align="center"></td><td align="center"></td><td align="right">Cont:</td><td align="left" width="100px"><font size="1"></td>
			</tr>
			<tr>
<td align="right">Banca:</td><td align="left" width="100px"><font size="1">'.$banca_furn.'</td><td align="center"></td><td align="center"></td><td align="center"></td><td align="right">Banca:</td><td align="left"><font size="1"></td>
			</tr>
			<tr>
<td align="right">Cap.Soc.:</td><td align="left" width="100px"><font size="1">'.$capital_furn.'</td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td>

			</tr>
			<tr>
<td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td>

			</tr>
			<tr>
<td align="center"><font size="1">Cota TVA:24%</td><td align="center"><td align="center"></td><td align="center"></td></td><td align="center"></td><td align="center"></td><td align="center"></td>
			</tr>
</table>


<table border="1" cellspacing="0" cellpadding="1" width="100%">

<tr bgcolor="#DFDFDF">
<th align="center">NrCrt</th>
<th align="center">Cod</th>
<th align="center">Denumire produs</th>
<th align="center" width="80px">Cantitate</th>
<th align="center">Pret unitar</th>
<th align="center">Valoare</th>
<th align="center">Valoaretva</th>
<th align="center">&#10003;</th>
<th align="center">Actiune</th></tr>
</table><table border="0" cellspacing="0" cellpadding="1" width="80%"><tr><th colspan="10" align="right">Suma pozitiilor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    </th>
</tr>
<tr>
<td colspan="9" align="right">Valoare ftva:&nbsp;<b>'.$pret_total_fara_tva.'</b>&nbsp;&nbsp;&nbsp;Valoare tva:&nbsp;<b>'.$tva_total.'</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
<td colspan="9" align="right"></td>
</tr>
<tr>
<td colspan="9" align="right" >Valoare totala &nbsp;&nbsp;<b>'.$pret_total.'</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<br/>
 </table>
';

}



?>
<div class="spatiustinga"></br><h3 align="center">&nbsp;&nbsp;&nbsp;ACTIUNI</h3>
</br>
<ul class="meniu_vertical">
<li><a href="cauta_facturi.php"><img src="../poze/document.gif" border="0" alt="" />Cauta Facturi</a></li>
</ul>


</div>
<div class="spatiuprodus">
<?php
  echo $factura;
?>

</div>











<?php
include'admin_barajos.php';
?>