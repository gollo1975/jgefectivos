<?
 session_start();
?>
<?
if(session_is_registered("xsession")):
if(empty($cantidad)):
 ?>
  <script language="javascript">
     alert("Digite la cantidad de carnets " )
     history.back()
   </script>
   <?
elseif(empty($tipo)):
 ?>
  <script language="javascript">
     alert("Seleccion una opcion de la lista" )
     history.back()
   </script>
   <?
else:
   include("../conexion.php");
   $estado=strtoupper($estado);
   $consulta = "select count(*) from carnet";
   $result = mysql_query ($consulta);
   $answ = mysql_fetch_row($result);
   if ($answ[0] > 0):
           $consulta = "select max(cast(codcarnet as unsigned)) + 1 from carnet";
           $result = mysql_query ($consulta) or die ("Fallo en la consulta");
           $codc = mysql_fetch_row($result);
           $codca= str_pad($codc[0], 4, "0", STR_PAD_LEFT);
   else:
     $codca = "0001";
   endif;
   $consulta="insert into carnet(codcarnet,cedemple,fecha,estado,cantidad,tipocarnet)
   values('$codca','$documento','$fecha','$estado','$cantidad','$tipo')";
   $resultado=mysql_query($consulta) or die("Insercion incorrecta");
   $reg=mysql_affected_rows();
   if ($reg!=0):
    ?>
     <script language="javascript">
       alert("Registro Almacenado Correctamente")
       open("agregar.php","_self")
     </script>
     <?
   else:
     ?>
     <script language="javascript">
       alert("No se almacenaron registros")
       open("agregar.php","_self")
     </script>
     <?
   endif;
endif;
else:
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección")
    pagina='../acceso/agregar.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
endif;
?>
