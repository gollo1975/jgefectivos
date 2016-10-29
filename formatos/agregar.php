
<html>
<head>
<title></title>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">

</head>
<body>
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
                            alert ("Digite el Documento del Empleado o asociado ?");
                            document.getElementById("cedula").focus();
                            return;
                        }
                        document.getElementById("contrato").submit();
                    }
                    function validar()
                    {
                        if (document.getElementById("matricula").value.length <=0)
                        {
                            alert ("Digite el valor de la matricula ?");
                            document.getElementById("matricula").focus();
                            return;
                        }
                        if (document.getElementById("valor").value.length <=0)
                        {
                            alert ("Digite el valor de matricula a pagar?");
                            document.getElementById("valor").focus();
                            return;
                        }
                        document.getElementById("matgrabar").submit();
                    }
</script>
<?
if (empty($cedula)):
include("../conexion.php");
?>
  <center><h4><u>Fondo de Auxilios</u><h4></center>
  <form action="" method="post" id="contrato">
    <table border="0" align="center">
     <tr><td><br></td></tr>
      <tr>
       <td><b>Documento de Identidad:</b></td>
         <td><input type="text" name="cedula" value="" size="14" maxlength="14" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula">
     </tr>
     <tr>
                     <td><b>Tipo_Fondo:</b></td>
                      <td><select name="tipo" class="cajas">
                         <option value="0">Seleccione el fondo
                          <?
                            $consulta_c="select * from itemfondo";
                            $resultado_c=mysql_query($consulta_c)or die ("Consulta de fondos incorrecta");
                            while($filas_c=mysql_fetch_array($resultado_c)):
                              ?>
                              <option value="<?echo $filas_c["codigo"];?>"><?echo $filas_c["concepto"];?>
                              <?
                              endwhile;
                      ?></select></td>
                   </tr>
      <tr><td><br></td></tr>
      <tr>
         <td colspan="5">
           <input type="button" value="Buscar Dato" class="boton" onclick="chequearcampos()">
         </td>
       </tr>
      </table>
    </form>
    <?
    elseif (empty($tipo)):
    ?>
      <script language="javascript">
         alert("Seleccione una opicón de la lista?")
         history.back()
      </script>
    <?
    else:
      include("../conexion.php");
      $con="select itemfondo.concepto from itemfondo
             where  itemfondo.codigo='$tipo'";
      $xcon=mysql_query($con)or die("Error de Busqueda de item");
      $filas_i=mysql_fetch_array($xcon);
      $fondo=$filas_i["concepto"];
      $busca="select empleado.codemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,zona.zona,zona.zona,empleado.cuenta  from empleado,zona
             where  zona.codzona=empleado.codzona and
                    empleado.cedemple='$cedula'";
      $resultado=mysql_query($busca)or die("Error de Busqueda");
      $registro=mysql_num_rows($resultado);
      if ($registro!=0):
             $consulta="select empleado.codemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado,contrato
              where contrato.codemple=empleado.codemple and
                   contrato.fechater = '0000-00-00' and
                   empleado.cedemple='$cedula'";
              $result=mysql_query($consulta)or die("Error de Busqueda contrato");
              $regi=mysql_affected_rows();
            while($filas=mysql_fetch_array($resultado)):
            if($regi==0):
                   ?>
                <script language="javascript">
                  alert("Este empleado o asociado esta retirado del sistema ?")
                  open("agregar.php","_self")
                </script>
        <?
            else:
                ?>
                 <h5><div align="center"><u>Fondo de Auxilios</u></div></h5>
                  <form action="grabarfondos.php" method="post" id="matgrabar" >
                   <table border="0" align="center">
                   <input type="hidden"  name="tipo" value="<? echo $tipo;?>" size="12">
                   <tr>
                      <td><b>Documento:</b></td>
                       <td><input type="text"  name="cedula" value="<? echo $cedula;?>" size="12"class="cajas" readonly><td>
                   </tr>
                   <tr>
                      <td><b>Empleado:</b></td>
                       <td><input type="text" name="empleado" value="<? echo $filas["nomemple"];?>&nbsp;<? echo $filas["nomemple1"];?>&nbsp;<? echo $filas["apemple"];?>&nbsp;<? echo $filas["apemple1"];?>"class="cajas" size="50" readonly></td>
                   </tr>
                   <tr>
                      <td><b>Fondo:</b></td>
                       <td><input type="text" name="fondo" value="<? echo $fondo;?>" size="50" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fondo" readonly></td>
                   </tr>
                   <tr>
                      <td><b>Cta_Nomina:</b></td>
                       <td><input type="text" name="cuenta" value="<? echo $filas["cuenta"];?>" size="12" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cuenta" readonly></td>
                   </tr>
                   <tr>
                      <td><b>Nro_Pago:</b></td>
                       <td><input type="text" name="documento" value="" size="12" maxlength="11" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="documento"></td>
                   </tr>
                   <tr>
                      <td><b>Vlr_Matricula:</b></td>
                       <td><input type="text" name="matricula" value="" size="12" maxlength="11" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="matricula"></td>
                   </tr>
                   <tr>
                      <td><b>Vlr_Fondo:</b></td>
                       <td><input type="text" name="valor" value="" size="12" maxlength="11" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="valor"></td>
                   </tr>
                   <tr>
                      <td><b>F_Pago:</b></td>
                       <td><input type="text" name="fechap" value="<?echo date("Y-m-d");?>" size="12" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fechap"></td>
                   </tr>
                   <tr>
                       <td><b>Zona:</b></td>
                       <td><input type="text" name="zona" value="<?echo $filas["zona"];?>" size="50" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="zona" readonly></td>
                    </tr>
                    <tr>
                       <td><b>Observacioón:</b></td>
                       <td><textarea name="nota" cols="50" rows="5" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nota"></textarea></td>
                   </tr>
                   <tr><td><br></td></tr>
                   <tr>
                         <td colspan="2">
                           <input type="button" value="Guardar" class="boton" onclick="validar()">
                         </td>
                       </tr>
                      </table>
                 </form>
             <?
            endif;
            endwhile;
       else:

        ?>
        <script language="javascript">
          alert("Este empleado, No existe en el Sistema ?")
          open("agregar.php","_self")
        </script>
        <?
     endif;

        endif;
 ?>
 </body>
</html>
