<html>

<head>
<title>Sistema de créditos</title>
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

                    var solicitado = 0;
                    var aporte = 0;
                    var interes = 0;
                    function generarInteresMensual()
                    {
                        solicitado = document.getElementById("vlrsolicitado").value;
                        aporte = document.getElementById("vlrinteres").value;
                        interes = ((solicitado * aporte) / 100);
                        document.getElementById("interesmensual").value = interes.toFixed(0);
                    }

                   var intMensual = 0;
                   var intDia = 0;
                   var plazo = 0;
                   var intTotal = 0;
                    function generarInteresTotal()
                    {
                        intMensual = document.getElementById("interesmensual").value;
                        intDia = intMensual / 30;
                        plazo =  document.getElementById("plazo").value;
                        intTotal = intDia * plazo;
                        document.getElementById("totalinteres").value = intTotal.toFixed(0);
                        aux = parseFloat(document.getElementById("vlrsolicitado").value) + intTotal;
                        document.getElementById("total").value = aux.toFixed(0);
                    }

                    function getRadioButtonSelectedValue(ctrl)
                    {
                        for(i=0;i<ctrl.length;i++)
                        {
                            if(ctrl[i].checked)
                                return ctrl[i].value;
                        }
                    }

                    function generarCuota(texto)
                    {

                        totalcredito = document.getElementById("total").value;
                        dias = document.getElementById("plazo").value;
                        valordia = totalcredito / dias;
                        if (texto =="SEMANAL")
                        {
                            aux =valordia * 7
                           document.getElementById("cuota").value = aux.toFixed(0) ;
                        }
                        if (texto =="DECADAL")
                        {
                            aux =valordia * 10
                           document.getElementById("cuota").value = aux.toFixed(0) ;
                        }
                        if (texto =="CATORCENAL")
                        {
                            aux =valordia * 14
                           document.getElementById("cuota").value = aux.toFixed(0) ;
                        }
                        if (texto == "QUINCENAL")
                        {
                            aux = valordia * 15
                            document.getElementById("cuota").value = aux.toFixed(0) ;
                        }
                        if (texto =="MENSUAL")
                        {
                            aux =valordia * 30
                           document.getElementById("cuota").value = aux.toFixed(0) ;
                        }

                    }
                    function validar()
                    {
                         if (document.getElementById("cedula").value <= 0)
                        {
                            alert ("Favor digite el documento de identidad del empleado!");
                            document.getElementById("cedula").focus();
                            return;
                        }
                     document.getElementById("matE").submit();
                    }

                    function chequearcampos()
                    {
                         if (document.getElementById("vlrsolicitado").value == 0)
                        {
                            alert ("El campo Valor Solicitado no puede ser cero");
                            document.getElementById("vlrsolicitado").focus();
                            return;
                        }

                        if (document.getElementById("plazo").value == 0)
                        {
                            alert ("El campo Plazo no puede ser cero");
                            document.getElementById("plazo").focus();
                            return;
                        }


                       document.getElementById("matriculas").submit();
                    }



                   </script>
</head>
<body>

<?
if (empty($cedula)):
include("../conexion.php");
?>
<center><h4><u>Crear Prestamo</u></h4></center>
  <form  action="" method="post" id="matE">
    <table border="0" align="center">
       <tr><td><br></td></tr>
       <tr>
        <td><b>Documento de Identidad:</b></td>
         <td><input type="text" name="cedula" id="cedula" size="16" maxlength="13"  class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
       </tr>
       <tr>
                <td><b>Tipo_Alianza</b></td>
                <td><select name="codsalario" class="cajas">
                <option value="0">Seleccione la alianza
                <?
                $consulta = "select codsala,desala from salario where salario.egreso='SI' order by codsala";
                $result = mysql_query ($consulta) or die ("Error en la consulta");
                while($linea=mysql_fetch_array($result))
                {
                ?>
                  <option value="<?echo $linea["codsala"];?>"><?echo $linea["codsala"];?>-<?echo $linea["desala"];?>
                <?
                 }
                 ?></select></td>
            </tr>
              <tr><td><br></td></tr>
    <tr>
         <td colspan="2">
           <input type="button" value="Buscar" class="boton" onclick="validar()">
           <input type="reset" value="Limpiar"class="boton"> </td>
       </tr>

    </table>
    <br>
    
  </form>
  <?
elseif(empty($codsalario)):
 ?>
               <script language="javascript">
                 alert("Seleccion la alianza de la lista de convenios!") ;
                 history.back();
               </script>
            <?
else:
    include("../conexion.php");
    /*consulta que permite validar los item de salario*/
    $conP="select salario.codsala,salario.desala,salario.sumarcupo,salario.prestacion,salario.control,salario.insertar from salario where salario.codsala='$codsalario'";
    $resP=mysql_query($conP)or die("error al consultar salarios");
    $regP=mysql_num_rows($resP);
    $filas_S=mysql_fetch_array($resP);
    $SumarCupo=$filas_S["sumarcupo"];
    $Concepto=$filas_S["desala"];
    $Prestacion=$filas_S["prestacion"];
    $Estado=$filas_S["control"];
    $Datos=$filas_S["insertar"];
    /*fin de codigo*/
    $estado = false;
    $consulta = "select nomina, concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' , apemple1) as fullname from empleado where cedemple='" . $cedula . "'";
    $result = mysql_query ($consulta) or die ("Error en la consulta [nomina]");
    if (mysql_num_rows($result) > 0):
        $conT = "select zona.zona from empleado,zona,sucursal,maestro
        where maestro.codmaestro=sucursal.codmaestro and
              sucursal.codsucursal=zona.codsucursal and
              zona.codzona=empleado.codzona and
              zona.bloqueo='NO' and
              empleado.cedemple='$cedula'";
        $resuT = mysql_query ($conT);
        $RegT=mysql_num_rows($resuT);
        if($RegT!=0):

	        $consulta = "select contrato.fechater from contrato, empleado
	         where empleado.codemple = contrato.codemple and
	              contrato.fechater='0000-00-00' and
	              empleado.cedemple='$cedula'";
	        $result2 = mysql_query ($consulta);
	        $aux = mysql_fetch_array($result2);
	        if ($aux['fechater'] != '0000-00-00'):
	                ?>
	               <script language="javascript">
	                 alert("Este empleado se encuentra retirado del sistema") ;
	                 history.back();
	               </script>
	            <?
	        else:
	            $nomina = mysql_fetch_array($result);
	            if ($nomina['nomina'] == "SI"):
	                $consulta = "select novedad from novedad where cedemple='$cedula' and estado='ACTIVO'";
	                $nombre = $nomina['fullname'];
	                mysql_free_result($result2);
	                $result2 = mysql_query($consulta);
	                if (mysql_num_rows($result2) > 0 ):
	                    $aux = mysql_fetch_array($result2);
	                    echo "<script language=\"javascript\">";
	                    echo "alert(\"" . $aux['novedad'] . "\");";
	                    echo "history.back()";
	                    echo "</script>";
	                else:
                            $conC= "select credito.codsala from credito
			    where credito.codsala='$codsalario' and
			          credito.cedemple='$cedula' and
                                  credito.nuevo > 0";
			    $resuC = mysql_query ($conC);
                            $Dato = mysql_num_rows($resuC);
                            if($Dato != 0){
                                 ?>
			         <script language="javascript">
			                 alert("Un empleado no puede tener dos creditos de la misma linea!!") ;
			                 history.back();
			         </script>
                                 <?
                            }else{
                              $estado=true;
                            }
	                endif;
	            else:
	                 ?>
	                   <script language="javascript">
	                     alert("Este empleado no está autorizado para sacar créditos");
	                     history.back()
	                   </script>
	                <?
	            endif;
                endif;
         else:
             ?>
	     <script language="javascript">
	        alert("Debe de solicitar autorización en gerencia para ingresar el registro!");
	        history.back()
	     </script>
	      <?
         endif;
    else:
        ?>
       <script language="javascript">
             alert("La Cédula ingresada no existe en la Base de Datos")
             history.back()
       </script>
        <?
    endif;
    if ($estado == true):
    ?>
        <center><h4><u>Crear Prestamo</u></h4></center>
        <form action="guardarcredito.php"  method="post" id="matriculas">
        <input type="hidden" name="codsalario" value="<?echo $codsalario?>">
        <input type="hidden" name="SumarCupo" value="<?echo $SumarCupo?>">
        <input type="hidden" name="Estado" value="<?echo $Estado?>">
        <input type="hidden" name="Datos" value="<?echo $Datos?>">
        <input type="hidden" name="Prestacion" value="<?echo $Prestacion?>">
        <input type="hidden" name="Concepto" value="<?echo $Concepto?>">
        <table border="0" align="center">
            <tr>
                <td><br></td>
            </tr>
            <tr>
                <td><b>Documento</b></td>
                <td ><input type="text" name="cedula" value="<?echo $cedula?>" readonly="yes" size="12" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula" class ="cajas"></td>
            </tr>
            <tr>
                <td><b>Nombre Completo</b></td>
                <td> <input type="text" value="<?echo $nombre?>" name="nombres" readonly="yes" size="50" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" class="cajas" id="nombres" ></td>
            </tr>
            <tr>
                <td><b>Tipo de Crédito</b></td>
                <td><select name="tipoc" class="cajas">
                <?
                $consulta = "select tipocre, descripcion from tipo order by descripcion";
                $result = mysql_query ($consulta) or die ("Error en la consulta");
                while($linea=mysql_fetch_array($result))
                {
                ?>
                  <option value="<?echo $linea["tipocre"];?>"><?echo $linea["descripcion"];?>
                <?
                 }
                 ?></select></td>
            </tr>
            <tr>
              <tr>
                <td><b>Alianza</b></td>
                <td><input type="text" name="desala" value="<?echo $filas_S["desala"];?>" size="50"  readonly onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id);document.getElementById('vlrentregado').value = document.getElementById('vlrsolicitado').value;" id="desala" class ="cajas">
            </tr>
            </tr>
            <tr>
                <td><b>Valor Solicitado</b></td>
                <td><input type="text" name="vlrsolicitado" value="" size="12" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id);document.getElementById('vlrentregado').value = document.getElementById('vlrsolicitado').value;" id="vlrsolicitado" class ="cajas">
            </tr>
            <tr>
                <td><b>Aportes</b></td>
                <td><input type="text" name="vlrinteres" value="" size="12" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id);generarInteresMensual();" id="vlrinteres" class ="cajas">

            </tr>
            <tr>
                <td><b>Interes Mensual</b></td>
                <td><input type="text" readonly = "yes" name="interesmensual" value="" size="12" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="interesmensual" class ="cajas">
            </tr>
             <tr>
                <td><b>Plazo</b></td>
                <td><input type="text" name="plazo" value="" size="6" maxlength="5" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id);generarInteresTotal();" id="plazo" class ="cajas"> días </td>
            </tr>
             <tr>
                <td><b>Tot. Interes</b></td>
                <td><input type="text" readonly="yes" name="totalinteres" value="" size="12" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="totalinteres" class ="cajas">
            </tr>

             <tr>
                <td><b>Valor Entregado</b></td>
                <td><input type="text" name="vlrentregado" readonly="yes" value="" size="12" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="vlrentregado" class ="cajas">
            </tr>
             <tr>
                <td><b>Forma de Pago</b></td>
                <td><input type="radio" name="fpago" id="fpago" value="SEMANAL" onclick="generarCuota(getRadioButtonSelectedValue(fpago));">Semanal<input type="radio" name="fpago" id="fpago" value="DECADAL" onclick="generarCuota(getRadioButtonSelectedValue(fpago));">Decadal<input type="radio" name="fpago" id="fpago" value="CATORCENAL" onclick="generarCuota(getRadioButtonSelectedValue(fpago));">Catorcenal<input type="radio" name="fpago" id="fpago" value="QUINCENAL" onclick="generarCuota(getRadioButtonSelectedValue(fpago));">Quincenal <input type="radio" name="fpago" id="fpago" value="MENSUAL" onclick="generarCuota(getRadioButtonSelectedValue(fpago))">Mensual   </td>
            </tr>
             <tr>
             <td><b>Cuota</b></td>
                <td><input type="text" name="cuota" value="" size="12" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cuota" class ="cajas">
            </tr>
            <tr>
            <td><b>Total Crédito</b></td>
                <td><input type="text" name="total" readonly="yes" value="" size="12" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="total" class ="cajas">
            </tr>
            <tr><td><br></td></tr>
            <tr>
                <td colspan="2"><input type="button" Value="Guardar" class="boton" onclick="chequearcampos()">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
            </tr>
        </table>
        </form>



    <?
   endif;
endif;
