<html>

<head><title>Peticiones</title>
<link href='IMAGES/LOGO.png' rel='shortcut icon' type='image/png'>

	<LINK REL="stylesheet" HREF="CSS/stylem.css" TYPE="text/css">
	<meta name="description" content="website description" />
  <meta name="keywords" content="website keywords, website keywords" />
  <meta http-equiv="content-type" content="text/html; charset=UTF-8" />
  <link rel="stylesheet" type="text/css" href="css/style.css" />
  <!-- modernizr enables HTML5 elements and feature detects -->
  <script type="text/javascript" src="js/modernizr-1.5.min.js"></script>

</head>
<body>

<?php

//Code Here

	
?>
<!---------------------------------->
<div id="main">
    <header>
      <div id="logo">
        <div id="logo_text">
          <!-- class="logo_colour", allows you to change the colour of the text -->
          <h1><a href="index.html">Control<span class="logo_colour">_Almacen</span></a></h1>
          <h2>Comite Directivo Estatal PRI Chih.</h2>
        </div>
      </div>
      <?php require_once("menu.php");?>
    </header>
    <div id="site_content">
      
      
        <h1>Solicitar Productos al Departamento de Sistemas</h1>
        <?php
        
       require_once('BIN/controler.php');
       
					$db= new dbManager();
					$db->configuracion("peticiones.php");

		//echo($_COOKIE["idUs"]);
   		if(ISSET($_POST["idart"])){
   			$valida=true;
   			$message="";
   			if(!$db->valida($_POST["idart"],true)){
					$valida=false;
					$message="Clave de Producto no valida";   			
   			}
   			if(!$db->valida($_POST["cantidad"],true)){
					$valida=false;
					$message="cantidad no valida";   			
   			}
   			if($valida==true&&$_POST["idart"]!='0'){
   			$db->agregarPeticion($_POST["idart"],$_POST["cantidad"],$_COOKIE["idUs"]);
   			?><h2>Agregado Correctamente</h2><?php
					}else{
					?><h2><?php echo($message); ?></h2><?php
					}   			
   		}

      ?>
        <form action="peticiones.php" method="post">
        <table class="tab" align="center" border="1" >
			<tr >
				<th style="color:black;" colspan="10" align="center" ><center>Agregar Peticion</center></th>
			</tr>       
			
			<tr>
			<th>Nombre del Articulo</th>
			<th>Cantidad</th>	
			<th>Agregar</th>		
			</tr>
			<tr>
				<?php 
					
					$p= $db->getProductosL();
					$ids=explode(',', $p[0]);
					$np=explode(',', $p[1]);				
				?>
			
				
				<td><select  name="idart" class="stab" >
				<option  value="0">Ninguno</option>	
				<?php
				if($ids[0]!="")
				 for($i=0;$i<count($ids);$i++){
					?><option value="<?php echo($ids[$i]); ?>"><?php echo($np[$i]); ?></option> <?php				 
				 } 
				?>			
				</select></td>
				<td><input type="text" name="cantidad" class="prec" /></td>	
				
				
				<td><input class="button" type="submit" value="AGREGAR" /></td>				
			</tr>
        
     </form>
     
<tr >
				<th style="color:black;" colspan="10" align="center" ><center>Peticiones del Usuario&nbsp;<?php echo($_COOKIE["useralmacen"]); ?></center></th>
			</tr>       
			
			<tr>
			<th>Nombre</th>
			<th>Cantidad</th>
			<th>Fecha</th>		
			</tr>
			<?php
			$pet=$db->getPeticiones($_COOKIE["idUs"]);
			$nom=explode(",",$pet[0]);
			$cant=explode(",",$pet[1]);
			$fec=explode(",",$pet[2]);
			$disp=explode(",",$pet[3]);
			$color="white"; 
			for($i=0;$i<count($cant);$i++){
			  if($disp[$i]=="" || intval($disp[$i])<2)
			  $color= "red";
			  else
			  $color="white"; 
			?><tr>
					<td style="background-color:<?php echo($color); ?>;"><?php echo($nom[$i]); ?></td>
					<td style="background-color:<?php echo($color); ?>;"><?php echo($cant[$i]); ?></td>	
					<td style="background-color:<?php echo($color); ?>;"><?php echo($fec[$i]); ?></td>		
			</tr> <?php
			}
			?>
			
</table>
    <footer>
      <p>&copy; 2013 Secretaria de Analisis de la Informacion, Evaluacion y Seguimiento  | <a href="http://www.prichihuahua.org.mx">Comite Directivo Estatal Chih.</a></p>
    </footer>
  </div>
  <!-- javascript at the bottom for fast page loading -->
  <script type="text/javascript" src="js/jquery.js"></script>
  <script type="text/javascript" src="js/jquery.easing-sooper.js"></script>
  <script type="text/javascript" src="js/jquery.sooperfish.js"></script>
  <script type="text/javascript" src="js/image_fade.js"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('ul.sf-menu').sooperfish();
    });
  </script>



</div>

</body>
</html>