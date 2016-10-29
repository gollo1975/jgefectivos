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
        function volver()// para declara funcion
        {
                pagina='individual.php'
                tiempo=70
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }
</script>
</head>
<body>
<?php
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
      $consulta="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,mercado.*,salario.desala from empleado,mercado,salario
              where empleado.cedemple=mercado.cedemple and
                    mercado.codsala=salario.codsala and
                   empleado.cedemple='$valor'";
       $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
       $registro=mysql_num_rows($resultado);
       if ($registro==0):
          ?>
          <script language="javascript">
           alert("NO existen registro en la consulta ?")
           history.back()
          </script>
        <?
       else:
          ?>
           <center><h4><u>Listado de Mercados</u></h4></center>
           <table border="0" align="center">
              <tr align="center">
              <th>Nro</th>
                  <th class="cajas">Nro_Auto.</th>
                  <th class="cajas">Nro_Auto.</th>
                  <th class="cajas">F_Proceso</th>
                  <th class="cajas">Cupo</th>
                  <th class="cajas">Estado</th>
                  <th class="cajas">Autorizado</th>
                  <th class="cajas">Saldo</th>
                  <th class="cajas">Cartera</th>
                  <th class="cajas">Alianza</th>
                 </tr>

                  <?$t=1;
                  while($filas=mysql_fetch_array($resultado)):
                   $aux1=number_format($filas["cupo"],0);
                   $aux2=number_format($filas["nsaldo"],0);
                    ?>
                    <tr  class="cajas">
                       <th><?echo $t;?></th>
                       <td> <a href="detalladoabono.php?nroAuto=<?echo $filas["codmerca"];?>"><?echo $filas["codmerca"];?></a></td>
                        <td> <a href="imprimir.php?codmerca=<?echo $filas["codmerca"];?>"><?echo $filas["codmerca"];?></a></td>
                         <td><?echo $filas["fecha"];?></td>
                         <td>&nbsp;<?echo $aux1;?>&nbsp;</td>
                         <td><?echo $filas["estado"];?></td>
                         <td><?echo $filas["autoriza"];?></td>
                         <td>&nbsp;<?echo $aux2;?>&nbsp;</td>
                         <td><?echo $filas["historia"];?></td>
                          <td><?echo $filas["desala"];?></td>

                   </tr>
                     <? $t=$t+1;
                 endwhile;
                ?>
                </table>
               <th><center><a href="impindividual.php?valor=<?echo $valor;?>" target="_blank" onclick="volver()">Imprimir</a></center></th>
                <?
       endif;
  endif;

     ?>


</body>
</html>
