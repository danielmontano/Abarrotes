<!DOCTYPE html>
<html>
<title>W3.CSS</title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<style>
.mySlides {display:none;}
</style>
<body>

<div class="w3-container">
  <h2>Galeria:</h2>
  
</div>
<br>
<br>
<div class="w3-content w3-section" style="max-width:500px">
  <img class="mySlides w3-animate-top" src="imagenes/lechita.jpg" style="width:100%">
  <img class="mySlides w3-animate-bottom" src="imagenes/tos.png" style="width:100%">
  <img class="mySlides w3-animate-top" src="imagenes/ricos.jpg" style="width:100%">
  <img class="mySlides w3-animate-bottom" src="imagenes/tecate1.jpg" style="width:100%">
</div>

<script>
var myIndex = 0;
carousel();

function carousel() {
    var i;
    var x = document.getElementsByClassName("mySlides");
    for (i = 0; i < x.length; i++) {
      x[i].style.display = "none";  
    }
    myIndex++;
    if (myIndex > x.length) {myIndex = 1}    
    x[myIndex-1].style.display = "block";  
    setTimeout(carousel, 2500);    
}
</script>

</body>
</html>