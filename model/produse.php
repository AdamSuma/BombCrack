<?php
session_start();

include('verificare_user.php');

$mesaj='';
if (isset($_GET['selectat'])){
$criteriu=$_GET['criteriu'];
$ordonare=$_GET['ordonare'];
$categorie=$_GET['categorie'];
}else{
$criteriu='';
$categorie='denumire_produs';
$masina='';
$ordonare='ASC';
$rezultat_masina='';
$rezultat_subcategorie='';
$rezultat_motorizare='';
$rezultat_categorie='';
$cat_noua='';
}
$masina = $subcategorie_masina = $motorizare =$cat= ''; 
$conn = mysql_connect('localhost', 'root', '');
$db = mysql_select_db('licenta',$conn);
if(isset($_GET["cat"]))
{
    $cat= $_GET["cat"];
}
include('conectare.php');



if(isset($_GET['criteriu']))
{
$criteriu = $_GET['criteriu'];
}
if(isset($_GET['categorie']))
{
$categorie = $_GET['categorie'];
}if((isset($_GET["masina"]))&&is_numeric($_GET["masina"]))

{
    $masina = $_GET["masina"];
}else{
    $masina=''; 
}

if(isset($_GET["subcategorie_masina"]) && is_numeric($_GET["subcategorie_masina"]))
{
    $subcategorie_masina = $_GET["subcategorie_masina"];
}

if(isset($_GET["motorizare"]) && is_numeric($_GET["motorizare"]))
{
    $motorizare = $_GET["motorizare"];
}

$sql = "SELECT * FROM masina";
        $masini = mysql_query($sql,$conn);

        while($row = mysql_fetch_array($masini))
        {
            $rezultat_masina.="<option value=\"$row[id_masina]\" " . ($masina == $row["id_masina"] ? " selected" : "") . ">$row[masina]</option>";
        }
 if($masina != null && is_numeric($masina))
    {
     $sql = "SELECT id_subcategorie_masina, subcategorie_masina FROM subcategorie_masina WHERE id_masina = $masina ";
        $subcategorie_masini = mysql_query($sql,$conn);

        while($row = mysql_fetch_array($subcategorie_masini))
        {
           $rezultat_subcategorie.="<option value=\"$row[id_subcategorie_masina]\" " . ($subcategorie_masina == $row["id_subcategorie_masina"] ? " selected" : "") . ">$row[subcategorie_masina]</option>";
        }
        }
      if($subcategorie_masina != null && is_numeric($subcategorie_masina) && $masina != null)
    {
    $sql = "SELECT id_motorizare,motorizare FROM motorizare WHERE id_subcategorie_masina = $subcategorie_masina ";
        $motorizari = mysql_query($sql,$conn);

        while($row = mysql_fetch_array($motorizari))
        {
            $rezultat_motorizare.="<option value=\"$row[id_motorizare]\" " . ($motorizare == $row["id_motorizare"] ? " selected" : "") . ">$row[motorizare]</option>";
        }
        }if(isset($_GET['ordonare']))
{
$ordonare = $_GET['ordonare'];
}
$intrebare_categorie=mysql_query("SELECT * FROM categorii");
while($rand_categorie=mysql_fetch_array($intrebare_categorie)){
$id_categorie=$rand_categorie['id_categorie'];
$dotare_categorie=$rand_categorie['categorie'];
$cat_noua.='<li><a href="produse.php?cat='.$id_categorie.'&criteriu='.$criteriu.'&categorie='.$categorie.'&masina='.$masina.'&subcategorie_masina='.$subcategorie_masina.'&motorizare='.$motorizare.'&ordonare='.$ordonare.'">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<img src="poze/sageata2.png" style="border: none;">&nbsp;&nbsp;'.$dotare_categorie.'</a></li>';
}
if($masina==''&&$cat==''){
$stare="ascuns";
$intrebare=mysql_query("SELECT * FROM produse WHERE $categorie  LIKE '%".$criteriu."%' AND stare_produs NOT LIKE'ascuns' ORDER BY $categorie $ordonare");
}else{
$intrebare=mysql_query("SELECT * FROM produse WHERE $categorie  LIKE '%".$criteriu."%' and id_produs IN(SELECT id_produs FROM clasificare_piese WHERE (id_masina LIKE '%".$masina."%' or id_masina='0') and (id_subcategorie_masina LIKE '%".$subcategorie_masina."%' or id_subcategorie_masina='0') and (id_motorizare LIKE '%".$motorizare."%' or id_motorizare='0')  and id_categorie LIKE '%".$cat."%' AND stare_produs NOT LIKE'ascuns') ORDER BY $categorie $ordonare");
}
$nr=mysql_num_rows($intrebare);
$nr2=mysql_num_rows($intrebare);
if($nr==0){
$nr=1;
}


if(isset($_GET['pn'])){
$pn=preg_replace('#[^0-9]#i','',$_GET['pn']);
}else{

$pn=1;
}



$items_per_page=5;
$lastpage=ceil($nr/$items_per_page);
$firstpage=1;

if (isset($_POST['formpagina'])){
$pn=$_POST['pagina'];
}
if ($pn<1){
 $pn=1;
}else if($pn>$lastpage){

    $pn=$lastpage;
}

$centerpages="";
$sub1=$pn-1;
$sub2=$pn-2;
$sub3=$pn-3;
$sub4=$pn-4;
$add1=$pn+1;
$add2=$pn+2;
$add3=$pn+3;
$add4=$pn+4;
if($pn==1){
$centerpages.='&nbsp;<span class="pagNumActive">'.$pn.'</span>&nbsp;';
$centerpages.='&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?pn='.$add1.'&criteriu='.$criteriu.'&categorie='.$categorie.'&masina='.$masina.'&subcategorie_masina='.$subcategorie_masina.'&motorizare='.$motorizare.'&cat='.$cat.'&ordonare='.$ordonare.'">'.$add1.'</a>&nbsp;';
}else if($pn==$lastpage&&$pn>3){
  $centerpages.='&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?pn='.$sub3.'&criteriu='.$criteriu.'&categorie='.$categorie.'&masina='.$masina.'&subcategorie_masina='.$subcategorie_masina.'&motorizare='.$motorizare.'&cat='.$cat.'&ordonare='.$ordonare.'">'.$sub3.'</a>&nbsp;';
  $centerpages.='&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?pn='.$sub2.'&criteriu='.$criteriu.'&categorie='.$categorie.'&masina='.$masina.'&ordonare='.$ordonare.'">'.$sub2.'</a>&nbsp;';
  $centerpages.='&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?pn='.$sub1.'&criteriu='.$criteriu.'&categorie='.$categorie.'&masina='.$masina.'&ordonare='.$ordonare.'">'.$sub1.'</a>&nbsp;';
  $centerpages.='&nbsp;<span class="pagNumActive">'.$pn.'</span>&nbsp;';
 }
 else if($pn==$lastpage&&$pn==3){
  $centerpages.='&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?pn='.$sub2.'&criteriu='.$criteriu.'&categorie='.$categorie.'&masina='.$masina.'&subcategorie_masina='.$subcategorie_masina.'&motorizare='.$motorizare.'&cat='.$cat.'&ordonare='.$ordonare.'">'.$sub2.'</a>&nbsp;';
  $centerpages.='&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?pn='.$sub1.'&criteriu='.$criteriu.'&categorie='.$categorie.'&masina='.$masina.'&subcategorie_masina='.$subcategorie_masina.'&motorizare='.$motorizare.'&cat='.$cat.'&ordonare='.$ordonare.'">'.$sub1.'</a>&nbsp;';
  $centerpages.='&nbsp;<span class="pagNumActive">'.$pn.'</span>&nbsp;';
 }else if($pn==$lastpage&&$pn==2){
  $centerpages.='&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?pn='.$sub1.'&criteriu='.$criteriu.'&categorie='.$categorie.'&masina='.$masina.'&subcategorie_masina='.$subcategorie_masina.'&motorizare='.$motorizare.'&cat='.$cat.'&ordonare='.$ordonare.'">'.$sub1.'</a>&nbsp;';
  $centerpages.='&nbsp;<span class="pagNumActive">'.$pn.'</span>&nbsp;';
 }else if($pn>2&&$pn<($lastpage-1)){
   $centerpages.='&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?pn='.$sub2.'&criteriu='.$criteriu.'&categorie='.$categorie.'&masina='.$masina.'&subcategorie_masina='.$subcategorie_masina.'&motorizare='.$motorizare.'&cat='.$cat.'&ordonare='.$ordonare.'">'.$sub2.'</a>&nbsp;';
   $centerpages.='&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?pn='.$sub1.'&criteriu='.$criteriu.'&categorie='.$categorie.'&masina='.$masina.'&subcategorie_masina='.$subcategorie_masina.'&motorizare='.$motorizare.'&ordonare='.$ordonare.'">'.$sub1.'</a>&nbsp;';
   $centerpages.='&nbsp;<span class="pagNumActive">'.$pn.'</span>&nbsp;';
   $centerpages.='&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?pn='.$add1.'&criteriu='.$criteriu.'&categorie='.$categorie.'&masina='.$masina.'&subcategorie_masina='.$subcategorie_masina.'&motorizare='.$motorizare.'&cat='.$cat.'&ordonare='.$ordonare.'">'.$add1.'</a>&nbsp;';
   $centerpages.='&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?pn='.$add2.'&criteriu='.$criteriu.'&categorie='.$categorie.'&masina='.$masina.'&subcategorie_masina='.$subcategorie_masina.'&motorizare='.$motorizare.'&cat='.$cat.'&ordonare='.$ordonare.'">'.$add2.'</a>&nbsp;';
 }else if($pn>1&&$pn<$lastpage){
   $centerpages.='&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?pn='.$sub1.'&criteriu='.$criteriu.'&categorie='.$categorie.'&masina='.$masina.'&subcategorie_masina='.$subcategorie_masina.'&motorizare='.$motorizare.'&cat='.$cat.'&ordonare='.$ordonare.'">'.$sub1.'</a>&nbsp;';
   $centerpages.='&nbsp;<span class="pagNumActive">'.$pn.'</span>&nbsp;';
   $centerpages.='&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?pn='.$add1.'&criteriu='.$criteriu.'&categorie='.$categorie.'&masina='.$masina.'&subcategorie_masina='.$subcategorie_masina.'&motorizare='.$motorizare.'&cat='.$cat.'&ordonare='.$ordonare.'">'.$add1.'</a>&nbsp;';
   }else if($pn==1&&$lastpage>3){
  $centerpages.='&nbsp;<span class="pagNumActive">'.$pn.'</span>&nbsp;';
  $centerpages.='&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?pn='.$add1.'&criteriu='.$criteriu.'&categorie='.$categorie.'&masina='.$masina.'&subcategorie_masina='.$subcategorie_masina.'&motorizare='.$motorizare.'&cat='.$cat.'&ordonare='.$ordonare.'">'.$add1.'</a>&nbsp;';
  $centerpages.='&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?pn='.$add2.'&criteriu='.$criteriu.'&categorie='.$categorie.'&masina='.$masina.'&subcategorie_masina='.$subcategorie_masina.'&motorizare='.$motorizare.'&cat='.$cat.'&ordonare='.$ordonare.'">'.$add2.'</a>&nbsp;';
  $centerpages.='&nbsp;<a href="'.$_SERVER['PHP_SELF'].'?pn='.$add3.'&criteriu='.$criteriu.'&categorie='.$categorie.'&masina='.$masina.'&subcategorie_masina='.$subcategorie_masina.'&motorizare='.$motorizare.'&cat='.$cat.'&ordonare='.$ordonare.'">'.$add3.'</a>&nbsp;';
  }
$limit=($pn-1)*$items_per_page.','.$items_per_page;
if($masina==''&&$cat==''){
$intrebare2=mysql_query("SELECT * FROM produse WHERE $categorie  LIKE '%".$criteriu."%' AND stare_produs NOT LIKE'ascuns' ORDER BY $categorie $ordonare LIMIT $limit")OR DIE (mysql_error());
}else{
$intrebare2=mysql_query("SELECT * FROM produse WHERE $categorie  LIKE '%".$criteriu."%' and id_produs IN(SELECT id_produs FROM clasificare_piese WHERE (id_masina LIKE '%".$masina."%' or id_masina='0') and (id_subcategorie_masina LIKE '%".$subcategorie_masina."%' or id_subcategorie_masina='0') and (id_motorizare LIKE '%".$motorizare."%' or id_motorizare='0')  and id_categorie LIKE '%".$cat."%' AND stare_produs NOT LIKE'ascuns')ORDER BY $categorie $ordonare LIMIT $limit")OR DIE (mysql_error());
}
$numar_rezultate=mysql_num_rows($intrebare2);

$pagini="";
$numar_rezultate="";
$paginationdisplay="";
if($nr2==0){
$numar_rezultate.='Nu s-au gasit rezultate pentru termenii introdusi';
}else if($nr2==1){
$numar_rezultate.='Sa gasit '.$nr.' produs';
}
else{
$numar_rezultate.='S-au gasit '.$nr.' produse';
}
 if($lastpage==1){
  $pagini='</br>Pagina&nbsp;<strong>'.$pn.'</strong> din &nbsp;'.$lastpage.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';


}

if($lastpage!=1){
  $pagini='Pagina&nbsp;<strong>'.$pn.'</strong> din &nbsp;'.$lastpage.'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
if($pn!=1){	 
  $paginationdisplay.='&nbsp;<span class="paginationNumbers"><a href="'.$_SERVER['PHP_SELF'].'?pn='.$firstpage.'&criteriu='.$criteriu.'&categorie='.$categorie.'&masina='.$masina.'&subcategorie_masina='.$subcategorie_masina.'&motorizare='.$motorizare.'&cat='.$cat.'&ordonare='.$ordonare.'">Prima</a></span>';
  } 
  if($pn!=1){
  $previous=$pn-1;
  $paginationdisplay.='&nbsp;<span class="paginationNumbers"><a href="'.$_SERVER['PHP_SELF'].'?pn='.$previous.'&criteriu='.$criteriu.'&categorie='.$categorie.'&masina='.$masina.'&subcategorie_masina='.$subcategorie_masina.'&motorizare='.$motorizare.'&cat='.$cat.'&ordonare='.$ordonare.'">Inapoi</a></span>';
         }
		 
	
   $paginationdisplay.='&nbsp;<span class="paginationNumbers">'.$centerpages.'</span>';

   if($pn!=$lastpage){
   $nextpage=$pn+1;
   $paginationdisplay.='&nbsp;<span class="paginationNumbers"><a href="'.$_SERVER['PHP_SELF'].'?pn='.$nextpage.'&criteriu='.$criteriu.'&categorie='.$categorie.'&masina='.$masina.'&subcategorie_masina='.$subcategorie_masina.'&motorizare='.$motorizare.'&cat='.$cat.'&ordonare='.$ordonare.'">Inainte</a></span>';
   }
   if($pn!=$lastpage){
   $paginationdisplay.='&nbsp;<span class="paginationNumbers"><a href="'.$_SERVER['PHP_SELF'].'?pn='.$lastpage.'&criteriu='.$criteriu.'&categorie='.$categorie.'&masina='.$masina.'&subcategorie_masina='.$subcategorie_masina.'&motorizare='.$motorizare.'&cat='.$cat.'&ordonare='.$ordonare.'">Ultima</a></span>';
   }
}

  $outputlist='';

  while($row=mysql_fetch_array($intrebare2)){

    $id=$row['id_produs'];
   $denumire_produs =$row['denumire_produs'];
   $pret_produs=$row['pret_produs'];
   $stoc_produs=$row['stoc_produs'];
   if(!isset($_SESSION["nivel_client"])){
   $nivel_client=1;
   }
   if(($stoc_produs==0)&&($nivel_client==1)){
   $stoc_produs1="<h3>La comanda</h3>";
   }
   if(($stoc_produs>0)&&($nivel_client==1)){
   $stoc_produs1="<text font-color='#0033FF'>In stoc</text>";
   }
   if($nivel_client==2){
   $stoc_produs1="$stoc_produs buc";
   
   }
   $adresa_imagine="poze/poze_produse/".$row['id_produs'].".jpg";
				if(file_exists($adresa_imagine))
					{
						$imagine='<img src="'.$adresa_imagine.'" width="120" height="100">';
					}
					else
						{
							$imagine= '<div style="width:120px; height:100px; border:1px black  solid; background-color:#cccccc;">Fara Imagine</div>';
						}




   $outputlist.='<div class="articol"><table border="0" cellspacing="0" cellpadding="4" width="100%"><tr><td align="center"><b>Cod produs</b></td><td align="center"><b>Denumire</b></td><td align="center" rowspan=5>'.$imagine.'</td><tr><td width="100" height="20" align="center"><p>'.$id.'</p></td><td align="center" width="200" height="20"><p>'.$denumire_produs.'</p></td></tr><tr><td align="center"><b>Disponibilitate</b></td><td align="center"><b>Pret</b></td></tr><tr><td align="center" width="50" height="20">&nbsp;'.$stoc_produs1.'</td><td align="center" height="20"><strong><h1>'.$pret_produs.'&nbsp;lei</h1></strong></td></tr><tr><td><a href="produs.php?id_produs=' . $id . '"><img src="poze/vezidetalii.png" border="0"></a></td><td align=center><a href="cumpara.php?id_produs=' . $id . '&actiune=adauga"><img src="poze/adaugaincos.png" border="0"></a></td></tr></table></div>';

  }
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
  $cele_mai_cautate=mysql_query("SELECT * FROM produse WHERE stare_produs NOT LIKE 'ascuns' ORDER BY vizualizari_produs DESC LIMIT 5");
while($rand_cele_mai_cautate=mysql_fetch_array($cele_mai_cautate)){

$denumire_cautat=$rand_cele_mai_cautate['denumire_produs'];
$id_produs_cautat=$rand_cele_mai_cautate['id_produs'];
$afisare_cele_mai_cautate.='<a href="produs.php?id_produs='. $id_produs_cautat .'"> '.$denumire_cautat.'</a><br/>';
}
include'barasus.php';
?>
<title>Produse</title>
<?php
include'logomeniu.php';
?>
<div class="cutie_stingap">
<div class="cos">
<img src="poze/cos_imagine.jpg" />
<br /><br />
<?php echo $cos ?></div>
<div class="meniu_categorii">
<img src="poze/categorii.jpg" />
<ul class="meniu_vertical">
<?php echo $cat_noua;?>
</ul>
</div>
 </div>
 <div class="cutie_mijloc">
  <div class="rezultate1"><br/><br/><form method="get" action="produse.php" name="theForm">
<input type="hidden" name="theForm" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Masina:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<select name="masina" onChange="autoSubmit();"><option value="">Toate masinile</option><?php echo $rezultat_masina;?> </select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>Cautare dupa:&nbsp;&nbsp;
<select name="categorie">
<option value="denumire_produs" >Denumire</option>
<option value="id_produs" >cod</option>
</select>
</label><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Model:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b> <select name="subcategorie_masina" onChange="autoSubmit();"><option value="">Toate modelele</option><?php echo $rezultat_subcategorie;?></select>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>Sortare:
&nbsp;&nbsp;<select name="ordonare">
<option value="ASC">Ascendenta</option>
<option value="DESC">Descendenta</option>
</select>
</label><br/><br/>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Motorizare:</b><select name="motorizare" onChange="autoSubmit();"><option value="">Toate motorizarile</option><?php echo $rezultat_motorizare;?></select>



</br></br><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Criteriu de cautare:&nbsp;&nbsp;<input type="text"  name="criteriu" /></label>
<input type="submit" value="Cauta"/>
</form>
 </div>
 <div class="rezultat"><?php echo $numar_rezultate; ?></div>


 <div class="lista_produse"><?php echo $outputlist; ?></div>


  <div class="paginare_produs"><?php echo $paginationdisplay; ?><p><?php echo $pagini; ?></p></div>
 </div>
  <div class="cutie_dreaptap">
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
