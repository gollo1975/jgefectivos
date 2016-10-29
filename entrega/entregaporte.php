<html>
<head>
<title>Pago de Aportes</title>
<LINK REL="stylesheet"  HREF="../estilo.css" type="text/css">
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
                        if (document.getElementById("cedula").value.length <=0)
                        {
                            alert ("El Nro de Documento  no puede estar vacío");
                            document.getElementById("cedula").focus();
                            return;
                        }
                        if (document.getElementById("fechainic").value.length <=0)
                        {
                            alert ("El campo fecha de inicio  no puede estar vacío");
                            document.getElementById("fechainic").focus();
                            return;
                        }
                        if (document.getElementById("fechafinal").value.length <=0)
                        {
                            alert ("El campo fecha Final  no puede estar vacío");
                            document.getElementById("fechafinal").focus();
                            return;
                        }
                         document.getElementById("matpago").submit();
                    }
                </script>
</head>
<body>
<?
if (empty($cedula)):
  include("../conexion.php");
?>
    <center><h4><u>Matricular Pago</u></h4></center>
  <form action="" method="post" id="matpago">
    <table border="0" align="center">
     <tr><td><br></td></tr>
     <tr>
       <td><b>Documento de Identidad:</b></td>
       <td><input type="text" name="cedula" value="" size="15" maxlength="15" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
     </tr>
      <tr><td><br></td></tr>
     <tr>
       <td colspan="2">
           <input type="button" value="Buscar" class="boton" onclick="document.getElementById('matpago').submit()">
           <input type="reset" value="Limpiar" class="boton">
       </td>
     </tr>
    </table>
    
  </form>
  <?
  elseif(empty($cedula)):
       ?>
     <script language="javascript">
       alert("Digite el documento del empleado " )
       history.back()
     </script>
      <?
    else:
      include("../conexion.php");
         $consulta1="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,contrato.fechainic from contrato,empleado where
            empleado.codemple=contrato.codemple and
            contrato.fechater='0000-00-00' and
            empleado.cedemple='$cedula'";
         $resultado1=mysql_query($consulta1) or die("Consulta de empleado incorrecta");
         $regis=mysql_num_rows($resultado1);
         if ($regis==0):
         ?>
          <script language="javascript">
            alert("El documento no existe en la b.d / Este asociado no genera Aporte social")
            history.back()
          </script>
          <?
         else:
         ?>
         <center><h4><u>Aportes Sociales</u></h4></center>
         <?
          while ($filas=mysql_fetch_array($resultado1)):
          ?>

          <form action="buscar.php" method="post" id="matpago">
            <table border="0" align="center">
              <tr>
               <td colspan="6"><br></td>
              </tr>
            <tr>
            <td><b>Documento:</b></td>
            <td><input type="text" name="cedula" value="<? echo $filas["cedemple"];?>" class="cajas" size="11" maxlength="11" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
          </tr>
          <tr>
           <td><b>Empleado:</b></td>
           <td><input type="text" name="nomemple" value="<? echo $filas["nomemple"];?>&nbsp;<? echo $filas["nomemple1"];?>&nbsp;<? echo $filas["apemple"];?>&nbsp;<? echo $filas["apemple1"];?>" class="cajas" size="40" maxlength="40" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)"></td>
          </tr>
          <tr>
           <td><b>Fecha_Inicio:</b></td>
           <td><input type="text" name="fechainic" value="<? echo $filas["fechainic"];?>"class="cajas" size="11" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fechainic"></td>
           </tr>
           <tr>
           <td><b>Fecha_Final:</b></td>
           <td><input type="text" name="fechafinal" value="<? echo date("Y-m-d");?>" class="cajas" size="11" maxlength="10"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fechafinal"></td>
          </tr>
          <tr>
            <td><b>Fecha_Grabado:</b></td>
                <td><input type="text" name="fechagra" value="<? echo date("Y-m-d");?>"class="cajas" size="11" maxlength="10" readonly></td>
          </tr>
       <tr>
       <td><b>Nota:</b></td>
       <td><textarea name="nota" cols="50" rows="5" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nota"></textarea></td>
     </tr>
     <tr><td><br></td></tr>
     <tr>
       <td colspan="2">
           <input type="submit" value="Buscar" class="boton" onclick="chequearcampos()">
           <input type="reset" value="Limpiar" class="boton">
       </td>
     </tr>
    </table>
  </form>
 <?
 endwhile;
 endif;
endif;
?>
 </body>
</html>
