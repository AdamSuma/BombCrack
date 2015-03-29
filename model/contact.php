
<?php
session_start();

$mesaj='';

if(isset($_POST['email'])){
$to ='ggregad@yahoo.com'; 
$from = $_REQUEST['email'] ; 
$name = $_REQUEST['nume'] ; 
$headers = "From: $from"; 
$subject = "Email de pe site"; 

$fields = array(); 
$fields{"nume"} = "Nume"; 
$fields{"firma"} = "Companie/persoana"; 
$fields{"email"} = "Email"; 
$fields{"telefon"} = "Telefon"; 
$fields{"list"} = "Adauga in lista mail"; 
$fields{"mesaj"} = "Mesaj"; 

$body = "A-ti primit urmatorul mesaj de pe site:\n\n"; foreach($fields as $a => $b){ $body .= sprintf("%20s: %s\n",$b,$_REQUEST[$a]); } 

$headers2 = "De la: pozecom@gmail.com"; 
$subject2 = "Va multumim ca ne-ati contactat!"; 
$autoreply = "Va multumim ca ne-ati contactat. Cineva va va contacta si va va raspunde cat se poate de repede, de obicei nu dureaza mai mult de 24 de ore. Daca mai ai alte nelamuriri, te rugam sa accesezi situl nostru :www.grelus.ro";

if($from == '') {print "Nu ai introdus adresa ta de Email, intoarce-te si introdu o adresa de Email";} 
else { 
if($name == '') {print "Nu ai introdus numele tau, intoarce-te si introdu un nume";} 
else { 
$send = mail($to, $subject, $body, $headers); 
$send2 = mail($from, $subject2, $autoreply, $headers2); 
if($send) 
{$mesaj.='Mesajul dumneavoastra a fost primit.Vi se va raspunde in cel mai scurt timp';} 
else 
{$mesaj.= 'Am intalnit o problema in a va trimite cererea prin Email, va rog anuntati eroarea la: ggregad@gmail.com'; } 
}
}
}

include('verificare_user.php');
include'barasus.php';

?>
<title>Contact</title>
<?php
include'logomeniu.php';
?>
<div style="orar">
</br><span style="font-size: 24px; color: rgb(0, 0, 0);" align="center"><h4 align="center" style="color: #0066FF;">Piese Auto Grelus Andrei</h4></span>
<table width="100%" border="0" cellspacing="0" cellpadding="0">
   <tr>
    <td width="28%" height="30" bgcolor="#FBFBFB" align="right"><strong>Adresa</strong></td>
    <td width="72%" height="30" bgcolor="#FBFBFB" align="center">Ana Ipatescu nr.9,
Timisoara, Romania</td>
  </tr>
  <tr>
    <td height="30" bgcolor="#F7F7F7" align="right"><strong>Orar</strong></td>
    <td height="30" bgcolor="#F7F7F7" align="center">Luni-Vineri: 9-18&nbsp;&nbsp;&nbsp;Sambata: 9-14</td>
  </tr>
  <tr>
    <td height="30" bgcolor="#FBFBFB" align="right"><strong>Telefon</strong></td>
    <td height="30" bgcolor="#FBFBFB" align="center">0356-469-320&nbsp;&nbsp;&nbsp;/&nbsp;&nbsp;&nbsp;0356-469-322</td>
    </tr>
  <tr>
    <td height="30" bgcolor="#F7F7F7" align="right"><strong>Tel. / Fax</strong></td>
    <td height="30" bgcolor="#F7F7F7" align="center">0356-469-323</td>
  </tr>
  <tr>
    <td height="30" bgcolor="#FBFBFB" align="right"><strong>Mobil</strong></td>
    <td height="30" bgcolor="#FBFBFB" align="center">0770-128-204</td>
  </tr>
  <tr>
    <td height="30" bgcolor="#F7F7F7" align="right"><strong>Coordonate GPS</strong></td>
    <td height="30" bgcolor="#F7F7F7" align="center">Lat: 45.762007 / Lon: 21.208530</td>
  </tr>
</table>
  </br>
  </br>
 </div>
<div id="map">
<script type="text/javascript" src="http://api.maps.yahoo.com/ajaxymap?v=3.8&appid=KngaBT7V34E6DyZD9EduqVPgyjgUzECqMUzbsvBalFC1we1OXqjVJ5jKjTX3uQ--"></script>
<script type="text/javascript">
var myPoint = new YGeoPoint(45.782007,21.208530);
// Create a map object
var map = new YMap(document.getElementById('map'));

// Add map zoom (long) control
map.addZoomLong();
 // Add the Pan Control
map.addPanControl();
  // Set map type to either of: YAHOO_MAP_SAT, YAHOO_MAP_HYB, YAHOO_MAP_REG
map.setMapType(YAHOO_MAP_REG);
var currentGeoPoint = new YGeoPoint(45.762007,21.208530);
var myMarker = new YMarker(currentGeoPoint);
myMarker.openSmartWindow("Grelus Andrei");
map.addMarker(currentGeoPoint);
map.addOverlay(myMarker);
  // Display the map centered on a geocoded location
map.drawZoomAndCenter(myPoint, 5);
</script>
</div>
<div style="formular_contact">
<form method="post" action="contact.php" name="formular_contact"> 
<table align="center"> 
<tr><td colspan=2><strong>Contacteaza-ne complectand formularul de mai jos:</strong></td></tr>
<br />
<tr><td><font color=red>*</font> Nume:</td><td><input size=25 name="nume"></td></tr>
<tr><td><font color=red>*</font> Emailul tau:</td><td><input size=25 name="email"></td></tr> 
<tr><td>Companie:</td><td><input size=25 name="firma"></td></tr> 
<tr><td>Telefon:</td><td><input size=25 name="telefon"></td></tr> 
<tr><td>Inscrie-ma<br> pentru newsletter:</td><td><input type="radio" name="list" value="Nu"> Nu<br> <input type="radio" name="list" value="Da" checked> Da,trimite-mi noutatile.<br></td></tr>
<tr><td colspan=2>Mesaj:</td></tr> 
<tr><td colspan=2 align=center><textarea name="mesaj" rows=5 cols=35></textarea></td></tr> 
<tr><td colspan=2 align=center><input type=submit name="trimite" value="Trimite"></td></tr> 
<tr><td colspan=2 align=center><small> <font color=red>*</font> indica spatiile de complectare obligatorii</small></td></tr> 
<tr><td colspan=2 align=center><small> <font color=red> <?php echo $mesaj;?></small></font></td></tr>
</table> 
</form> 
</div>
<?php
include'barajos.php';
?>