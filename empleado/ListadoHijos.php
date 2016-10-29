<html>

<head>
  <title>Detalle de Hijos</title>
   <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>

<body>
<?
if (!isset($estado)):
   ?>
   <div align="center"><h4><u>Detalle de Hijos</u></h4></div>
   <form action="" method="post">
      <table border="0" align="center" width="200">
        <tr><td><br></td></tr>
        <td><div align="center"><u><b>Seleccion una opción</b></u></div></td>
        <tr><td><br></td></tr>
         <tr>
           <td><input type="radio" value="general" name="estado">&nbsp;&nbsp;&nbsp;General (Hijos-Hijastro)</td>
         </tr>
         <tr>
           <td><input type="radio" value="sucursal" name="estado">&nbsp;&nbsp;&nbsp;Sucursal (Hijos-Hijastro)</td>
         </tr>
         <tr>
           <td><input type="radio" value="zona" name="estado">&nbsp;&nbsp;&nbsp;Zona (Hijos-Hijastro)</td>
         </tr>
         <tr>
           <td><input type="radio" value="empleado" name="estado">&nbsp;&nbsp;&nbsp;Empleado</td>
         </tr>
        <tr><td><br></td></tr>
        <tr>
              <td colspan="5">
              <input type="submit" value="Aceptar" class="boton" ></td>
            </tr>
      </table>
   </form>
   <?
elseif(empty($estado)):
    ?>
    <script language="javascript">
      alert("Debe de seleccionar una opción para la Consulta ?")
      history.back()
    </script>
   <?
else:
   if($estado=='general'):
        include("../conexion.php");
           ?>
           <div align="center"><h4><u>Detalle de Hijos</u></h4></div>
           <form action="GeneralHijos.php" method="post">
             <input type="hidden" name="Estado" value="<?echo $Empresa;?>">
                           <table border="0" align="center" width="200">
                 <tr><td><br></td></tr>
                 <tr>
                 <td><b>Empresa:</b></td>
                   <td><select name="Empresa" class="cajasletra">
                         <option value="0">Seleccione la Empresa
                        <?
                        $consulta_b="select codmaestro,nomaestro from maestro ";
                       $resultado_b=mysql_query($consulta_b) or die("Error Al buscar empresa");
                       while ($filas_b=mysql_fetch_array($resultado_b)):
                           ?>
                          <option value="<?echo $filas_b["codmaestro"];?>"><?echo $filas_b["nomaestro"];?>
                          <?
                       endwhile;
                         ?>
                        </select></td>
                   </tr>
                 <tr><td><br></td></tr>
              <tr>
                 <td colspan="5">
                 <input type="submit" value="Aceptar" class="boton" ></td>
               </tr>
              </table>
              <td class="cajas"><div align="center"><a href="ListadoHijos.php"><b><font color="red"><u>Volver</u></font></b></a></div></td>
           </form>
      <?
   else:
       if($estado=='sucursal'):
          include("../conexion.php");
           ?>
           <div align="center"><h4><u>Detalle de Hijos</u></h4></div>
           <form action="SucursalHijos.php" method="post">
             <input type="hidden" name="Sucursal" value="<?echo $Sucursal;?>">
                           <table border="0" align="center" width="200">
                 <tr><td><br></td></tr>
                 <tr>
                 <td><b>Sucursal:</b></td>
                   <td><select name="Sucursal" class="cajasletra">
                         <option value="0">Seleccione la sucursal
                        <?
                        $consulta_b="select codsucursal,sucursal from sucursal ";
                       $resultado_b=mysql_query($consulta_b) or die("Error Al buscar sucursal");
                       while ($filas_b=mysql_fetch_array($resultado_b)):
                           ?>
                          <option value="<?echo $filas_b["codsucursal"];?>"><?echo $filas_b["sucursal"];?>
                          <?
                       endwhile;
                         ?>
                        </select></td>
                   </tr>
                 <tr><td><br></td></tr>
              <tr>
                 <td colspan="5">
                 <input type="submit" value="Aceptar" class="boton" ></td>
               </tr>
              </table>
             <td class="cajas"><div align="center"><a href="ListadoHijos.php"><b><font color="red"><u>Volver</u></font></b></a></div></td>
           </form>
        <?
        else:
           if($estado=='zona'):
              include("../conexion.php");
              ?>
              <div align="center"><h4><u>Detalle de Hijos</u></h4></div>
              <form action="ZonaHijos.php" method="post">
                 <input type="hidden" name="Zona" value="<?echo $Zona;?>">
                           <table border="0" align="center" width="200">
                 <tr><td><br></td></tr>
                 <tr>
                 <td><b>Zona:</b></td>
                   <td><select name="Zona" class="cajasletra">
                         <option value="0">Seleccione la Zona
                        <?
                        $consulta_b="select codzona,zona from zona where zona.estado='ACTIVA' and nomina='SI' order by zona.zona";
                       $resultado_b=mysql_query($consulta_b) or die("Error Al buscar zonas");
                       while ($filas_b=mysql_fetch_array($resultado_b)):
                           ?>
                          <option value="<?echo $filas_b["codzona"];?>"><?echo $filas_b["zona"];?>
                          <?
                       endwhile;
                         ?>
                        </select></td>
                   </tr>
                 <tr><td><br></td></tr>
                 <tr>
                 <td colspan="5">
                 <input type="submit" value="Aceptar" class="boton" ></td>
                 </tr>
                </table>
                 <td class="cajas"><div align="center"><a href="ListadoHijos.php"><b><font color="red"><u>Volver</u></font></b></a></div></td>
              </form>
            <?
           else:
               ?>
               <div align="center"><h4><u>Detalle de Hijos</u></h4></div>
              <form action="EmpleadoHijos.php" method="post">
               <table border="0" align="center" width="200">
                 <tr><td><br></td></tr>
                 <tr>
                 <td><b>Documento:</b></td>
                   <td><input type="text" name="Documento" value="" class="cajas" size="15" maxlength="15"></td>
                   </tr>
                 <tr><td><br></td></tr>
                 <tr>
                 <td colspan="5">
                 <input type="submit" value="Aceptar" class="boton" ></td>
                 </tr>
                </table>
                 <td class="cajas"><div align="center"><a href="ListadoHijos.php"><b><font color="red"><u>Volver</u></font></b></a></div></td>    
              </form>
              <?
           endif;
        endif;;
   endif;
endif;
?>
</body>
</html>
