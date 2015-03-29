<?php
session_start();

include('verificare_user.php');
?>
<?php
$mesaj='';
$atentionare='';
if($mesagerie==1){
$atentionare='<td colspan=2 align="center">Va rugam nu abuzati de acest serviciu,acest serviciu este deschis pentru a ne semnala nereguli de pe
site sau probleme in ce privesc comenzile efectuate de dumneavoastra.<br />
Va multumim.
</td>';
}
include_once "conectare.php";
if((isset($_POST['subiect']))&&(strlen($_POST['subiect'])>0)&&(strlen($_POST['comentariu'])>0)&&($mesagerie==1)){

$subiect=$_POST['subiect'];
$comentariu=$_POST['comentariu'];
$data_tiket=date("Ymd");
$cere_introducere=mysql_query("INSERT INTO tiket (id_client,data_tiket,subiect,comentariu,stare) values ('$userid','$data_tiket','$subiect','$comentariu','necitit')");
$raspuns=mysql_affected_rows();
if($raspuns==1){
$mesaj.='Tiketul a fost primit!</br>Vi se va raspunde in cel mai scurt timp';
}else{
$mesaj.='A aparut o eroare la trimiterea tiketului!';
}

}else if((isset($_POST['subiect']))&&(strlen($_POST['subiect'])==0)){
$mesaj.='Nu a-ti introdus un subiect!';
}else if((isset($_POST['subiect']))&&(strlen($_POST['comentariu'])==0)){
$mesaj.='Nu a-ti introdus un comentariu';
}else if($mesagerie==2){
$atentionare='<td colspan=2 align="center">Acest serviciu va fost restrictionat.Nu mai puteti trimite mesaje!<br />
</td>';
}
$cere_mesaje=mysql_query("SELECT * FROM mesaje WHERE id_client='$userid' and stare_mesaj='necitit' order by id_mesaj DESC LIMIT 15");
$mesaje_necitite=mysql_num_rows($cere_mesaje);
include'barasus.php';
?>
<title>Tiket</title>
<?php
include'logomeniu.php';
?>
<div class="spatiu_meniu_client"><br/></br></br></br></br>
<ul class="meniu_vertical">
<li><a href="schimba_par.php?id=<?php echo $userid;?>"><img src="poze/lacat.jpg" border="0" alt="" />&nbsp;Schimba parola</a></li>
<li><a href="client.php?id=<?php echo $userid;?>"><img src="poze/document.gif" border="0" alt="" />&nbsp;Modifica date de facturare</a></li>
<li><a href="comenzi_client.php?id=<?php echo $userid;?>"><img src="poze/cos.gif" border="0" alt="" />&nbsp;Comenzi trimise</a></li>
<li><a href="tiket.php"><img src="poze/ticket.gif" border="0" alt="" />&nbsp;Trimite mesaj catre suport</a></li>
<li><a href="raspuns_tiket.php"><img src="poze/ticket.gif" border="0" alt="" />&nbsp;Mesaje(<?php echo $mesaje_necitite;?>)</a></li>
 </ul>
</div>
<div class="spatiu_tiket"></br></br>
<h3 style="color: #B22222" align="center"><?php echo $mesaj;?></h3>
<form method="post" action="tiket.php" name="formular_tiket">
<table border="0" cellspacing="0" cellpadding="4" width="400px">
<tr><th colspan=2>Trimite mesaj catre administrator:</th></tr>
<tr>
<td align="right">Subiect:</td><td><input type="text" name="subiect" size="33"/></td>
</tr>
<tr>
<td align="right">Continut:</td><td><textarea name="comentariu" rows="10" cols="25"></textarea></td>
</tr>
<tr>
<td colspan=2 align="center"><div class="buton_mesaj"><input type="submit" name="" value=""></div>
</td>
</tr>
<tr>
<?php echo $atentionare; ?>
</tr>

</table>
</form>


</div>
<?php
include'barajos.php';
?>