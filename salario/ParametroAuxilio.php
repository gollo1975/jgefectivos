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


                </script>
</head>
<body>
<?
if(!isset($Valor)):?>
  <center><h4><u>Parámetro Auxilio</u><h4></center>
	      <form action="" method="post">
	        <table border="0" align="center">
		    <tr>
		       <td><b>Valor:</b></td>
		       <td><input type="text" name="Valor"  value="" size="10" maxlength="10" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Valor"></td>
                        <td><b>Año:</b></td>
		       <td><input type="text" name="Ano"  value="" size="10" maxlength="10" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Ano"></td>
		    </tr>
                    <tr>
		       <td><b>Máximo:</b></td>
		       <td><input type="text" name="Maximo"  value="" size="10" maxlength="10" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Maximo"></td>
                        <td><b>Mínimo:</b></td>
		       <td><input type="text" name="Minimo"  value="" size="10" maxlength="10" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Minimo"></td>
		    </tr>
                    <tr>
                    <td><b>Estado:</b></td>
                                          <td><select name="Estado" class="cajasletra">
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

		     </form>
<?elseif(empty($Valor)):
    ?>
     <script language="javascript">
	 alert("Digite el valor del auxilio de Transporte!")
	 history.back()
    </script>
    <?
elseif(empty($Minimo)):
     ?>
     <script language="javascript">
	 alert("Digite el Salario Minimo legal Vigente !")
	 history.back()
    </script>
    <?
elseif(empty($Maximo)):
     ?>
     <script language="javascript">
	 alert("Digite la suma de los dos salarios minimos legales vigente!")
	 history.back()
    </script>
    <?
else:
include("../conexion.php");  
$fechaC=date("Y-m-d");
  $consulta="insert into parametroauxilio(valor,ano,maximo,minimo,estado,fechac)
             values('$Valor','$Ano','$Maximo','$Minimo','$Estado','$fechaC')";
             $resultado=mysql_query($consulta)or die("inserección incorrecta");
              $registro1=mysql_affected_rows();
             ?>
            <script language="javascript">
              alert("Registro Grabado con Exito en la Base de Datos ?")
              open("ParametroAuxilio.php","_self");
            </script>
            <?
endif;
?>
 </body>
</html>
