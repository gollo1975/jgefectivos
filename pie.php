<html>
  <head>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">    
  </head>
  <body>
  <tr class="cajas">
    <?
    $tiempo = getdate();
    echo $tiempo['hours'] . ":" . $tiempo['minutes'] . ":     " . $msg;
    ?>
    </tr>
  </body>
</html>
