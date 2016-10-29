<html>

<head>
  <title>Empleados Activos</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</body>
<?
if(!isset($orden)):
  ?>
   <div align="center"><u><h4>Empleados Activos</h4></u></div>
   <form action="" method="post">
      <table border="0" align="center">
       <tr><td><br></td></tr>
       <tr>
         <td ><b>Ordenado por:&nbsp;</b></td>
         <td><select name="orden" class="cajas" >
             <option value="0">Centro de Costo
             <option value="1">Documento
             <option value="2">Nombres
             <option value="3">Apellidos
             <option value="4">Fecha de Ingreso
             <option value="5">Salario
             </select></td>
        </tr>
         <tr><td><br></td></tr>
         <tr>
           <td colspan="2"><input type="submit" value="Ver Listado" class="boton"></td>
         </tr>
      </table>
   </form>
<?
else:
include("../conexion.php");
  $consu="select pnovedad.hasta,zona.zona from zona,pnovedad
      where pnovedad.codzona=zona.codzona and
            pnovedad.estado='FALTA' and
            zona.codzona= '$codigo'";
 $resu=mysql_query($consu);
 $regis=mysql_num_rows($resu);
 $fila_s=mysql_fetch_array($resu);
 $final=$fila_s["hasta"];
 if($regis==2):
     ?>
          <script language="javascript">
             alert("Error, Hay dos periodos abiertos en sistema para la elaboración de Novedades?")
             history.back()
          </script>
          <?
 else:
   ?>
   <table border="0" align="center">
      <tr  class="cajas">
             <td><?echo $fila_s["zona"];?></td>
      </tr>
     </table>
  <?
  endif;
  ?>
    <table border="0" align="center">
  <tr class="cajas">
    <td>Presiones Click Sobre el Documento para porcesar la Novedad..</td>
  </tr>
</table>
    <?
    if($orden==0):
	      $consulta="select concat(nomemple,' ',nomemple1) as nombres,concat(apemple,' ',apemple1) as apellidos,empleado.codcosto,empleado.cedemple,empleado.tiempo,detalladozona.pnomina,contrato.fechainic,contrato.salario,costo.centro,zona.zona,pnovedad.desde,pnovedad.hasta from detalladozona,empleado,zona,contrato,costo,pnovedad where
	      empleado.codzona=zona.codzona and
	      zona.codzona=pnovedad.codzona and
              zona.codzona=detalladozona.codzona and
	      pnovedad.estado='FALTA'and
	      empleado.codemple=contrato.codemple and
	      empleado.codcosto=costo.codcosto and
	      empleado.nomina='SI' and
	      contrato.fechater='0000-00-00'and
	      contrato.fechainic <= '$final' and
	      zona.codzona= '$codigo' order by costo.centro,empleado.nomemple,empleado.nomemple1";
      else:
          if($orden==1):
             $consulta="select concat(nomemple,' ',nomemple1) as nombres,concat(apemple,' ',apemple1) as apellidos,empleado.codcosto,empleado.cedemple,empleado.tiempo,contrato.fechainic,detalladozona.pnomina,contrato.salario,costo.centro,zona.zona,pnovedad.desde,pnovedad.hasta from detalladozona,empleado,zona,contrato,costo,pnovedad where
	      empleado.codzona=zona.codzona and
	      zona.codzona=pnovedad.codzona and
              zona.codzona=detalladozona.codzona and
	      pnovedad.estado='FALTA'and
	      empleado.codemple=contrato.codemple and
	      empleado.codcosto=costo.codcosto and
	      empleado.nomina='SI' and
	      contrato.fechater='0000-00-00'and
	      contrato.fechainic <= '$final' and
	      zona.codzona= '$codigo' order by empleado.cedemple,costo.centro";
           else:
              if($orden==2):
	         $consulta="select concat(nomemple,' ',nomemple1) as nombres,concat(apemple,' ',apemple1) as apellidos,empleado.codcosto,empleado.cedemple,empleado.tiempo,detalladozona.pnomina,contrato.fechainic,contrato.salario,costo.centro,zona.zona,pnovedad.desde,pnovedad.hasta from detalladozona,empleado,zona,contrato,costo,pnovedad where
		 empleado.codzona=zona.codzona and
	         zona.codzona=pnovedad.codzona and
                 zona.codzona=detalladozona.codzona and
	         pnovedad.estado='FALTA'and
		 empleado.codemple=contrato.codemple and
		 empleado.codcosto=costo.codcosto and
		 empleado.nomina='SI' and
		 contrato.fechater='0000-00-00'and
		 contrato.fechainic <= '$final' and
		 zona.codzona= '$codigo' order by empleado.nomemple,empleado.nomemple1,costo.centro";
              else:
                if($orden==3):
                   $consulta="select concat(nomemple,' ',nomemple1) as nombres,concat(apemple,' ',apemple1) as apellidos,empleado.codcosto,empleado.cedemple,empleado.tiempo,detalladozona.pnomina,contrato.fechainic,contrato.salario,costo.centro,zona.zona,pnovedad.desde,pnovedad.hasta from detalladozona,empleado,zona,contrato,costo,pnovedad where
		   empleado.codzona=zona.codzona and
	           zona.codzona=pnovedad.codzona and
                   zona.codzona=detalladozona.codzona and
	           pnovedad.estado='FALTA'and
		   empleado.codemple=contrato.codemple and
		   empleado.codcosto=costo.codcosto and
		   empleado.nomina='SI' and
		   contrato.fechater='0000-00-00'and
		   contrato.fechainic <= '$final' and
		   zona.codzona= '$codigo' order by empleado.apemple,empleado.apemple1,costo.centro";
                else:
                   if($orden==4):
                      $consulta="select concat(nomemple,' ',nomemple1) as nombres,concat(apemple,' ',apemple1) as apellidos,empleado.codcosto,empleado.cedemple,empleado.tiempo,detalladozona.pnomina,contrato.fechainic,contrato.salario,costo.centro,zona.zona,pnovedad.desde,pnovedad.hasta from detalladozona,empleado,zona,contrato,costo,pnovedad where
		      empleado.codzona=zona.codzona and
	              zona.codzona=pnovedad.codzona and
                      zona.codzona=detalladozona.codzona and
	              pnovedad.estado='FALTA'and
		      empleado.codemple=contrato.codemple and
		      empleado.codcosto=costo.codcosto and
		      empleado.nomina='SI' and
		      contrato.fechater='0000-00-00'and
		      contrato.fechainic <= '$final' and
		      zona.codzona= '$codigo' order by contrato.fechainic DESC";
                   else:
                      $consulta="select concat(nomemple,' ',nomemple1) as nombres,concat(apemple,' ',apemple1) as apellidos,empleado.codcosto,empleado.cedemple,empleado.tiempo,detalladozona.pnomina,contrato.fechainic,contrato.salario,costo.centro,zona.zona,pnovedad.desde,pnovedad.hasta from detalladozona,empleado,zona,contrato,costo,pnovedad where
		      empleado.codzona=zona.codzona and
		      zona.codzona=pnovedad.codzona and
                      zona.codzona=detalladozona.codzona and
		      pnovedad.estado='FALTA'and
		      empleado.codemple=contrato.codemple and
		      empleado.codcosto=costo.codcosto and
		      empleado.nomina='SI' and
		      contrato.fechater='0000-00-00'and
		      contrato.fechainic <= '$final' and
		      zona.codzona= '$codigo' order by contrato.salario DESC";
                   endif;
                endif;
              endif;
           endif;
      endif;
      $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
      $registro=mysql_num_rows($resultado);
      if ($registro==0):
          ?>

          <script language="javascript">
             alert("Dede de Crear en Periodo de corte para las Novedades ?")
             history.back()
          </script>
          <?
       else:
       ?>
              <tr><td><br></td></tr>
             <table border="1" align="center">
           <tr  class="fondo">
             <td colspan="9"></td>
           </tr>
           <tr  class="cajas">
              <th>Item</b></th>
              <th>Ducumento</th>
             <th>Nombres</th>
              <th>Apellidos</th>
              <th>Costo</th>
              <th>Fecha Ing</th>
              <th>Salario</th>
           </tr>
        <?
        $suma=1;
           while($filas=mysql_fetch_array($resultado)):
            $aux=number_format($filas["salario"],0);
            $Cedula=$filas["cedemple"];
            $Desde = $filas["desde"];
            $Hasta = $filas["hasta"];
              /*CODIGO QUE PERMITE MOSTRAR SOLO PERSONAL CON NOMINA*/
              $conN="select novedadnomina.codnovedad from novedadnomina,denovedanomina
                  where novedadnomina.codnovedad=denovedanomina.codnovedad and
                        novedadnomina.cedemple='$Cedula' and
                        novedadnomina.desde='$Desde' and
                        novedadnomina.hasta='$Hasta'";
             $resN=mysql_query($conN)or die ("Error al buscar las novedades");
              $regN=mysql_num_rows($resN);
             if ($regN==0){
	             ?>
                   <tr  class="cajas">
	                <th><?echo $suma;?></th>
	                 <td><a href="CargarNovedad.php?cedula=<? echo $filas["cedemple"];?>&Modalidad=<? echo $filas["tiempo"];?>&codigo=<? echo $codigo;?>&Periodo=<?echo $filas["pnomina"];?>&orden=<?echo $orden;?>&fechainic=<? echo $filas["fechainic"];?>&zona=<?echo $filas["zona"];?>&nombres=<?echo $filas["nombres"];?>&apellidos=<?echo $filas["apellidos"];?>&desde=<? echo $filas["desde"];?>&hasta=<? echo $filas["hasta"];?>"><? echo $filas["cedemple"];?></a></td>
	                  <td class="cajas"><?echo $filas["nombres"];?></td>
	                 <td class="cajas"><?echo $filas["apellidos"];?></td>
	                 <td class="cajas"><?echo $filas["centro"];?></td>
	                 <td><?echo $filas["fechainic"];?></td>
	                 <td><div align="right"><?echo $aux;?></div></td>
	           </tr>
	            <?
	             $suma=$suma+1;
             }
           endwhile;
           ?>
           </table>
           <tr><td><br></td></tr>

           <?
       endif;
 endif;
 ?>
 </body>
</html>
