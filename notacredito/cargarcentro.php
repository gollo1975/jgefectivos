<html>

<head>
<title>Notas Creditos por Zona</title>
 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
if (!isset($desde)):
include("../conexion.php");
?>
<center><h4><u>Deducciones</u></h4></center>
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
         <td><b>Codigo:</b></td>
                              <td><select name="codigo" class="cajas">
                              <option value="0">Seleccione el item de nomina
                                <?
                                 $consulta_z="select codsala,desala  from salario where prestacion='NO'order by desala";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codsala"];?>"> <?echo $filas_z["desala"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
       </tr>
       <tr>
         <td><b>Empresa Usuaria:</b></td>
                              <td><select name="codzona" class="cajas">
                              <option value="0">Seleccione la Zona
                                <?
                                 $consulta_z="select codzona,zona  from zona where zona.estado='ACTIVA'order by zona";
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
    </table>
    <br>
    </form>
  <?
elseif (empty($desde)):
   ?>
   <script language="javascript">
     alert("Debe colocar la fecha inicio")
     history.back()
   </script>
    <?
elseif (empty($codigo)):
   ?>
   <script language="javascript">
     alert("Seleccion un concepto de nomina")
     history.back()
   </script>
   <?
elseif (empty($codzona)):
   ?>
   <script language="javascript">
     alert("Seleccion la zona de la lista")
     history.back()
   </script>
   <?
   else:
     include("../conexion.php");
     $variable="select zona.zona from zona where
                zona.codzona='$codzona'";
         $resultado=mysql_query($variable)or die("consulta incorrecta uno");
        $registro=mysql_num_rows($resultado);
       $filas=mysql_fetch_array($resultado);
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
               <tr class="cajas">
                 <td><?echo $filas["zona"];?></td>
               </tr>
           </table>
           <?
            endif;
             include("../conexion.php");
            $variable1="select denomina.deduccion,denomina.salario,nomina.cedemple,concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' ,apemple1)as empleado,denomina.nrohora from zona,periodo,nomina,denomina,empleado,salario
             where  zona.codzona=periodo.codzona and
                    periodo.codigo=nomina.codigo and
                   periodo.desde between '$desde' and '$hasta' and
                   nomina.desde between '$desde' and '$hasta' and
                   nomina.consecutivo=denomina.consecutivo and
                   nomina.cedemple=empleado.cedemple and
                   denomina.codsala=salario.codsala and
                   salario.codsala='$codigo' and
                   zona.codzona='$codzona' order by empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1  ";
           $resultado1=mysql_query($variable1)or die("consulta incorrecta dos");
           $registro=mysql_num_rows($resultado1);
           if ($registro==0):
           ?>
           <script language="javascript">
             alert("No existen deducciones para este concepto")
             history.back()
          </script>
         <?
         else:
         ?>
         <tr><td><br></td></td>
          <table border="0" align="center">
           <tr>
             <td colspan="30" class="fondo"></td>
           </tr>
           <tr class="cajas">
           <th>Item</th>
              <th>Documento</th>
              <th>Empleado</th>
              <th>Deduccion</th>
			  <th>Nros Horas</th>
              </tr>
              <? $a=1;
              $con=0;
             while($filas_s=mysql_fetch_array($resultado1)):
               $deduccion=number_format($filas_s["deduccion"],0);
             ?>
              <tr class="cajas">
               <th><?echo $a;?></th>
                <td><?echo $filas_s["cedemple"];?>
                <td><?echo $filas_s["empleado"];?></td>
                <td><div align="right">$<?echo $deduccion;?></div></td>
				<td><div align="right"><?echo $filas_s["nrohora"];?></div></td>
              </tr>
                <?
                  $a=$a+1;
                  $con=$con+$filas_s["deduccion"];
              endwhile;
              $con=number_format($con,0);
              ?>
              </table>
              <tr><td><br></td></tr>
            <tr>
              <center><td><b>Total:</b>&nbsp;&nbsp;$<?echo $con?></td></center>
            </tr>

               <?
           endif;
         endif;
         ?>

        </table>

       </body>
  </html>
