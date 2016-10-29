<?
 session_start();
?>
<html>
<head>
<title>Modificacion de contrato</title>
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
                        if (document.getElementById("fechainic").value.length <=0)
                        {
                            alert ("El campo FECHA INICIO no puede estar vacío");
                            document.getElementById("fechainic").focus();
                            return;
                         }   
                          document.getElementById("concotra").submit();
                    }

                   </script>
</head>
<body>
<?
 if(session_is_registered("xsession")):
   include("../conexion.php");
   $con="select dato.contrato from dato
     where dato.contrato='$contrato'";
    $res=mysql_query($con)or die("Consulta incorrecta");
    $reg=mysql_num_rows($res);
    if($reg==0):
	    $consulta="select contrato.*,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 ,empleado.cedemple from empleado,contrato
	     where empleado.codemple=contrato.codemple and
	             contrato.contrato='$contrato'";
	    $resultado=mysql_query($consulta)or die("Consulta incorrecta");
	    $registro=mysql_num_rows($resultado);
	     while($filas=mysql_fetch_array($resultado)):

	       ?>
	       <center><h4><u>Crear Observaciones</u></h4></center>
	         <form action="guardarnota.php" method="post" id="concontra">
	           <table border="0" align="center">
	             <tr><td><br></td></tr>
	             <tr>
	               <td><b>Nro_contrato:</b></td>
	               <td><input type="text" value="<?echo $filas["contrato"];?>" name="contrato" size="6" class="cajas" readonly></td>
	             </tr>
	              <tr>
	               <td ><b>Documento:</b></td>
	               <td class="cajas"><input type="text" name="cedemple" value="<?echo $filas["cedemple"];?>" class="cajas" size="15" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedemple"></td>
	             <tr>
	             <tr>
	               <td ><b>Empleado:</b></td>
	               <td class="cajas"><input type="text" name="nombre" value="<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?>" class="cajas" size="50" readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nombre"></td>
	             <tr>
	               <td><b>Fecha_Inicio:</b></td>
	               <td><input type="text" value="<?echo $filas["fechainic"];?>"name="fechainic" size="15" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" readonly id="fechainic"></td>
	             </tr>
	              <tr>
	               <td><b>Cargo:</b></td>
	               <td><input type="text" value="<?echo $filas["cargo"];?>" name="cargo"size="40" class="cajas"maxlength="40"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" readonly id="cargo"></td>
	             </tr>
	             <tr>
	               <td><b>Observaciones:</b></td>
	               <td><textarea name="nota" cols="50" rows="8"class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nota" ></textarea></td>
	             </tr>
	              <tr>
	               <td colspan="2">
	                 <input type="submit" value="Guardar" class="boton">
	                 <input type="reset" value="Limpiar"class="boton">
	               </td>
	              </tr>
	            <?
	            endwhile;
       else:
         ?>
           <script language="javascript">
             alert("Este contrato ya tiene la observación de retiro ?")
             history.back()
           </script>
         <?
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
     </table>
     </form>
</body>
</html>
