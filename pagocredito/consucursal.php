<html>

<head>
<title>Créditos por sucursal</title>
 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
 <script language="javascript">
        function imprimir(numero)// para declara funcion
        {
                pagina='imprimir.php?nrocredito=' + numero
                tiempo=100
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }

</script>
<?
if (!isset($campo)):
include("../conexion.php");
?>
<center><h4>Creditos por Sucursal</h4></center>
  <form  action="" method="post">
    <table border="0" align="center">
      <tr>
        <td colspan="2" class="fondo"></td>
      </tr>
       <tr><td><br></td></tr>
       <tr>
        <td><b>Fecha_Inicio:</b></td>
         <td><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="10" maxlength="10"></td>
       </tr>
       <tr>
        <td><b>Fecha Final:</b></td>
         <td><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10" maxlength="10"></td>
       </tr>
       <tr>
         <td><b>Sucursal:</b></td>
                              <td><select name="campo" class="cajas">
                              <option value="0">Seleccione la sucursal
                                <?
                                 $consulta_z="select sucursal.codsucursal,sucursal.sucursal  from sucursal order by sucursal.sucursal";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codsucursal"];?>"> <?echo $filas_z["sucursal"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
       </tr>
       <tr><td><br></td></tr>
       <tr>
         <td colspan="2">
           <input type="submit" value="Buscar" class="boton">
           <input type="reset" value="Limpiar"class="boton"> </td>
       </tr>
               <tr><td><br></td></tr>
    </table>
    <br>

  </form>
  <?
elseif (empty($campo)):
   ?>
   <script language="javascript">
     alert("Debe de seleccionarla sucursal")
     history.back()
   </script>
    <?
elseif (empty($desde)):
   ?>
   <script language="javascript">
     alert("Debe colocar la fecha inicio")
     history.back()
   </script>
   <?
   else:
     include("../conexion.php");
     $variable="select sucursal.sucursal from sucursal where
                sucursal.codsucursal='$campo'";
         $resultado=mysql_query($variable)or die("consulta incorrecta uno");
           ?>
           <table border="0" align="center">
                 <?
             while($filas=mysql_fetch_array($resultado)):
             ?>
               <tr class="cajas">
                 <td><?echo $filas["sucursal"];?></td>
               </tr>
                <?
              endwhile;
           ?>
           </table>
           <?
            $variable1="SELECT empleado.cedemple, empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1, credito.nrocredito, salario.desala, credito.fesalida, credito.vlrsolicitado, credito.nuevo, credito.cuota, credito.vlrinteres,zona.codzona,zona.zona
                        FROM empleado, credito, salario, zona,sucursal,contrato
                        WHERE  sucursal.codsucursal=zona.codsucursal
                        and zona.codzona = empleado.codzona
                        AND empleado.cedemple = credito.cedemple
                        and contrato.codemple=empleado.codemple
                        AND credito.codsala = salario.codsala
                        and credito.nuevo > 0
                        AND credito.fesalida
                        BETWEEN '$desde'
                        AND '$hasta'
                        AND sucursal.codsucursal = '$campo' AND
                        contrato.fechater='0000-00-00' ORDER BY zona.zona";
           $resultado1=mysql_query($variable1)or die("consulta incorrecta $variable1");
           $registros=mysql_num_rows($resultado1);
            if ($registros==0):

               ?>
               <script language="javascript">
                 alert("No existen Crédito en la Sucursal.")
                 history.back()
              </script>
             <?
           else:
              $bloque=40;
                   if (!$pagina):
                     $pagina=1;
                     $inicio=0;
                   else:
                      $inicio=($pagina-1)*$bloque;
                   endif;
                   $variable1="SELECT empleado.cedemple, empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1, credito.nrocredito, salario.desala, credito.fesalida, credito.vlrsolicitado, credito.nuevo, credito.cuota, credito.vlrinteres,zona.codzona,zona.zona
                        FROM empleado, credito, salario, zona,sucursal
                        WHERE  sucursal.codsucursal=zona.codsucursal
                        and zona.codzona = empleado.codzona
                        AND empleado.cedemple = credito.cedemple
                        AND credito.codsala = salario.codsala
                        and credito.nuevo > 0
                        AND credito.fesalida
                        BETWEEN '$desde'
                        AND '$hasta'
                        AND sucursal.codsucursal = '$campo'order by zona.zona limit $inicio,$bloque";
                  $resultado1=mysql_query($variable1)or die("consulta incorrecta dos");
                  $nropaginas=ceil($registros/$bloque);

         ?>

         <td><center><h4><u>Listado de Creditos</u></h4></center></td>
          <table align="center">
                <tr>
                  <td class="cajas">Para Imprimir el crédito, presione Click sobre el Nro de Crédito, Para ver el Listado de Crédito por Zona, Presione Click sobre el [COD_ZONA] </td>
                </tr>
          </table>

          <table border="1" align="center">
           <tr class="cajas">
              <th class="fondo">Cedula</th>
              <th class="fondo">Empleado</th>
              <th class="fondo">Nro_Credito</th>
              <th class="fondo">Descripción</th>
              <th class="fondo">F_Salida</th>
              <th class="fondo">Vlr_Soli.</th>
              <th class="fondo">Saldo</th>
              <th class="fondo">Cuota</th>
              <th class="fondo">Cod_Zona</th>
              <th class="fondo">Zona</th>
           </tr>
              <?
             while($filas_s=mysql_fetch_array($resultado1)):
             ?>
               <tr class="cajas">
                 <td>&nbsp;<?echo $filas_s["cedemple"];?></a></td>
                 <td><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?>&nbsp;<?echo $filas_s["apemple"];?>&nbsp;<?echo $filas_s["apemple1"];?></td>
                <td>&nbsp;<a href="imprimir.php?nrocredito=<?echo $filas_s["nrocredito"];?>"><?echo $filas_s["nrocredito"];?></a></td>
                 <td><?echo $filas_s["desala"];?></td>
                 <td><?echo $filas_s["fesalida"];?></td>
                 <td><?echo $filas_s["vlrsolicitado"];?></td>
                 <td><?echo $filas_s["nuevo"];?></td>
                <td><?echo $filas_s["cuota"];   ?></td>
                <td><a href="detalladozona.php?codzona=<?echo $filas_s["codzona"];?>"><?echo $filas_s["codzona"];?></td>
                 <td><?echo $filas_s["zona"];?></td>
                  </tr>
                <?
                  $suma=$suma+$filas_s["nuevo"];
                   $suma1=$suma1+$filas_s["vlrinteres"];
                   $con=$con+1;
              endwhile;
              ?>
              </table>
              <tr><td><br></td></tr>
            <tr>
              <center><td><b>Total Interes:</b>&nbsp;&nbsp;<?echo $suma1?>&nbsp;&nbsp;<td><b>Total Deuda:</b>&nbsp;&nbsp;<?echo $suma?></td></center>
            </tr>
            <table align="center">
                            <tr>
                             <?
                             if ($pagina==$nropaginas):
                               ?>
                                   <tr class="cajas">
                                 <center><b>Nro_Empleados:</b>&nbsp;<?echo $registros;?></center></tr>
                              <?
                             else:
                             ?>
                               <tr class="cajas">
                                 <center><b>Nro_Empleados:</b>&nbsp;<?echo $bloque*$pagina;?></center></tr>
                              <?
                             endif;
                              for ($i=1;$i<=$nropaginas;$i++)
                              {
                              ?>
                              <td class="cajas"><a href="consucursal.php?pagina=<?echo $i;?>&desde=<? echo $desde;?>&hasta=<? echo $hasta;?>&campo=<? echo $campo;?>">
                             <?echo "$i";?></a></td>
                              <?
                              }
                              ?>
            </table>
              <?
           endif;
   endif;
         ?>

       </body>
  </html>
