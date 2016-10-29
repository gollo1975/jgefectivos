<?
 session_start();
?>
<html>
<head>
<title>Matricula de Sucursal</title>
<LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
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
                        if (document.getElementById("sucursal").value.length <=0)
                        {
                            alert ("El campo Nombre de Sucursal no puede estar vacío");
                            document.getElementById("sucursal").focus();
                            return;
                        }
                        if (document.getElementById("dirsucursal").value.length <=0)
                        {
                            alert ("El campo Dirección no puede estar vacío");
                            document.getElementById("dirsucursal").focus();
                            return;
                        }
                        if (document.getElementById("telsucursal").value.length <=0)
                        {
                            alert ("El campo Teléfono no puede estar vacío");
                            document.getElementById("telsucursal").focus();
                            return;
                        }
                       document.getElementById("matsucursales").submit();
                    }

                   </script>


</head>
<body>
<?
if(session_is_registered("xsession")):
if (empty($sucursal)):
  include("../conexion.php");
?>
<center><h4><u>Matricular Sucursales</u></h4></center>
  <form action="" method="post" id="matsucursales" >
    <table border="0" align="center">
    <tr><td><br></td></tr>
      <tr>
       <td><b>Sucursal:</b></td>
       <td colspan="5"><input type="text" name="sucursal" value="" size="50" maxlength="50" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="sucursal"></td>
     </tr>
     <tr>
       <td><b>Dirección:</b></td>
       <td><input type="text" name="dirsucursal" value="" size="50" maxlength="50"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="dirsucursal"></td>
     </tr>
     <tr>
       <td><b>Teléfono:</b></td>
       <td colspan="5"><input type="text" name="telsucursal" value="" size="10" maxlength="7" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="telsucursal"></td>
     </tr>
     <tr>
       <td><b>Fax:</b></td>
       <td colspan="5"><input type="text" name="faxsucursal" value="" size="10" maxlength="7"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="faxsucursal"></td>
       </tr>
       <tr>
      <tr>
         <td><b>Municipio</b></td>
         <td colspan="1"><select name="municipio" class="cajasletra">
               <option value="0">Seleccione el Municipio
               <?
               $consulta_z="select codmuni,municipio from municipio  order by municipio";
               $resultado_z=mysql_query($consulta_z) or die("Error al buscar municipios");
                while ($filas_z=mysql_fetch_array($resultado_z)):
                   ?>
                   <option value="<?echo $filas_z["codmuni"];?>"><?echo $filas_z["municipio"];?>
                   <?
               endwhile;
                    ?>
             </select></td>
     </tr>
     <tr>
       <td><b>Cuenta Nro 1:</b></td>
       <td><input type="text" name="cuenta1" value="" size="20" maxlength="15"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cuenta1"></td>
     </tr>
     <tr>
       <td><b>Tipo de Cta:</b></td>
       <td><input type="text" name="tipo1" value="" size="20" maxlength="15"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="tipo1"></td>
     </tr>
     <tr>
       <td><b>Banco 1:</b></td>
       <td><input type="text" name="banco" value="" size="20" maxlength="20"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="banco"></td>
     </tr>
     <tr>
       <td><b>Cuenta Nro 2:</b></td>
       <td><input type="text" name="cuenta2" value="" size="20" maxlength="15"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cuenta2"></td>
     </tr>
     <tr>
       <td><b>Tipo de Cta:</b></td>
       <td><input type="text" name="tipo2" value="" size="20" maxlength="15"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="tipo2"></td>
     </tr>
     <tr>
       <td><b>Banco 2:</b></td>
       <td><input type="text" name="banco1" value="" size="20" maxlength="20"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="banco1"></td>
     </tr>
      <tr>
       <td><b>Resolución Dian:</b></td>
       <td><input type="text" name="dian" value="" size="60" maxlength="60"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="dian"></td>
     </tr>
      <tr>
       <td><b>Desde:</b></td>
       <td><input type="text" name="rango" value="" size="15" maxlength="15"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="rango"></td>
     </tr>
     <tr>
       <td><b>Hasta:</b></td>
       <td><input type="text" name="rango2" value="" size="15" maxlength="15"class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="rango2"></td>
     </tr>
     <tr>
       <td><b>Departamento:</b></td>
          <td colspan="5"><select name="departamento" class="cajas">
          <option value="0">Seleccione Dpto
          <?
            $consulta_d="select * from departamento ";
            $resultado_d=mysql_query($consulta_d)or die ("Consulta de departamento incorrecta");
            while($filas_d=mysql_fetch_array($resultado_d)):
              ?>
              <option value="<?echo $filas_d["codepart"];?>"> <?echo $filas_d["departamento"];?>
              <?
              endwhile;
              ?></select></td>
       </tr>
       <tr>
         <td><b>Email:</b></td>
         <td colspna="2"><input type="text" name="email" value="" size="50" maxlength="50" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="email"></td>
       </tr>
        <tr>
         <td><b>Principal:</b></td>
           <td>
              <select name="principal" class="cajasletra">
              <option value="NO">NO
              <option value="SI">SI
             </select>
           </td>
       </tr>
        <tr>
        <td><b>Empresa:</b></td>
          <td colspan="5"><select name="empresa" class="cajas">
          <option value="0">Seleccione Principal
          <?
            $consulta_e="select * from maestro";
            $resultado_e=mysql_query($consulta_e)or die ("Consulta de empresa incorrecta");
            while($filas_e=mysql_fetch_array($resultado_e)):
              ?>
              <option value="<?echo $filas_e["codmaestro"];?>"> <?echo $filas_e["nomaestro"];?>
              <?
              endwhile;
              ?></select></td>
       </tr>
       <tr><td><br></td></tr>
       <tr>
         <td colspan="2">
           <input type="button" value="Guardar" class="boton" onclick="chequearcampos()">
           <input type="reset" value="Limpiar" class="boton">
         </td>
       </tr>
       <tr><td><br></td></tr>
      </table>
     </form>
    <?
     else:
       include("../conexion.php");
       $consulta = "select max(cast(codsucursal as unsigned)) + 1 from sucursal";
       $result = mysql_query ($consulta);
       $codsuc = mysql_fetch_row($result);
       $codsuc[0] = str_pad($codsuc[0], 2, "0", STR_PAD_LEFT);
       $sucursal = strtoupper($sucursal);
       $dirsucursal = strtoupper($dirsucursal);
       $email=strtoupper($email);
       $banco=strtoupper($banco);
       $banco1=strtoupper($banco1);
       $tipo1=strtoupper($tipo1);
       $tipo2=strtoupper($tipo2);
        $consulta="insert into sucursal(codsucursal,sucursal,dirsucursal,telsucursal,faxsucursal,codmuni,cuenta1,tipocta1,banco,cuenta2,tipocta2,banco1,dian,rango,rango2,codepart,email,estadosucu,codmaestro)
         values('$codsuc[0]','$sucursal','$dirsucursal','$telsucursal','$faxsucursal','$municipio','$cuenta1','$tipo1','$banco','$cuenta2','$tipo2','$banco1','$dian','$rango','$rango2','$departamento','$email','$principal','$empresa')";
        $resultado=mysql_query($consulta)or die("inserección incorrecta .$consulta");
         $registro=mysql_affected_rows();
         echo "<script language=\"javascript\">";
         echo "open (\"../pie.php?msg=Se Grabo $registro Registro, de la Sucursal : $sucursal\",\"pie\");";
         echo ("open (\"agregar.php\",\"_self\");");
         echo "</script>";
      endif;
  else:
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección")
    pagina='../acceso/agregar.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
endif;
  ?>
 </body>
</html>
