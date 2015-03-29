 <?php
include'verificare.php';
include'admin_barasus.php';
include'admin_logomeniu.php';
include'conectare.php';

$buton='';
if(!isset($_SESSION['serie_factura'])){
$_SESSION['serie_factura']='';
}
if(!isset($_SESSION['numar_factura'])){
$_SESSION['numar_factura']='';
}
if(!isset($_SESSION['data_factura'])){
$_SESSION['data_factura']=date( 'd-m-Y' );
}
if(!isset($_SESSION['furnizor'])){
$_SESSION['furnizor']='';
}
if(isset($_GET['id_furnizor'])){
$_SESSION['id_furnizor']=$_GET['id_furnizor'];
$furnizor=$_SESSION['id_furnizor'];
}else{
$furnizor='';
}

$intrebare_furnizor=mysql_query("SELECT * FROM furnizori WHERE id_furnizor='$furnizor' LIMIT 1");
$raspuns_furn=mysql_fetch_array($intrebare_furnizor);
$_SESSION['furnizor']=$raspuns_furn['denumire_firma'];
if($_SESSION['furnizor']==''){
$buton.='Adauga furnizor';
}else if($_SESSION['furnizor']!=''){
$buton.='Modifica furnizor';
}

$factura='';
$factura.='<table border="0" cellspacing="0" cellpadding="1" width="980px">
<tr><th align="center" colspan="2">Facturi furnizori</th>
</tr>
<tr><td align="center" colspan="2">Furnizor:&nbsp;&nbsp;<b>'.$_SESSION['furnizor'].'</b><br/><a href="admin_adauga_furnizor.php" target="_self" accesskey="ctrl+x" style=color:#000000;text-decoration:none font-family:"Times New Roman" onmouseover=this.style.color="#ff0000"; return true" onmouseout=this.style.color="#000000"; return true">'.$buton.'</a></td>
 </tr>
 <tr align="right" >
<td></td><td>Serie&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Numar&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
 <tr align="right" >
 <td></td>
<td><form method="POST" action="admin_receptii.php" name="serie_numar"><input type="text" name="serie_factura" size="6" value="'.$_SESSION['serie_factura'].'"/>&nbsp;<input type="text" name="numar_factura" size="7" value="'.$_SESSION['numar_factura'].'"/></td>
</tr>
<tr align="right" >
 <td></td>
<td>Data:<input type="text" name="data_factura" size="19" value="'.$_SESSION['data_factura'].'"/><br/><input type="submit" value="valideaza"/></form></td>
</tr>
</table>';
if(isset($_POST['serie_factura'])){
$_SESSION['serie_factura']=$_POST['serie_factura'];
$_SESSION['numar_factura']=$_POST['numar_factura'];
$_SESSION['data_factura']=$_POST['data_factura'];
header("location:admin_receptii.php");
}
if (isset($_GET['id_fac'])){
 $sql_factura="insert into factura(utilizator,numar_factura) values('facturist','20')";
 mysql_query($sql_factura)or die(mysql_error());
$id_factura=mysql_insert_id();
}
if (isset($_GET['fid_produs'])){
$sql_id_factura="SELECT * FROM factura ORDER BY id_factura DESC LIMIT 1";
$raspuns=mysql_query($sql_id_factura)or die(mysql_error());
while($rand=mysql_fetch_array($raspuns)){
$id_factura=$rand['id_factura'];
}
}


$prettotalftva=0;
$tvatotal=0;
$total=0;
$i=1;
$tva='';
$factura.='<a href="admin_adauga_produse_receptie.php" target="_self" style=color:#000000;text-decoration:none font-family:"Times New Roman" onmouseover=this.style.color="#ff0000"; return true" onmouseout=this.style.color="#000000"; return true">Adauga produs</a>';
$factura.='<table border="1" cellspacing="0" cellpadding="1" width="980px">

<tr bgcolor="#F9F1E7">
<th align="center">NrCrt</th>
<th align="center">Cod</th>
<th align="center">Denumire produs</th>
<th align="center" width="80px">Cantitate</th>
<th align="center">Pret unitar</th>
<th align="center">Valoare</th>
<th align="center">Valoaretva</th>
<th align="center">&#10003;</th>
<th align="center">Actiune</th></tr>';
if (isset($_GET['fid_produs'])){
$id_produs=$_GET['fid_produs'];
$sql_produs="INSERT INTO factura_intrare(id_factura,id_produs,bucati,pret_fva) values('$id_factura','$id_produs','0','0')";
mysql_query($sql_produs)or die(mysql_error());
header("location:admin_receptii.php");
}
$sql_id_factura="SELECT * FROM factura ORDER BY id_factura DESC LIMIT 1";
$raspuns=mysql_query($sql_id_factura)or die(mysql_error());
while($rand=mysql_fetch_array($raspuns)){
$id_factura=$rand['id_factura'];
}
$sql_intrebare=mysql_query("SELECT * FROM factura_intrare WHERE id_factura='$id_factura'");
$randuri=mysql_num_rows($sql_intrebare);
 if($randuri>0){
 while($rand=mysql_fetch_array($sql_intrebare)){
   $id_pozitie=$rand['id_pozitie'];
   $id_produs=$rand['id_produs'];
   $denumire_produss=mysql_query("SELECT denumire_produs FROM produse WHERE id_produs='$id_produs'");
  while($randul=mysql_fetch_array($denumire_produss)){
    $denumire_produs=$randul['denumire_produs'];
  }
   $id_pozitie=$rand['id_pozitie'];
   $bucati=$rand['bucati'];
   $pret_fva=$rand['pret_fva'];
   $nr_crit=$i++;
   $tva='24%';
   $valoare=$pret_fva*$bucati;
   $valoare_tva=$valoare*1.24-$valoare;
   $prettotalftva=$prettotalftva+$valoare;
   $tvatotal=$tvatotal+$valoare_tva;
   $total=$prettotalftva+$tvatotal;
   
$factura.='<tr>
<td>'.$nr_crit.'</td>
<td>'.$id_produs.'</td>
<td>'.$denumire_produs.'</td>
<form action="admin_receptii.php?id_produs='.$id_produs.'&id_pozitie='.$id_pozitie.'" name="form" method="POST">
<td align="center">		    
<input type="text" name="bucati" size="7" value="'.$bucati.'"/>
								</td>
<td align="center">
<input type="text" name="pret_fva" size="8"  value="'.$pret_fva.'"/>
</td>
<td align="center">'.$valoare.'</td>
<td align="center">'.$valoare_tva.'</td>
<td align="center"><input type="submit" value="&#10003;"/></td>
<td align="center" ><a href="admin_receptii.php?id_produs='.$id_produs.'&actiune=sterge" style=color:#000000;text-decoration:none font-family:"Times New Roman" onmouseover=this.style.color="#ff0000"; return true" onmouseout=this.style.color="#000000"; return true">Sterge</a></td>
</tr></form>'; 
} 
}

if (isset($_POST['bucati'])){
$sql_id_factura="SELECT * FROM factura ORDER BY id_factura DESC LIMIT 1";
$raspuns=mysql_query($sql_id_factura)or die(mysql_error());
while($rand=mysql_fetch_array($raspuns)){
$id_factura=$rand['id_factura'];
}
$id_pozitie=$_GET['id_pozitie'];
$id_produs=$_GET['id_produs'];
$bucati=$_POST['bucati'];
$pret_fva=$_POST['pret_fva'];
$sql_vanzari="UPDATE factura_intrare  SET bucati='$bucati',pret_fva='$pret_fva' WHERE id_factura='$id_factura' AND id_produs='$id_produs' AND id_pozitie='$id_pozitie'";
mysql_query($sql_vanzari)or die(mysql_error());
header("location:admin_receptii.php");
}

if (isset($_GET['actiune']) && ($_GET['actiune']=="sterge")){
$id_produs=$_GET['id_produs'];
$sql_vanzari=mysql_query("DELETE FROM factura_intrare WHERE id_produs=$id_produs LIMIT 1");
 header("location:admin_receptii.php");
 }
$factura.='</table><table border="0" cellspacing="0" cellpadding="1" width="980px"><tr><th colspan="10" align="right">Suma pozitiilor&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;    </th>
</tr>
<tr>
<td colspan="9" align="right">Valoare ftva:&nbsp;<b>'.$prettotalftva.'</b>&nbsp;&nbsp;&nbsp;Valoare tva:&nbsp;<b>'.$tvatotal.'</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<tr>
<td colspan="9" align="right"></td>
</tr>
<tr>
<td colspan="9" align="right" >Valoare totala &nbsp;&nbsp;<b>'.$total.'</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
</tr>
<br/>
<tr>
<td colspan="9" align="right"><input type="submit" value="Salveaza"/><input type="submit" value="Emite"/><input type="submit" value="Tipareste"/></td>
</tr>
</table><form action="admin_receptii.php?id_fac=1" name="form" method="POST"><input type="submit" value="Adauga"/></form>';
?>
<div class="spatiuprodus">
<?php
  echo $factura;
?>
</div>






<?php
include'admin_barajos.php';
?>