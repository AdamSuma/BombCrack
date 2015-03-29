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
<title>Cum cumpar</title>
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
 <h2 style="color: #0066FF; padding-left: 30px;">Modalitati de plata</h2>
				<h2 style="color: #0066FF; padding-left: 30px;">Plata cash sau cu cardul la sediul din Timisoara</h2>
		<p style="padding-left: 25px; padding-right: 25px; font-family: @Arial Unicode MS; color: #656565;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Se poate opta pentru plata <strong>cash sau cu cardul</strong>, doar pentru comenzile care au fost confirmate telefonic , la sediul din Timisoara din strada Ana Ipatescu  nr 9 . <strong>Programul, adresa si harta de acces a  punctului de lucru din Timisoara le gasiti in sectiunea </strong><a href="contact.php">Contact</a></p>
		<h2 style="color: #0066FF; padding-left: 30px;">Plata prin ordin de plata</h2>
		<p style="padding-left: 25px; padding-right: 25px; font-family: @Arial Unicode MS; color: #656565;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pentru plata prin ordin de plata, veti primi prin emial sau fax o factura proforma emisa de SC GRELUS ANDREI, in baza careia veti completa ordinul de plata.Livrarea marfii se va face dupa confirmarea platii in cont sau prin trimiterea ordinului de plata la numarul de fax 0356-462322</p>
		<h2 style="color: #0066FF; padding-left: 30px;">Plata la livrare, ramburs</h2>
		<p style="padding-left: 25px; padding-right: 25px; font-family: @Arial Unicode MS; color: #656565;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Pentru plata la livrare se poate opta pentru comenzi pana in 1000 RON. Pentru comenzile care depasesc 1000 RON si se doresc a se plati la livrare este necesara achitarea unui avans de cel putin 30% din valoarea produsului.</p>

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