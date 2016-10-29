<html>
<head>
<title>Ingreso de Curso cooperativismo</title>
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
                      function chequear()
                    {
                        if (document.getElementById("cedula").value.length <=0)
                        {
                            alert ("Digiete el documento del empleado");
                            document.getElementById("cedula").focus();
                            return;
                        }
                        document.getElementById("matinicio").submit();

                    }

                    function chequearcampos()
                    {
                        if (document.getElementById("fechag").value.length <=0)
                        {
                            alert ("El campo FECHA GRABADO no puede estar vacío");
                            document.getElementById("fechag").focus();
                            return;
                        }
                        if (document.getElementById("fechar").value.length <=0)
                        {
                            alert ("El campo FECHA REALIZO no puede estar vacío");
                            document.getElementById("fechar").focus();
                            return;
                        }
                        if (document.getElementById("puntaje").value.length <=0)
                        {
                            alert ("El campo PUNTAJE no puede estar vacío");
                            document.getElementById("puntaje").focus();
                            return;
                        }
                        document.getElementById("matcurso").submit();

                    }
                </script>
</head>
<body>
<?
if (empty($cedula)):

?>
<center><h4><u>Matricular Curso</u><h4></center>
  <form action="" method="post" id="matinicio">
    <table border="0" align="center">
     <tr><td><br></td></tr>
     <tr>
       <td><b>Documento de Identidad:</b></td>
       <td><input type="text" name="cedula"  size="15" maxlength="15" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
    <tr>
    <tr><td><br></td></tr>
        <tr>
         <td colspan="2">
           <input type="button" value="Guardar" class="boton" onclick="chequear()">
           <input type="reset" value="Limpiar" class="boton">
         </td>
       </tr>
       <tr><td><br></td></tr>
   </table>
 </form>
<?else:
   include("../conexion.php");
   $con="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado where empleado.cedemple='$cedula'";
   $res=mysql_query($con)or die("Error al buscar curso");
   $reg=mysql_num_rows($res);
   $fila=mysql_fetch_array($res);
   if($reg!=0):
	   $consulta1="select curso.cedemple from curso where curso.cedemple='$cedula'";
	   $resultado1=mysql_query($consulta1)or die("Error al buscar curso");
	   $registro=mysql_num_rows($resultado1);
	   if ($registro==0):
	     ?>
	     <center><h4><u>Matricular Curso</u><h4></center>
	      <form action="grabarcurso.php" method="post"id="matcurso" id="matcurso">
	        <table border="0" align="center">
	        <tr><td><br></td></tr>
	          <tr>
		       <td><b>Documento:</b></td>
		       <td><input type="text" name="cedula"  value="<?echo $cedula;?>" size="15"  class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula" readonly></td>
		    <tr>
		    <tr>
		       <td><b>Empleado:</b></td>
		       <td><input type="text" name="nombres"  value="<?echo $fila["nomemple"];?>&nbsp;<?echo $fila["nomemple1"];?>&nbsp;<?echo $fila["apemple"];?>&nbsp;<?echo $fila["apemple1"];?>"size="45"  class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nombres" readonly></td>
		    <tr>
		      <td><b>Fecha_Grabado:</b></td>
		       <td><input type="text" name="fechag" value="<?echo date("Y-m-d");?>" size="10" maxlength="10"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fechag"></td>
		     </tr>
		     <tr>
		       <td><b>Fecha_Curso:</b></td>
		       <td><input type="text" name="fechar" value=" <?echo date("Y-m-d");?>" size="10" maxlength="10"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fechr"></td>
		     </tr>
		     <tr>
		       <td><b>Puntaje:</b></td>
		       <td><input type="text" name="puntaje" value="" size="10" maxlength="4"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="puntaje"></td>
		     </tr>
		     <tr>
		       <td><b>Proveedor:</b></td>
		          <td><select name="provedor" class="cajas">
		          <option value="0">Seleccione el Proveedor
		          <?
		            $consulta_p="select * from provedor order by nomprove ";
		            $resultado_p=mysql_query($consulta_p)or die ("Consulta incorrecta");
		            while($filas_p=mysql_fetch_array($resultado_p)):
		              ?>
		              <option value="<?echo $filas_p["nitprove"];?>"> <?echo $filas_p["nomprove"];?>
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
	         ?>
	         <script language="javascript">
	         alert("Este empleado ya hizo el curso de cooperativismo ?")
	         history.back()
	         </script>
	         <?
	       endif;
        else:
          ?>
	         <script language="javascript">
	         alert("Este documento no existe en sistema ?")
	         history.back()
	         </script>
	         <?
       endif;
   endif;
     ?>
 </body>
</html>
