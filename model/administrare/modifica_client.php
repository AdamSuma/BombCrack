<?php
include'verificare.php';
include'admin_barasus.php';
include'admin_logomeniu.php';


$mesaj='';
$client='';
$rezultat_nivel='';
$rezultat_mesaj='';
$rezultat_stare='';
if(isset($_GET['mesaj'])){
$mesaj.=$_GET['mesaj'];
}
if(isset($_GET['id_client'])){
$id_client=$_GET['id_client'];
$clienti_inregistrati=mysql_query("SELECT * FROM clienti where id_client='$id_client'");
$numar_clienti=mysql_num_rows($clienti_inregistrati);
while($rand_clienti=mysql_fetch_array($clienti_inregistrati)){
$id_client=$rand_clienti['id_client'];
$nume_client=$rand_clienti['nume_client'];
$nick_client=$rand_clienti['nick_client'];
$parola_m=$rand_clienti['parola_client'];
$parola_c=$rand_clienti['parola_clara'];
$nivel_client=$rand_clienti['nivel_client'];
if($nivel_client==1){
$rezultat_nivel.='<option value="1">Client normal</option><option value="2">Client en-gros</option>';
}
if($nivel_client==2){
$rezultat_nivel.='<option value="2">Client en-gros</option><option value="1">Client normal</option>';
}
$mesagerie=$rand_clienti['mesagerie'];
if($mesagerie==1){
$rezultat_mesaj.='<option value="1">Activa</option><option value="2">Blocata</option>';
}
if($mesagerie==2){
$rezultat_mesaj.='<option value="2">Blocata</option><option value="1">Activa</option>';
}

$email=$rand_clienti['email'];
$nume_cumparator=$rand_clienti['nume_cumparator'];
$nr_registru_comert=$rand_clienti['nr_registru_comert'];
$cod_fiscal=$rand_clienti['cod_fiscal'];
$strada_client=$rand_clienti['strada_client'];
$judet_client=$rand_clienti['judet_client'];
$localitate_client=$rand_clienti['localitate_client'];
$telefon=$rand_clienti['telefon'];
$stare_cont_client=$rand_clienti['stare_cont_client'];
$mesagerie=$rand_clienti['mesagerie'];
if($stare_cont_client=='acceptat'){
$rezultat_stare.='<option value="acceptat">Acceptat</option><option value="neactivat">Neactivat</option><option value="blocat">Blocat</option>';
}
if($stare_cont_client=='neactivat'){
$rezultat_stare.='<option value="neactivat">Neactivat</option><option value="acceptat">Acceptat</option><option value="blocat">Blocat</option>';
}
if($stare_cont_client=='blocat'){
$rezultat_stare.='<option value="blocat">Blocat</option><option value="neactivat">Neactivat</option><option value="acceptat">Acceptat</option>';
}

$ip_client=$rand_clienti['ip_client'];
$data_logare_client=$rand_clienti['data_logare_client'];
$ultima_logare=$rand_clienti['ultima_logare'];
 }

$client.=' <form method="post" action="modifica_client.php?id_client='.$id_client.'" name="form_modifica_client"><table width=50%><tr><td align="center"  colspan="2" bgcolor="lightblue">Client:&nbsp;'.$nume_cumparator.'</td></tr>
<tr><th align="right">Nume:</th><td align="center"><input type="text" name="nume_client" size="30" value="'.$nume_client.'"/></td></tr>
<tr><th align="right">Nick:</th><td align="center"><input type="text" name="nick_client" size="30" value="'.$nick_client.'"/></td></tr>
<tr><th align="right">Parola:</th><td align="center"><input type="text" name="parola" size="30" value="'.$parola_c.'"/></td></tr>
<tr><th align="right">Email:</th><td align="center"><input type="text" size="30" name="email" value="'.$email.'"/></td></tr>
<tr><th align="right">Telefon:</th><td align="center"><input type="text" size="30" name="telefon" value="'.$telefon.'"/></td></tr>

<tr><td align="center"  colspan="2" bgcolor="lightblue">Date de facturare:&nbsp;'.$nume_cumparator.'</td></tr>
<tr><th align="right">Client:</th><td align="center"><input type="text" size="30" name="nume_cumparator" value="'.$nume_cumparator.'"/></td></tr>
<tr><th align="right">Cod fiscal sau CNP:</th><td align="center"><input type="text" size="30" name="cod_fiscal" value="'.$cod_fiscal.'"/></td></tr>
<tr><th align="right">Numar registru comert:</th><td align="center"><input type="text" size="30" name="nr_reg" value="'.$nr_registru_comert.'"/></td></tr>
<tr><th align="right">Adresa:</th><td align="center"><input type="text" size="30" name="strada" value="'.$strada_client.'"/></td></tr>
<tr><th align="right">Judet:</th><td align="center"><input type="text" size="30" name="judet" value="'.$judet_client.'"/></td></tr>
<tr><th align="right">Localitate:</th><td align="center"><input type="text" size="30" name="localitate" value="'.$localitate_client.'"/></td></tr>
<tr><td align="center"  colspan="2" bgcolor="lightblue">Stari cont:&nbsp;'.$nume_cumparator.'</td></tr>
<tr><th align="right">Ip la inregistrare:</th><td align="center">'.$ip_client.'</td></tr>
<tr><th align="right">Inregistrat la data de:</th><td align="center">'.$data_logare_client.'</td></tr>
<tr><th align="right">Ultima logare la:</th><td align="center">'.$ultima_logare.'</td></tr>
<tr><th align="right">Nivel client:</th><td align="center"><select name="nivel_client">'.$rezultat_nivel.'</select><font size="-2" color="#006600">(alege pentru modificare)</font></td></tr>
<tr><th align="right">Mesagerie interna:</th><td align="center"><select name="mesagerie">'.$rezultat_mesaj.'</select><font size="-2" color="#006600">(alege pentru modificare)</font></td></tr>
<tr><th align="right">Stare cont:</th><td align="center"><select name="stare_cont">'.$rezultat_stare.'</select><font size="-2" color="#006600">(alege pentru modificare)</font></td></tr>
<tr><th align="right"></th><td><input type="submit" value="modifica"/></td>
</table>
</form>
';
if (isset($_POST['nume_client'])){
$nume_client=$_POST['nume_client'];
$nick_client=$_POST['nick_client'];
$parola_c=$_POST['parola'];
$email=$_POST['email'];
$telefon=$_POST['telefon'];
$nume_cumparator=$_POST['nume_cumparator'];
$cod_fiscal=$_POST['cod_fiscal'];
$nr_reg=$_POST['nr_reg'];
$strada=$_POST['strada'];
$judet=$_POST['judet'];
$localitate=$_POST['localitate'];
$nivel_client=$_POST['nivel_client'];
$mesagerie1=$_POST['mesagerie'];
$stare_cont=$_POST['stare_cont'];
$parolamd5=md5($parola_c);
include('conectare.php');
$modifica_client=mysql_query("UPDATE clienti SET nume_client='$nume_client',nick_client='$nick_client',parola_client='$parolamd5',parola_clara='$parola_c',nivel_client='$nivel_client',mesagerie='$mesagerie1',email='$email',nume_cumparator='$nume_cumparator',nr_registru_comert='$nr_reg',cod_fiscal='$cod_fiscal',strada_client='$strada',judet_client='$judet',localitate_client='$localitate',telefon='$telefon',stare_cont_client='$stare_cont' WHERE id_client=$id_client") or die (mysql_error());
$afectate=mysql_affected_rows();
if($afectate=1){
header("location:modifica_client.php?id_client=$id_client&mesaj=A-ti modificat cu succes datele");
$mesaj.='A-ti modificat cu succes datele';
}else if($afectate=0){
header("location:modifica_client.php?id_client=$id_client&mesaj=Datele nu s-au modificat");
$mesaj.='Datele nu s-au modificat';

}
}

}





?>

<div class="spatiustinga"></br><h3 align="center">&nbsp;&nbsp;&nbsp;ACTIUNI</h3>
</br>
<ul class="meniu_vertical">
<li><a href="admin_clienti_toti.php"><img src="../poze/document.gif" border="0" alt="" />Toti clientii</a></li>
<li><a href="modifica_client.php"><img src="../poze/document.gif" border="0" alt="" />Modifica client</a></li>

</ul>


</div>
<div class="spatiudreapta_comenzi"></br>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $mesaj; ?>
<?php echo $client; ?>
</table>
</div>





<?php
include'admin_barajos.php';
?>