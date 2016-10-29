<html>

<head>
  <title>Pagar Incapacidad</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
   <script language="javascript">
      function calcular()
        {
        x1 = 0;
        x2 = 0;
        x3 = 0;
        x4 = 0;
        x5 = 0;
        x1 = document.getElementById("diaspagar").value;
        x2 = document.getElementById("porcentaje").value;
        x3 = document.getElementById("ibc").value;
        x4 = (x1 * x3);
        x5 = (x4 * x2)/100;
        document.getElementById("pagado").value = x5.toFixed(0);
        }
  </script>
</head>

<body>
<?
include("../conexion.php");
$cons="select provision.* from provision
where provision.nro='$nro'";
$resu=mysql_query($cons)or die ("Error de Consulta $cons");
$reg=mysql_num_rows($resu);
if($reg!=0):
  while($filas=mysql_fetch_array($resu)):
  ?>
   <center><h4><u>Detalle del Registro</u></h4></center>
          <form action="grabardetalle.php" method="post" width="200">
           <td><input type="hidden" name="cedula" value="<? echo $cedula;?>"></td>  
           <table border="0" align="center">
           <tr><td><br></td></tr>
            <tr>
                <td><b>Nro_Pago:</b></td>
               <td><input type="text" name="numero" value="<? echo $filas["nro"];?>"class="cajas" size="10" readonly></td>
             </tr>
             <tr>
                <td><b>Documento:</b></td>
               <td><input type="text" name="cedula" value="<? echo $filas["cedemple"];?>"class="cajas" size="15" maxlenght="15" readonly></td>
             </tr>
             <tr>
                <td><b>Empleado:</b></td>
               <td colspan="20"><input type="text" name="nombre" value="<? echo $filas["nombre"];?>" class="cajas"size="45"  readonly></td>
             </tr>
             <tr>
               <td><b>Valor:</b></td>
               <td ><input type="text" name="valor" value="<? echo $filas["valor"];?>" class="cajas"size="10" maxlenght="10" ></td>
             </tr>
             <tr>
               <td><b>Periodo:</b></td>
                <td><select name="periodo" class="cajas">
                 <option value="<?echo $filas["periodo"];?>"selected><?echo $filas["periodo"]?>
                 <option value="01-15">01-15
                 <option value="16-30">16-30
                </select></td>
             </tr>
             <tr>
	        <td><b>Motivo:</b></td>
	        <td colspan="9"><textarea name="nota" cols="45" rows="4" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nota"><?echo $filas["nota"];?></textarea></td></tr>
	     <tr>
                          <tr><td><br></td></tr>
             <tr>
               <td colspan="5">
                  <input type="submit" value="Guardar Dato" class="boton"></td>
             </tr>
           </table>
         </form>
         <?
endwhile;
else:
  ?>
    <script language="javascript">
      alert("No hay registro para modificar ")
      history.back()
    </script>
  <?
endif;

?>
</body>
</html>
