<html>

<head>
  <title></title>
  <LINK HREF="../estilo.css" REL="stylesheet"  type="text/css">
</head>

<body>
<?
 include("../conexion.php");
    $consulta="select curso.* from curso where codcurso='$codigo'";
    $resultado=mysql_query($consulta)or die("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
     while($filas=mysql_fetch_array($resultado)):
       ?>
       <center><h4><u>Modificar Datos</u></h4></center>
         <form action="guardar.php" method="post">
           <table border="0" align="center">
             <tr><td><br></td></td>
             <tr>
               <td><b>Cod_Curso:</b></td>
               <td><input type="text" value="<?echo $filas["codcurso"];?>" name="codcurso" readonly size="7"></td>
             </tr>
             <tr>
              <td><b>Empleado:</b></td>
               <td><select name="empleado" class="cajas">
                 <?
                 $epaux=$filas["cedemple"];
                 $consulta_e="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado,contrato
                  where empleado.codemple=contrato.codemple and
                  contrato.fechater='0000-00-00' order by empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1";
                 $resultado_e=mysql_query($consulta_e)or die("Consulta de departamento incorrecta");
                 while($filas_e=mysql_fetch_array($resultado_e)):
                   if ($epaux==$filas_e["cedemple"]):
                 ?>
                 <option value="<?echo $filas_e["cedemple"];?>"selected><?echo $filas_e["nomemple"];?>&nbsp;<?echo $filas_e["nomemple1"];?>&nbsp;<?echo $filas_e["apemple"];?>&nbsp;<?echo $filas_e["apemple1"];?>
                 <?
                   else:
                   ?>
                    <option value="<?echo $filas_e["cedemple"];?>"><?echo $filas_e["nomemple"];?>&nbsp;<?echo $filas_e["nomemple1"];?>&nbsp;<?echo $filas_e["apemple"];?>&nbsp;<?echo $filas_e["apemple1"];?>
                   <?
                   endif;
                 endwhile;
                 ?> </selet></td>
             <tr>
               <td><b>Fecha_Grabado:</b></td>
               <td><input type="text" value="<?echo $filas["fechag"];?>"name="fechag" size="10" maxlength="10"></td>
             </tr>
              <tr>
               <td><b>Fecha_Realizo:</b></td>
               <td><input type="text" value="<?echo $filas["fechar"];?>"name="fechar" size="10" maxlength="10"></td>
             </tr>
             <tr>
               <td><b>Puntaje:</b></td>
               <td><input type="text" value="<?echo $filas["puntaje"];?>"name="puntaje" size="10" maxlength="3"></td>
             </tr>
              <tr>
                 <td><b>Proveedor:</b></td>
               <td><select name="provedor" class="cajas">
                 <?
                 $depaux=$filas["nitprove"];
                 $consulta_d="select * from provedor order by nomprove";
                 $resultado_d=mysql_query($consulta_d)or die("Consulta de departamento incorrecta");
                 while($filas_d=mysql_fetch_array($resultado_d)):
                   if ($depaux==$filas_d["nitprove"]):
                 ?>
                 <option value="<?echo $filas_d["nitprove"];?>" selected><?echo $filas_d["nomprove"];?>
                 <?
                   else:
                   ?>
                     <option value="<?echo $filas_d["nitprove"];?>"><?echo $filas_d["nomprove"];?>
                   <?
                   endif;
                 endwhile;
                 ?> </selet></td>
             </tr>
              <tr><td><br></td></tr>
             <tr>
               <td colspan="2">
                 <input type="submit" value="Guardar" class="boton">
                 <input type="reset" value="Limpiar"class="boton">
               </td>
              </tr>
              <tr><td><br></td></td>
            </table>
            </form>
            <?
            endwhile;
      ?>
</body>
</html>
</body>

</html>
