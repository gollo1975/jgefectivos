<?
include("../conexion.php");
if ($EstadoP=='Descargar'):
  $con="select controlpresta.nropresta from controlpresta where controlpresta.nropresta='$nropresta'";
  $resu=mysql_query($con)or die("Error de busqueda ");
  $reg=mysql_num_rows($resu);
  if ($reg==0):
     $consulta="insert into controlpresta(nropresta,cedemple,emple,fechacontrol,nota)
     values('$nropresta','$cedula','$emple','$fechaentrega','$nota')";
     $resu=mysql_query($consulta)or die("Error de busqueda en grabar");
     $regi=mysql_affected_rows();
     $consul="update prestacion set estado='SI',fecharadicado='$fechaentrega',notatrabajador='$nota' where nropresta='$nropresta'";
     $resultad=mysql_query($consul)or die("Inserccion incorrecta seis");
     $regi=mysql_affected_rows();
     if($regi==0):
       ?>
      <script language="javascript">
         alert("Los datos no se grabaron con Exitos ?")
         open("entregapresta.php","_self")
      </script>
     <?
     else:
       ?>
        <script language="javascript">
       alert("Registro Almacenados Correctamente, y se actualizó la tabla Prestación ")
       open("entregapresta.php","_self")
       </script>
       <?
     endif;
  else:
    ?>
   <script language="javascript">
       alert("El Nro de la prestación Ya se descargo por sistemas ")
       open("entregapresta.php","_self")
     </script>
   <?
  endif;
else:
    $consulta="update prestacion set control='$Estado' where nropresta='$nropresta'";
     $resu=mysql_query($consulta)or die("Error de busqueda en actualizacion");
     $regi=mysql_affected_rows();
     if($regi==0):
       ?>
      <script language="javascript">
         alert("Los datos no se grabaron con Exitos ?")
         open("entregapresta.php","_self")
      </script>
     <?
     else:
       ?>
        <script language="javascript">
       alert("Se actualizó la tabla Prestación con exito ")
       open("entregapresta.php","_self")
       </script>
       <?
     endif;
endif;
?>