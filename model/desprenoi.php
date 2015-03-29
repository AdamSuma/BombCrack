<?php
session_start();

include('verificare_user.php');
$cat_noua='';
 $cos='';
  if (!isset($_SESSION['total'])){
    $_SESSION['total']=0;
  }
  if (!isset($_SESSION['nr_produse'])){
    $_SESSION['nr_produse']=0;
  }
  if (($_SESSION['nr_produse']==0)||($_SESSION['total']==0)){
     $cos.='Nu aveti produse in cosul de cumparaturi';
  }else if($_SESSION['nr_produse']==1){
   $cos.='Aveti  '.$_SESSION['nr_produse'].' produs.<br/><br/>

   In valoare de  <b>'.$_SESSION['total'].'</b>&nbsp;Lei';

  }else if($_SESSION['nr_produse']>1){
   $cos.='Aveti  '.$_SESSION['nr_produse'].' produse.<br/><br/>

   In valoare de  <b>'.$_SESSION['total'].'</b>&nbsp;Lei';

  }
 $afisare_cele_mai_cautate='';
 include('conectare.php');
$cele_mai_cautate=mysql_query("SELECT * FROM produse WHERE stare_produs NOT LIKE 'ascuns' ORDER BY vizualizari_produs DESC LIMIT 5");
while($rand_cele_mai_cautate=mysql_fetch_array($cele_mai_cautate)){

$denumire_cautat=$rand_cele_mai_cautate['denumire_produs'];
$id_produs_cautat=$rand_cele_mai_cautate['id_produs'];
$afisare_cele_mai_cautate.='<a href="produs.php?id_produs='. $id_produs_cautat .'"> '.$denumire_cautat.'</a><br/>';

}
$intrebare_categorie=mysql_query("SELECT * FROM categorii");
while($rand_categorie=mysql_fetch_array($intrebare_categorie)){
$id_categorie=$rand_categorie['id_categorie'];
$dotare_categorie=$rand_categorie['categorie'];
$cat_noua.='<li><a href="produse.php?cat='.$id_categorie.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="poze/sageata2.png" style="border: none;">&nbsp;&nbsp;'.$dotare_categorie.'</a></li>';
}

include'barasus.php';
?>
<title>Despre noi</title>
<?php
include'logomeniu.php';
?>
<div class="cutie_stinga">
<div class="cos">
<img src="poze/cos_imagine.jpg" />
<br /><br />
<h1><?php echo $cos ?></h1></div>

<div class="meniu_categorii">
<img src="poze/categorii.jpg" />
<ul class="meniu_vertical">
<?php echo $cat_noua;?>
</ul>
</div>
</div>
 <div class="cutie_mijloc">
 <br />
<h2 align="center" style="color: #0066FF;">Despre noi</h2>

       <p style="padding-left: 25px; padding-right: 25px; font-family: @Arial Unicode MS; color: #656565;"> Comercializam piese auto originale si aftermarket, anvelope si produse pentru intretinere, in lista producatorilor nostri regasindu-se numai nume consacrate. Dorim astfel sa va punem la dispozitie doar produse calitative si competitive, incercand sa oferim cel mai mic pret de pe piata romaneasca.</p>

        <p style="padding-left: 25px; padding-right: 25px; font-family: @Arial Unicode MS; color: #656565;">Un alt avantaj pe care vi-l oferim este economia de timp. Veti fi scutiti de a alerga de la un magazin la altul si de a cauta cea mai buna varianta pentru dumneavoastra. Acum puteti comanda din fata calculatorului, iar produsele le veti primi in 24 ore la adresa specificata de dumneavostra.</p>

       <p style="padding-left: 25px; padding-right: 25px; font-family: @Arial Unicode MS; color: #656565;"> Promovam ideea de continuitate si parteneriat, oferim clientilor nostrii cel mai bun raport calitate pret, promptitudine, consultanta gratuita in domeniul pieselor auto incercand sa va oferim solutia optima pentru cererea dumneavoastra.</p>

       <p style="padding-left: 25px; padding-right: 25px; font-family: @Arial Unicode MS; color: #656565;"> Firma noastra colaboreaza cu multe service-uri ceea ce face ca cererea si rulajul de piese la noi sa fie mare ,astfel ca reusim sa avem preturi fara concurenta , stocuri considerabile si marfa diversificata astfel incat clientii nostri sa gaseasca pe loc orice piesa auto au nevoie;noi de altfel nu neglijam nici piesele de shimb marunte sau cu o valoare mai mica,dar atat de necesare pentru incheierea unei reparatii de calitate.</p>

       <p style="padding-left: 25px; padding-right: 25px; font-family: @Arial Unicode MS; color: #656565;"> Va multumim pentru alegerea facuta si ne bucuram sa fim alaturi de dumneavoastra.</p>


		<br />
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href="javascript: history.back(-1)">&laquo; Inapoi</a>
 </div>
  <div class="cutie_dreapta">
   <div class="anunt">
   <br />
   <br /> <br />Nu gasesti piesa dorita?</br>Contacteaza-ne si i-ti vom raspunde in cel mai scurt timp.<br /><br /><b align="center">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Tel.0356-416132</b><br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;sau<br/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Tel.0770-128204</b><br/> <br />   </div>


  <div class="cele_mai_cautate"><br/><br/><br/>
  <?php echo $afisare_cele_mai_cautate;?>

   <br/>

  </div>

  <div class="newsletter"><br/><br/><br />
    Inscrie-te la newsletter pentru a primii informatii despre produsele noi.
  <form action="cum_cumpar.php" method="post" name="newsletter">
  Email:<br/><input type="text" name="email"></br>
  <input type="submit" value="Inscrie-ma">
  </form>
  </div>
  </div>
















<?php
include'barajos.php';
?>