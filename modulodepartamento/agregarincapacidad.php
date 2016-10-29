<html>
<head>
<title>Ingreso De Incapacidades</title>
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
                        if (document.getElementById("motivo").value.length <=0)
                        {
                            alert ("Digite el motivo de la incapacidad ");
                            document.getElementById("motivo").focus();
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
   <center><h4>Ingreso de Incapacidades</h4></center>
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
   $con="select empleado.nomemple,empleado.nomemple1,empleado.apemple1,empleado.apemple,eps.eps,eps.codeps from sucursal,zona,empleado,eps
       where sucursal.codsucursal=zona.codsucursal and
        zona.codzona=empleado.codzona and
        empleado.codeps=eps.codeps and
        sucursal.codsucursal='$codigo' and
        empleado.cedemple='$cedula'";
  $res=mysql_query($con)or die ("Error de busqueda de empleado");
   $reg=mysql_num_rows($res);
   $filas=mysql_fetch_array($res);
   if($reg!=0):
        ?>
         <div align="center"><h4>Matricular Incapacidades</h4></div>
          <form action="grabarincapacidad.php" method="post" id="matinc">
            <input type="hidden" name="codeps" value="<?echo $filas["codeps"];?>"></td>
            <input type="hidden" name="codigo" value="<?echo $codigo;?>"></td>
            <table border="0" align="center">
             <tr>
               <td colspan="2"><br></td>
              </tr>
              <tr>
               <td><b>Documento:</b></td>
               <td><input type="text" name="cedula" value="<?echo $cedula;?>" size="13" readonly ></td>
              </tr>
              <tr>
               <td><b>Emepleado:</b></td>
               <td><input type="text"  value="<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?>" size="47" class="cajas"readonly ></td>
              </tr>
             <tr>
               <td><b>Nro. Incapacidad:</b></td>
               <td><input type="text" name="nroinca" value="" size="10" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nroinca"></td>
             </tr>
             <tr>
               <td><b>Fecha Inicio:</b></td>
               <td><input type="text" name="fechaini" value="<?echo date("Y-m-d");?>" size="10" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fechaini"></td>
             </tr>
              <tr>
               <td><b>Fecha Termino:</b></td>
               <td><input type="text" name="fechater" value="<?echo date("Y-m-d");?>" size="10" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="fechater"></td>
             </tr>
             <tr>
               <td><b>Días:</b></td>
               <td><input type="text" name="dias" value="" size="10" maxlength="3" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="dias"></td>
             </tr>
             <tr>
              <td><b>Tipo_Incapacidad:</b></td>
                  <td><select name="tipo" class="cajas">
                  <option value="0">Seleccione La Descripción
                  <?
                    $consulta_t="select * from tipoinca order by concepto";
                    $resultado_t=mysql_query($consulta_t)or die ("Consulta de eps incorrecta");
                    while($filas_t=mysql_fetch_array($resultado_t)):
                      ?>
                      <option value="<?echo $filas_t["tipoinca"];?>"> <?echo $filas_t["concepto"];?>
                      <?
                      endwhile;
                      ?></select></td>
               </td>
               </tr>
                <tr>
               <td><b>Eps:</b></td>
               <td><input type="text"  name="eps" value="<?echo $filas["eps"];?>" size="25" class="cajas"readonly ></td>
              </tr>
               <td><b>Estado:</b></td>
               <td><select name="estado" class="cajas">
                   <option value="0">Seleccione el Estado
                   <option value="por cobrar">POR COBRAR
                   <option value="cancelada">CANCELADA
               </select></td>
             </tr>
             <tr>
              <td><b>Diagnóstico:</b></td>
                  <td><select name="diagnostico" class="cajas">
                  <option value="0">Seleccione el diagnostico
                  <?
                    $consulta_t="select control.codigo,control.concepto from control order by codigo";
                    $resultado_t=mysql_query($consulta_t)or die ("Consulta de codigo incorrecta");
                    while($filas_t=mysql_fetch_array($resultado_t)):
                      ?>
                      <option value="<?echo $filas_t["codigo"];?>"> <?echo $filas_t["codigo"];?>-<?echo $filas_t["concepto"];?>
                      <?
                      endwhile;
                      ?></select></td>
               </td>
               <tr>
               <td><b>Fecha_Proceso:</b></td>
               <td><input type="text" name="fechapro" value="<?echo date("Y-m-d");?>" size="10" maxlength="10"readonly></td>
             </tr>
              <tr>
               <td><b>Motivo:</b></td>
               <td><textarea name="motivo" cols="60" rows="8" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="motivo"></textarea></td>
             </tr>
             <tr><td><br></td></tr>
               <tr>
                 <td colspan="2">
                   <input type="button" value="Guardar" class="boton" onclick="chequearcampos()">
                   <input type="reset" value="Limpiar"  class="boton">
                 </td>
               </tr>
              </table>
        <?
        else:
           ?>
             <script language="javascript">
               alert("Este documento no existe en Sistema / o no esta autorizado para este ingreso  ?")
               history.back()
             </script>
           <?
         endif;
   endif;
   ?>
 </body>
</html>
