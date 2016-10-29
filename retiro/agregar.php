<html>
<head>
  <title>Retiros de Empleados</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
if (!isset($cedula)):
 ?>
 <center><h4><u>Cerrar Contratos</u></h4></center>
  <form action="" method="post">
    <table border="0" align="center">
     <tr><td><br></td></tr>
       <tr>
         <td><b>Documento de Indentidad:</b></td>
         <td><input type="text" name="cedula" value="" size="15" maxlength="15"></td>
       </tr>
       <tr><td><br></td></tr>
       <tr>
         <td colspna="3">
         <input type="submit" value="Buscar" class="boton"></td>
       </tr>
    </table>
  </form>
<?
elseif(empty($cedula)):
   ?>
    <script language="javascript">
      alert("Digite el Documento de Indentidad..")
      history.back()
    </script>
<?
else:
   include("../conexion.php");
   $cons="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,empleado.codemple,zona.zona from empleado,contrato,zona where
         zona.codzona=empleado.codzona and
         empleado.codemple=contrato.codemple and
         contrato.fechater='0000-00-00' and
         empleado.cedemple='$cedula'";
   $resu=mysql_query($cons)or die ("Error de Consulta");
   $reg=mysql_num_rows($resu);
   if($reg!=0):
    while($filas=mysql_fetch_array($resu)):
     ?>
          <center><h4><u>Cerrar Contratos</u></h4></center>
          <form action="grabar.php" method="post" width="200">
           <table border="0" align="center">
           <input type="hidden" name="codigo" value="<? echo $filas["codemple"];?>">
            <tr><td><br></td></tr>
             <tr>
                <td><b>Documento:</b></td>
               <td><input type="text" name="cedula" value="<? echo $cedula;?>"class="cajas" size="15" maxlenght="15" readonly></td>
             </tr>
             <tr>
                <td><b>Empleado:</b></td>
               <td colspan="5"><input type="text" name="nombre" value="<? echo $filas["nomemple"];?>&nbsp;<? echo $filas["nomemple1"];?>&nbsp;<? echo $filas["apemple"];?>&nbsp;<? echo $filas["apemple1"];?>" class="cajas"size="47" maxlenght="45" readonly></td>
             </tr>
              <tr>
                <td><b>Zona:</b></td>
               <td colspan="5"><input type="text" name="zona" value="<? echo $filas["zona"];?>" class="cajas"size="47" maxlenght="45" readonly></td>
             </tr>
             <tr>
               <td><b>Fecha_Proceso:</b></td>
               <td ><input type="text" name="fecha" value="<? echo date("Y-m-d");?>" class="cajas"size="13" maxlenght="10" readonly></td>
               <td><b>Fecha_Retiro:</b></td>
               <td colspan="1"><input type="text" name="fechare" value="<? echo date("Y-m-d");?>" class="cajas"size="13" maxlenght="10"></td>
             </tr>
             <tr>
                <td><b>Dias:</b></td>
               <td><input type="text" name="dia" value="" class="cajas" size="3" maxlenght="3"></td>
             </tr>
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
      alert("Este Documento no existe, o El contrato Ya esta Cerrado ?..")
     open("agregar.php","_self")
     </script>
     <?
   endif;
endif;
 ?>
</body>
</html>
