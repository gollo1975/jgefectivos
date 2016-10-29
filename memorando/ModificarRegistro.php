<html>
        <head>
                <title>Agregar Memorando</title>
               <LINK  REL="stylesheet" HREF="../estilo.css" type="text/css">

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
                            alert ("Digite el documento de identidad.");
                            document.getElementById("cedula").focus();
                            return;
                        }
                         document.getElementById("matmemo").submit();

                    }
                </script>
                <?
if (!isset($cedula)):?>
   <center><h4><u>Editar Registro</u></h4></center>
     <form action="" method="post" id="matmemo">
         <table border="0" align="center"
            <tr><td><br></td></tr>
           <tr>
              <td><b>Documento de Identidad:</b></td>
              <td><input type="text" name="cedula" value="" size="15" mexlength="15" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
           </tr>

           <tr><td><br></td></tr>
          <tr>
             <td colspan="6">
             <input type="button" Value="Guardar" class="boton" onclick="chequearcampos()">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
         </tr>
     </table>
  </form>
<?
else:
      include("../conexion.php");
      if($admon!=''):
	   $conM="select memorando.*,memorando.fechap,concat(nomemple,' ',nomemple1,' ',apemple,' ',apemple1)as empleado from memorando,empleado
	    where empleado.cedemple=memorando.cedemple and
                  empleado.cedemple='$cedula'";
	   $resulM=mysql_query($conM) or die("Error al busca empleados");
	   $reg=mysql_num_rows($resulM);
	   if($reg==0):
	      ?>
	      <script language="javascript">
	         alert("Este documento no presenta historia de registros o no esta autorizado para Modificarlo.")
	         history.back()
	      </script>
	      <?
	   else:
	     ?>
	      <center><h4><u>Proceso Disciplinario</u></h4></center>
              <input type="hidden" name="admon" value="<?echo $admon;?>">
	         <table border="0" align="center"
	         <tr><td><br></td></tr>
                 <tr>
                    <th>Item</th>
                    <th>Nro_Radicado</th>
                    <th>Empleado</th>
                    <th>F_Proceso</th>
                    <th>Motivo</th>
                    <th>Estado</th>
                 </tr>
                 <?$a=1;
                 while ($filas=mysql_fetch_array($resulM)):
                    ?>
                    <tr class="cajas">
                       <th><?echo $a;?></th>
                       <td><a href="Editar.php?nroradicado=<?echo $filas["radicado"];?>&FechaP=<?echo $filas["fechap"];?>&empleado=<?echo $filas["empleado"];?>&admon=<?echo $admon;?>"><?echo $filas["radicado"];?></a></td>
                       <td><?echo $filas["empleado"];?></td>
                       <td><?echo $filas["fecha"];?></td>
                       <td><?echo $filas["asunto"];?></td>
                       <td><?echo $filas["estado"];?></td>
                    </tr>
                 <?$a=$a+1;
               endwhile;
               ?>
	     </table>
             <?
	   endif;
       else:
           ?>
            <script language="javascript">
               alert("No tiene permiso para el registro.")
               history.back()
            </script>
          <?
       endif;
 endif;
        ?>
        </body>
</html>
