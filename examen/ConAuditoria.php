<html>
<head>
  <title></title>
</head>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<body>
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
                        if (document.getElementById("Desde").value.length <=0)
                        {
                            alert ("Digite la fecha de inicio para la busqueda!");
                            document.getElementById("Desde").focus();
                            return;
                        }
                        document.getElementById("matrec").submit();

                    }
               function ActualizarSaldo()
	         {
	        var totalitem = 0
	        var pagado = 0
	         var totalitem =  document.getElementById("tActualizaciones").value
	         var nEle = document.f1.elements.length;
	               for (i=0; i<nEle; i++) {
	                  if (document.f1.elements[i].type=="checkbox" &&
		                document.f1.elements[i].name.lastIndexOf('datos')!=-1 ) {
				document.f1.elements[i].checked ? document.f1.elements[i].checked=false : document.f1.elements[i].checked=true;
		          }
	                }
		       }
              </script>
<?
if(!isset($Desde)):
?>
  <div align="center"><h5><u>Exportar Auditoria</u></h5></div>
  <form action="" method="post" id="matrec" name="f4">
     <table border="0" align="center">
        <tr><td><br></td></tr>
        <tr>
            <td><b>Fecha_Inicio:&nbsp;</b></td>
            <td><input type="text" name="Desde" value="<?echo date("Y-m-d");?>" size="13" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Desde"></td>
        </tr>
        <tr>
            <td><b>Fecha_Final:&nbsp;</b></td>
            <td><input type="text" name="Hasta" value="<?echo date("Y-m-d");?>" size="13" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Hasta"></td>
        </tr>
       <tr>
            <td><b>Tipo_Exportación:&nbsp;</b></td>
             <td><input type="radio" value="Negativo" name="DatosE"><font color="red">Para Cobrar</font><input type="radio" value="General"  name="DatosE"><font color="blue">General</font></td>
       </tr>
       <tr><td><br></td></tr>
       <td colspan="3">
       <input type="button" value="Buscar" class="boton" onclick="chequearcampos()" name="buscar" id="buscar"></td></tr>
     </table>
  </form>
<?
elseif(empty($DatosE)):
    ?>
	      <script language="javascript">
	         alert("Favor seleccione la opcion de exportacion! ?")
                 history.back()
	      </script>
	      <?
else:
   include("../conexion.php");
     $con="select auditoriaexamen.* from auditoriaexamen
               where auditoriaexamen.fechap between '$Desde' and '$Hasta' and auditoriaexamen.estado='' order by auditoriaexamen.zona";
	   $res=mysql_query($con)or die ("Error al buscar el examen ?");
	   $reg=mysql_num_rows($res);
	   if($reg!=0):
	     ?>

             <div align="center"><h5><u>Exportar Auditoria</u></h5></div>
             <form action="ExportarAuditoria.php" method="post" id="f1" name="f1">
             <table border="0" align="center">
                 	<tr class="cajas">
       		       	<th><input type="checkbox" name="calculo" onClick="ActualizarSaldo()"></th><th><b>Id</b></th><th><b>Nro_Examen</b></th><th><b>Empleado</b></th><th><b>Diferencia</b></th><th><b>Zona</b></th>
            	       </tr>
	         <?
                 $i=1;
                 $Suma=0;
                 echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($res) . "\">");
	         while($filas=mysql_fetch_array($res)):
                     $Valor=$filas["diferencia"];
                     if ($DatosE=='Negativo' and $Valor < 0 ):
                        ?>
		          <tr class=>
                             <td>&nbsp;</td><?
                             echo ("<td><input type=\"checkbox\" id=name=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas['id'] ."\" onClick=\"ActualizarSaldo()\">" .$filas['id']."</td>")?>
                             <td><input type="text" value="<?echo $filas["nro"];?>" name="Nro[<? echo $i;?>]"id="Nro[<? echo $i;?>]" size="10"  readonly class="cajas"></td>
                             <td><input type="text" value="<?echo $filas["empleado"];?>" name="Empleado[<? echo $i;?>]"id="Empleado[<? echo $i;?>]"size="45" readonly class="cajas"></td>
                             <td><input type="text" value="<?echo $filas["diferencia"];?>" name="diferencia[<? echo $i;?>]"id="diferencia[<? echo $i;?>]"size="10" readonly class="cajas"></td>
                             <td><input type="text" value="<?echo $filas["zona"];?>" name="zona[<? echo $i;?>]" id="zona[<? echo $i;?>]"size="45"class="cajas" ></td>
                          </tr>
                      <?
                      $Suma=$Suma+$filas["diferencia"];
                      endif;

                      if ($DatosE=='General'):?>
                          <tr>
                             <td>&nbsp;</td><?
                             echo ("<td><input type=\"checkbox\" id=name=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas['id'] ."\" onClick=\"\">" .$filas['id']."</td>")?>
                             <td><input type="text" value="<?echo $filas["nro"];?>" name="Nro[<? echo $i;?>]"id="Nro[<? echo $i;?>]" size="10"  readonly class="cajas"></td>
                             <td><input type="text" value="<?echo $filas["empleado"];?>" name="Empleado[<? echo $i;?>]"id="Empleado[<? echo $i;?>]"size="45" readonly class="cajas"></td>
                             <td><input type="text" value="<?echo $filas["diferencia"];?>" name="diferencia[<? echo $i;?>]"id="diferencia[<? echo $i;?>]"size="10" readonly class="cajas"></td>
                             <td><input type="text" value="<?echo $filas["zona"];?>" name="zona[<? echo $i;?>]" id="zona[<? echo $i;?>]"size="45" class="cajas"></td>
                          </tr>
                     <?
                     $Suma=$Suma+$filas["diferencia"];
                     endif;?>
   	               <?
		      $i=$i+1;
	         endwhile;
	         ?>
                   <tr><td><br></td></tr>
                    <th><b>&nbsp;</b></th> <th><b>&nbsp;</b></th> <th><b>&nbsp;</b></th><th><b>&nbsp;</b></th><th><b><?echo $Suma;?></b></td><th><b>&nbsp;</b></th>
                   <tr>

 	          <td colspan="3">  <input type="submit" value="Exportar" class="boton" name="exportar" id="exportar"></td></tr>
               </table>

              </form>
	       <?
           else:
              ?>
	      <script language="javascript">
	         alert("No hay registros de Examenes en este rango de fechas para cobrar!")
                 history.back()
	      </script>
	      <?
           endif;
endif;
?>
</body>
</html>
