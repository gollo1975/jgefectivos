<html>
<head>
  <title>Periodo de Nomina</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
if(!isset($desde)):

  ?>
  <center><h4><u>Periodo de Nomina</u></h4></center>
  <form action="" method="post">
    <table border="0" align="center">
     <tr><td><br></td></tr>
      <tr>
        <td><b>Desde:</b></td>
       <td><input type="text" name="desde" value="<?echo date("Y-m-d");?>" size="15" maxlength="10" class="cajas"></td>
        </tr>
           <td><b>Hasta:</b></td>
       <td><input type="text" name="hasta" value="<?echo date("Y-m-d");?>" size="15" maxlength="10" class="cajas"></td>
        </tr>
        <tr><td><br></td></tr>
        <td colspan="5">
         <input type="submit" value="Buscar" class="boton">
        </td>
    </table>
  </form>
  <?
elseif(empty($desde)):
?>
  <script language="javascript">
    alert("Digite la fecha de inicio ?")
    history.back()
  </script>
<?
else:
   include("../conexion.php");
   $consulta="select periodo.*,zona.zona from periodo,zona
   where periodo.codzona=zona.codzona and
   periodo.desde='$desde' and
   periodo.hasta='$hasta' and
   periodo.pagado='SI' order by zona.zona";
   $resultado=mysql_query($consulta)or die("Consulta incorrecta");
   $registro=mysql_num_rows($resultado);
   if($registro!=0):
      ?>
      <center><h4><u>Periodos de Nomina</u></h4></center>
        <table border="0" align="center">
          <tr>
            <th>Reg.</th>
            <th>Cod_Periodo</th>
            <th>Zona</th>
            <th>Desde</th>
            <th>Hasta</th>
            <th>Cerrado</th>
          </tr>
      <?
          $a=1;
          while($filas=mysql_fetch_array($resultado)):
            ?>
             <tr class="cajas">
             <th><? echo $a;?></th>
               <td><a href="DatosPeriodo.php?NroP=<? echo $filas["codigo"];?>&desde=<?echo $desde;?>&hasta=<?echo $hasta;?>&Estado=<?echo $filas["pagado"];?>"><? echo $filas["codigo"];?></a></td>
               <td><? echo $filas["zona"];?></td>
               <td><? echo $filas["desde"];?></td>
               <td><? echo $filas["hasta"];?></td>
               <td><div align="center"><? echo $filas["pagado"];?></div></td>
             </tr>
            <?
            $a=$a+1;
          endwhile;
          ?>
          </table>
          <?
      else:
        ?>
          <script language="javascript">
            alert("No hay periodos de nomina en este rango de fechas. ?")
             history.back()
          </script>
         <?
      endif;
endif;
?>
</body>
<html>



