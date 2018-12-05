<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php 
foreach($css_files as $file): ?>
    <link type="text/css" rel="stylesheet" href="<?php echo $file; ?>" />
<?php endforeach; ?>
<?php foreach($js_files as $file): ?>
    <script src="<?php echo $file; ?>"></script>
<?php endforeach; ?>
</head>
<body>
    <div>
        <?php echo $output; ?>
        <center>
       <a href="http://loestasviendo.com" class="btn btn-danger"  style="width: 85%;height: 45px; font-size: 25px;margin-bottom: 1px">Cerrar</a>
        </center>
    </div>
</body>
</html>