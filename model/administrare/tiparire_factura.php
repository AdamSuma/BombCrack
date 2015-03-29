 <?php
include'verificare.php';
$factura='';
if((isset($_GET['id_factura']))&&(strlen($_GET['id_factura']))){
$id_factura_vanzare=$_GET['id_factura'];
include('conectare.php');
$intrebare_factura=mysql_query("SELECT * FROM factura_vanzare WHERE id_factura_vanzare='$id_factura_vanzare' LIMIT 1");
while($randuri_factura=mysql_fetch_array($intrebare_factura)){
$numar_factura=$randuri_factura['numar_factura'];
$id_client=$randuri_factura['id_client'];
$data=$randuri_factura['data_factura_vanzare'];
$serie_factura=$randuri_factura['serie_factura'];
$mod_plata=$randuri_factura['mod_plata'];
$total_factura=$randuri_factura['total_factura'];
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

$intrebare_nume_client=mysql_query("SELECT * FROM clienti WHERE id_client='$id_client'") or die (mysql_error());
while($client=mysql_fetch_array($intrebare_nume_client)){
$nume_client=$client['nume_cumparator'];
$cod_client=$client['cod_fiscal'];
$nr_reg_com_client=$client['nr_registru_comert'];
$sediu_client=$client['strada_client'];
$judet_client=$client['judet_client'];
$cod_client=$client['cod_fiscal'];

}

$factura.='<table border="0" cellspacing="0" cellpadding="0" width="100%">
       <tr>
<td align="right" width="100px"></td><td align="left" width="100px"><td align="center"></td><td align="center"><a href="#" onclick="window.print();return false">Tipareste&nbsp;&nbsp;<img src="../poze/tipareste.gif" border="0">&nbsp;&nbsp;</a></td><td align="center"></td><td align="center" width="100px"></td><td width="100px"align="left"></td>
			</tr>
					<tr>
<td align="left" width="100px">Furnizor:</td><td align="left" width="100px"><font size="1">'.$nume_furn.'</td><td align="center"></td><td align="center"></td><td align="center"></td><td align="left" width="100px">Client:</td><td width="100px"align="left"><font size="1">'.$nume_client.'</td>
			</tr>
			<tr>
<td align="left" width="100px">Nr.Reg.Com.:</td><td align="left" width="100px"><font size="1">'.$nr_reg_com_furn.'</td><td align="center" colspan=2>FACTURA FISCALA</td><td align="right"></td><td align="left">Cod fiscal:</td><td width="100px" align="left"><font size="1">'.$cod_client.'</td>
			</tr>
			<tr>
<td align="left" width="100px">Cod fiscal:</td><td align="left" width="100px"><font size="1">'.$cod_fiscal_furn.'</td><td align="center" colspan=2>Serie:'.$_SESSION['serie_factura'].'  Numar:'.$_SESSION['nr_factura'].'</td><td align="right"></td><td width="100px" align="left">Nr.Reg.Com.:</td><td align="left"><font size="1">'.$nr_reg_com_client.'</td>
			</tr>
			<tr>
<td align="left">Sediul:</td><td align="left" width="100px"><font size="1">'.$sediu_furn.'</td><td align="center" colspan=2>Data:&nbsp;'.$data.'</td><td align="right"></td><td align="rleft">Sediul:</td><td align="left" width="100px"><font size="1">'.$sediu_client.'</td>
			</tr>
			<tr>
<td align="left">Judetul:</td><td align="left" width="100px"><font size="1">'.$judet_furn.'</td><td align="center"></td><td align="center"></td><td align="center"></td><td align="rleft">Judet:</td><td align="left" width="100px"><font size="1">'.$judet_client.'</td>
			</tr>
			<tr>
<td align="left">Cont:</td><td align="left" width="100px"><font size="1">'.$cont_furn.'</td><td align="center"></td><td align="center"></td><td align="center"></td><td align="left">Cont:</td><td align="left" width="100px"><font size="1"></td>
			</tr>
			<tr>
<td align="left">Banca:</td><td align="left" width="100px"><font size="1">'.$banca_furn.'</td><td align="center"></td><td align="center"></td><td align="center"></td><td align="left">Banca:</td><td align="left"><font size="1"></td>
			</tr>
			<tr>
<td align="left">Cap.Soc.:</td><td align="left" width="100px"><font size="1">'.$capital_furn.'</td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td>

			</tr>
			<tr>
<td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center"></td>

			</tr>
			<tr>
<td align="center"><font size="1">Cota TVA:24%</td><td align="center"><td align="center"></td><td align="center"></td></td><td align="center"></td><td align="center"></td><td align="center"></td>
			</tr>

			</table>
<table border="1em" cellspacing="0" cellpadding="0" width="100%" height="600px" background:url(../poze/aripa_fata_renault.jpg) no-repeat;>

<tr bgcolor="#DFDFDF" height="30px">
<td align="center">Nr.<br/>Crt.</td>
<td align="center">Denumirea produselor<br/> sau a serviciilor</td>
<td align="center">U.M</td>
<td align="center" width="80px">Cantitate</td>
<td align="center">Pret unitar<br/>(fara TVA)-lei-</td>
<td align="center">Valoare<br/>-lei-</td>
<td align="center">Valoare <br/>TVA -lei-</td>
</tr>
<tr height="20px">
<td align="center">0</td>
<td align="center">1</td>
<td align="center">2</td>
<td align="center" width="80px">3</td>
<td align="center">4</td>
<td align="center">5(3*4)</td>
<td align="center">6</th>
</tr>';
 $i=1;			
$intrebare_linii_factura=mysql_query("SELECT * FROM pozitii_factura_vanzare WHERE id_factura_vanzare='$id_factura_vanzare'");
while($rand_pozitii=mysql_fetch_array($intrebare_linii_factura)){
$id_produs=$rand_pozitii['id_produs'];
$denumire_produs=$rand_pozitii['denumire_produs'];
$bucati=$rand_pozitii['bucati'];			
$pret_produs=$rand_pozitii['pret_produs'];
$pret_fara_tva=$pret_produs/1.24;
$pret_fara_tva=round($pret_fara_tva,2);
$linie_produs_fara_tva=$pret_fara_tva*$bucati;
$linie_produs_fara_tva=round($linie_produs_fara_tva,2);
$tva_linie_produs=$linie_produs_fara_tva*1.24-$linie_produs_fara_tva;
$tva_linie_produs=round($tva_linie_produs,2);			
$nr_crit=$i++;			
$factura.='<tr height="20px">
<td align="center">'.$nr_crit.'</td><td align="left">'.$denumire_produs.'</td><td align="center">BUC</td><td align="center">'.$bucati.'</td>
<td align="center">'.$pret_fara_tva.'</td>
<td align="center">'.$linie_produs_fara_tva.'</td>
<td align="center">'.$tva_linie_produs.'</td>
</tr>';
}
$factura.='<tr>
<td align="center"></td><td align="left"></td><td align="center"></td><td align="center"></td>
<td align="center"></td>
<td align="center"></td>
<td align="center"></td>
</tr>';
$pret_total_fara_tva=$total_factura/1.24;
$tva_total=$total_factura-$pret_total_fara_tva;
$pret_total_fara_tva=round($pret_total_fara_tva,2);
$tva_total=round($tva_total,2);
$factura.='</table><table border="1" cellspacing="0" cellpadding="0" width="100%">
<tr >
<td align="center" rowspan=2 width="10%">Semnatura</br>si stampila</br>furnizorului</td>
<td align="left" rowspan=2 width="45%">Delegat.............................................................</br>Buletin:...............................................................</br>Transport:............................................................</br>Expedierea sa efectuat in prezenta noastra la</br>data de...........................................ora.................</br>Semnaturile........................................................</td>
<td align="center" width="14%"><b>Total</b></td>
<td align="center" width="8%"><b>'.$pret_total_fara_tva.'</b></td>
<td align="center" width="9%"><b>'.$tva_total.'</b></td>
</tr>
<tr >
<td align="center">Semnatura </br>de primire</td>
<td align="center" colspan=2><b>Total de plata</b><br/>(col.5+col.6)</br><b>'.$total_factura.'</b></td>
</tr>
</table>
';
}else{
$factura.="<font size='3' color='red'>Nu sau gasit destule date pentru a afisa factura!<br/>Pentru a tiparii factura mai intai trebuie sa o salvati!";

}

?>
<html>
<head>
<link rel="stylesheet" href="../css.css" type="text/css" media="screen">
</head>
<body>
<div class="factura" border:"1px solid #CCCCCC;">
<?php
echo $factura;
?>
<a href="javascript:window.close().style.visibility ='hidden'" >Inchide fereastra</a>
</div>

</body>
</html>




