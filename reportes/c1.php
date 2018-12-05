<?php
/*
* Este archio muestra los productos en una tabla.
*/
include "../php/conection.php";
?>
<meta charset="utf-8">  
</head>
<style>
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
</head>
<body >

<div class="containerc">
    <div class="row ">
        <div class="col-lg-12">
<?php

$products = $con->query("select @rownum:=@rownum+1 AS N, t4.producto_beh,t4.total
from (SELECT @rownum:=0) r,
(
select t1.producto_beh,if(isnull(t1.total),0,t1.total) as total
from
(
select p.producto_beh,sum(d.cantidad_beh*p.precio_beh) as total
from
productos as p
left join
detalles as d
on
p.id_prod_beh=d.id_prodf_beh
group by p.id_prod_beh
order by total asc
) as t1
) as t4
where
total =
(
select max(t3.total) as Mas_Vendido
from
(
select t2.producto_beh,if(isnull(t2.total),0,t2.total) as total
from
(
select p.producto_beh,sum(d.cantidad_beh*p.precio_beh) as total
from
productos as p
left join
detalles as d
on
p.id_prod_beh=d.id_prodf_beh
group by p.id_prod_beh
order by total desc
) as t2
) as t3
)order by total desc");
?>
<div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h1 class="panel-title text-center">Producto Más vendido</h1>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>
                </div>
            </div>
<table class="table">
    <thead>
        <tr class="filters">
                  <th><input type="text" class="form-control" placeholder="#" disabled></th>
                  <th><input type="text" class="form-control" placeholder="PRODUCTO" disabled></th>
                  <th><input type="text" class="form-control" placeholder="TOTAL" disabled></th>
        </tr>
    </thead>
<?php 
while($r=$products->fetch_object()):?>
<tr>
    <td><?php echo $r->N;?></td>
    <td><?php echo $r->producto_beh;?></td>
    <td>$ <?php echo number_format($r->total,2); ?></td>
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