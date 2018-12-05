

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

$products = $con->query("select @rownum:=@rownum+1 AS N,t4.Nombre_fecha,t4.Anio,t4.Mes_Monto_Compra as Compra_Total_Mes 
from (SELECT @rownum:=0) r,
(
select sum(t2.total_factura) as Mes_Monto_Compra,t2.fecha_beh,t2.Mes,t2.Anio,
CASE WHEN MONTH(t2.fecha_beh) = 1 THEN 'Enero'
WHEN MONTH(t2.fecha_beh) = 2 THEN 'Febrero'
WHEN MONTH(t2.fecha_beh) = 3 THEN 'Marzo'
WHEN MONTH(t2.fecha_beh) = 4 THEN 'Abril'
WHEN MONTH(t2.fecha_beh) = 5 THEN 'Mayo'
WHEN MONTH(t2.fecha_beh) = 6 THEN 'Junio'
WHEN MONTH(t2.fecha_beh) = 7 THEN 'Julio'
WHEN MONTH(t2.fecha_beh) = 8 THEN 'Agosto'
WHEN MONTH(t2.fecha_beh) = 9 THEN 'Septiembre'
WHEN MONTH(t2.fecha_beh) = 10 THEN 'Octubre'
WHEN MONTH(t2.fecha_beh) = 11 THEN 'Noviembre'
WHEN MONTH(t2.fecha_beh) = 12 THEN 'Diciembre'
ELSE 'esto no es un mes'
END as Nombre_fecha
from
(
select f.folio_beh,f.fecha_beh,if(isnull(t1.total_factura),0,t1.total_factura) as total_factura,
month(f.fecha_beh) as Mes, year(f.fecha_beh) as Anio
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
order by f.fecha_beh
) as t2
group by t2.Mes,t2.Anio
) as t4
where 
t4.t4.Mes_Monto_Compra=
(
select max(Mes_Monto_Compra) as Mejor_Mes
from
(
select sum(t2.total_factura) as Mes_Monto_Compra,t2.fecha_beh,t2.Mes,t2.Anio
from
(
select f.folio_beh,f.fecha_beh,if(isnull(t1.total_factura),0,t1.total_factura) as total_factura,
month(f.fecha_beh) as Mes, year(f.fecha_beh) as Anio
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
order by f.fecha_beh
) as t2
group by t2.Mes,t2.Anio
) as t3
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
                  <th><input type="text" class="form-control" placeholder="Año" disabled></th>
                  <th><input type="text" class="form-control" placeholder="Mes" disabled></th>
                  <th><input type="text" class="form-control" placeholder="Total de Ventas" disabled></th>
        </tr>
    </thead>
<?php 
while($r=$products->fetch_object()):?>
<tr>
    <td><?php echo $r->N;?></td>
    <td><?php echo $r->Anio;?></td>
	<td><?php echo $r->Nombre_fecha;?></td>
	<td>$ <?php echo number_format($r->Compra_Total_Mes,2); ?></td>
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