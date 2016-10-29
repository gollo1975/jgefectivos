<html>

<head>
  <title></title>

</head>
<body>
<script language="javascript">
                function imprimir(numero)// para declara funcion
                {
                pagina='imprimir.php?nroentrega=' + numero
                tiempo=80
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
                }
</script>
<?   include("../conexion.php");
$fechaentrega=date("Y-m-d");
$motivo=strtoupper($motivo);
$estado='ACTIVA';
$responsable=strtoupper($responsable);
$consulta="select count(*) from carpeta";
$resul=mysql_query($consulta)or die("Consulta incorrecta 1");
$sw=mysql_fetch_row($resul);
if ($sw[0]>0):
   $consulta="select max(cast(nroentrega as unsigned))+ 1 from carpeta";
   $resultado=mysql_query($consulta)or die ("error en la consulta");
   $codigo = mysql_fetch_row($resultado);
   $codigo1= str_pad($codigo[0], 6, "0", STR_PAD_LEFT);
else:
$codigo1='000001';
endif;
$consulta="insert into carpeta(nroentrega,codemple,cedemple,empleado,zona,responsable,motivo,fechaentrega,estado)
values('$codigo1','$codigoE','$documento','$nombre','$zona','$responsable','$motivo','$fechaentrega','$estado')";
$resultad=mysql_query($consulta)or die("Error al grabar datos");
$reg=mysql_affected_rows();
if ($reg!=0):
   echo ("<script language=\"javascript\">");
   echo ("open (\"imprimir.php?nroentrega=$codigo1\" ,\"\");");
   echo ("</script>");
   ?>
   <script language="javascript">
        open("entrega.php","_self");
   </script>
   <?
endif;
       ?>
</body>
</html>
