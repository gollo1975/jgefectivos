<html>
<head>
  <title>Modificando Nomina</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
  <center><h4><u>Abrir Periodo</u></h4></center>
  <form action="GrabarPeriodo.php" method="post">
  <input type="hidden" name="desde" value="<?echo $desde;?>">
  <input type="hidden" name="hasta" value="<?echo $hasta;?>">
    <table border="0" align="center">
     <tr><td><br></td></tr>
      <tr>
        <td><b>Nro_Periodo:</b></td>
       <td><input type="text" name="NroP" value="<?echo $NroP;?>" size="15" maxlength="15" class="cajas" readonly></td>
        </tr>
        <tr>
            <td><b>Estado:</b></td>
            <td><select name="Proceso" class="cajas">
            <option value="<?echo $Estado;?>" selected><?echo $Estado;?>
            <option value="SI">SI
            <option value="">
         </select></td>
     </tr>
        <tr><td><br></td></tr>
        <td colspan="5">
         <input type="submit" value="Grabar" class="boton">
        </td>
    </table>
  </form>

</body>

</html>
