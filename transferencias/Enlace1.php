<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Transferencia de Información</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link href="../eCommerceAssets/styles/eCommerceStyle.css" rel="stylesheet" type="text/css">
<!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.-->
<script>var __adobewebfontsappname__="dreamweaver"</script><script src="http://use.edgefonts.net/montserrat:n4:default;source-sans-pro:n2:default.js" type="text/javascript"></script>
</head>

<body>
<div id="mainWrapper">
  <header> 
    <!-- This is the header content. It contains Logo and links -->
    <div id="logo"> <!-- <img src="logoImage.png" alt="sample logo"> --><a href="transferencia.php"><img src="rozzyslogo.png" width="50" height="54" alt=""/></a></div>
    <div id="headerLinks"></div>
  </header>
  <section id="offer"> 
    <!-- The offer section displays a banner text for promotions -->
    <h2>Transferencia en Lotes - PQR en Proceso a PQR no procesadas.</h2>
  </section>
  <div id="content">
    <section class="sidebar"> 
      <!-- This adds a sidebar with 1 searchbox,2 menusets, each with 4 links -->
      <div id="menubar">
        <nav class="menu">
          <h2><!-- Title for menuset 1 -->MENU </h2>
          <hr>
          <ul>
            <!-- List of links under menuset 1 -->
            <li><a href="#" title="Link">Transferir Lote de PQR en proceso a PQR no procesada.</a></li>
            <li><a href="#" title="Link">Transferir Lote de PQR en proceso a PQR periodos anteriores</a></li>
            <li><a href="#" title="Link">Transferir PQR de no Procesada a PQR en proceso.</a></li>
            <li><a href="#" title="Link">Transferir PQR de periodos anteriores a PQR en proceso</a></li>
          </ul>
        </nav>
      </div>
    </section>
    <section class="mainContent">
      <div class="productRow"> 
<p>
          <!-- Each product row contains info of 3 elements -->
        <span style="text-align: justify">En esta area, se tomaran las PQR en Proceso del periodo seleccionado que han sido señaladas como 'No Contactado', despues de varios intentos, y se trasladaran al </span>area de PQR no Procesadas, esto se hará despues del tiempo establecido para toma de este tipo de decisión.        </p>
<p><strong>Periodo a Trasladar</strong>:
		  
		  
		  <?php
  $mysqli = new mysqli("localhost","medico_web","Medicontrol123*","medico_rozzys");
?>
<!DOCTYPE html>
<title></title>
  <body>

  <select name="select">
          <option value="0">Seleccione:</option>
          <?php
          $query = $mysqli -> query ("SELECT DISTINCT periodo from pqr");
          while ($valores = mysqli_fetch_array($query)) {
            echo '<option value="'.$valores[periodo].'">'.$valores[periodo].'</option>';
          } ?> 
	  </select><p><input type='submit' name='seleccionar' value='Trasladar'/>
	 <?php
    if(isset($_POST['seleccionar'])){
        
		echo "<script>alert('Usuario ya existe');</script>";
    }
?>
  </select>
  
</body>

</html>
		  
		  
		  
		  </p>
        <p>&nbsp;</p>
      </div>
    </section>
  </div>
</div>
</body>
</html>
