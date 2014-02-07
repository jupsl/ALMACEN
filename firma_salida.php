<html>

<head>
<title>Firma Salidas</title>
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
      <?php //require_once("menu.php");?>
    </header>
    <div id="site_content"> 
      
     
        <h1>Recibo de Mercancia</h1>
        <center>
          <table class="tab" align="center" border="1" >
        <tr>
			<th colspan="5"><center>Listado de Artículos</center></th>        
        </tr>
        <tr>
			<th>Usuario que entrega</th>
			<th>Usuario que Recibe</th>
			<th>Producto </th>
			<th>Cantidad</th>
			<th>Firma</th>       
        </tr>
        <?php
        if(ISSET($_COOKIE["userrecibo"])){
        		require_once('BIN/controler.php');
       
					$db= new dbManager();
				//echo($_COOKIE["idart"]);
        		$uss= explode(",",$_COOKIE["userrecibo"]);
        		$cant= explode(",",$_COOKIE["cant"]);
        		$idart= explode(",",$_COOKIE["idart"]);
        		for($i=0;$i<count($uss);$i++){
        			?>
        			 <tr>
        			 	<td><?php echo($_COOKIE["useralmacen"]); ?></td>
						<td><?php echo($db->getNombreUS($uss[$i])); ?></td>  
						<td><?php echo($db->getNombreArt($idart[$i])); ?></td> 
						<td><?php echo($cant[$i]); ?></td>    
						<td>__________________________</td>   			 
        			 </tr>
        			<?php 
        		}
        		setcookie("userrecibo","");
        		setcookie("cant","");
        		setcookie("idart","");
        		
			}         
        ?>
		  </table>
	</center>
 <a href="#" onclick="window.print();">Imprimir</a>
    
    </div>
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

</table>
</form>
</div>

</body>
</html>