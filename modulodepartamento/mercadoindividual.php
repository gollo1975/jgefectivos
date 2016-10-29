<html>
<head>
<title>Consulta de Mercados</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">

<script language="javascript">
        function ColorFoco(obj)
             {
              document.getElementById(obj).style.background="#9DFF9D"
             }
        function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }

</script>
</head>
<body>
<?
if (!isset($valor)):
?>
<center><h4>Consulta de Mercados</h4></center>
  <form action="" method="post">
    
    <table border="0" align="center">
       <tr>
   <td colspan="2" class="fondo"></td>
      </tr>
      <tr><td><br></td></tr>
       <tr>
           <td><b>Digite el Documento:</b></td>
           <td><input type="text" name="valor" value="" size="15" maxlength="15" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="valor"></td>
        </tr>
        <tr><td><br></td></tr>
        <tr>
         <td colspan="2"><input type="submit" value="Buscar" class="boton">&nbsp;<input type="reset" value="Limpiar"  class="boton"></td>
        </tr>
        <tr><td><br></td></tr>
    </table>
 </form>
  <?
  elseif(empty($valor)):
   ?>
     <script language="javascript">
       alert("Digite el documento del empleado")
       history.back()
     </script>
   <?
    else:
      include("../conexion.php");
      $consulta="select empleado.nomemple,empleado.apemple,mercado.* from empleado,mercado,zona,sucursal
              where sucursal.codsucursal=zona.codsucursal and
                    zona.codzona=empleado.codzona and
                    empleado.cedemple=mercado.cedemple and
                    sucursal.codsucursal='$codigo' and
                   empleado.cedemple='$valor'";
       $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
       $registro=mysql_num_rows($resultado);
       if ($registro==0):
          ?>
          <script language="javascript">
           alert("No esta Autorizado para ver La cartera de Este Empleado ?")
           history.back()
          </script>
        <?
       else:
          ?>
           <center><h4>Mercados Autorizados a Empleados</h4></center>
           <table border="0" align="center">
              <tr align="center">
                  <th class="cajas">Nro_Autorización</th>
                  <th class="cajas">Fecha_Proceso</th>
                  <th class="cajas">Cupo</th>
                  <th class="cajas">Estado</th>
                  <th class="cajas">Autorizado</th>
                  <th class="cajas">Saldo</th>
                  <th class="cajas">Cartera</th>
                 </tr>

                  <?
                  while($filas=mysql_fetch_array($resultado)):
                  $aux1=number_format($filas["cupo"],0);
                  $aux2=number_format($filas["nsaldo"],0);
                    ?>
                    <tr  class="cajas">
                        <td> <a href="../mercado/imprimir.php?codmerca=<?echo $filas["codmerca"];?>"><?echo $filas["codmerca"];?></a></td>
                         <td><?echo $filas["fecha"];?></td>
                         <td><?echo $aux1;?>&nbsp;</td>
                         <td><?echo $filas["estado"];?></td>
                         <td><?echo $filas["autoriza"];?></td>
                         <td>&nbsp;<?echo $aux2;?>&nbsp;</td>
                         <td><?echo $filas["historia"];?></td>

                   </tr>
                     <?
                 endwhile;
                ?>
                </table>
               <th><center><a href="impindividual.php?valor=<?echo $valor;?>&codigo=<? echo $codigo;?>">Imprimir</a></center></th>
                <?
       endif;
  endif;

     ?>


</body>
</html>
