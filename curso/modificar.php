<html>
<head>
<title>Modificar Registro del curso</title>
<LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
</head>
<body>
<?
if (!isset($cedula)):
?>
<center><h4><u>Cursos en Altura</u></h4></center>
<form action="" method="post">
    <table border="0" align="center">
      <tr><td><br></td></tr>
      <tr>
        <td><b>Documento de Identidad:</b></td>
        <td><input type="text" name="cedula" value="" size="15" maxlength="15"></td>
      </tr>
       <tr><td><br></td></tr>
      <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">
      <input type="reset" value="Limpiar"class="boton">
    </td>

    </tr>
   </table>
   </form>
<?
elseif(empty($cedula)):
?>
  <script language="javascript">
    alert("Digite el valor a consultar ?")
    history.back()
  </script>
<?
  else:
    include("../conexion.php");
    $consulta="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado where cedemple='$cedula'";
    $resultado=mysql_query($consulta)or die("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
    if ($registro!=0):
       while($filas=mysql_fetch_array($resultado)):
        ?>
        <table border="0" align="center">
        <tr>
        <td><? echo $filas["nomemple"];?>&nbsp;<? echo $filas["nomemple1"];?>&nbsp;<? echo $filas["apemple"];?>&nbsp;<? echo $filas["apemple1"];?></td>
        </tr>
        </table>
        <?
       endwhile;
      $consulta1="select curso.codcurso,curso.fechar,curso.puntaje from empleado,curso
      where empleado.cedemple=curso.cedemple and
      empleado.cedemple='$cedula'";
      $resultado1=mysql_query($consulta1)or die("Consulta incorrecta");
      $registro1=mysql_num_rows($resultado1);
      if ($registro1!=0):
         ?>

       <center><h4>Listado de Cursos</h4></center>
       <table border="0" align="center">
        <tr class="cajas"><td>Para modificar el Registro del curso, Presione Click sobre el Cod_Curso ?</td></tr>
        </table>
       <table border="0" align="center">
         <tr>
           <th>Cod_Curso</th>
           <th>Fecha_Realizo</th>
           <th>Puntaje</th>
         </tr>
        <?
        while($filas_s=mysql_fetch_array($resultado1)):
        ?>
        <tr class="cajas">
          <td><a href="detallado.php?codigo=<? echo $filas_s["codcurso"];?>"><? echo $filas_s["codcurso"];?></td>
          <td><? echo $filas_s["fechar"];?></td>
          <td><? echo $filas_s["puntaje"];?></td>
        </tr>
        <?
       endwhile;
       ?>
       </table>
        <?
      else:
        ?>
         <script language="javascript">
           alert("No existe Cursos para este Empleado ?")
           open("modificar.php","_self");
         </script>
        <?
      endif;
    else:
       ?>
         <script language="javascript">
           alert("El documento no existe en sistema ?")
           open("modificar.php","_self");
         </script>
        <?
    endif;
 endif;
       ?>
     </form>
</body>
</html>
