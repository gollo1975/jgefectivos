<html>
<head>
  <title>Entregas</title>
  <link rel="stylesheet" href="../estilo.css" type="text/css">
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
                            alert ("Digite el ducumento del Responsable");
                            document.getElementById("cedula").focus();
                            return;
                        }
                        document.getElementById("matelimi").submit();
                   }
                     function validar()
                    {
                        if (document.getElementById("responsable").value.length <=0)
                        {
                            alert ("Digite el nombre del resposable de la carpeta !");
                            document.getElementById("responsable").focus();
                            return;
                        }
                        if (document.getElementById("motivo").value.length <=0)
                        {
                            alert ("Digite el motivo del prestamo de la carpeta !");
                            document.getElementById("motivo").focus();
                            return;
                        }
                        document.getElementById("matentrega").submit();
                   }
    </script>
</head>
<body>
<?
if(!isset($cedula)):
?>
  <center><h4><u>Entrega Carpetas</u></h4></center>
  <form action="" method="post" >
    <table border="0" align="center">
    <tr><td><br></td></tr>
       <td><b>Tipo Busqueda:</b></td>
     <td><select name="cedula" class="cajas">
        <option value="0">Seleccione la Opción
        <option value="1">Cod_Empleado
        <option value="2">Documento
        </select></td>
   </tr>
   <tr>
     <td><b>Documento Empleado:</b></td>
     <td><input type="text" name="valor" value="" size="20" maxlength="20" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="valor"></td>
   </tr>
        <tr><td><br></td></tr>
        <tr>
        <td colspan="5">
        <input type="submit" value="Buscar" class="boton" ></td>
        </tr>
    </table>
  </form>
<?
elseif(empty($cedula)):
  ?>
   <script language="javascript">
      alert("Seleccione el tipo de busqueda ?");
      history.back()
   </script>
  <?
elseif(empty($valor)):
 ?>
   <script language="javascript">
      alert("Digite el dato a buscar en sistema ?");
      history.back()
   </script>
  <?
 else:
  include("../conexion.php");
  $opc=$cedula;
  switch($opc)
    {
    case 1:
  $con="select carpeta.* from carpeta
        where carpeta.codemple='$valor' and estado='ACTIVA'";
   break;
   case 2:
    $con="select carpeta.* from carpeta
        where carpeta.cedemple='$valor' and estado='ACTIVA'";
    break;
    }
  $res=mysql_query($con)or die("Error al busar datos");
  $reg=mysql_num_rows($res);
  if($reg!=0):
       ?>
       <script language="javascript">
          alert ("Esta carpeta no se encuenta en archivo por este documento?");
          history.back()
       </script>
       <?
    else:
	  $opc=$cedula;
	    switch($opc)
	    {
	      case 1:
			  $consulta = "select empleado.codemple,empleado.cedemple,zona.zona,concat(nomemple,' ',nomemple1,' ',apemple,' ',apemple1)'nombre', contrato.fechainic, contrato.fechater from empleado inner join zona on empleado.codzona=zona.codzona inner join contrato on empleado.codemple = contrato.codemple
where empleado.codemple='$valor' and contrato.fechainic = (select max(fechainic) from contrato where codemple = '$valor' and empleado.codemple = contrato.codemple);";
	        /*$consulta="select empleado.codemple,empleado.cedemple,zona.zona,concat(nomemple,' ',nomemple1,' ',apemple,' ',apemple1) as nombre from empleado,zona
	        where empleado.codzona=zona.codzona and
	         empleado.codemple='$valor'";*/
	        break;
	      case 2:
		  	$consulta = "select empleado.codemple,empleado.cedemple,zona.zona,concat(nomemple,' ',nomemple1,' ',apemple,' ',apemple1)'nombre', contrato.fechainic, contrato.fechater from empleado inner join zona on empleado.codzona=zona.codzona inner join contrato on empleado.codemple = contrato.codemple
where empleado.cedemple='$valor' and contrato.fechainic = (select max(fechainic) from contrato where cedemple = '$valor' and empleado.codemple = contrato.codemple);";
	       /*$consulta="select empleado.codemple,empleado.cedemple,zona.zona,concat(nomemple,' ',nomemple1,' ',apemple,' ',apemple1) as nombre from empleado,zona
	        where empleado.codzona=zona.codzona and
	        empleado.cedemple='$valor'";*/
	        break;
	     }
	    $resultado=mysql_query($consulta)or die ("Error al buscar datos");
	    $registro=mysql_num_rows($resultado);
	    $filas=mysql_fetch_array($resultado);
	    if ($registro==0):
	       ?>
	       <script language="javascript">
	          alert ("No existe datos en la busqueda de información ?")
	          history.back()
	       </script>
	       <?
	    else:
	       ?>
	       <center><h4><u>Entrega Carpetas</u></h4></center>
	       <form action="grabarCarpeta.php" method="post" id="matentrega">
	           <table width="509" border="0" align="center">
	              <tr><td width="121"><br></td></tr>
	              <tr>
	               <td><b>Código:&nbsp;</b></td>
	              <td width="374"><input type="text" name="codigoE" value="<?echo $filas["codemple"];?>"class="cajas" size="5" maxlength="5" readonly onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="codigo"></td>
	              </tr>
	              <tr>
	               <td><b>Documento:&nbsp;</b></td>
	              <td><input type="text" name="documento" value="<?echo $filas["cedemple"];?>" class="cajas" size="15" maxlength="15" readonly onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="documento"></td>
	              </tr>
	              <tr>
	               <td><b>Empleado:&nbsp;</b></td>
	              <td><input type="text" name="nombre" value="<?echo $filas["nombre"];?>" class="cajas" size="51" maxlength="51" readonly onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="nombre"></td>
	              </tr>
	              <tr>
	                <td><strong>Fecha Inicio:</strong></td>
	                <td><input type="text" name="fechainic" value="<?echo $filas["fechainic"];?>" class="cajas" size="15" maxlength="10" readonly onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="fechainic"></td>
                 </tr>
	              <tr>
	                <td><strong>Fecha Terminaci&oacute;n:</strong></td>
	                <td><input type="text" name="fechater" value="<?echo $filas["fechater"];?>" class="cajas" size="15" maxlength="10" readonly onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="fechater"></td>
                 </tr>
	              <tr>
	               <td><b>Zona:&nbsp;</b></td>
	              <td><input type="text" name="zona" value="<?echo $filas["zona"];?>" class="cajas" size="51" maxlength="51" readonly onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="zona"></td>
	              </tr>
	               <tr>
	               <td><b>Responsable:&nbsp;</b></td>
	              <td><input type="text" name="responsable" value="" class="cajas" size="51" maxlength="51" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="responsable"></td>
	              </tr>
	               <tr>
	                   <td><b>Motivo:</b></td>
	                   <td colspan="9"><textarea name="motivo" cols="50" rows="4" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="motivo"></textarea></td></tr>
	               <tr>
	              <tr><td><br></td><tr>
	               <tr>
	           <td colspan="2">
	           <input type="button" Value="Aceptar" class="boton" onClick="validar()">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
	           </tr>
	           </table>
</form>
	       <?
         endif;
   endif;
 endif;
?>
</body>

</html>
