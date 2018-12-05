

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
<body>

	<div class="row ">
		<div class="col-lg-12"> <br><br>
<?php

$products = $con->query("select @rownum:=@rownum+1 AS N,t5.nombre_completo,t5.total_cliente as Monto_Total_Compras
from (SELECT @rownum:=0) r,
(
select t4.nombre_completo,
if(isnull(t4.total_cliente),0,t4.total_cliente) as total_cliente
from
(
select concat(c.nomb_cli_beh,' ',c.ap_cli_beh,' ',c.am_cli_beh) as nombre_completo,
t3.total_cliente
from
clientes as c
left join
(
select f.id_clif_beh,sum(t1.total_factura) as total_cliente
from
facturas as f
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
group by f.id_clif_beh
) as t3
on
c.id_cli_beh=t3.id_clif_beh
) as t4
order by t4.total_cliente desc
) as t5
where
t5.total_cliente=0 or
t5.total_cliente=
(
select min(total_cliente) as Monto_Total_Compras
from
(
select t4.nombre_completo,
if(isnull(t4.total_cliente),0,t4.total_cliente) as total_cliente
from
(
select concat(c.nomb_cli_beh,' ',c.ap_cli_beh,' ',c.am_cli_beh) as nombre_completo,
t3.total_cliente
from
clientes as c
left join
(
select f.id_clif_beh,sum(t1.total_factura) as total_cliente
from
facturas as f
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
group by f.id_clif_beh
) as t3
on
c.id_cli_beh=t3.id_clif_beh
) as t4
order by t4.total_cliente desc
) as t5 where total_cliente !=0
)");
?>
<div class="panel panel-primary filterable">
            <div class="panel-heading">
                <h1 class="panel-title text-center">Cliente que menos ha comprado</h1>
                <div class="pull-right">
                    <button class="btn btn-default btn-xs btn-filter"><span class="glyphicon glyphicon-filter"></span> Filtrar</button>
                </div>
            </div>
<table class="table">
    <thead>
        <tr class="filters">
                  <th><input type="text" class="form-control" placeholder="#" disabled></th>
                  <th><input type="text" class="form-control" placeholder="Nombre Completo" disabled></th>
                  <th><input type="text" class="form-control" placeholder="Total" disabled></th>
        </tr>
    </thead>
<?php 
while($r=$products->fetch_object()):?>
<tr>
    <td><?php echo $r->N;?></td>
	<td><?php echo $r->nombre_completo;?></td>
	<td>$ <?php echo number_format($r->Monto_Total_Compras,2); ?></td>
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