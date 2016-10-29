<?
if(empty($tipo)):
     ?>
       <script language="javascript">
         alert("Seleccione el tipo de incapacidad")
         history.back()
       </script>
       <?
      elseif(empty($estado)):
     ?>
       <script language="javascript">
         alert("Debe digitar el estado de la Incapacidad")
         history.back()
       </script>
     <?
     elseif(empty($diagnostico)):
     ?>
       <script language="javascript">
         alert("Seleccione el codigo de diagnóstico ?")
         history.back()
       </script>
       <?
     else:
       include("../conexion.php");
       $estado=strtoupper($estado);
       $motivo=strtoupper($motivo);
       $consulta="select * from incapacidad where nroinca='$nroinca'";
       $resultado=mysql_query($consulta)or die("Consulta incorrecta");
       $registro=mysql_num_rows($resultado);
       if ($registro==0):

         $consulta="insert into incapacidad(nroinca,fechaini,fechater,dias,tipoinca,codeps,cedemple,codigo,estado,fechapro,motivo)
         values('$nroinca','$fechaini','$fechater','$dias','$tipo','$codeps','$cedula','$diagnostico','$estado','$fechapro','$motivo')";
         $resultado=mysql_query($consulta)or die("Error al grabar incapacidad");
         echo "<script language=\"javascript\">";
         echo "open (\"../pie.php?msg=Se Grabo registros de la Incapacidad Nro: $nroinca\",\"pie\");";
         echo "open(\"agregarincapacidad.php\",\"_self\");";
         echo "</script>";
       else:
         ?>
         <script language="javascript">
         alert("Este Nro de Incapacidad ya existe en la b.d ?")
        history.back()
       </script>
     <?
      endif;
 endif;
