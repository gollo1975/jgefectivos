<script language="javascript">
                function imprimir(numero)// para declara funcion
                {
                pagina='imprimirprestamo.php?nroprestamo=' + numero
                tiempo=10
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
                }
</script>
<?
 if(empty($formapago)):
  ?>
 <script language="javascript">
    alert("Seleccione la forma de pago del empleado !")
    history.back()
 </script>
 <?
elseif(empty($valor)):
  ?>
 <script language="javascript">
    alert("Digite el valor del prestamo autorizado !")
    history.back()
 </script>
 <?
 elseif(empty($dias)):
  ?>
 <script language="javascript">
    alert("Digite el tiempo en dias para el prestamo !")
    history.back()
 </script>
 <?
 elseif(empty($responsable)):
  ?>
 <script language="javascript">
    alert("Digite un resposanble para el prestamo !")
    history.back()
 </script>

 <?
else:

  if($formapago=='SEMANAL'):
     $vlrcuota=round(($valor/$dias)*7);
  else:
     if ($formapago=='DECADAL'):
        $vlrcuota=round(($valor/$dias)*10);
     else:
        if ($formapago=='QUINCENAL'):
          $vlrcuota=round(($valor/$dias)*15);
        else:
        $vlrcuota=round(($valor/$dias)*30);
        endif;
     endif;
  endif;
   $estado='ACTIVO';
  $responsable=strtoupper($responsable);
  $descripcion=strtoupper($descripcion);
   include("../conexion.php");
      $consulta1 = "select count(*) from prestamoempresa";
       $result = mysql_query ($consulta1);
                 $answ = mysql_fetch_row($result);
                 if ($answ[0] > 0):
                   $consulta = "select max(cast(nroprestamo as unsigned)) + 1 from prestamoempresa";
                   $result2 = mysql_query($consulta);
                   $codc = mysql_fetch_row($result2);
                   $codex= str_pad($codc[0], 5, "0", STR_PAD_LEFT);
                 else:
                   $codex='00001';
                 endif;
                 $conP="insert into prestamoempresa (nroprestamo,cedemple,nombres,codzona,zona,fechap,fechad,formapago,vlrprestamo,cuota,dias,responsable,nota,estado)
                          values('$codex','$cedula','$nombre','$codigo','$zona','$fechaP','$fechaD','$formapago','$valor','$vlrcuota','$dias','$responsable','$observacion','$estado')";
                 $resP=mysql_query($conP)or die("Error al grabar datos de los prestamos");
                 $regP=mysql_affected_rows();
                 if($regP==0):
                    ?>
			 <script language="javascript">
			    alert("Los datos no se grabaron en sistema !")
			    history.back()
			 </script>
           	    <?
                 else:
                     echo ("<script language=\"javascript\">");
		     echo ("open (\"imprimirPrestamo.php?nroprestamo=$codex\" ,\"\");");
		     echo ("</script>");
		     ?>
		     <script language="javascript">
		        open("PrestamoEmpresa.php?codigo=<?echo $codigo;?>","_self");
		     </script>
		    <?
                 endif;
endif;
