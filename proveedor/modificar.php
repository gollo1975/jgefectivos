<html>
<head>
<title>Consulta de Proveedores</title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<script language="javascript">
                    function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#73EABD"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }
</script>
</head>
<body>
<?
if (!isset($nitprove)):

?>
<center><h4><u>Editar Proveedores</u></h4></center>
  <form action="" method="post">
    <table border="0" align="center">
      <tr>
        <td colspan="2" class="fondo"></td>
      </tr>
      <tr><td><br></td></tr>
      <tr>
        <td><b>Nit_Proveedor:</b></td>
        <td><input type="text" name="nitprove" value="" size="15" maxlength="15"></td>
      </tr>
      <tr><td><br></td></tr>
      <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
      <input type="reset" value="Limpiar" class="boton">
    </td>
    </tr>
   </table>

   </form>
<?
elseif(empty($nitprove)):
?>
  <script language="javascript">
    alert("Digite el valor a consultar ?")
    history.back()
  </script>
<?
  else:
    include("../conexion.php");
    $consulta="select * from provedor where nitprove='$nitprove'";
    $resultado=mysql_query($consulta)or die("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
    if ($registro==0):
     ?>
     <script language="javascript">
       alert("No existe el registro en la bd ?")
       history.back()
     </script>
    <?
     else:
       while($filas=mysql_fetch_array($resultado)):
       ?>
       <center><h4><u>Editar Proveedores</u></h4></center>
         <form action="guardar.php" method="post">
           <table border="0" align="center">
           
            <tr><td><br></td></tr>
             <tr>
       <td><b>Nit:</b></td>
       <td><input type="text" name="nitprove" value="<?echo $filas["nitprove"];?>" size="20" maxlength="15" readonly class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nitprove"></td>
     </tr>
     <tr>
       <td><b>Dv:</b></td>
       <td><input type="text" name="dvprove" value="<?echo $filas["dvprove"];?>" size="20" maxlength="1" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="dvprove"></td>
     </tr>
     <tr>
       <td><b>Nombre:</b></td>
       <td><input type="text" name="nomprove" value="<?echo $filas["nomprove"];?>" size="50" maxlength="40" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nomprove"></td>
     </tr>
     <tr>
       <td><b>Direccion:</b></td>
       <td><input type="text" name="dirprove" value="<?echo $filas["dirprove"];?>" size="50" maxlength="40" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="dirprove"></td>
     </tr>
     <tr>
       <td><b>Teléfono:</b></td>
       <td><input type="text" name="telprove" value="<?echo $filas["telprove"];?>" size="20" maxlength="7" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="telprove"></td>
     </tr>
     <tr>
       <td><b>Fax:</b></td>
       <td><input type="text" name="faxprove" value="<?echo $filas["faxprove"];?>" size="20" maxlength="7" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="faxprove"></td>
       </tr>
       <tr>
      <tr>
               <td><b>Municipio:</b></td>
               <td><select name="municipio" class="cajas">
                 <?
                 $sucaux=$filas["codmuni"];
                 $consulta_s="select municipio.codmuni,municipio.municipio from municipio";
                 $resultado_s=mysql_query($consulta_s)or die("Consulta de municipio incorrecta");
                 while($filas_s=mysql_fetch_array($resultado_s)):
                   if ($sucaux==$filas_s["codmuni"]):
                 ?>
                 <option value="<?echo $filas_s["codmuni"];?>" selected><?echo $filas_s["municipio"];?>
                 <?
                   else:
                   ?>
                     <option value="<?echo $filas_s["codmuni"];?>"><?echo $filas_s["municipio"];?>
                   <?
                   endif;
                 endwhile;
                 ?> </selet></td>
             </tr>
      <tr>
       <td><b>Cuenta:</b></td>
       <td><input type="text" name="cuenta" value="<?echo $filas["cuenta"];?>" size="20" maxlength="15" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cuenta"></td>
     </tr>
     <tr>
       <td><b>Tipo_Cta:</b></td>
       <td><select name="tipo" class="cajas">
          <option value="<?echo $filas["tipoc"];?>"selected><?echo $filas["tipoc"];?>
          <option value="AHORRO">AHORRO
          <option value="CORRIENTE">CORRIENTE
          </select></td>
     </tr>
     <tr>
         <td><b>Banco:</b></td>
         <td><input type="text" name="banco" value="<?echo $filas["banco"];?>" size="20" maxlength="200" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="banco"></td>
       </tr>
       <tr>
         <td><b>Fecha:</b></td>
         <td><input type="text" name="fecha" value="<?echo $filas["fecha"];?>" size="20" maxlength="10" readonly class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fecha"></td>
       </tr>
       <tr>
         <td><b>Email:</b></td>
         <td><input type="text" name="email" value="<?echo $filas["email"];?>" size="50" maxlength="50" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="email"></td>
       </tr>
       <tr>
       <td><b>Gran Cont.:</b></td>
       <td><select name="gran" class="cajas">
          <option value="<?echo $filas["grancon"];?>"selected><?echo $filas["grancon"];?>
          <option value="NO">NO
          <option value="SI">SI
          </select></td>
     </tr>
     <tr>
       <td><b>Agente Retenedor:</b></td>
       <td><select name="agente" class="cajas">
          <option value="<?echo $filas["aretenedor"];?>"selected><?echo $filas["aretenedor"];?>
          <option value="NO">NO
          <option value="SI">SI
          </select></td>
     </tr>
     <tr>
       <td><b>Tipo_Regimen:</b></td>
       <td><select name="regimen" class="cajas">
          <option value="<?echo $filas["regimen"];?>"selected><?echo $filas["regimen"];?>
          <option value="SIMPLIFICADO">SIMPLIFICADO
          <option value="COMUN">COMUN
          <option value="SIN ANIMO DE LUCRO">SIN ANIMO DE LUCRO
          <option value="OTRO">OTRO

          </select></td>
     </tr>
      <tr>
               <td><b>Actividad:</b></td>
               <td><select name="actividad" class="cajas">
                 <?
                 $sucaux=$filas["codigocre"];
                 $consulta_s="select cree.codigocre,cree.concepto from cree";
                 $resultado_s=mysql_query($consulta_s)or die("Consulta de sucursal incorrecta");
                 while($filas_s=mysql_fetch_array($resultado_s)):
                   if ($sucaux==$filas_s["codigocre"]):
                 ?>
                 <option value="<?echo $filas_s["codigocrel"];?>" selected><?echo $filas_s["codigocre"];?>-<?echo $filas_s["concepto"];?>
                 <?
                   else:
                   ?>
                     <option value="<?echo $filas_s["codigocre"];?>"><?echo $filas_s["codigocre"];?>-<?echo $filas_s["concepto"];?>
                   <?
                   endif;
                 endwhile;
                 ?> </selet></td>
             </tr>
             <tr>
       <td><b>Estado:</b></td>
       <td><select name="estado" class="cajas">
          <option value="<?echo $filas["estado"];?>"selected><?echo $filas["estado"];?>
          <option value="ACTIVO">ACTIVO
          <option value="INACTIVO">INACTIVO
          </select></td>
     </tr>
 <tr>
       <td><b>Alianza_Convenio:</b></td>
       <td><select name="alianza" class="cajas">
          <option value="<?echo $filas["alianza"];?>"selected><?echo $filas["alianza"];?>
          <option value="NO">NO
          <option value="SI">SI
          </select></td>
     </tr>
<tr>
       <td><b>Alianza_Examen:</b></td>
       <td><select name="AlianzaExamen" class="cajas" id="AlianzaExamen">
          <option value="<?echo $filas["alianzaexamen"];?>"selected><?echo $filas["alianzaexamen"];?>
          <option value="NO">NO
          <option value="SI">SI
          </select></td>
     </tr>	 
     <tr>
       <tr>
               <td><b>Sucursal:</b></td>
               <td><select name="codsucursal" class="cajas">
                 <?
                 $sucaux=$filas["codsucursal"];
                 $consulta_s="select * from sucursal";
                 $resultado_s=mysql_query($consulta_s)or die("Consulta de sucursal incorrecta");
                 while($filas_s=mysql_fetch_array($resultado_s)):
                   if ($sucaux==$filas_s["codsucursal"]):
                 ?>
                 <option value="<?echo $filas_s["codsucursal"];?>" selected><?echo $filas_s["sucursal"];?>
                 <?
                   else:
                   ?>
                     <option value="<?echo $filas_s["codsucursal"];?>"><?echo $filas_s["sucursal"];?>
                   <?
                   endif;
                 endwhile;
                 ?> </selet></td>
             </tr>
              <tr><td><br></td></tr>
          <tr>
               <td colspan="2" class="fondo">
                 <input type="submit" value="Guardar" class="boton">
                 <input type="reset" value="Limpiar"class="boton">
               </td>
              </tr>
            <?
            endwhile;
          endif;
        endif;
       ?>
     </table>

     </form>
</body>
</html>
