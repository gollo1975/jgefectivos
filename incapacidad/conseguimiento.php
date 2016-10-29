<html>
<head>
<title>Seguimiento de Incapacidad</title>
<LINK  REL="stylesheet" HREF="../estilo.css" type="text/css">
                <script language="javascript">
                    function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }
                       function validar()
                    {
                        if (document.getElementById("cedula").value.length <=0)
                        {
                            alert ("Digite el documento de Identidad ?");
                            document.getElementById("cedula").focus();
                            return;
                        }
                         document.getElementById("matvali").submit();
                    }
                    function chequearcampos()
                    {
                        if (document.getElementById("nroinca").value.length <=0)
                        {
                            alert ("El campo Número de Incapacidad no puede estar vacío");
                            document.getElementById("nroinca").focus();
                            return;
                        }
                        if (document.getElementById("dias").value.length <=0)
                        {
                            alert ("El campo Días no puede estar vacío");
                            document.getElementById("dias").focus();
                            return;
                        }
                         document.getElementById("matinc").submit();
                    }

                </script>
</head>
<body>
<?
if (!isset($cedula)):
  ?>
   <center><h4>Seguimiento de Incapacidad</h4></center>
   <form action="" method="post" id="matvali">
      <table border="0" align="center">
        <tr><td><br></td></tr>
        <tr>
           <td><b>Documento de identidad:</b><td>
           <td><input type="text" name="cedula" value="" size="15" maxlength="15" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
        </tr>
        <tr><td><br></td></tr>
        <tr>
                 <td colspan="2">
                   <input type="button" value="Buscar" class="boton" onclick="validar()">
                 </td>
               </tr>
      </table>
   </form>
  <?
else:
   include("../conexion.php");
   $con="select concat(nomemple,' ' ,nomemple1,' ' ,apemple,' ' ,apemple1) as nombre from empleado
      where  empleado.cedemple='$cedula'";
   $res=mysql_query($con)or die ("Error de busqueda de empleado");
   $filas_s=mysql_fetch_array($res);
   $reg=mysql_num_rows($res);
   if($reg!=0):
      ?>
      <table border="0" align="center">
        <tr>
           <td class="cajas"><b><?echo $filas_s["nombre"];?></b></td>
        </tr>
      </table>
       <tr><td><br></td></tr>
      <?
      $con1="select incapacidad.nroinca,incapacidad.fechaini,incapacidad.fechater,tipoinca.concepto from incapacidad,empleado,tipoinca
      where incapacidad.cedemple=empleado.cedemple and
            incapacidad.tipoinca=tipoinca.tipoinca and
            empleado.cedemple='$cedula' order by incapacidad.fechaini";
     $res1=mysql_query($con1)or die ("Error de busqueda de empleado");
     $reg1=mysql_num_rows($res1);
     if($reg1!=0):
        ?>
        <table border="0" align="center">
        <tr>
           <td class="cajas">Presione Click en el Nro_Incap. para para ver el seguimiento</td>
        </tr>
      </table>
       <tr><td><br></td></tr>
         <table border="0" align="center" >
            <tr>
              <th>Item</th>
              <th>Nro_Incap.</th>
              <th>F_Inicio</th>
              <th>F_Final</th>
              <th>Motivo</th>
            </tr>
         <?
         $a=1;
         while($filas=mysql_fetch_array($res1)):
           ?>
            <tr class="cajas">
               <th><?echo $a;?></th>
               <td><a href="extrato.php?nro=<?echo $filas["nroinca"];?>&nombre=<?echo $filas_s["nombre"];?>"><?echo $filas["nroinca"];?></a></td>
               <td><?echo $filas["fechaini"];?>&nbsp;</td>
               <td><?echo $filas["fechater"];?>&nbsp;</td>
               <td><?echo $filas["concepto"];?></td>
            </tr>
           <?
           $a=$a+1;
         endwhile;
         ?>
       </table>
        <?
     else:
        ?>
        <script language="javascript">
          alert("No hay incapacidades para este Empleado ?")
         history.back()
        </script>
        <?
     endif;
   else:
        ?>
       <script language="javascript">
          alert("Este documento no existe en Sistema ?")
         history.back()
      </script>
     <?
   endif;
   endif;
   ?>
 </body>
</html>
