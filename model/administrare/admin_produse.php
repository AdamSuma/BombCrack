<?php
include'verificare.php';
include'admin_barasus.php';
include'admin_logomeniu.php';

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
}
$masina = $subcategorie_masina = $motorizare =$cat= ''; 
$conn = mysql_connect('localhost', 'root', '');
$db = mysql_select_db('licenta',$conn);
if(isset($_GET["cat"]))
{
    $cat= $_GET["cat"];
}
include('conectare.php');

$intrebare_categorie=mysql_query("SELECT * FROM categorii");
while($rand_categorie=mysql_fetch_array($intrebare_categorie)){
$id_categorie=$rand_categorie['id_categorie'];
$dotare_categorie=$rand_categorie['categorie'];
$rezultat_categorie.="<option value=\"$rand_categorie[id_categorie]\" " . ($cat == $rand_categorie["id_categorie"] ? " selected" : "") . ">$rand_categorie[categorie]</option>";
}

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
if($masina==''&&$cat==''){
$intrebare=mysql_query("SELECT * FROM produse WHERE $categorie  LIKE '%".$criteriu."%' ORDER BY $categorie $ordonare");
}else{
$intrebare=mysql_query("SELECT * FROM produse WHERE $categorie  LIKE '%".$criteriu."%' and id_produs IN(SELECT id_produs FROM clasificare_piese WHERE (id_masina LIKE '%".$masina."%' or id_masina='0') and (id_subcategorie_masina LIKE '%".$subcategorie_masina."%' or id_subcategorie_masina='0') and (id_motorizare LIKE '%".$motorizare."%' or id_motorizare='0')  and id_categorie LIKE '%".$cat."%' ) ORDER BY $categorie $ordonare");
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
$intrebare2=mysql_query("SELECT * FROM produse WHERE $categorie  LIKE '%".$criteriu."%' ORDER BY $categorie $ordonare LIMIT $limit")OR DIE (mysql_error());
}else{
$intrebare2=mysql_query("SELECT * FROM produse WHERE $categorie  LIKE '%".$criteriu."%' and id_produs IN(SELECT id_produs FROM clasificare_piese WHERE (id_masina LIKE '%".$masina."%' or id_masina='0') and (id_subcategorie_masina LIKE '%".$subcategorie_masina."%' or id_subcategorie_masina='0') and (id_motorizare LIKE '%".$motorizare."%' or id_motorizare='0')  and id_categorie LIKE '%".$cat."%' )ORDER BY $categorie $ordonare LIMIT $limit")OR DIE (mysql_error());
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
   $adresa_imagine="../poze/poze_produse/".$row['id_produs'].".jpg";
				if(file_exists($adresa_imagine))
					{
						$imagine='<img src="'.$adresa_imagine.'" width="80" height="60">';
					}
					else
						{
							$imagine= '<div style="width:80px; height:60px; border:1px black  solid; background-color:#cccccc;">Fara Imagine</div>';
						}




   $outputlist.='<div style="produse"><table border="0" cellspacing="0" cellpadding="4" width="780"><tr bgcolor="#FFFFFF"><td><b>Cod produs</b></td><td align="center">Denumire</td><td align="center">Stoc</td><td align="center">Pret</td><td align="right"rowspan=3 bgcolor="#FFFFFF">'.$imagine.'</td></tr><tr><td>'.$id.'</td><td align="center">'.$denumire_produs.'</td><td align="center">'.$stoc_produs.'</td><td align="center">'.$pret_produs.'</td></tr><tr><td><a href="sterge_produs.php?id_produs=' . $id . '">Sterge</a></td><td align=center><a href="modifica_produs.php?id_produs=' . $id . '">Modifica</a>&nbsp;&nbsp;&nbsp;&nbsp;<a href="ascunde_produs.php?id_produs=' . $id . '">Ascunde</a></td><td><a href="clasificare_produse.php?id_produs=' . $id . '" >Clasifica</a></td></tr></table><hr width="70%" align="center"/></div>';

  }











?>
<div class="spatiustinga"></br><h3 align="center">&nbsp;&nbsp;&nbsp;ACTIUNI</h3>
</br>
<ul class="meniu_vertical">
<li><a href="adauga_produs.php"><img src="../poze/document.gif" border="0" alt="" />Adauga produs</a></li>
<li><a href="adauga_categorie.php"><img src="../poze/document.gif" border="0" alt="" />Adauga categorie</a></li>
<li><a href="adauga_masina.php"><img src="../poze/document.gif" border="0" alt="" />Adauga masina</a></li>
<li><a href="adauga_model.php"><img src="../poze/document.gif" border="0" alt="" />Adauga model</a></li>
<li><a href="adauga_motorizare.php"><img src="../poze/document.gif" border="0" alt="" />Adauga motorizare</a></li>
</ul>


</div>
<div class="spatiudreapta">
 <div class="rezultate"></br></br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>CAUTARE AVANSATA:</b></br></br><form method="get" action="admin_produse.php" name="theForm">
 <input type="hidden" name="theForm" />
<tr><td align="right"><b>Masina:</b></td><td><select name="masina" onChange="autoSubmit();"><option value="">Toate masinile</option><?php echo $rezultat_masina;?> </select></td></tr>
<tr><td align="right"><b>Model:</b></td><td> <select name="subcategorie_masina" onChange="autoSubmit();"><option value="">Toate modelele</option><?php echo $rezultat_subcategorie;?></select></td></tr>
<tr><td align="right"><b>Motorizare:</b></td><td> <select name="motorizare" onChange="autoSubmit();"><option value="">Toate motorizarile</option><?php echo $rezultat_motorizare;?></select></td></tr>
<tr><td align="right"><b>Categorie:</b></td><td><select name="cat" onChange="autoSubmit();"><option value="">Toate</option><?php echo $rezultat_categorie;?></select></td></tr>
</br></br><label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Cautare dupa:&nbsp;&nbsp;
<select name="categorie">
<option value="denumire_produs" >Denumire</option>
<option value="id_produs" >cod</option>
</select>
</label>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>Sortare:
&nbsp;&nbsp;<select name="ordonare">
<option value="ASC">Ascendenta</option>
<option value="DESC">Descendenta</option>
</select>
</label>
</br></br>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<label>Criteriu de cautare:&nbsp;&nbsp;<input type="text"  name="criteriu" /></label>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="Cauta"/>
</form>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
  <div class="articol1"><?php echo $numar_rezultate; ?><?php echo $outputlist; ?></div>
  <div class="paginare1"><?php echo $paginationdisplay; ?><p><?php echo $pagini; ?></p></div>
    </div>










<?php
include'admin_barajos.php';
?>