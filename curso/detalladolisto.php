<?
 session_start();
?>
<html>
<head>
<title> Datos de los Empleados</title>
 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>

<?
 if(session_is_registered("validar")):
     include("../conexion.php");
      $con="select zona.zona from zona
             where zona.codzona='$cod'";
     $resu=mysql_query($con)or die("Consulta incorrecta");
      $filas_s=mysql_fetch_array($resu);
      ?>
       <table border="0" align="center">
         <tr>
           <td><?echo $filas_s["zona"];?></td>
         </tr>
       </table>
       <?
     $consulta="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1,zona.zona,contrato.fechainic,curso.fechar from empleado,zona,contrato,curso
             where zona.codzona=empleado.codzona and
                 empleado.codemple=contrato.codemple and
                 empleado.cedemple=curso.cedemple and
                 contrato.fechater='0000-00-00' and
                empleado.estado='LISTO' and
                zona.codzona='$cod'";
     $resultado=mysql_query($consulta)or die("Consulta incorrecta");
     $registros=mysql_num_rows($resultado);
     if($registros==0):
     ?>
      <script language="javascript">
          alert("Los asociados de esta zona No tienen el curso ?")
          history.back()
        </script>
<?
    else:
       ?>
         <center><h4><u>Asociados que Hicieron el Curso</u></h4></center>
         <table border="0" align="center">
         <tr class="cajas">
         <th>Item</th>
         <th><b>Documento</b></th>
         <th><b>Empleado</b></th>
         <th><b>Fecha_Realizo</b></th>
         </tr>
             <?
             $i=1;
         while($filas=mysql_fetch_array($resultado)):
            ?>
            <tr class="cajas">
              <th><?echo $i;?></th>
              <td><?echo $filas["cedemple"];?></td>
               <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
               <td><?echo $filas["fechar"];?></td>
            </tr>
            <?
            $i=$i+1;
          endwhile;
         ?>
         </table>

         <?
    endif;
else:
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección")
    pagina='../acceso/agregar.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
endif;

 ?>
 </table>

 </form>
</body>
</html>
