<html>

<head>
  <title>Bancos</title>
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
                        if (document.getElementById("codbanco").value.length <=0)
                        {
                            alert ("El campo CODBANCO no puede estar vacío");
                            document.getElementById("codbanco").focus();
                            return;
                        }
                        if (document.getElementById("bancos").value.length <=0)
                        {
                            alert ("El campo NOMBRE BANCO no puede estar vacío");
                            document.getElementById("bancos").focus();
                            return;
                        }
                        if (document.getElementById("dirbanco").value.length <=0)
                        {
                            alert ("El campo DIRECCION no puede estar vacío");
                            document.getElementById("dirbanco").focus();
                            return;
                        }
                        if (document.getElementById("telbanco").value.length <=0)
                        {
                            alert ("El campo TELEFONO no puede estar vacío");
                            document.getElementById("telbanco").focus();
                            return;
                        }
                         if (document.getElementById("municipio").value.length <=0)
                        {
                            alert ("El campo MUNICIPIO no puede estar vacío");
                            document.getElementById("municipio").focus();
                            return;
                        }

                      document.getElementById("matbanco").submit();

                    }
                </script>
</head>

<body>
<?
if (!isset($codbanco)):
?>
<center><h4><u>Matricular Bancos</u></h4></center>
<form action="" method="post"id="matbanco">
<table border="0" align="center">
  <tr><td><br></td></tr>
<tr>
    <td><b>Cód_Banco:</b></td>
    <td><input type="texto" name="codbanco" value="" size="40" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codbanco"></td>
 </tr>
 <tr>
    <td><b>Nombre_Ban:</b></td>
    <td><input type="texto" name="bancos" value="" size="40" maxlength="40" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="bancos"></td>
 </tr>
 <tr>
    <td><b>Dirección:</b></td>
    <td><input type="texto" name="dirbanco" value="" size="40" maxlength="40" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="dirbanco"></td>
 </tr>
 <tr>
    <td><b>Teléfono:</b></td>
    <td><input type="texto" name="telbanco" value="" size="40" maxlength="7" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="telbanco"></td>
 </tr>
 <tr>
    <td><b>Municipio:</b></td>
    <td><input type="texto" name="municipio" value="" size="40" maxlength="25" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="municipio"></td>
 </tr>
  <tr>
	<td><b>C_Nómina:</b></td>
	<td><select name="Convenio" class="cajasletra" id="Convenio" style="width: 258px">
	<option value="NO">SI		
	<option value="SI">NO
	</select></td>
	</tr>
   <tr><td><br></td></tr>
 <tr>
    <td colspan="2">
    <input type="button" value="Guardar" class="boton" onclick="chequearcampos()">
    <input type="reset" value="Limpiar"class="boton">
    </td>
  </tr>
  </table>
 </form>
 <?
   else:
    include("../conexion.php");
     $consulta="select * from banco where codbanco='$codbanco'";
     $resultado=mysql_query($consulta) or die ("consulta incorrecta");
     $registro=mysql_num_rows($resultado);
     if ($registro==0):
       $bancos=strtoupper($bancos);
       $dirbanco=strtoupper($dirbanco);
       $municipio=strtoupper($municipio);
       $consulta="insert into banco(codbanco,bancos,dirbanco,telbanco,municipio,nomina) values('$codbanco','$bancos',
       '$dirbanco','$telbanco','$municipio','$Convenio')";
       $resultado=mysql_query($consulta) or die("inserccion incorrecta");
    ?>
    <script language="javascript">
    alert("Registro almacenado correctamente ?")
   open("gbanco.php","_self")
     </script>
   <?
   else:
   ?>
    <script language="javascript">
    alert("El Registro, ya existe en la base de datos ?")
    open("gbanco.php","_self")
   </script>
   <?
   endif;
 endif;
?>

</body>

</html>
