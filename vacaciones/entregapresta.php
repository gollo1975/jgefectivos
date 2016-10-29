<html>

<head>
  <title>Entrega de Prestaciones</title>
  <LINK REL="stylesheet"  HREF="../estilo.css" type="text/css">
  <script language="javascript">
    function ColorFoco(obj)

      {
      document.getElementById(obj).style.background="#9DFF9D"
      }

     function QuitarFoco(obj)

     {
      document.getElementById(obj).style.background="white"
     }
  function chequearcampos()

     {
     if(document.getElementById("nropresta").value.length <=0)
       {
       alert ("El campo [Nro_Prestacion] no puede estar vacío");
       document.getElementById("nropresta").focus();
       return;
       }
       document.getElementById("mat1").submit();
     }
  </script>
</head>
<body>
<?
if (!isset($nropresta)):
 ?>
   <center><h5>Descargar Compensaciones</h5></center>
   <form action="" method="post" id="mat1">
     <table border="0" align="center">
     <tr><td><br></td></tr>
       <tr>
           <td><b>Nro_ Prestación:</b></td>
           <td colspan="2"><input type="text" name="nropresta" value="" class="cajas" size="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nropresta"></td>
       </tr>
       <tr>
       <td><b>Tipo_Proceso:</b></td>
       <td><input type="radio" value="Descargar" name="EstadoP">Descargar<input type="radio" value="Saldar" name="EstadoP">Saldar</td>
     </tr>
       <tr><td><br></td></tr>
       <td colspan="5">
        <input type="button" value="Buscar Dato" class="boton"onclick="chequearcampos()"></td>
     </table>
   </form>
 <?
elseif(empty($EstadoP)):
 ?>
     <script language="javascript">
       alert("Seleccine el tipo de procesoa a validar")
       history.back()
     </script>
    <?  
else:
  include("../conexion.php");
  $con="select prestacion.nropresta,prestacion.cedemple,prestacion.nombres,prestacion.control from prestacion
      where prestacion.nropresta='$nropresta' and prestacion.estado=''";
  $res=mysql_query($con)or die("Error de Busqueda");
  $reg=mysql_num_rows($res);
  if($reg==0):
    ?>
     <script language="javascript">
       alert("Este Nro de Prestacion ya Fue Descargado / O no Existe en la Base de Datos")
       history.back()
     </script>
    <?
  else:
     while($filas=mysql_fetch_array($res)):
    ?>
       <center><h5>Datos Encontrados</h5></center>
       <form action="procesar.php" method="post">
       <input type="hidden" name="EstadoP" value="<?echo $EstadoP;?>">
         <table border="0" align="center">
         <tr><td><br></td></tr>
           <tr>
             <td><b>Nro_Prestación:</b></td>
             <td colspan="2"><input type="text" name="nropresta" value="<?echo $filas["nropresta"];?>" size="13" class="cajas"readonly></td>
           </tr>
           <tr>
             <td><b>Documento:</b></td>
             <td colspan="2"><input type="text" name="cedula" value="<?echo $filas["cedemple"];?>" size="13"class="cajas" readonly></td>
           </tr>
           <tr>
             <td><b>Empleado:</b></td>
             <td colspan="2"><input type="text" name="emple" value="<?echo $filas["nombres"];?>" size="45" class="cajas" readonly></td>
           </tr>
            <tr>
             <td><b>Fecha_Entrega:</b></td>
             <td colspan="2"><input type="text" name="fechaentrega"value="<? echo date("Y-m-d");?>" size="13" class="cajas" readonly></td>
           </tr>
          <tr>
              <td><b>Estado:</b></td>
              <td><select name="Estado" class="cajas">
              <option value="<?echo $filas["control"];?>" selected><?echo $filas["control"];?>
              <option value="ACTIVA">ACTIVA
              <option value="PAGADO">PAGADO
              </select></td>
          </tr>
            <tr>
              <td><b>Observación:</b></td>
              <td><textarea name="nota" cols="44" rows="5" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nota"></textarea></td>
            </tr>
            <tr><td><br></td></tr>
             <tr>
                         <td colspan="2">
                           <input type="submit" value="Descargar" class="boton">
                         </td>
         </table>
       </form>
         <?
    endwhile;
  endif;
endif;
?>

</body>
</html>
