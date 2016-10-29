<html>

<head>
  <title>Consulta de Empleados por Zona</title>
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
       function chequearcampos()
       {
         if (document.getElementById("basico").value.length <=0)
         {
           alert ("Digite el salario Básico de Facturación ?");
           document.getElementById("basico").focus();
           return;
         }
         if (document.getElementById("pension").value.length <=0)
           {
           alert ("Digite el porcentaje de Pensión ?");
           document.getElementById("pension").focus();
           return;
           }
           if (document.getElementById("eps").value.length <=0)
           {
           alert ("Digite el porcentaje de Eps ?");
           document.getElementById("eps").focus();
           return;
           }
           if (document.getElementById("arp").value.length <=0)
           {
           alert ("Digite el porcentaje de Arp ?");
           document.getElementById("arp").focus();
           return;
           }
           if (document.getElementById("caja").value.length <=0)
           {
           alert ("Digite el porcentaje de la caja de Compensación ?");
           document.getElementById("caja").focus();
           return;
           }
           if (document.getElementById("admon").value.length <=0)
           {
           alert ("Digite la Administración de Cobro ?");
           document.getElementById("admon").focus();
           return;
           }
           document.getElementById("matfactura").submit();
        }
   </script>
 </head>
<?
  if (!isset($campo)):
     include("../conexion.php");
  ?>
  <center><h4>Empleados por Zona</h4></center>
<form action="" method="post" width="200">
    <table border="0" align="center">
    <tr><td><br></td></tr>
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
      <input type="reset" value="Limpiar" class="boton">
    </td>
  </tr>
</table></td></tr>
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
include ("../conexion.php");
      $consu="select zona.codzona,zona.zona,zona.iva from zona
                where zona.codzona='$campo'";
                 $resulta=mysql_query($consu) or die("consulta incorrecta  ");
                 while ($filas_s=mysql_fetch_array($resulta)):
                     ?>
                   <center><h4>Facturacion Por Empacadores</h4></center>
                   <form name="" action="detallado.php" method="post" id="matfactura">
                    <input type="hidden" name="codzona" value="<? echo $filas_s["codzona"];?>" size="3">
                    <input type="hidden" name="zona" value="<? echo $filas_s["zona"];?>" size="3">
                    <input type="hidden" name="iva" value="<? echo $filas_s["iva"];?>" size="3"> 
                    <table border="0" align="center">
                    <tr><td><br></td></tr>
                     <tr>
                        <td><b>Cod_Zona:</b></td>
                        <td colspan="5"><input type="text" name="codzona" value="<? echo $filas_s["codzona"];?>"  class="cajas" size="4" readonly></td>
                     </tr>
                     <tr>
                        <td><b>Zona:</b></td>
                        <td colspan="8"><input type="text" name="zona" value="<? echo $filas_s["zona"];?>" class="cajas"size="45" readonly></td>
                     </tr>
                     <tr>
                        <td><b>Auxilio:</b></td>
                        <td colspan="1"><input type="text" name="auxilio" value="0" class="cajas" size="11" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="desde"></td>
                        <td><b>Presta. %:</b></td>
                        <td colspan="2"><input type="text" name="prestacion" value="0" class="cajas" size="11" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="hasta"></td>
                     </tr>
                     <tr>
                        <td><b>Desde:</b></td>
                        <td colspan="1"><input type="text" name="desde" value="<? echo date("Y-m-d");?>" class="cajas" size="11" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="desde"></td>
                        <td><b>Hasta:</b></td>
                        <td colspan="2"><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" class="cajas" size="11" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="hasta"></td>
                     </tr>
                     <tr>
                        <td><b>Básico:</b></td>
                        <td colspan="1"><input type="text" name="basico" value="" class="cajas" size="7" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="basico"></td>
                        <td><b>Pensión %:</b></td>
                        <td colspan="2"><input type="text" name="pension" value="" class="cajas" size="7" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="pension"></td>
                     </tr>
                        <tr>
                        <td><b>Eps %:</b></td>
                        <td colspan="1"><input type="text" name="eps" value="" class="cajas"  size="7" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="eps"></td>
                        <td><b>Arp %:</b></td>
                        <td colspan="2"><input type="text" name="arp" value="" class="cajas" size="7" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="arp"></td>
                     </tr>
                     <tr>
                        <td><b>Caja %:</b></td>
                        <td colspan="1"><input type="text" name="caja" value="" class="cajas" size="7" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="caja"></td>
                        <td><b>Admon:</b></td>
                        <td colspan="2"><input type="text" name="admon" value="" class="cajas" size="7" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="admon"></td>
                     </tr>
                      <tr><td><br></td></tr>
                     <tr><td colspan="5"><input type="button" value="Buscar Datos" class="boton" onclick="chequearcampos()"></td>
                     </tr>
                   </table>
                 </form>
                 <?
                 endwhile;
 endif;
       ?>
</body>
</html>
