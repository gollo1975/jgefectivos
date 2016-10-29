<html>

<head>
  <title>Pagar Incapacidad</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>

<body>
<?
include("../conexion.php");
$cons="select entregaprovi.* from entregaprovi
where entregaprovi.nro='$nro'";
$resu=mysql_query($cons)or die ("Error de Consulta $cons");
$reg=mysql_num_rows($resu);
if($reg!=0):
  while($filas=mysql_fetch_array($resu)):
  ?>
   <center><h4><u>Detalle del Registro</u></h4></center>
          <form action="grabardetallenota.php" method="post" width="200">
           <td><input type="hidden" name="cedula" value="<? echo $cedula;?>"></td>
           <table border="0" align="center">
           <tr><td><br></td></tr>
            <tr>
                <td><b>Nro_Nota:</b></td>
               <td><input type="text" name="numero" value="<? echo $filas["nro"];?>"class="cajas" size="10" readonly></td>
             </tr>
             <tr>
                <td><b>Documento:</b></td>
               <td><input type="text" name="cedula" value="<? echo $filas["cedemple"];?>"class="cajas" size="15" maxlenght="15" readonly></td>
             </tr>
             <tr>
                <td><b>Empleado:</b></td>
               <td colspan="20"><input type="text" name="nombre" value="<? echo $filas["nombres"];?>" class="cajas"size="45"  readonly></td>
             </tr>
             <tr>
               <td><b>Valor:</b></td>
               <td ><input type="text" name="valor" value="<? echo $filas["vlrpagado"];?>" class="cajas"size="10" maxlenght="10" ></td>
             </tr>
             <tr>
                           <td><b>Motivo:</b></td>
                           <td colspan="9"><textarea name="nota" cols="45" rows="4" class="cajas"><?echo $filas["nota"];?></textarea></td></tr>
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
