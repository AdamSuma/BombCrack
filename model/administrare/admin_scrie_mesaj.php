<?php
include'verificare.php';
include'admin_barasus.php';
include'admin_logomeniu.php';

$mesaj=$client=$rezultat_client=$raspuns='';

include_once "conectare.php";
if(isset($_GET['id_client'])){
$id_client=$_GET['id_client'];
$raspuns=$_GET['subiect'];
$clienti =mysql_query("SELECT * FROM clienti WHERE id_client='$id_client'");
             
			 while($row = mysql_fetch_array($clienti))
        {
            $rezultat_client.="<option value=\"$row[id_client]\" " . ($client == $row["id_client"]) . ">$row[nume_cumparator]</option>";
        }

}else{
$clienti =mysql_query("SELECT * FROM clienti");
         $rezultat_client.="<option value=''>Alege client</option>";    
			 while($row = mysql_fetch_array($clienti))
        {
            $rezultat_client.="<option value=\"$row[id_client]\" " . ($client == $row["id_client"]) . ">$row[nume_cumparator]</option>";
        }
		}
if((isset($_POST['subiect']))&&(strlen($_POST['subiect'])>0)&&(strlen($_POST['comentariu'])>0)&&(strlen($_POST['client'])>0)){

$subiect=$_POST['subiect'];
$comentariu=$_POST['comentariu'];
$data_mesaj=date("Ymd");
$id_client=$_POST['client'];
$cere_introducere=mysql_query("INSERT INTO mesaje (id_client,data_mesaj,subiect,continut,stare_mesaj) values ('$id_client','$data_mesaj','$subiect','$comentariu','necitit')");
$raspuns=mysql_affected_rows();
if($raspuns==1){
$mesaj.='Mesajul a fost trimis!';
}else{
$mesaj.='A aparut o eroare la trimiterea mesajului!';
}

}else if((isset($_POST['subiect']))&&(strlen($_POST['subiect'])==0)){
$mesaj.='Nu a-ti introdus un subiect!';
}else if((isset($_POST['subiect']))&&(strlen($_POST['comentariu'])==0)){
$mesaj.='Nu a-ti introdus un comentariu';
}else if((isset($_POST['subiect']))&&(strlen($_POST['client'])==0)){
$mesaj.='Nu a-ti selectat clientul pentru a trimite mesajul!';
}

?>
<div class="spatiustinga"></br><h3 align="center">&nbsp;&nbsp;&nbsp;Mesaje</h3>
</br>
<ul class="meniu_vertical">
<li><a href="admin_mesaje_toate.php"><img src="../poze/document.gif" border="0" alt="" />Vezi toate mesajele</a></li>
<li><a href="admin_scrie_mesaj.php"><img src="../poze/document.gif" border="0" alt="" />Scrie mesaj</a></li>
</ul>


</div>
<div class="spatiu_tiket"></br></br>
<h3 style="color: #B22222" align="center"><?php echo $mesaj;?></h3>
<form method="post" action="admin_scrie_mesaj.php" name="formular_tiket">
<table border="0" cellspacing="0" cellpadding="4" width="400px">
<tr><th>Trimite mesaj catre:</th><td><select name="client"><?php echo $rezultat_client;?> </select></td></tr>
<tr>
<td align="right">Subiect:</td><td><input type="text" name="subiect" size="33" value="<?php echo $raspuns;?>"/></td>
</tr>
<tr>
<td align="right">Continut:</td><td><textarea name="comentariu" rows="10" cols="25"></textarea></td>
</tr>
<tr>
<td colspan=2 align="center"><div class="buton_mesaj"><input type="submit" name="" value=""></div>
</td>
</tr>
<tr>
<td colspan=2 align="center">Va rugam nu abuzati de acest serviciu,acest serviciu este deschis pentru a ne semnala nereguli de pe
site sau probleme in ce privesc comenzile efectuate de dumneavoastra.<br />
Va multumim.
</td>
</tr>

</table>
</form>


</div>
<?php
include'admin_barajos.php';
?>