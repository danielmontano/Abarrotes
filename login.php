<style type="text/css">
  .prettyline {
  height: 5px;
  border-top: 0;
  background: #c4e17f;
  border-radius: 5px;
  background-image: -webkit-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: -moz-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: -o-linear-gradient(left, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
  background-image: linear-gradient(to right, #c4e17f, #c4e17f 12.5%, #f7fdca 12.5%, #f7fdca 25%, #fecf71 25%, #fecf71 37.5%, #f0776c 37.5%, #f0776c 50%, #db9dbe 50%, #db9dbe 62.5%, #c49cde 62.5%, #c49cde 75%, #669ae1 75%, #669ae1 87.5%, #62c2e4 87.5%, #62c2e4);
}
.imgagenoxtro{
    position: absolute;
    left: 22%;
    top: 33%;
    z-index: -1;
    opacity: 0.2;
    width: 55%;
}
</style>

  <link rel="stylesheet" href="css/login.css" type="text/css" media="screen">
<link href="./css/style.css" rel="stylesheet" type="text/css">
<link href="./css/estilo.css" rel="stylesheet">

<?php require_once("./barra.php"); ?>
<div class="container"> 
    <br>
    <hr class="prettyline">
    <br><br>
    <center>
    <img alt="Brand" class="imgagenoxtro" src="imagenes/oxtro.jpg">
    <h1><b>Atención</b></h1>
    <h3>Necesita iniciar sesión con su cuenta de cliente o registrarse para poder comprar en OXTRO.xyz</h3>
    <br><em>¡Gracias por su comprensión!</em>
    <br><br>
  <button class="btn btn-primary btn-lg" href="#" data-toggle="modal" data-target="#login-modal">Iniciar Sesión/Registrarse</button>
  </center>
  <br><br>
    <hr class="prettyline">
 </div>

 <br><br>
<?php require_once("./pie.php"); ?>
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