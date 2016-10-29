<script language="javascript">
            function imprimir(numero)// para declara funcion
             {
              pagina='imprimirpresta.php?nropresta=' + numero
                tiempo=50
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
               }
</script>
 <?
 echo $ValD;
  if (empty($ibc)):
  ?>
    <script language="javascript">
      alert("El campo Ibc No puede estar Vacío..")
      history.back()
    </script>
  <?
  elseif (empty($dias)):
  ?>
    <script language="javascript">
      alert("El campo Dias no puede estar Vacío..")
      history.back()
    </script>
  <?
  elseif (empty($ValidarPago)):
  ?>
    <script language="javascript">
      alert("Seleccione las prestaciones que va a Generar.!")
      history.back()
    </script>
  <?
  elseif (empty($Validar)):
  ?>
    <script language="javascript">
      alert("Seleccion el tipo de prestacion social.!")
      history.back()
    </script>
  <?
   elseif (empty($ValD)):
  ?>
    <script language="javascript">
      alert("Favor seleccione si va a procesar deducciones.!")
      history.back()
    </script>
  <?
  else:
     include("../conexion.php");
    $nota=strtoupper($nota);
    $Datos = $_POST['ValidarPago'];
    $N = count($Datos);
    if($N > 2):
       for($i=0; $i < $N; $i++){
           if($Validar=='Normal'):
              if($Datos[$i]=='XCesantia'):
	         $Cesantia=round((($ibc+$auxilio)*$dias)/360);
              endif;
              if($Datos[$i]=='XInteres'):
                 $Interes=round((($Cesantia * $dias)*0.12)/360);
              endif;
              if($Datos[$i]=='XPrima'):
	         $Prima=round((($ibc+$auxilio)*$DiasP)/360);
              endif;
               if($Datos[$i]=='XVacacion'):
                  $Porce = ($dias * 15)/360;
	          $Vacacion=round(($SalarioB/30)*$Porce);
               endif;
           else:
               if($Datos[$i]=='XCesantia'):
                  $Cesantia=round((($ibc+$auxilio)*$dias)/360);
               endif;
               if($Datos[$i]=='XInteres'):
	          $Interes=round((($Cesantia * $dias)*0.12)/360);
               endif;
               if($Datos[$i]=='XPrima'):
  	          $Prima=round((($ibc+$auxilio)*$DiasP)/360);
               endif;
               if($Datos[$i]=='XVacacion'):
                  $Porce = ($dias * 15)/360;
	          $Vacacion=round(($ibc/30)*$Porce);
               endif;
          endif;
          }
	    $TotalGenerado=($Cesantia + $Interes + $Prima + $Vacacion);
	    $TotalPagar=$TotalGenerado;
	   $consulta="update prestacion set fechaini='$fechainic',fechacor='$fechacorte',ibc='$ibc',salario='$SalarioB',dias='$dias',diasprima='$DiasP',auxilio='$auxilio',total='$TotalGenerado',totalp='$TotalPagar',cesantia='$Cesantia',interes='$Interes',prima='$Prima',vacacion='$Vacacion',nota='$nota'
	    where prestacion.nropresta='$nropresta'";
	    $resultado=mysql_query($consulta) or die("Error al actualizar datos");
	    $regis=mysql_affected_rows();
            if($ValD=='No'){
   	       echo ("<script language=\"javascript\">");
	       echo "open (\"../pie.php?msg=Se actualizado $regis registros del empleado: $nombres\",\"pie\");";
	       echo ("open (\"imprimirpresta.php?nropresta=$nropresta\" ,\"\");");
               echo ("</script>");
	       ?>
	       <script language="javascript">
	          open("modificarcesantia.php","_self");
	       </script>
	       <?
            }else{
                 header("location: CrearDeduccion.php?NroPrestacion=$nropresta&Cedula=$Cedula");
            }

     else:
      ?>
    <script language="javascript">
      alert("Por esta opcion no se puede generar las prestaciones")
      history.back()
    </script>
  <?
    endif;
 endif;
?>
