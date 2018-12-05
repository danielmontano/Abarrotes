<style>
.white {
    color: white;
}  
 .white1{
     font: 13px arial, sans-serif;
    color: white;
}  

 .white2 {
     font: 13px arial, sans-serif;
    color: white;
}
    .redondo {
    /* cambia estos dos valores para definir el tamaño de tu círculo */
    height: 30px;
    width: 30px;
    /* los siguientes valores son independientes del tamaño del círculo */
    background-repeat: no-repeat;
    background-position: 50%;
    border-radius: 50%;
    background-size: 100% auto;
}



</style>    
<link rel="stylesheet" type="text/css" href="css/estilobarra.css">
  <link rel="stylesheet" href="css/login.css" type="text/css" media="screen">
<link rel="stylesheet" type="text/css" href="css/dropdown.css">
<script src="./../js/jquery-3.2.1.min.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="./css/bootstrap.min.css">

<div id="flipkart-navbar">
    <div class="navbar container">
        <div class="row row1">

            <ul class="largenav pull-left ">
              <!--
               <li class="upper-links"><a class="links" href="#" onclick="$('.containerc').load('quienessomos.php');">¿Quiénes somos?</a></li>
               <li class="upper-links"><a class="links" href="#" onclick="$('.containerc').load('historia.php');">Historia</a></li>
               -->
               <li class="upper-links"><a class="links" href="#" onclick="window.location='./products.php';">Productos</a></li>
				<!--
              <li class="upper-links"><a class="links" href="#servicios">Servicios</a></li>
-->
              <li class="upper-links"><a class="links" href="#" onclick="$('.containerc').load('galeria.php');">Galeria</a></li>
              <li class="upper-links"><a class="links" href="#" onclick="$('.containerc').load('promo.php');">Inventarios</a></li>
              <li class="upper-links"><a class="links" href="#" onclick="$('.containerc').load('acercade.php');">Acerca de</a></li>
              <li class="upper-links"><a class="links" href="#" onclick="$('.containerc').load('contacto.php');">Contacto</a></li>
                    </ul>
                    
                <?php 
            if(!isset($_SESSION["id_usu_beh"]) and !isset($_SESSION["id_cli_beh"]))
            {
            ?><ul class=" largenav pull-right">
            <!-- 2017-3-oxtro  -->
             <li><a  class="white1" href="alexlapaz/a/index.php/examples/registro_clientes/add"><span class="glyphicon glyphicon-plua white"> Registrarse</span></a><a class="white2"> | </a><a href="#" class="white1" data-toggle="modal" data-target="#login-modal"><span class="glyphicon glyphicon-user white"> Login </span></a></li> </ul>
             <?php 
            }else if(isset($_SESSION["id_usu_beh"]) and !isset($_SESSION["id_cli_beh"])){
            ?> <ul id="d" class=" nav navbar-nav pull-right" >
            
           <li id="a" class="dropdown" >
              <a  id="a" style="color:white" href="#" class="dropdown-toggle pull-right" data-toggle="dropdown"><?php echo $_SESSION["nomb_usu_beh"].'  '; ?><img class="redondo" src="./a/assets/uploads/files/Usuarios/<?php echo $_SESSION["foto_beh"]; ?>"></a>
              <ul id="a" class="dropdown-menu" >
                <li><a id="a" style="color:white" href="#">Usuario: <br><h4><?php echo $_SESSION["usuario_beh"]; ?></h4></a></li>
                <li class="divider"></li>
                <li><a id="a" style="color:white" href="#">Ocupación: <br><h4><?php echo $_SESSION["ocupacion_beh"]; ?></h4></a></li>
                <li class="divider"></li>
                <li><a id="a" style="color:white" href="#" onclick="window.location='http://loestasviendo.com/alexlapaz/a/';">Administración<span class="glyphicon glyphicon-cog pull-right"></span></a></li>
                <li class="divider"></li>
                <li><a id="a" style="color:white" href="#" onclick="window.location='logout.php';">Cerrar Sesión<span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
              </ul>
            </li>
            </ul>
                    <!-- Example split danger button -->
             <?php 
        } else if(isset($_SESSION["id_cli_beh"]) and $_SESSION["nivel_beh"]!=1){
            ?>
            <ul id="d" class=" nav navbar-nav pull-right" >
            
           <li id="a" class="dropdown" >
              <a  id="a" style="color:white" href="#" class="dropdown-toggle pull-right" data-toggle="dropdown"><?php echo $_SESSION["nomb_cli_beh"].'  '.$_SESSION["ap_cli_beh"]; ?><img class="redondo" src="./a/assets/uploads/files/Clientes/<?php echo $_SESSION["img_cli_beh"]; ?>"></a>
              <ul id="a" class="dropdown-menu" >
                <li><a id="a" style="color:white" href="#">Usuario: <br><h4><?php echo $_SESSION["usuario_beh"]; ?></h4></a></li>
                <li class="divider"></li>
                <li><a id="a" style="color:white" href="#">Email: <br><h4><?php echo $_SESSION["email_beh"]; ?></h4></a></li>
                <li class="divider"></li>
                <li><a id="a" style="color:white" href="#" onclick="window.location='logout.php';">Cerrar Sesión<span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
              </ul>
            </li>
            </ul>
        <?php 
        } else {
            ?> <ul id="d" class=" nav navbar-nav pull-right" >
            
           <li id="a" class="dropdown" >
              <a  id="a" style="color:white" href="#" class="dropdown-toggle pull-right" data-toggle="dropdown"><?php echo $_SESSION["nomb_cli_beh"].'  '.$_SESSION["ap_cli_beh"]; ?><img class="redondo" src="./a/assets/uploads/files/Clientes/<?php echo $_SESSION["img_cli_beh"]; ?>"></a>
              <ul id="a" class="dropdown-menu" >
                <li><a id="a" style="color:white" href="#">Usuario: <br><h4><?php echo $_SESSION["usuario_beh"]; ?></h4></a></li>
                <li class="divider"></li>
                <li><a id="a" style="color:white" href="#">Email: <br><h4><?php echo $_SESSION["email_beh"]; ?></h4></a></li>
                <li class="divider"></li>
                <li><a id="a" style="color:white" href="#" onclick="window.location='http://loestasviendo.com/alexlapaz/a/';">Administración<span class="glyphicon glyphicon-cog pull-right"></span></a></li>
                <li class="divider"></li>
                <li><a id="a" style="color:white" href="#" onclick="window.location='logout.php';">Cerrar Sesión<span class="glyphicon glyphicon-log-out pull-right"></span></a></li>
              </ul>
            </li>
            </ul>
        <?php 
        } 
        ?>
        </div>
        <div class="row row2">
            <div class="col-sl-2s">
            <h2 style="margin:0px;"><span class="smallnav menu" onclick="openNav()">☰ </span></h2>
                <h1 style="margin:0px;"><span class="largenav"></span></h1>
                <a class="navbar-brand" href="index.php">
        <img alt="Brand" src="imagenes/logoa.jpg" style="height:60px; width: 105px;">
      </a>
            </div>
            <div class="flipkart-navbar-search smallsearch col-sm-8 col-xs-11">
                <div class="row">
                   <br>
                   <form action="products.php" method="POST">
                    <input class="flipkart-navbar-input col-xs-11" style="color:#000; " type="" placeholder="Busca productos" name="nombProd">
                    <button type="submit" class="flipkart-navbar-button col-xs-1">
                        <svg width="15px" height="15px">
                            <path d="M11.618 9.897l4.224 4.212c.092.09.1.23.02.312l-1.464 1.46c-.08.08-.222.072-.314-.02L9.868 11.66M6.486 10.9c-2.42 0-4.38-1.955-4.38-4.367 0-2.413 1.96-4.37 4.38-4.37s4.38 1.957 4.38 4.37c0 2.412-1.96 4.368-4.38 4.368m0-10.834C2.904.066 0 2.96 0 6.533 0 10.105 2.904 13 6.486 13s6.487-2.895 6.487-6.467c0-3.572-2.905-6.467-6.487-6.467 "></path>
                        </svg>
                    </button>
                    </form>
                </div>
            </div>
            <div class="cart largenav col-sm-2">
                <br><a href="./cart.php" class="cart-button white2">
                    <svg class="cart-svg " width="16 " height="16 " viewBox="0 0 16 16 ">
                        <path d="M15.32 2.405H4.887C3 2.405 2.46.805 2.46.805L2.257.21C2.208.085 2.083 0 1.946 0H.336C.1 0-.064.24.024.46l.644 1.945L3.11 9.767c.047.137.175.23.32.23h8.418l-.493 1.958H3.768l.002.003c-.017 0-.033-.003-.05-.003-1.06 0-1.92.86-1.92 1.92s.86 1.92 1.92 1.92c.99 0 1.805-.75 1.91-1.712l5.55.076c.12.922.91 1.636 1.867 1.636 1.04 0 1.885-.844 1.885-1.885 0-.866-.584-1.593-1.38-1.814l2.423-8.832c.12-.433-.206-.86-.655-.86 " fill="#fff "></path>
                    </svg> 
                    <span class="item-number"><?php if($_SESSION["cart"]){echo "";}{ echo count($_SESSION["cart"]);}?></span>
                </a>
         </div>
        </div>
    </div>
</div>
<div id="mySidenav" class="sidenav">
    <div class="navbar container" style="background-color: #2874f0; padding-top: 10px;">
        <span class="sidenav-heading">Home</span>
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">×</a>
    </div>
    <!--
    <li class="upper-links"><a class="links" href="#" onclick="$('.containerc').load('quienessomos.php');">¿Quiénes somos?</a></li>
               <li class="upper-links"><a class="links" href="#" onclick="$('.containerc').load('historia.php');">Historia</a></li>
               -->
               <li class="upper-links"><a class="links" href="#" onclick="$('.containerc').load('productos.php');">Productos</a></li>
	<!--
              <li class="upper-links"><a class="links" href="#" onclick="$('.containerc').load('servicios.php');">Servicios</a></li>
-->
              <li class="upper-links"><a class="links" href="#" onclick="$('.containerc').load('galeria.php');">Galeria</a></li>
              <li class="upper-links"><a class="links" href="#" onclick="$('.containerc').load('promociones.php');">Inventarios</a></li>
              <li class="upper-links"><a class="links" href="#" onclick="$('.containerc').load('acercade.php');">Acerca de</a></li>
              <li class="upper-links"><a class="links" href="#" onclick="$('.containerc').load('contacto.php');">Contacto</a></li>
</div>

<div class="modal fade" id="login-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
        <div class="loginmodal-container">
        <div class="text-right">
        <button type="button" class="btn btn-danger" data-dismiss="modal" style="border:0px solid transparent;margin-top: -32px; margin-right:-15px; font-size:10px">X</button>
          </div>
          <h1>Ingresa tus Datos</h1><br>
         
                  <form id="form-signin" >


               <input type="text"  name="txtusuario" id="txtusuario" placeholder="usuario">
               <input type="password" name="txtpassw" id="txtpassw" placeholder="contraseña">
      
                <input type="submit" name="login" class="login loginmodal-submit" value="Iniciar Sesión">
                  </form>
          
          <div class="login-help">
          <!--
          <a href="2017-3-oxtro/a/index.php/examples/registro_clientes/add" style="color:blue">Registrate aquí</a></div>
          -->
          <a href="alexlapaz/a/index.php/examples/registro_clientes/add" style="color:blue">Registrate aquí</a></div>

        </div>
      </div>
 </div>

<script>
    var  form = $("#form-signin");
    form.submit(function(){
      $.ajax({
        url: "./clases/clsUsuarios.php?opc=1",
        method:"POST",
        async:false,
        data:form.serialize(),
        success: function(data){
          if(data == 1){    
			  
            // window.location = "2017-3-oxtro/a/";  
			window.location = "alexlapaz/a/";  
			  
          }
          else if(data == 2){           
            window.location = "index.php";  
          }else{
            alert("Usuario y/o Contraseña no valida");
            $('.containerc').load('login.php');
          }
        },
        error:function(request, status, error){
          alert("Error");
        },
        dataType:"json"
      });
      return false;
    });
  </script>


<script >
    
    function openNav() {
    document.getElementById("mySidenav").style.width = "60%";
    // document.getElementById("flipkart-navbar").style.width = "50%";
    document.body.style.backgroundColor = "rgba(0,0,0,0.4)";
}

function closeNav() {
    document.getElementById("mySidenav").style.width = "0";
    document.body.style.backgroundColor = "rgba(0,0,0,0)";
}
</script>