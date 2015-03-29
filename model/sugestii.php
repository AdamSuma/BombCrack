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
<title>Sugestii</title>
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
 <h3 style="color: #0066FF; padding-left: 30px;">Recomandari Logan...</h3>



<p style="padding-left: 25px; padding-right: 25px; font-family: @Arial Unicode MS; color: #656565; font-size: 12px;">1.Pentru o buna functionare a motorului folositi filtre de motorina originale...



2.Folositi placute de frina marca Valeo,TRW sau de origine pentru a evita uzura excesiva a discurilor de frina sau scartaitul la frinare.



3.Folositi piese de calitate la ambreaj pentru o durabilitate mai mare a acestuia,astfel faceti economie la costul manoperei.



4.Folositi doar antigelul recomandat de fabricant,iar complectarea lui se va face doar cu apa distilata,altfel riscati ca radiatoarele de aluminiu sa cedeze in maximum 1-2 ani!



5.La schimbul distributiei inlocuiti rolele de distributie si pompa de apa chiar daca nu prezinta uzura sau nu curge pentru a evita problemele pe parcursul urmatorilor 60.000 km.Manopera in caz de probleme va fi aceeasi la schimbarea pompei de apa ca la intreaga distributie.



6.Folositi uleiuri cu caracteristicile recomandate de Uzinele Dacia,si anume:pentru Logan cu motoare pe benzina ulei 5w30 iar pentru logan cu motoare pe motorina 10w40 sau iarna 5w40,iar la cutia de viteze ulei cu caracteristica 75w80.



7.Inlocuiti filtrul de ulei la fiecare schimb de ulei,iar filtrul de aer cel putin odata la 25.000km



8.In cazul in care aveti probleme cu motorasul de relantii la motoarele pe benzina inlocuiti-l doar cu motoras inscriptionat cu VDO cu tija de cupru pe interior si nu de bachelita,restul existente pe piata fiind doar o alternativa pentru o perioada scurta de timp acestea deobicei cedind dupa maximum cateva luni de zile.De preferabil sa se schimbe corpul clapeta complect,iar in cazul uzurii acestuia sigur in final se va ajunge la inlocuirea lui.



9.La segmentarea motorului folositi atat segmenti noi cat si pistoane noi(cele vechi pot prezenta uzura sau calamina in canalele pe care se monteaza segmentii).



10.Nu schimbati pivotul mai mult de 2 ori pe acelasi brat de fata pentru ca riscati ca si canelurile de pe brat sa nu mai fixeze pivotul.</p>

 <h3 style="color: #0066FF; padding-left: 30px;">Stiai ca?</h3>



<p style="padding-left: 25px; padding-right: 25px; font-family: @Arial Unicode MS; color: #656565; font-size: 12px;">Sint mai multe modele de filtre de motorina pentru Dacia Logan 1.5 dci. acestea diferind in functie de caii putere si catalizator euro 3 sau euro 4.....



Rulmentii de spate sint aceeasi la Nova,SuperNova,Solenza,Logan ...



Dacia Logan 1.4 MPI are acelasi Kit de ambreaj cu Dacia Solenza ...



Rulmentii de fata de la Dacia Nova difera fata de cei de la Dacia SuperNova ...



Se poate schimba doar sticla de oglinda exterioara la toate modele de autovehicule Dacia,inclusiv Logan sau Logan MCV...



Uzinele Dacia au echipat modelele Logan cu mai multe tipuri de discuri de frina diferite ca diametru ...



Filtrele de ulei pentru toate modelele Dacia cu motorizare Renault sint la fel ca dimensiuni...



Motorul la Logan este monobloc spre deosebire de SuperNova sau Solenza despre care se spune ca au aceeasi motorizare cu Loganul....



Sabotii de spate de la Dacia Bk se potrivesc la modelele Nova,SuperNova si Solenza...



Capetii de bara sint la fel de la Dacia BL model dupa an 1994 cu cei de la Nova,SuperNova,Solenta(la Solenta sau facut 2 modele de capeti de bara:cu filet pe interior si filet normal ca la Dacia Bl)...



Suportul de cutie de viteza(bieleta rasucita) de la modelele Dacia SuperNova si Solenta a fost preluat de la Renault Clio ...</p>
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