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

                </script>
</head>
<body>
<?
if (empty($cedula)):

?>
<center><h4><u>Parámetro Pensión</u><h4></center>
  <form action="" method="post" id="matinicio">
    <table border="0" align="center">
     <tr><td><br></td></tr>
     <tr>
       <td><b>Documento de Identidad:</b></td>
       <td><input type="text" name="cedula"  size="15" maxlength="15" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
    <tr>
    <tr>
       <td><b>Tipo_Proceso:</b></td>
        <td><input type="radio" value="Agregar"  name="Estado">Agregar<input type="radio" value="Modificar"  name="Estado">Modificar</td>
    </tr>
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
<?elseif(empty($Estado)):
  ?>
	         <script language="javascript">
	         alert("Seleccione el tipo de proceso a realizar!")
	         history.back()
	         </script>
	         <?
else:
   include("../conexion.php");
   $con="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado where empleado.cedemple='$cedula' and empleado.pagarp='NO'";
   $res=mysql_query($con)or die("Error al buscar curso");
   $reg=mysql_num_rows($res);
   $fila=mysql_fetch_array($res);
   if($reg!=0):
	   $consulta1="select parametropension.* from parametropension where cedemple='$cedula'";
	   $resultado1=mysql_query($consulta1)or die("Error al buscar curso");
	   $registro=mysql_num_rows($resultado1);
           $fila_m=mysql_fetch_array($resultado1);
           $CodA=$fila_m["codsala"];
	   if ($registro==0):
	     ?>
	     <center><h4><u>Parámetro Pensión</u><h4></center>
	      <form action="GrabarParametro.php" method="post">
	        <table border="0" align="center">
	        <tr><td><br></td></tr>
	          <tr>
		       <td><b>Documento:</b></td>
		       <td><input type="text" name="cedula"  value="<?echo $cedula;?>" size="15"  class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula" readonly></td>
		    </tr>
		    <tr>
		       <td><b>Empleado:</b></td>
		       <td><input type="text" name="nombres"  value="<?echo $fila["nomemple"];?>&nbsp;<?echo $fila["nomemple1"];?>&nbsp;<?echo $fila["apemple"];?>&nbsp;<?echo $fila["apemple1"];?>"size="45"  class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nombres" readonly></td>
		    </tr>
                      <tr>
			       <td><b>Cod_Salario:</b></td>
			          <td><select name="Codigo" class="cajas">
			          <option value="0">Seleccione el Item
			          <?
			            $consulta_p="select codsala,desala from salario where formapago='NINGUNA' order by codsala ";
			            $resultado_p=mysql_query($consulta_p)or die ("Consulta incorrecta");
			            while($filas_p=mysql_fetch_array($resultado_p)):
			              ?>
			              <option value="<?echo $filas_p["codsala"];?>"> <?echo $filas_p["desala"];?>
			              <?
			              endwhile;
			              ?></select></td>
			       </tr>
		       <tr><td><br></td></tr>
		        <tr>
		         <td colspan="2">
		           <input type="submit" value="Guardar" class="boton" ">
		           <input type="reset" value="Limpiar" class="boton">
		         </td>
		       </tr>
		      </table>

		     </form>
	   <?
	    else:
                if($Estado=='Modificar'):?>

                     <center><h4><u>Editar Parámetro</u><h4></center>
	             <form action="GrabarEditado.php" method="post">
                       <input type="hidden" name="CodSala"  value="<?echo $fila_m["codigo"];?>">
	               <table border="0" align="center">
	                    <tr><td><br></td></tr>
	                   <tr>
			       <td><b>Documento:</b></td>
			       <td><input type="text" name="cedula"  value="<?echo $cedula;?>" size="15"  class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula" readonly></td>
			    </tr>
			    <tr>
			       <td><b>Empleado:</b></td>
			       <td><input type="text" name="nombres"  value="<?echo $fila["nomemple"];?>&nbsp;<?echo $fila["nomemple1"];?>&nbsp;<?echo $fila["apemple"];?>&nbsp;<?echo $fila["apemple1"];?>"size="45"  class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nombres" readonly></td>
			    </tr>
                            <tr>
                     <td><b>Cod_Salario:</b></td>
                     <td>    <select name="Codigo"class="cajas">
                             <?
                             $consulta_c="select codsala,desala from salario where formapago='NINGUNA' order by codsala ";
                             $resultado_c=mysql_query($consulta_c) or die("consulta de Costo Incorrecta");
                             while ($filas_c=mysql_fetch_array($resultado_c)):
                                   if($CodA==$filas_c["codsala"]):
                                   ?>
                                      <option value="<?echo $filas_c["codsala"];?>" selected><?echo $filas_c["desala"];?>
                                   <?
                                   else:
                                   ?>
                                      <option value="<?echo $filas_c["codsala"];?>"><?echo $filas_c["desala"];?>
                                   <?
                                   endif;
                             endwhile;
                             ?>
                     </select></td>
		       </tr>
                       <tr>
                        <td><b>Estado:</b></td>
			                                          <td><select name="Estado" class="cajasletra">
			                                          <option value="<?echo $fila_m["estado"];?>" selected><?echo $fila_m["estado"];?>
			                                                <option value="ACTIVO">ACTIVO
			                                                <option value="INACTIVO">INACTIVO
			                                       </select></td>

                        </tr>
                             <tr><td><br></td></tr>
			        <tr>
			         <td colspan="2">
			           <input type="submit" value="Guardar" class="boton" ">
			           <input type="reset" value="Limpiar" class="boton">
			         </td>
			       </tr>
			      </table>

		     </form><?
                else:
	            ?>
	            <script language="javascript">
	                alert("Este empleado ya tiene el parametro creado, debe de modificarlo ?")
	                 history.back()
	             </script>
	             <?
                endif;
	   endif;
        else:
          ?>
	         <script language="javascript">
	         alert("Este documento no existe en sistema, o no esta habilitado para subir el parametro de Pensión!")
	         history.back()
	         </script>
	         <?
       endif;
   endif;
     ?>
 </body>
</html>
