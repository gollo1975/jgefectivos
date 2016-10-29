<html>
<head>
  <title>Modificando Nomina</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
if(!isset($Colilla)):

  ?>
  <center><h4><u>Abrir Colilla</u></h4></center>
  <form action="GrabarColilla.php" method="post">
    <table border="0" align="center">
     <tr><td><br></td></tr>
      <tr>
        <td><b>Nro_Colilla:</b></td>
       <td><input type="text" name="Nro" value="<?echo $codigo;?>" size="15" maxlength="15" class="cajas" ></td>
        </tr>
        <tr>
            <td><b>Estado:</b></td>
            <td><select name="Proceso" class="cajas">
            <option value="<?echo $Estado;?>" selected><?echo $Estado;?>
            <option value="CERRADO">CERRADO
            <option value="ABIERTO">ABIERTO
         </select></td>
     </tr>
        <tr><td><br></td></tr>
        <td colspan="5">
         <input type="submit" value="Grabar" class="boton">
        </td>
    </table>
  </form>
  <?
elseif(empty($cedula)):
endif;
?>
</body>

</html>
