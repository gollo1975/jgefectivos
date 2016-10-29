<html>

<head>
  <title>Consulta de Nomina por Zona</title>
      <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
      <script language="javascript">
        function volver()// para declara funcion
        {
                pagina='pagarnomina.php'
                tiempo=100
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
        }
      </script>
</head>
<body>
<?
  if (!isset($campo)):
     include("../conexion.php");
  ?>
  <center><h4>Consulta de Nomina por Zona</h4></center>
<form action="" method="post" width="200">
  <table border="0" align="center">
  <tr class="fondo">
       <td colspan="2"><br></td>
  </tr>
  <tr>
    <td><b>Desde:</b></td>
    <td colspan="3"><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
    <td><b>Hasta:</b></td>
    <td colspan="3"><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="10" maxlegth="10"></td>
  </tr>
  <tr>
         <td><b>Zona:</b></td>
                              <td colspan="12"><select name="campo" class="cajas">
                              <option value="0">Seleccione la zona
                                <?
                                 $consulta_z="select * from zona where zona.nomina='SI' order by zona";
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
      <input type="reset" value="Limpiar"class="boton">
    </td>
  </tr>
</table>
</form>
<?
elseif (empty($campo)):
?>
  <script language="javascript">
    alert ("Despliegue la vista para eligir la zona ?")
    history.back()
  </script>
    <?
     else:
       include("../conexion.php");
         $consulta="select zona.zona from zona where
                 zona.codzona='$campo'";
         $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
         $registro=mysql_num_rows($resultado);
         if ($registro==0):
    ?>
          <script language="javascript">
            alert ("La zona No existe en la bd. ?")
            history.back()
          </script>
   <?
        else:
        ?>
            <table border="0" align="center">
                <?
            while($filas=mysql_fetch_array($resultado)):
            $fecha=date("Ymd");
             $hora=date("his");
             ?>
             <tr>
              <td><?echo $filas["zona"]; $zona=$filas["zona"].$fecha.$hora;?></td>
              </tr>
              <?
            endwhile;
            ?>
            </table>
            <?
       
          $consu="select nomina.cedemple,nomina.neto,nomina.consecutivo,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,empleado.cuenta from empleado,periodo,zona,nomina where
          zona.codzona=periodo.codzona and
		  periodo.codigo=nomina.codigo and
          empleado.cedemple=nomina.cedemple and
          periodo.desde='$desde' and 
		  periodo.hasta='$hasta' and
          zona.codzona='$campo'order by empleado.nomemple,empleado.apemple";
          $resulta=mysql_query($consu)or die ("Consulta incorrecta dos");
          $registro=mysql_num_rows($resulta);
          $registro=mysql_affected_rows();
          if ($registro!=0):
     ?>
            <center><h4>Listado de Empleados</h4></center>
            <table border="0" align="center">
              <tr class="cajas">
                <td>Para ver El Informe de las colilla, Presione Click Sobre el Cod_Nómina..</td>
              </tr>
            </table>
              <table border="0" align="center">

              <tr  class="cajas">
                  <th>Cod_Nomina</th>
                  <th >Documento</th>
                  <th>Empleado&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</th>
                  <th>Cuenta</th>
                  <th>Vlr_Pagar</th>
                  </tr>
    <?
            while($filas_s=mysql_fetch_array($resulta)):
              $aux=number_format($filas_s["neto"],0);
                        ?>
         <tr  class="cajas">
                 <td><a href="imprimir.php?codigo=<?echo $filas_s["consecutivo"];?>"><?echo $filas_s["consecutivo"];?></a></td>
                 <td><?echo $filas_s["cedemple"];?></td>
                 <td><?echo $filas_s["nomemple"];?>&nbsp;<?echo $filas_s["nomemple1"];?>&nbsp;<?echo $filas_s["apemple"];?>&nbsp;<?echo $filas_s["apemple1"];?></td>
                 <td>&nbsp;&nbsp;<?echo $filas_s["cuenta"];?></td>
                 <td>&nbsp;&nbsp;<?echo $aux;?></td>
               </tr>

           <?
           $suma=$suma+1;
           $con=$con+$filas_s["neto"];
            endwhile;
            $con=number_format($con,0);    
            ?>
            </table>
            <tr><td>&nbsp;</td></tr>
             <center><td class="cajas"><b>Nro_Registro:</b>&nbsp;&nbsp;<?echo $suma;?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b>Vlr_Pagar:</b>&nbsp;&nbsp;<?echo $con;?></td></center>
             <th><center><a href="imprimirnomina.php?codzona=<?echo $campo;?>&desde=<? echo $desde;?>&hasta=<? echo $hasta;?>" target="_blank" onclick="volver()" class="fondo">Imprimir</a></center></th>
            <?
          else:
            ?>
              <script language="javascript">
                alert("No Existen empleados con nomina en este Rango de Fechas Zona")
                history.back()
             </script>
            <?

         endif;
    endif;
  endif;
  ?>
</table>

</body>
</html>
