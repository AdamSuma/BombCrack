<?php
session_start();
include('verificare_user.php');
$mesaj='';
if(isset($_POST['parola_veche'])){
$parola_veche=preg_replace('#[^A-Za-z0-9]#i','',md5($_POST["parola_veche"]));
$parola_noua=preg_replace('#[^A-Za-z0-9]#i','',md5($_POST["parola_noua"]));
$confirmare_parola_noua=preg_replace('#[^A-Za-z0-9]#i','',md5($_POST["confirmare_parola_noua"]));

if((isset($_POST["parola_veche"]))&&($parola_noua==$confirmare_parola_noua)&&(strlen($_POST["parola_noua"])>=6)&&(strlen($_POST["parola_noua"])<=10)){

include'conectare.php';
$intrebare_user="SELECT * FROM clienti WHERE id_client='$userid' AND parola_client='$parola_veche' AND stare_cont_client='acceptat'";
$raspuns_user=mysql_query($intrebare_user);
$randuri_user=mysql_num_rows($raspuns_user);

if(($randuri_user==1)&&($parola_noua==$confirmare_parola_noua)){
  $modificare_parola=mysql_query("UPDATE clienti SET parola_client='$parola_noua' WHERE id_client='$userid' LIMIT 1");
  $verificare=mysql_affected_rows();
if($verificare==1){
$mesaj.='<h3 align="center">A-ti modificat cu succes parola,la o noua logare folositi parola noua!</h3>';
}
} 

 else if($randuri_user==0){
 $mesaj.='<h3 align="center">Nu a-ti introdus parola corect!</h3>';
 }
 }
 else if((isset($_POST["parola_veche"]))&&($parola_noua!=$confirmare_parola_noua)){
 $mesaj.='<h3 align="center">Parola noua nu este identica cu confirmarea!</h3>';
}else if((isset($_POST["parola_veche"]))&&(strlen($_POST["parola_noua"])<6)||(strlen($_POST["parola_noua"])>10)){
 $mesaj.='<h3 align="center">Parola trebuie sa contina minim 6 caractere sau maxim 10 caractere!</h3>';
}
}
include'conectare.php';
$cere_mesaje=mysql_query("SELECT * FROM mesaje WHERE id_client='$userid' and stare_mesaj='necitit' order by id_mesaj DESC LIMIT 15");
$mesaje_necitite=mysql_num_rows($cere_mesaje);



include'barasus.php';

?>
<title>Schimba parola</title>
<?php
include'logomeniu.php';
?>
<div class="spatiu_meniu_client"><br/><br /><br /></br></br>
<ul class="meniu_vertical">
<li><a href="schimba_par.php?id=<?php echo $userid;?>"><img src="poze/lacat.jpg" border="0" alt="" />&nbsp;Schimba parola</a></li>
<li><a href="client.php?id=<?php echo $userid;?>"><img src="poze/document.gif" border="0" alt="" />&nbsp;Modifica date de facturare</a></li>
<li><a href="comenzi_client.php?id=<?php echo $userid;?>"><img src="poze/cos.gif" border="0" alt="" />&nbsp;Comenzi trimise</a></li>
<li><a href="tiket.php"><img src="poze/ticket.gif" border="0" alt="" />&nbsp;Trimite mesaj catre suport</a></li>
<li><a href="raspuns_tiket.php"><img src="poze/ticket.gif" border="0" alt="" />&nbsp;Mesaje(<?php echo $mesaje_necitite;?>)</a></li>
 </ul>
</div>
<div class="spatiu"><br /> <br /> <br />
<h3 align="center">Schimba parola&nbsp;<img src="poze/lacat.jpg" border="0" alt="" /> </h3>
<table align="center" cellpadding="6">
<form action="schimba_par.php" method="post" enctype="multipart/form-data" name="formular_modificare_parola" >
<tr>
<td align="right"><b>Parola veche:</b></td>
<td><input name="parola_veche" type="password" id="email" size="24" maxlength="10" /></td>
</tr>
<tr>
<td align="right"><b>Parola noua:</b></td>
<td><input name="parola_noua" type="password" id="parola" size="24" maxlength="10" /></td>
</tr>
<tr>
<td align="right"><b>Confirmare parola noua:</b></td>
<td><input name="confirmare_parola_noua" type="password" id="parola" size="24" maxlength="10" /></td>
</tr>
<tr>
<td>&nbsp;</td>
<td><input name="Submit" type="submit" value="Modifica" /></td>
</tr>
</form>
</table>
<?php echo $mesaj;?>
</div>
<?php
include'barajos.php';
?>