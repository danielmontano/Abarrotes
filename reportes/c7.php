<?php 
include "../php/conection.php";?>
<!DOCTYPE html>
<html lang="en">
<html>
<head>
<style>
    .containerc
    {
     margin: 10px 40px 20px 40px;
    }

    .foto{
    /* cambia estos dos valores para definir el tamaño de tu círculo */
    height: 220px;
    width: 210px;
    /* los siguientes valores son independientes del tamaño del círculo */
    background-repeat: no-repeat;
    
    background-size: 100% auto;
}

  .footer-bottom{
  position:fixed;
  right: 0;
  bottom: 0;
  left: 0;
  padding: 1rem;
  text-align: center;
}
.button {
    background-color: #2874f0; /* Green */
    border: none;
    color: white;
    padding: 15px 32px;
    text-align: center;
    text-decoration: none;
    display: inline-block;
    font-size: 16px;
}

.filterable {
    margin-top: 15px;
}
.filterable .panel-heading .pull-right {
    margin-top: -20px;
}
.filterable .filters input[disabled] {
    background-color: transparent;
    border: none;
    cursor: auto;
    box-shadow: none;
    padding: 0;
    height: auto;
}
.filterable .filters input[disabled]::-webkit-input-placeholder {
    color: #333;
}
.filterable .filters input[disabled]::-moz-placeholder {
    color: #333;
}
.filterable .filters input[disabled]:-ms-input-placeholder {
    color: #333;
}

</style>
<meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <link href="http://oxtro.xyz/css/estilo.css" rel="stylesheet">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  <script src="./js/jquery-3.2.1.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>

<body>
<div id="flipkart-navbar">
    <div class="navbar container">
        <div class="row row1">
          <ul><li><a href="http://oxtro.xyz/2017-3-oxtro/a/"> Regresar </a></li></ul>
          </div>
       </div>
     </div>
<div class="containerc">


            <form action="c7.php" method="POST">
      <input type="date" id="datei" name="datei" value="2017-10-30">
      <input type="date" id="datef" name="datef" value="<?php echo date("Y-m-d");?>">
      <button type="submit">Buscar</button>
            </form>

  <br>
      <div class="row ">
    <div class="col-lg-12"> <br><br>
<?php

$products = $con->query("select @rownum:=@rownum+1 AS N, if(isnull(sum(total_defactura)),0.00,sum(total_defactura)) as TOTAL  
 from (SELECT @rownum:=0) r,
(
select sum(if(isnull(t1.total_factura),0,t1.total_factura)) as total_defactura,f.fecha_beh 
from
facturas 
as f
left join
(
select d.foliof_beh,sum(d.cantidad_beh*p.precio_beh) as total_factura
from
detalles as d
inner join
productos as p
on
d.id_prodf_beh=p.id_prod_beh
group by d.foliof_beh
order by d.foliof_beh
) as t1
on
t1.foliof_beh=f.folio_beh
where f.fecha_beh >= \"$_POST[datei]\" 
and
f.fecha_beh<= \"$_POST[datef]\" 
group by f.id_clif_beh
)as t2 ");

if ($_POST["datei"] and $_POST["datei"]) {?>
<h3>Desde el <?php echo $_POST["datei"];?> hasta el <?php echo $_POST["datef"];?></h3>  
  <?php
  }
?>
<div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h1 class="panel-title text-center">Total de Ventas por Fecha</h1>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>
                </div>
            </div>
<table class="table">
    <thead>
        <tr class="filters">
                  <th><input type="text" class="form-control" placeholder="#" disabled></th>
                  <th><input type="text" class="form-control" placeholder="Total" disabled></th>
        </tr>
    </thead>
<?php 
while($r=$products->fetch_object()):?>
<tr>
    <td><?php echo $r->N;?></td>
  <td>$<?php echo number_format($r->TOTAL,2); ?></td>
</tr>
<?php endwhile; ?>
</table>
<br><br>

    </div>
  </div>
  </div>
        
            
                        
                

<script type="text/javascript">
  $(document).ready(function(){
    $('.filterable .btn-filter').click(function(){
        var $panel = $(this).parents('.filterable'),
        $filters = $panel.find('.filters input'),
        $tbody = $panel.find('.table tbody');
        if ($filters.prop('disabled') == true) {
            $filters.prop('disabled', false);
            $filters.first().focus();
        } else {
            $filters.val('').prop('disabled', true);
            $tbody.find('.no-result').remove();
            $tbody.find('tr').show();
        }
    });

    $('.filterable .filters input').keyup(function(e){
        /* Ignore tab key */
        var code = e.keyCode || e.which;
        if (code == '9') return;
        /* Useful DOM data and selectors */
        var $input = $(this),
        inputContent = $input.val().toLowerCase(),
        $panel = $input.parents('.filterable'),
        column = $panel.find('.filters th').index($input.parents('th')),
        $table = $panel.find('.table'),
        $rows = $table.find('tbody tr');
        /* Dirtiest filter function ever ;) */
        var $filteredRows = $rows.filter(function(){
            var value = $(this).find('td').eq(column).text().toLowerCase();
            return value.indexOf(inputContent) === -1;
        });
        /* Clean previous no-result if exist */
        $table.find('tbody .no-result').remove();
        /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
        $rows.show();
        $filteredRows.hide();
        /* Prepend no-result row if all rows are filtered */
        if ($filteredRows.length === $rows.length) {
            $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No se encontraron resultados</td></tr>'));
        }
    });
});
</script>

</div>


<footer>    
    <div class="footer-bottom">
        <div class=" container">
            <p class="text-center">  Administración tienda OXTRO Online<br>Copyright © Oxtro online 2017. All right reserved. </p>
        </div>
    </div>
    <br><br><br><br><br>
    <!--/.footer-bottom--> 
</footer>
</body>
</html>



