<html>

<head>
<title>Novedades de Nomina</title>
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

                       document.getElementById("matnovedad").submit();
                    }
                   </script>
</head>
<body>

<?
if (empty($cedula)):
?>
<center><h4>Ingreso de Novedades</h4></center>
  <form  action="" method="post" id="matnovedad">
    <table border="0" align="center">
      <tr>
        <td colspan="2" class="fondo"></td>
      </tr>
       <tr><td><br></td></tr>
        <tr>
                <td><b>Desde:</b></td>
                <td><input type="text" name="desde" value="<? echo $desde;?>" size="11" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="desde" class ="cajas">
                <td colspan="1"><b>Hasta:</b></td>
                <td><input type="text" name="hasta" value="<? echo $hasta;?>" size="11" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="hasta" class ="cajas">
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
    $estado=0;
    $consulta = "select empleado.nomina,concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' , apemple1) as nombre,zona.codzona,zona.zona from empleado,zona where zona.codzona=empleado.codzona and empleado.cedemple='$cedula'";
    $result = mysql_query ($consulta) or die ("Error en la consulta [nomina]");
   if (mysql_num_rows($result) > 0):
        $consulta = "select contrato.fechater from contrato,empleado where
                    empleado.codemple = contrato.codemple and empleado.cedemple='$cedula' and contrato.fechater='0000-00-00'";
        $result2 = mysql_query ($consulta);
        $aux = mysql_fetch_array($result2);
        if ($aux['fechater'] != '0000-00-00'):
              ?>
               <script language="javascript">
                 alert("Este empleado se encuentra retirado del sistema") ;
                 open("cargar.php","_self");
               </script>
            <?
        else:
            $nomina = mysql_fetch_array($result);
            if ($nomina['nomina'] != "SI"):
                ?>
                   <script language="javascript">
                     alert("Este empleado No pertenece al sistema de Nomina ?");
                    history.back()
                   </script>
                <?
             else:
                $con = "select novedadnomina.desde from novedadnomina,empleado where
                     empleado.cedemple = novedadnomina.cedemple and
                     novedadnomina.desde='$desde' and novedadnomina.hasta='$hasta' and
                     empleado.cedemple='$cedula'";

                $result3 = mysql_query ($con) or die ("Error de Busqueda");
                $filas = mysql_affected_rows();
                if($filas==0):
                   $estado=1;
                else:
                  ?>
                   <script language="javascript">
                     alert("Este empleado ya se le cargo la Novedad de la Nomina ?");
                     history.back()
                   </script>
                <?
                endif;
             endif;
        endif;
    else:
        ?>
       <script language="javascript">
             alert("La Cédula ingresada no existe en la Base de Datos")
               history.back()
       </script>
        <?
     endif;
    if ($estado == 1):
    $fechap=date("Y-m-d");
      ?>
        <center><h4>Ingreso de Novedades de Nomina</h4></center>
          <form action="grabar.php"  method="post">
            <input type="hidden" name="fechap" value="<? echo $fechap;?>" size="11">

        <table border="0" align="center">
            <tr>
                <td><br></td>
            </tr>
            <tr>
                <td><b>Documento</b></td>
                <td ><input type="text" name="cedula" value="<?echo $cedula?>" readonly="yes" size="12" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula" class ="cajas"></td>
            </tr>
            <tr>
                <td><b>Empleado:</b></td>
                <td colspan="5"> <input type="text" name="nombre" value="<?echo $nomina["nombre"];?>" readonly="yes" size="54.5" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nombre" class="cajas" ></td>
            </tr>
            <tr>
                <td><b>Cod_Zona:</b></td>
                <td colspan="5"><input type="text" name="codzona" value="<?echo $nomina["codzona"];?>" size="3" maxlength="3" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codzona" readonly=yes class ="cajas">
                <input type="text" name="zona" value="<?echo $nomina["zona"];?>" size="48" maxlength="48" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="zona" readonly=yes class ="cajas">
            </tr>
            <tr>
                <td><b>Desde</b></td>
                <td><input type="text" name="desde" value="<? echo $desde;?>" size="11" maxlength="9" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="desde" class ="cajas">
                <td colspan="1"><b>Hasta:</b></td>
                <td><input type="text" name="hasta" value="<? echo $hasta;?>" size="11" maxlength="9" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="hasta" class ="cajas">
            </tr>
                     <tr>
                        <td><b>Observación:</b></td>
                        <td colspan="5"><textarea name="observacion" value="" cols="60" rows="5" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="observacion"></textarea></td></tr>
                     <tr>
            <tr><td><br></td></tr>
            <tr>
                <td colspan="2"><input type="submit" Value="Guardar" class="boton">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
            </tr>
        </table>
        </form>
   <?
endif;

endif;
