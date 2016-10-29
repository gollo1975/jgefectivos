<html>
        <head>
                <title>Descargar Creditos por Empleado</title>
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
                        if (document.getElementById("abono").value.length <=0)
                        {
                            alert ("El campo [Abono] no puede estar vacío");
                            document.getElementById("abono").focus();
                            return;
                        }
                         document.getElementById("matabono").submit();

                    }
                </script>
        </head>
        <body>
        <?
               if (!isset($codigo)):
                    include("../conexion.php");
    $consulta="select credito.nrocredito,credito.cedemple,credito.nuevo,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado,credito where empleado.cedemple=credito.cedemple and credito.nrocredito='$cod'";
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
     ?><center><h4><u>Matricular Dato</u></h4></center><?
     while($filas=mysql_fetch_array($resultado)):
       ?>

         <form action="guardar.php" method="post" id="matabono">
           <table border="0" align="center">
             <tr>
               <td><b>Cedula:</b></td>
               <td colspan="2"><input type="text"class="cajas" value="<?echo $filas["cedemple"];?>" name="cedemple"size="15" maxlength="15" readonly></td>
               </tr>
               <tr>
                <td><b>Empleado:</b></td>
                  <td colspan="2"><input type="text"class="cajas" value="<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?>" name="nomemple"size="50" readonly></td>
                </tr>
                <tr>
                <td><b>Nro_Credito:</b></td>
                  <td colspan="2"><input type="text"class="cajas" value="<?echo $filas["nrocredito"];?>" name="nrocredito"size="10" maxlength="10" readonly></td>
                </tr>
                <td><b>Saldo:</b></td>
               <td colspan="2"><input type="text"class="cajas" value="<?echo $filas["nuevo"];?>" name="saldo" size="11" maxlength="11" readonly></td>
               </tr>
                <td><b>Abono:</b></td>
               <td><input type="text"class="cajas" value="" name="abono" size="11" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="abono"></td>
                <td><b>Fecha_Proceso:</b></td>
               <td colspan="1"><input type="text"class="cajas" value="<?echo date("Y-m-d");?>" name="fecha" size="10" maxlength="10" readonly></td>
               </tr>
             <tr>
               <td><b>Nota:</b></td>
               <td colspan="15"><textarea name="nota" cols="63" rows="6" class="cajas"></textarea></td>
             </tr>
              <tr>
             <td colspan="5"><b>Imprimir Recibo:</b>&nbsp;<input type="checkbox" name="buscar" value="imprimir"></td>
             <tr><td><br></td></tr>
             <tr>
               <td colspan="2">
               <input type="button" value="Guardar" class="boton" onclick="chequearcampos()">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
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
