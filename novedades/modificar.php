<html>

<head>
<title>Modificar Novedades de Nomina</title>
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
                         if (document.getElementById("cedula").value == 0)
                        {
                            alert ("Digite el Documento del Empleado ?");
                            document.getElementById("cedula").focus();
                            return;
                        }

                       document.getElementById("matnove").submit();
                    }
                   </script>
</head>
<body>

<?
if (empty($cedula)):
?>
<center><h4><u>Datos Modificar</u></h4></center>
  <form  action="" method="post" id="matnove">
    <table border="0" align="center">
      <tr>
        <td colspan="2" class="fondo"></td>
      </tr>
       <tr><td><br></td></tr>
        <tr>
                <td><b>Desde:</b></td>
                <td><input type="text" name="desde" value="<? echo date("Y-m-d");?>" size="11" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="desde" class ="cajas">
                <td colspan="1"><b>Hasta:</b></td>
                <td><input type="text" name="hasta" value="<? echo date("Y-m-d");?>" size="11" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="hasta" class ="cajas">
            </tr>
       <tr>
        <td><b>Documento:</b></td>
         <td><input type="text" name="cedula" value="" size="15" maxlength="15" onFocus="ColorFoco(this.id)" onlblur="QuitarFoco(this.id)" id="cedula"></td>
       </tr>
              <tr><td><br></td></tr>
    <tr>
         <td colspan="2">
           <input type="button" value="Buscar" class="boton" onclick="chequearcampos()">
           <input type="reset" value="Limpiar"class="boton"> </td>
       </tr>

    </table>
    <br>
    
  </form>
  <?
else:
   include("../conexion.php");
   $con = "select novedadindividual.* from novedadindividual,empleado where
           empleado.cedemple = novedadindividual.cedemple and
           novedadindividual.desde='$desde' and novedadindividual.hasta='$hasta' and
           empleado.cedemple='$cedula'";
   $result3 = mysql_query ($con) or die ("Error de Busqueda");
   $reg = mysql_num_rows($result3);
   if ($reg==0):
       ?>
       <script language="javascript">
          alert("Este empleado No tiene novedades en este periodo de Fechas ?");
          history.back()
       </script>
       <?
   else:
    while($filas=mysql_fetch_array($result3)):
       $nota=$filas["nota"];
       ?>
        <center><h4>Modificar Novedades de Nomina</h4></center>
          <form action="grabarmodificar.php"  method="post">
           <table border="0" align="center">
            <tr>
                <td><br></td>
            </tr>
            <tr>
                <td><b>Documento</b></td>
                <input type="hidden" name="codnovedad" value="<?echo $filas["codnovedad"];?>" size="10">
                <td><input type="text" name="cedula" value="<?echo $cedula?>" readonly="yes" size="12" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula" class ="cajas"></td>
                <td><b>Fecha_Proceso:</b></td>
                <td ><input type="text" name="fechap" value="<?echo $filas["fechap"];?>" readonly="yes" size="11" class ="cajas"></td>
            </tr>
            <tr>
                <td><b>Empleado:</b></td>
                <td colspan="5"> <input type="text" name="nombre" value="<?echo $filas["nombre"];?>" readonly="yes" size="54.5" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nombre" class="cajas" ></td>
            </tr>
            <tr>
                <td><b>Cod_Zona:</b></td>
                <td colspan="5"><input type="text" name="codzona" value="<?echo $filas["codzona"];?>" size="3" maxlength="3" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codzona" readonly=yes class ="cajas">
                <input type="text" name="zona" value="<?echo $filas["zona"];?>" size="48" maxlength="48" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="zona" readonly=yes class ="cajas">
            </tr>
            <tr>
                <td><b>Desde</b></td>
                <td><input type="text" name="desde" value="<?echo $filas["desde"];?>" size="11" maxlength="9" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="desde" class ="cajas">
                <td colspan="1"><b>Hasta:</b></td>
                <td><input type="text" name="hasta" value="<?echo $filas["hasta"];?>" size="11" maxlength="9" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="hasta" class ="cajas">
            </tr>
             <tr>
                <td><b>Observación:</b></td>
                <td colspan="5"><textarea   name="observacion"  cols="60" rows="5"  class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="observacion"><?echo $filas["nota"];?></textarea></td>
             <tr>
            <tr><td><br></td></tr>
            <tr>
                <td colspan="2"><input type="submit" Value="Guardar" class="boton"></td>
            </tr>
        </table>
        </form>
     <?
    endwhile;
endif;

endif;
