<html>

<head>
<title>Créditos por Zona</title>
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
if (empty($desde)):
include("../conexion.php");
?>
<center><h4>Creditos por Zona</h4></center>
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
         <td><b>Zona:</b></td>
                              <td><select name="campo" class="cajas">
                              <option value="0">Seleccione la Zona
                                <?
                                 $consulta_z="select zona.codzona,zona.zona  from zona where zona.nomina='SI' order by zona.zona";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codzona"];?>"> <?echo $filas_z["zona"];?>
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
     alert("Debe de seleccionar una zona")
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
     $variable="select zona.zona from zona where
                zona.codzona='$campo'";
         $resultado=mysql_query($variable)or die("consulta incorrecta uno");
        $registro=mysql_num_rows($resultado);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("La Zona no existe en la bd.")
            history.back()
          </script>
         <?
         else:
         ?>
                 <table border="0" align="center">
                 <?
             while($filas=mysql_fetch_array($resultado)):
             ?>
               <tr class="cajas">
                 <td><?echo $filas["zona"];?></td>
               </tr>
                <?
              endwhile;
           ?>
           </table>
           <?
            endif;
             include("../conexion.php");
            $variable1="SELECT empleado.cedemple, empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1, credito.nrocredito, credito.codsala,salario.desala, credito.fesalida, credito.vlrsolicitado, credito.nuevo, credito.cuota, credito.vlrinteres
                        FROM empleado, credito, salario, zona
                        WHERE zona.codzona = empleado.codzona
                        AND empleado.cedemple = credito.cedemple
                        AND credito.codsala= salario.codsala
                        and credito.nuevo > 0
                        AND credito.fesalida
                        BETWEEN '$desde'
                        AND '$hasta'
                        AND zona.codzona = '$campo'
                        ORDER BY empleado.nomemple,empleado.apemple";
           $resultado1=mysql_query($variable1)or die("consulta incorrecta dos");
           $registro=mysql_num_rows($resultado1);
           if ($registro==0):
           ?>
           <script language="javascript">
             alert("No existen Crédito a nivel de Zona.")
             history.back()
          </script>
         <?
         else:
         ?>
         <tr><td><br></td></td>
         <td><center><h4><u>Listado de Creditos</u></h4></center></td>
          <table align="center">
                <tr>
                  <td class="cajas">Para Imprimir el crédito, presione Click sobre el Nro de Crédito, Para ver el Listado de Crédito por empleado, Presione Click sobre el Documento </td>
                </tr>
          </table>
           <table align="center">
                <tr>
                  <td class="cajas">Para Ver la cartera por Orden de Prestamo, presione Click sobre La descripción del Crédito </td>
                </tr>
          </table>
              <tr><td><br></td></td>  
          <table border="1" align="center">
           <tr>
             <td colspan="30" class="fondo"></td>
           </tr>
           <tr class="cajas">
              <th class="fondo">Cedula</th>
              <th class="fondo">Empleado</th>
              <th class="fondo">Nro_Credito</th>
              <th class="fondo">Descripción</th>
              <th class="fondo">F_Salida</th>
              <th class="fondo">Vlr_Solicitado</th>
              <th class="fondo">Saldo</th>
              <th class="fondo">Cuota</th>
              <th class="fondo">Aporte</th>
           </tr>
              <?
             while($filas_s=mysql_fetch_array($resultado1)):
             $xbusca=number_format($filas_s["vlrsolicitado"],2);
             $xbusca1=number_format($filas_s["nuevo"],2);
             $xbusca2=number_format($filas_s["cuota"],2);
             $xbusca3=number_format($filas_s["vlrinteres"],2);
             ?>
               <tr class="cajas">
                 <td>&nbsp;<a href="detalladocredito.php?cedemple=<?echo $filas_s["cedemple"];?>"><?echo $filas_s["cedemple"];?></a></td>
                 <td><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?>&nbsp;<?echo $filas_s["apemple"];?>&nbsp;<?echo $filas_s["apemple1"];?></td>
                <td>&nbsp;<a href="imprimir.php?nrocredito=<?echo $filas_s["nrocredito"];?>"><?echo $filas_s["nrocredito"];?></a></td>
                 <td><a href="detalladocodigo.php?codcredito=<?echo $filas_s["codsala"];?>&codzona=<? echo $campo;?>&concepto=<?echo $filas_s["desala"];?>"><?echo $filas_s["desala"];?></a></td>
                 <td><?echo $filas_s["fesalida"];?></td>
                 <td><?echo $xbusca;?></td>
                 <td><?echo $xbusca1;?>&nbsp;</td>
                <td><?echo $xbusca2;?>&nbsp;</td>
                 <td><?echo $xbusca3;?></td>
                  </tr>
                <?
                  $suma=$suma+$filas_s["nuevo"];
                  $suma1=$suma1+$filas_s["vlrsolicitado"];
                   $con=$con+1;
                  endwhile;
                  $xbusca4=number_format($suma,2);
                  $xbusca5=number_format($suma1,2);
              ?>
              </table>
              <tr><td><br></td></tr>
            <tr class="cajas">
              <center><td><b>Nro_Reg.:</b>&nbsp;&nbsp;<?echo $con?></td><td><b>&nbsp;&nbsp;Vlr_Solicitado:</b>&nbsp;&nbsp;<?echo $xbusca5;?></td><td><b>&nbsp;&nbsp;Cartera:</b>&nbsp;&nbsp;<?echo $xbusca4;?></td></center>
            </tr>

               <?
           endif;
         endif;
         ?>

        </table>

       </body>
  </html>
