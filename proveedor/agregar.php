<html>
<head>
<title>Matricula de Tercero</title>
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
                      function chequearcampos()
                    {
                        if (document.getElementById("nitprove").value.length <=0)
                        {
                            alert ("El campo NIT no puede estar vacio");
                            document.getElementById("nitprove").focus();
                            return;
                        }
                        if (document.getElementById("dvprove").value.length <=0)
                        {
                            alert ("El campo DIGITO no puede estar vacio?");
                            document.getElementById("dvprove").focus();
                            return;
                        }
                        if (document.getElementById("nomprove").value.length <=0)
                        {
                            alert ("El campo NOMBRE no puede estar vacio?");
                            document.getElementById("nomprove").focus();
                            return;
                        }
                        if (document.getElementById("dirprove").value.length <=0)
                        {
                            alert ("El campo DIRECCION no puede estar vacio?");
                            document.getElementById("dirprove").focus();
                            return;
                        }
                        if (document.getElementById("telprove").value.length <=0)
                        {
                            alert ("El campo TELEFONO no puede estar vacio?");
                            document.getElementById("telprove").focus();
                            return;
                        }
                        document.getElementById("matprove").submit();

                    }
                </script>
</head>
<body>
<?
if (empty($nitprove))
{
  include("../conexion.php");
?>
<center><h4>Matricula de Tercero</h4></center>
  <form action="" method="post"id="matprove">
    <table border="0" align="center">
    <tr class="cajas">
      <td colspan="2" class="fondo"></td>
    </tr>
     <tr><td><br></td></tr>
     <tr>
       <td><b>Nit:</b></td>
       <td><input type="text" name="nitprove" value="" size="20" maxlength="15"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nitprove" class="cajas"></td>
     </tr>
     <tr>
       <td><b>Dv:</b></td>
       <td><input type="text" name="dvprove" value="" size="20" maxlength="1"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="dvprove" class="cajas"></td>
     </tr>
     <tr>
       <td><b>Nombre:</b></td>
       <td><input type="text" name="nomprove" value="" size="50" maxlength="40"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nomprove" class="cajas"></td>
     </tr>
     <tr>
       <td><b>Dirección:</b></td>
       <td><input type="text" name="dirprove" value="" size="50" maxlength="40"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="dirprove" class="cajas"></td>
     </tr>
     <tr>
       <td><b>Teléfono:</b></td>
       <td><input type="text" name="telprove" value="" size="20" maxlength="7"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="telprove" class="cajas"></td>
     </tr>
     <tr>
       <td><b>Fax:</b></td>
       <td><input type="text" name="faxprove" value="" size="20" maxlength="7"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="faxprove" class="cajas"></td>
       </tr>
       <tr>
       <td><b>Municipio:</b></td>
          <td><select name="municipio" class="cajas">
          <option value="0">Seleccione el Municipio
          <?
            $consulta_s="select municipio.codmuni,municipio.municipio from municipio order by municipio";
            $resultado_s=mysql_query($consulta_s)or die ("Consulta de Municipiio incorrecta");
            while($filas_s=mysql_fetch_array($resultado_s))
            {
              ?>
              <option value="<?echo $filas_s["codmuni"];?>"> <?echo $filas_s["municipio"];?>
              <?
              }
              ?></select></td>
       </tr>
     <tr>
     <td><b>Cuenta:</b></td>
       <td><input type="text" name="cuenta" value="" size="20" maxlength="15"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cuenta" class="cajas"></td>
     </tr>
     <tr>
       <td><b>Tipo Cta:</b></td>
       <td><select name="tipo" class="cajas">
          <option value="AHORRO">AHORRO
          <option value="CORRIENTE">CORRIENTE
          </select></td>
     </tr>
      <tr>
     <td><b>Banco:</b></td>
       <td><input type="text" name="banco" value="" size="20" maxlength="20"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="banco" class="cajas"></td>
     </tr>
      <tr>
         <td><b>Fecha:</b></td>
         <td><input type="text" name="fecha" value="<?echo date("Y-m-d");?>" size="20" class="cajas" maxlength="10" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fecha"></td>
       </tr>
       <tr>
         <td><b>Email:</b></td>
         <td><input type="text" name="email" value="" size="50" maxlength="50"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="email" class="cajas"></td>
       </tr>
       <tr>
          <td><b>Gran Cont.:</b></td>
             <td><select name="gran" class="cajas">
                <option value="SI">SI
                <option value="NO">NO
             </select></td>
        </tr>
       <tr>
          <td><b>Agente Ret.:</b></td>
             <td><select name="agente" class="cajas">
                <option value="SI">SI
                <option value="NO">NO
             </select></td>
       </tr>
       <tr>
          <td><b>Tipo Regimen:</b></td>
             <td><select name="regimen" class="cajas">
                <option value="SIMPLIFICADO">SIMPLIFICADO
                <option value="COMUN">COMUN
                <option value="SIN ANIMO DE LUCRO">SIN ANIMO DE LUCRO
                 <option value="OTRO">OTRO
             </select></td>
       </tr>
        <tr>
                                        <td><b>Actividad:</b></td>
                                        <td>
                                           <select name="actividad" class="cajas" id="actividad">
                                           <option value="0">Seleccione el Código de la Actividad
                                                  <?
                                                                $consulta="select codigocre,concepto from cree order by concepto";
                                                                $resultado=mysql_query($consulta) or die("consulta de vendedor Incorrecta");
                                                                while ($filas=mysql_fetch_array($resultado))
                                                                {
                                                        ?>
                                                                <option value="<?echo $filas["codigocre"];?>"><?echo $filas["codigocre"];?>-<?echo $filas["concepto"];?>
                                                        <?
                                                                }
                                                        ?>
                                        </select></td>
                                </tr>
<tr>
   <td><b>Alianza_Convenio:</b></td>
                                          <td><select name="alianza" class="cajasletra">
                                                <option value="NO">NO
                                                <option value="SI">SI
                                            </select></td>
                                       </tr>
</tr>
<tr>
   <td><b>Alianza_Examen:</b></td>
                                          <td><select name="alianzaExamen" class="cajasletra" id="alianzaExamen">
                                                <option value="NO">NO
                                                <option value="SI">SI
                                            </select></td>
                                       </tr>
</tr>
       <tr>
       <td><b>Sucursal:</b></td>
          <td><select name="codsucursal" class="cajas">
          <option value="0">Seleccione La Sucursal
          <?
            $consulta_s="select * from sucursal";
            $resultado_s=mysql_query($consulta_s)or die ("Consulta de sucursal incorrecta");
            while($filas_s=mysql_fetch_array($resultado_s))
            {
              ?>
              <option value="<?echo $filas_s["codsucursal"];?>"> <?echo $filas_s["sucursal"];?>
              <?
              }
              ?></select></td>
       </tr>
      <tr><td><br></td></tr>
       <tr>
         <td colspan="2">
           <input type="button" value="Guardar" class="boton"onclick="chequearcampos()">
           <input type="reset" value="Limpiar" class="boton">
         </td>
       </tr>
      </table>
           </form>
    <?
      }
     elseif(empty($municipio))
     {
     ?>
     <script language="javascript">
       alert("Seleccione un municipio de la lista ?")
       history.back()
     </script>
     <?
     }
      elseif(empty($codsucursal))
     {
     ?>
     <script language="javascript">
       alert("Seleccione una sucursal de la lista ?")
       history.back()
     </script>
     <?
     }
     else
     {

       include("../conexion.php");
       $consulta="select * from provedor where nitprove='$nitprove'";
       $resultado=mysql_query($consulta)or die("Consulta incorrecta");
       $registro=mysql_num_rows($resultado);
       if ($registro==0)
       {

                        $nomprove=strtoupper($nomprove);
                        $dirprove=strtoupper($dirprove);
                        $email=strtolower($email);
                        $estado='ACTIVO';
                        $consulta="INSERT INTO provedor (nitprove,dvprove,nomprove,dirprove,telprove,faxprove,codmuni,cuenta,tipoc,banco,fecha,email,grancon,aretenedor,regimen,codigocre,estado,alianza,alianzaexamen,codsucursal)
                                        VALUES ('$nitprove','$dvprove','$nomprove','$dirprove','$telprove','$faxprove','$municipio','$cuenta','$tipo','$banco','$fecha','$email','$gran','$agente','$regimen','$actividad','$estado','$alianza','$alianzaExamen','$codsucursal')";
                        $resultado=mysql_query($consulta) or die("Error al Grabar registro de proveedor $consulta");

                ?>

                                                <script language="javascript">
                                                        alert("Registro Almacenado Correctamente")
                                                       open("agregar.php","_self")
                                                </script>
                <?
                                                             }
       else
        {
                ?>

         <script language="javascript">
           alert("El Nit/Cedula, Ya existe en Sistema")
           open("agregar.php","_self")
        </script>
                 <?
                                }
                       }
                 ?>
        </body>
</html>
