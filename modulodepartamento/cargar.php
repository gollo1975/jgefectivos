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
     function actualizarSaldo()
             {
               totalAutorizaciones = document.getElementById("tActualizaciones").value
               subtotal =0
               subtotal1 =0
               suma = 0
               suma1 = 0
               xpresta= 0
               tot = 0
               total=0
               eps=0
               pension=0
               aux=0
               var nEle = document.f1.elements.length;
              for (i=0; i<nEle; i++) {
               if (document.f1.elements[i].type=="checkbox" &&
	                document.f1.elements[i].name.lastIndexOf('datos')!=-1 ) {
			document.f1.elements[i].checked ? document.f1.elements[i].checked=false : document.f1.elements[i].checked=true;
	       }
	      }
               for (i=1;i<=totalAutorizaciones;i++)
               {
                    if (document.getElementById("datos[" + i+ "]").checked == true )
                    {
                        if(document.getElementById("vlrhora[" + i+ "]").value!=0)
                        {
                                suma = document.getElementById("vlrhora[" + i+ "]").value
                                suma1 = document.getElementById("nrohora[" + i+ "]").value
                                total = (suma * suma1);
                                document.getElementById("salario["+ i+"]").value= total.toFixed(0);
                        }
                           if (document.getElementById("prestacion[" + i+ "]").value=='SI')
                           {
                             xpresta = parseFloat(xpresta) + parseFloat(document.getElementById("salario[" + i+ "]").value);
                           }
                              subtotal = parseFloat(subtotal) + parseFloat(document.getElementById("salario[" + i+ "]").value);
                              if (document.getElementById("variacion[" + i+ "]").value=='VARIABLE')
                              {
                                 aux= parseFloat(document.getElementById("porcentaje[" + i+"]").value);
                                 eps = (-xpresta * aux)/100;
                                 document.getElementById("deduccion["+ i+ "]").value= eps.toFixed(0);
                               }

                    }
               }
           }
 /*     function cambiaChkBox() {
	var nEle = document.f1.elements.length;
	for (i=0; i<nEle; i++) {
   	if (document.f1.elements[i].type=="checkbox" &&
		 document.f1.elements[i].name.lastIndexOf('datos')!=-1 ) {
			document.f1.elements[i].checked ? document.f1.elements[i].checked=false : document.f1.elements[i].checked=true;
		 }
	}
}  */
</script>
 </script>
</head>
<body>
<?
$dia=substr($fechainic,8,2);
$calculo=substr($hasta,8,2);
$inicio=substr($desde,8,2);
$Tdias=($calculo-$inicio)+1;
$Tdias1=($calculo-$dia)+1;
$resta=($calculo-$dia)+1;
$Thora=($Tdias*8);
$ThoraInicio=($resta*8);
$aux=substr($fechainic,2,8);
$auxInicio=substr($desde,2,8);
  include("../conexion.php");
    $con = "select empleado.nomina,concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' , apemple1) as nombre,zona.codzona,zona.zona from empleado,zona,novedadnomina
         where zona.codzona=empleado.codzona and
             novedadnomina.codzona=zona.codzona and
             novedadnomina.desde='$desde' and
             novedadnomina.hasta='$hasta' and
             novedadnomina.cedemple='$cedula' and
             zona.codzona='$codigo' and
             empleado.cedemple='$cedula'";
            $resu= mysql_query ($con) or die ("Error en la consulta [nomina]");
            $registro=mysql_affected_rows();
            $fechap=date("Y-m-d");
            if($registro!=0):
               ?>
               <script language="javascript">
                 alert("Este empleado ya tiene la novedad en este corte de Fecha, Debe de Moficarla ?")
                 history.back()
               </script>
              <?
             else:
                  ?>
                <center><h4><u>Novedades de Nomina</u></h4></center>
                  <form action="grabar.php" name="f1"  method="post">
                    <input type="hidden" name="fechap" value="<? echo $fechap;?>" size="11">
                    <input type="hidden" name="desde" value="<? echo $desde;?>" size="11">
                    <input type="hidden" name="orden" value="<? echo $orden;?>" size="11">
                    <input type="hidden" name="hasta" value="<? echo $hasta;?>" size="11">
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
                        <td colspan="5"> <input type="text" name="nombre" value="<? echo $nombres;?>&nbsp;<? echo $apellidos;?>" readonly="yes" size="55" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nombre" class="cajas" ></td>
                    </tr>
                    <tr>
                        <td><b>Cod_Zona:</b></td>
                        <td colspan="5"><input type="text" name="codzona" value="<?echo $codigo;?>" size="3" maxlength="3" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codzona" readonly=yes class ="cajas">
                        <input type="text" name="zona" value="<?echo $zona;?>" size="55" maxlength="55" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="zona" readonly=yes class ="cajas">
                    </tr>
                   <tr>
                        <td><b>Desde</b></td>
                        <td><input type="text" name="desde" value="<? echo $desde;?>" size="11" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="desde" readonly=yesclass ="cajas">
                        <td colspan="1"><b>Hasta:</b></td>
                        <td><input type="text" name="hasta" value="<? echo $hasta;?>" size="11" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="hasta" readonly=yesclass ="cajas">
                  </tr>
                  <tr>
                       <?if($auxInicio>$aux):?>
		        <td><b>Dia_Pagar:</b></td>
		         <td><input type="text" name="diaspagar" value="<?echo $Tdias;?>"  size="5" class="cajas" readonly></td>
		         <td><b>Total_Horas:</b></td>
		         <td><input type="text" name="totalhora" value="<?echo $Thora;?>"  size="5" class="cajas" readonly></td>
		       </tr>
		     <?else:?>
		         <td><b>Dia_Pagar:</b></td>
		         <td><input type="text" name="diaspagar" value="<?echo $Tdias1;?>"  size="5" class="cajas" readonly></td>
		         <td><b>Total_Horas:</b></td>
		         <td><input type="text" name="totalhora" value="<?echo $ThoraInicio;?>"  size="5" class="cajas" readonly></td>
                     <?endif;?>
		       </tr>
                    <tr>
                        <td><b>Observación:</b></td>
                        <td colspan="5"><textarea name="observacion" value="" cols="60" rows="3" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="observacion"></textarea></td></tr>
                     <tr>
                    </table>
                   <table border="0" align="center" width="400">
		     <tr><td>&nbsp;</td></tr>
		    <tr class="cajas">
		      <th><input type="checkbox" name="calculo" onClick="actualizarSaldo()"></th><th><b>Cod_Salario</b></th><th><b>Descripción</b></th><th><b>Vlr_Hora</b></th><th><b>Nro_Hora</b></th><th><b>Devengado</b></th><th><b>%Por.</b></th><th><b>Deducción</b></th>
		    </tr>
		    <tr>
		     <td><br></td>
		    </tr>
                    <?
                $conR="select nomina.cedemple from nomina where nomina.cedemple='$cedula'";
                $resR=mysql_query($conR)or die ("Error de consulta");
	        $regist=mysql_affected_rows();
                if($regist==0):
                    $con="select decentro.* from centro,decentro,empleado
                     where empleado.cedemple=centro.cedemple and
                           centro.codcentro=decentro.codcentro and
                           empleado.cedemple='$cedula'  and
                           decentro.estado='SI' order by decentro.descripcion";
                    $resu=mysql_query($con)or die("Error al buscar datos");
                    $reg=mysql_affected_rows();
                    $i=1;
                     echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resu) . "\">");
                    while($filas=mysql_fetch_array($resu)):
                        $Xcontrol=$filas["datos"];
                           ?>
		            <tr class="cajasletra">
                                <td>&nbsp;</td><?
                                echo ("<td><input type=\"checkbox\" id=name=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas['codsala'] ."\" onClick=\"actualizarSaldo()\">" .$filas['codsala']."</td>")?>
                               <td><input type="text" value="<?echo $filas["descripcion"];?>" name="concepto[<? echo $i;?>]"id="concepto[<? echo $i;?>]" size="35"  readonly class="cajas"></td>
                               <td><input type="text" value="<?echo $filas["vlrhora"];?>" name="vlrhora[<? echo $i;?>]"id="vlrhora[<? echo $i;?>]"size="7" readonly></td>
                              <?if ($Xcontrol=='SI'):?>
                                    <?if($auxInicio>$aux):?>
                                       <td><input type="text" value="<?echo $Thora;?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="5" maxlength="5"></td>
                                    <?else:?>
                                      <td><input type="text" value="<?echo $ThoraInicio;?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="5" maxlength="5"></td>
                                    <?endif;
                                 else:?>
                                    <td><input type="text" value="<?echo $filas["nrohora"];?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="5" maxlength="5"></td>
                                <?endif;?>
		               <td><input type="text" value="<?echo round($filas["salario"]/15*$resta,0);?>" name="salario[<? echo $i;?>]" id="salario[<? echo $i;?>]"size="11" ></td>
		               <input type="hidden" value="<?echo $filas["prestacion"];?>" name="prestacion[<? echo $i;?>]"id="prestacion[<? echo $i;?>]"size="11" readonly>
                               <input type="hidden" value="<?echo $filas["variacion"];?>" name="variacion[<? echo $i;?>]"id="variacion[<? echo $i;?>]"size="5" readonly>
		               <td><input type="text" value="<?echo $filas["porcentaje"];?>" name="porcentaje[<? echo $i;?>]"id="porcentaje[<? echo $i;?>]"size="5" readonly></td>
                               <td><input type="text" value="<?echo round($filas["deduccion"],0);?>" name="deduccion[<? echo $i;?>]"id="deduccion[<? echo $i;?>]"size="11" mexlength="11"></td>
 		            </tr>
		            <?
		       $i=$i+1;
                    endwhile;
                     $con="select decentro.* from centro,decentro,empleado
                     where empleado.cedemple=centro.cedemple and
                           centro.codcentro=decentro.codcentro and
                           empleado.cedemple='$cedula' and
                           decentro.estado='NO'  order by decentro.porcentaje";
                    $resu1=mysql_query($con)or die("Error al buscar datos");
                    mysql_num_rows($resu1);
                    $i=(mysql_num_rows($resu)+1);
                    ?>
                    </table>
                    <table border="0" align="center" width="400">
                      <?
                      echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resu1) . "\">");
                      while($filas=mysql_fetch_array($resu1)):
                      $Xcontrol=$filas["datos"];
                            ?>
		            <tr class="cajasletra">
		               <?
		               echo ("<td><input type=\"checkbox\" id=name=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas['codsala'] ."\">" .$filas['codsala']."</td>");?>
                               <td><input type="text" value="<?echo $filas["descripcion"];?>" name="concepto[<? echo $i;?>]"id="concepto[<? echo $i;?>]" size="35" readonly class="cajas"></td>
                               <td><input type="text" value="<?echo $filas["vlrhora"];?>" name="vlrhora[<? echo $i;?>]"id="vlrhora[<? echo $i;?>]"size="7" readonly></td>
                               <?if ($Xcontrol=='SI'):?>
                                    <?if($auxInicio>$aux):?>
                                       <td><input type="text" value="<?echo $Thora;?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="5" maxlength="5"></td>
                                    <?else:?>
                                      <td><input type="text" value="<?echo $ThoraInicio;?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="5" maxlength="5"></td>
                                    <?endif;
                                 else:?>
                                    <td><input type="text" value="<?echo $filas["nrohora"];?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="5" maxlength="5"></td>
                                <?endif;?>
		               <td><input type="text" value="<?echo $filas["salario"];?>" name="salario[<? echo $i;?>]" id="salario[<? echo $i;?>]"size="11"readonly></td>
		               <input type="hidden" value="<?echo $filas["prestacion"];?>" name="prestacion[<? echo $i;?>]"id="prestacion[<? echo $i;?>]"size="11" readonly>
                               <input type="hidden" value="<?echo $filas["variacion"];?>" name="variacion[<? echo $i;?>]"id="variacion[<? echo $i;?>]"size="5" readonly>
		               <td><input type="text" value="<?echo $filas["porcentaje"];?>" name="porcentaje[<? echo $i;?>]"id="porcentaje[<? echo $i;?>]"size="5" readonly></td>
                               <td><input type="text" value="<?echo round($filas["deduccion"],0);?>" name="deduccion[<? echo $i;?>]"id="deduccion[<? echo $i;?>]"size="11" readonly></td>
                            </tr>
		             <?
		            $i=$i+1;
                    endwhile;
                  else:
                     $con="select decentro.* from centro,decentro,empleado
                     where empleado.cedemple=centro.cedemple and
                           centro.codcentro=decentro.codcentro and
                           empleado.cedemple='$cedula'  and
                           decentro.estado='SI' order by decentro.descripcion";
                    $resu=mysql_query($con)or die("Error al buscar datos");
                    $reg=mysql_affected_rows();
                    $i=1;
                     echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resu) . "\">");
                    while($filas=mysql_fetch_array($resu)):
                            $Xcontrol=$filas["datos"];
                           ?>
		            <tr class="cajasletra">
                                <td>&nbsp;</td><?
                                echo ("<td><input type=\"checkbox\" id=name=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas['codsala'] ."\" onClick=\"actualizarSaldo()\">" .$filas['codsala']."</td>")?>
                               <td><input type="text" value="<?echo $filas["descripcion"];?>" name="concepto[<? echo $i;?>]"id="concepto[<? echo $i;?>]" size="35"  readonly class="cajas"></td>
                               <td><input type="text" value="<?echo $filas["vlrhora"];?>" name="vlrhora[<? echo $i;?>]"id="vlrhora[<? echo $i;?>]"size="7" readonly></td>
                               <?if ($Xcontrol=='SI'):?>
                                    <?if($auxInicio>$aux):?>
                                       <td><input type="text" value="<?echo $Thora;?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="5" maxlength="5"></td>
                                    <?else:?>
                                      <td><input type="text" value="<?echo $ThoraInicio;?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="5" maxlength="5"></td>
                                    <?endif;
                                 else:?>
                                    <td><input type="text" value="<?echo $filas["nrohora"];?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="5" maxlength="5"></td>
                                <?endif;?>
		               <td><input type="text" value="<?echo $filas["salario"];?>" name="salario[<? echo $i;?>]" id="salario[<? echo $i;?>]"size="11" ></td>
		               <input type="hidden" value="<?echo $filas["prestacion"];?>" name="prestacion[<? echo $i;?>]"id="prestacion[<? echo $i;?>]"size="11" readonly>
                               <input type="hidden" value="<?echo $filas["variacion"];?>" name="variacion[<? echo $i;?>]"id="variacion[<? echo $i;?>]"size="5" readonly>
		               <td><input type="text" value="<?echo $filas["porcentaje"];?>" name="porcentaje[<? echo $i;?>]"id="porcentaje[<? echo $i;?>]"size="5" readonly></td>
                               <td><input type="text" value="<?echo round($filas["deduccion"],0);?>" name="deduccion[<? echo $i;?>]"id="deduccion[<? echo $i;?>]"size="11" mexlength="11"></td>
 		            </tr>
		            <?
		       $i=$i+1;
                    endwhile;
                     $con="select decentro.* from centro,decentro,empleado
                     where empleado.cedemple=centro.cedemple and
                           centro.codcentro=decentro.codcentro and
                           empleado.cedemple='$cedula' and
                           decentro.estado='NO'  order by decentro.porcentaje";
                    $resu1=mysql_query($con)or die("Error al buscar datos");
                    mysql_num_rows($resu1);
                    $i=(mysql_num_rows($resu)+1);
                    ?>
                    </table>
                    <table border="0" align="center" width="400">
                      <?
                      echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resu1) . "\">");
                      while($filas=mysql_fetch_array($resu1)):
                          $Xcontrol=$filas["datos"];
                            ?>
		            <tr class="cajasletra">
		               <?
		               echo ("<td><input type=\"checkbox\" id=name=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas['codsala'] ."\">" .$filas['codsala']."</td>");?>
                               <td><input type="text" value="<?echo $filas["descripcion"];?>" name="concepto[<? echo $i;?>]"id="concepto[<? echo $i;?>]" size="35" readonly class="cajas"></td>
                               <td><input type="text" value="<?echo $filas["vlrhora"];?>" name="vlrhora[<? echo $i;?>]"id="vlrhora[<? echo $i;?>]"size="7" readonly></td>
                              <?if ($Xcontrol=='SI'):?>
                                    <?if($auxInicio>$aux):?>
                                       <td><input type="text" value="<?echo $Thora;?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="3" maxlength="3"></td>
                                    <?else:?>
                                      <td><input type="text" value="<?echo $ThoraInicio;?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="3" maxlength="3"></td>
                                    <?endif;
                                 else:?>
                                    <td><input type="text" value="<?echo $filas["nrohora"];?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="3" maxlength="3"></td>
                                <?endif;?>
		               <td><input type="text" value="<?echo $filas["salario"];?>" name="salario[<? echo $i;?>]" id="salario[<? echo $i;?>]"size="11"readonly></td>
		               <input type="hidden" value="<?echo $filas["prestacion"];?>" name="prestacion[<? echo $i;?>]"id="prestacion[<? echo $i;?>]"size="11" readonly>
                               <input type="hidden" value="<?echo $filas["variacion"];?>" name="variacion[<? echo $i;?>]"id="variacion[<? echo $i;?>]"size="5" readonly>
		               <td><input type="text" value="<?echo $filas["porcentaje"];?>" name="porcentaje[<? echo $i;?>]"id="porcentaje[<? echo $i;?>]"size="5" readonly></td>
                               <td><input type="text" value="<?echo round($filas["deduccion"],0);?>" name="deduccion[<? echo $i;?>]"id="deduccion[<? echo $i;?>]"size="11" readonly></td>
                            </tr>
		             <?
		            $i=$i+1;
                    endwhile;
                  endif;
                  $con2="select decentro.* from centro,decentro,empleado
                     where empleado.cedemple=centro.cedemple and
                           centro.codcentro=decentro.codcentro and
                           empleado.cedemple='$cedula'";
                    $resu2=mysql_query($con2)or die("Error al buscar datos");
                    echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resu2) . "\">");
                     ?>
                    <tr><td><br></td></tr>
                    <tr>
                        <td colspan="2"><input type="submit" Value="Guardar" class="boton"></td>
                    </tr>
                </table>
<tr><td><br></td></tr>
                <tr>
                <td><b>Nota:&nbsp; El auxilio de transporte se toma por dias mas no por horas, favor cambiar..</b></td>
                <tr>
                </form>
      <?
       endif;
 ?>

                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                          
