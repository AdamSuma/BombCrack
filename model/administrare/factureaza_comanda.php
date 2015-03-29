<?php
include'verificare.php';
include'admin_barasus.php';
include'admin_logomeniu.php';
$factura='';
$total_factura='';
$total_tva='';
$nr_crit=0;
$data=date("d-m-Y");
if((isset($_GET['id_comanda']))&&(isset($_GET['id_client']))){
$id_comanda=$_GET['id_comanda'];
$id_client=$_GET['id_client'];
include('conectare.php');
$intrebare_nume_client=mysql_query("SELECT * FROM clienti WHERE id_client='$id_client'");
$client=mysql_fetch_array($intrebare_nume_client);
$nume_client=$client['nume_cumparator'];
$cod_client=$client['cod_fiscal'];
$nr_reg_com_client=$client['nr_registru_comert'];
$sediu_client=$client['strada_client'];
$judet_client=$client['judet_client'];
$cod_client=$client['cod_fiscal'];

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

$factura.='<font size="2"><table border="1" cellspacing="0" cellpadding="4" width="600px">
          			<tr>
<td align="right">Furnizor:</td><td align="left" width="100px"><font size="1">'.$nume_furn.'</td><td align="center"></td><td align="center"></td><td align="center"></td><td align="right">Client:</td><td align="left"><font size="1">'.$nume_client.'</td>
			</tr>
			<tr>
<td align="right">Nr.Reg.Com.:</td><td align="left" width="100px"><font size="1">'.$nr_reg_com_furn.'</td><td align="center" colspan=2>FACTURA FISCALA</td><td align="right"></td><td align="right">Cod fiscal:</td><td align="left"><font size="1">'.$cod_client.'</td>
			</tr>
			<tr>
<td align="right">Cod fiscal:</td><td align="left" width="100px"><font size="1">'.$cod_fiscal_furn.'</td><td align="center" colspan=2>Serie:  Numar:</td><td align="right"></td><td align="right">Nr.Reg.Com.:</td><td align="left"><font size="1">'.$nr_reg_com_client.'</td>
			</tr>
			<tr>
<td align="right">Sediul:</td><td align="left" width="100px"><font size="1">'.$sediu_furn.'</td><td align="center" colspan=2>Data:&nbsp;'.$data.'</td><td align="right"></td><td align="right">Sediul:</td><td align="left"><font size="1">'.$sediu_client.'</td>
			</tr>
			<tr>
<td align="right">Judetul:</td><td align="left" width="100px"><font size="1">'.$judet_furn.'</td><td align="center"></td><td align="center"></td><td align="center"></td><td align="right">Judet:</td><td align="left"><font size="1">'.$judet_client.'</td>
			</tr>
			<tr>
<td align="right">Cont:</td><td align="left" width="100px"><font size="1">'.$cont_furn.'</td><td align="center"></td><td align="center"></td><td align="center"></td><td align="right">Cont:</td><td align="left"><font size="1"></td>
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
						<tr>
<td align="center">Nr.Crt.</td><td align="center">Denumirea produselor sau serviciilor</td><td align="center">UM</td><td align="center">Cantitatea</td><td align="center">Pret unitar</td><td align="center">Valoare</td><td align="center">TVA</td>
			</tr>
			';
$cere_pozitii=mysql_query("SELECT * FROM vanzari WHERE id_comanda=$id_comanda");
$numar_pozitii=mysql_num_rows($cere_pozitii);
while($randuri=mysql_fetch_array($cere_pozitii)){
$nr_crit++;
$id_produs=$randuri['id_produs'];
$bucati=$randuri['bucati'];
 $_SESSION['factura'][$id_produs]=$bucati;
$cere_detalii_produs=mysql_query("SELECT * FROM produse WHERE id_produs='$id_produs'");
$raspuns_cere_detalii_produs=mysql_num_rows($cere_detalii_produs);
if($raspuns_cere_detalii_produs>0){
$detalii_produs=mysql_fetch_array($cere_detalii_produs);
$denumire_produs=$detalii_produs['denumire_produs'];
$stoc_produs=$detalii_produs['stoc_produs'];
$pret_produs=$detalii_produs['pret_produs'];
$pret_fara_tva=$pret_produs/1.24;
$afisare_pret_fara_tva=round($pret_fara_tva,2);
 foreach($_SESSION['factura']as $id_produs =>$x){
 $valoare_linie=$pret_fara_tva*$x;
 $afisare_valoare_linie=round( $valoare_linie,2);
  }
$tva= $valoare_linie*1.24- $valoare_linie;
$afisare_tva=round($tva,2);
}
$factura.='<tr><td align="center">'.$nr_crit.'</td><td align="center">'.$denumire_produs.'</td><td align="center">buc</td><td align="center">'.$bucati.'</td><td align="center">'.$afisare_pret_fara_tva.'</td><td align="center">'. $afisare_valoare_linie.'</td><td align="center">'.$afisare_tva.'</td></tr>';

$total_factura=$total_factura+$valoare_linie;
$afisare_total_factura=round($total_factura,2);
$total_tva=$total_tva+$tva;
$afisare_total_tva=round($total_tva,2);
$total_de_plata=$total_factura+$total_tva;
$afisare_total_de_plata=round($total_de_plata,2);

}

$factura.='<tr><td align="center" rowspan=2><font size="1">Semnatura si stampila furnizorului</td><td align="center"></td><td align="center"></td><td align="center"></td><td align="center">Total</td><td align="center">'.$afisare_total_factura.'</td><td align="center">'.$afisare_total_tva.'</td></tr>
<tr><td align="center" ></td><td align="center" colspan=3 rowspan=2></td><td align="right">Total de plata</td><td align="center">'.$afisare_total_de_plata.'</td></tr>';
}
?>
<div class="spatiustinga"></br><h3 align="center">&nbsp;&nbsp;&nbsp;Mesaje</h3>
</br>
<ul class="meniu_vertical">
<li><a href="admin_mesaje_toate.php"><img src="../poze/document.gif" border="0" alt="" />Vezi toate mesajele</a></li>
<li><a href="adauga_categorie.php"><img src="../poze/document.gif" border="0" alt="" />Scrie mesaj</a></li>
</ul>


</div>

<div class="spatiu_mesaj"></br></br></br>

	<?php echo $factura;?>
 </table>
<form method="post" action="factureaza_comanda.php" name="formular_inchide">
<input type="submit" name="inchide" value="Inapoi la Comenzi">
</form>
 </br></br>
</div>

<?php
include'admin_barajos.php';
unset($_SESSION['factura']);
?>