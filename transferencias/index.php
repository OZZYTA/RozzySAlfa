<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>RozzyS - Transferencia y Depuración - Login</title>
<link href="../AboutPageAssets/styles/aboutPageStyle.css" rel="stylesheet" type="text/css">

<!--The following script tag downloads a font from the Adobe Edge Web Fonts server for use within the web page. We recommend that you do not modify it.-->
<script>var __adobewebfontsappname__="dreamweaver"</script><script src="http://use.edgefonts.net/montserrat:n4:default;source-sans-pro:n2:default.js" type="text/javascript"></script>
</head>

<body>
<!-- Header content -->
<header>
  <div class="profileLogo"> 
    <!-- Profile logo. Add a img tag in place of <span>. -->
    <p class="logoPlaceholder"><!-- <img src="logoImage.png" alt="sample logo"> --><img src="rozzyslogo.png" width="46" height="50" alt=""/></p>
  </div>
  <div class="profilePhoto"> 
    <form action="validar.php" method="post">
    <p>&nbsp;</p>
    <p>
      <label for="memberId" class="profileHeader"><strong>Nombre de Usuario:</strong></label>
    </p>
    <p>
      <input name="memberID" type="text" required="required" id="memberID">
    </p>
    <p>
      <label for="passMD5" class="profileHeader"><strong>Contraseña:</strong></label>
    </p>
    <p>
      <input type="password" name="passMD5" id="passMD5">
    </p>
    <p>
      <input type="submit" name="login" id="login" value="Iniciar Sesión">
    </p>
	  </form>
  </div>
  <!-- Identity details -->
  <section class="profileHeader">
    <h1>SEGURIDAD - 2 PASOS</h1>
    <h3>SOLO USUARIOS AUTORIZADOS</h3>
    <hr>
    <p>Por favor inicie sesión nuevamente con sus credenciales RozzyS para verificar su acceso a esta área y sus funcionalidades.</p>
  </section>
  <!-- Links to Social network accounts -->
  <aside class="socialNetworkNavBar"></aside>
</header>
<!-- content -->
<footer>
  <hr>
  <p class="footerDisclaimer">2021  Copyrights- Medicontrol SAS- <span>All Rights Reserved</span></p>
  <p class="footerNote">Ozzyta - <span>ozzyta1@gmail.com</span></p>
</footer>
</body>
</html>
