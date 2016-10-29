<html>
<head>
<title></title>
  <LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
</head>
<script language="javascript">
                    function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"
                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }
 </script>
<body>
<?
if (!isset($cedula)):
?>
    <center><h4><u>Curso en Alturas</u></h4></center>
  <form action="" method="post" width=30%>
    <table border="0" align="center">
    <tr><td><br></td></tr>
      <tr>
        <td><b>Documento de Identidad:</b></td>
        <td><input type="text" name="cedula" value="" size="13" maxlength="13" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
      </tr>
      <tr><td><br></td></tr>
      <tr>
    <td colspan="2">
      <input type="submit" value="Buscar Dato" class="boton">
   </td>
    </tr>
  </table>
   </form>
<?
elseif(empty($cedula)):
?>
  <script language="javascript">
    alert("Digite el documento de Identidad ?")
    history.back()
  </script>
<?
  else:
    include("../conexion.php");
    $consulta="select curso.*,empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado,curso
    where empleado.cedemple=curso.cedemple and
    empleado.cedemple='$cedula'";
    $resultado=mysql_query($consulta)or die("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
    if ($registro==0):
     ?>
     <script language="javascript">
       alert("El documento no existe y / o este empleado no tiene Curso ?")
       open("buscar.php","_self")
     </script>
    <?
     else:

       while($filas=mysql_fetch_array($resultado)):
       ?>
        <center><h4>Curso en Alturas</h4></center>
           <table border="0" align="center">
           <tr><td><br></td></tr>
               <tr class="cajas">
                <td><b>Documento:&nbsp;&nbsp;</b><?echo $filas["cedemple"];?></td>
               </tr>
               <tr>
                <td class="cajas"><b>Empleado:&nbsp;</b><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
               </tr>
               <tr class="cajas">
                <td><b>Fecha_Rea.:&nbsp;&nbsp;&nbsp;</b><?echo $filas["fechar"];?></td>
               </tr>
               <tr class="cajas">
                <td><b>Puntaje:&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</b><?echo $filas["puntaje"];?></td>
               </tr>
               <tr><td><br></td></tr>
           </table>
           <tr><td><br></td></tr>
           <center><td ><a href="buscar.php" title="Permite otra Busqueda"><b><h5><font color="blue">Nueva Busqueda</font></h5></b></a></td></center>
        <?
        endwhile;
     endif;
 endif;
 ?>
</form>
</body>
</html>
