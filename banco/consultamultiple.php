<html>

<head>
  <title>Consulta de bancos</title>
   <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css"> 
</head>
<body>
<?
  if (!isset($campo)):
  ?>
  <center><h4>Consulta de Bancos</h4></center>
<form action="" method="post">
  <table border="0" align="center">
   <tr>
     <td><b>Campo de Consulta:</b></td>
     <td><select name="campo" >
        <option value="0">Seleccione la Opción
        <option value="1">cod_banco
        <option value="2">banco
        <option value="3">dirección
        <option value="4">telefono
        <option value="5">municipio
        </select></td>
   </tr>
   <tr>
     <td><b>Valor de Consulta:</b></td>
     <td><input type="text" name="valor" value="" size="50"></td>
   </tr>
   <tr><td><br></td></tr>
  <tr>
    <td colspan="2">
      <input type="submit" value="busca" class="boton">
      <input type="reset" value="limpiar" class="boton">
    </td>
  </tr>
</table>
</form>
<?
elseif (empty($valor)):
?>
  <script language="javascript">
    alert ("Digite un valor a Consultar:")
    history.back()
  </script>
 <?
  else:
    include("../conexion.php");
    $opc=$campo;
    switch($opc)
    {
      case 1:
        $consulta="select * from banco where codbanco='$valor'";
        break;
      case 2:
        $consulta="select * from banco where bancos like'%$valor%'";
        break;
      case 3:
        $consulta="select * from banco where dirbanco like'%$valor%'";
        break;
      case 4:
        $consulta="select * from banco where telbanco='$valor'";
        break;
       case 5:
        $consulta="select * from banco where municipio like'%$valor%'";
        break;
      }
    $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
    if ($registro==0):
    ?>
    <script language="javascript">
    alert ("No existen registro en la consulta:")
    history.back()
    </script>
   <?
     else:
   ?>
 <center><h4>Datos del Banco</h4></center>
<table border="0" align="center">
  <tr class="cajas">
     <td><b>Cod_Banco</b></td>
     <td><b>Banco</b></td>
     <td><b>Dirección</b></td>
     <td><b>Teléfono</b></td>
     <td><b>Municipio</b></td>
   </tr>
   <?
     while($filas=mysql_fetch_array($resultado)):
   ?>
     <tr class="cajas">
       <td><?echo $filas["codbanco"];?></td>
       <td><?echo $filas["bancos"];?></td>
       <td><?echo $filas["dirbanco"];?></td>
       <td><?echo $filas["telbanco"];?></td>
       <td><?echo $filas["municipio"];?></td>
     </tr>
     <?
    endwhile;
   endif;
  endif;
  ?>
</table>  
</body>
</html>
