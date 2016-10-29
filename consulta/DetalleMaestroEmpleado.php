<html>
<head>
  <title>Consulta de Nomina Por Empleado</title>
   <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
  <script language="javascript">
                    function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }
                      function ValidarCaja()
                    {
                        if ((document.getElementById("Cedula").value.length <=0) && (document.getElementById("Nombre").value.length <=0))
                        {
                            alert ("Digite el documento del empleao para la busqueda.!");
                            document.getElementById("Cedula").focus();
                            return;
                        }
                         document.getElementById("f1").submit();

                    }
    </script>

</head>
<body>
<?
if (!isset($Cedula)){
     ?>
     <center><h4><u>MAESTRO EMPLEADO</u></h4></center>
     <form action="" method="post" width="200" id="f1">
     <input type="hidden" name="codigo"  value="<?echo $codigo;?>">
         <table border="0" align="center">
               <tr><td><br></td></tr>
	       <tr>
		    <td><b>Documento de Identidad:</b></td>
		    <td colspan="3"><input type="text" name="Cedula" value="" size="15" maxlength="15" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Cedula"></td>
		    </tr>
	       <tr>
               <tr>
		    <td><b>Nombre o parte del Nombre:</b></td>
		    <td colspan="3"><input type="text" name="Nombre" value="" size="25" maxlength="25" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Nombre"></td>
		    </tr>
		     <tr><td><br></td></tr>
	       <tr>

		    <td colspan="2">
		      <input type="button" value="Buscar" class="boton" id="buscar" onclick="ValidarCaja()">
		      </td>
	       </tr>
	</table>
    </form>
<?
}else{
      include("../conexion.php");
      if($Cedula !=''){
          if($codigo == 0){
          $consulta="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado where
                 empleado.cedemple='$Cedula'";
          }else{
              $consulta="select empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from empleado,zona where
                   empleado.codzona=zona.codzona and
                   zona.codzona='$codigo' and
                    empleado.cedemple='$Cedula'";
          }
         $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
         $registro=mysql_num_rows($resultado);
        if ($registro==0){
             ?>
             <script language="javascript">
                alert ("Este Numero de Documento no existe en Sistemas o no pertenece a esta Empresa. ?")
                history.back()
             </script>
             <?
        }else{
            ?>
            <table border="0" align="center">
	            <?
	            while($filas=mysql_fetch_array($resultado)){
	                  ?>
	                 <tr>
	                  <td><b>Empleado:&nbsp;</b><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
	                  </tr>
	                  <?
	            }
	            ?>
	    </table>
            <?
             $consu="select zona.zona, concat(nomemple, ' ', nomemple1, ' ', apemple, ' ', apemple1) as Empleado from empleado,zona where
              empleado.codzona=zona.codzona and
              empleado.cedemple='$Cedula'";
              $resulta=mysql_query($consu)or die ("Error al buscar el empleado ");
              $registro=mysql_num_rows($resulta);
              if ($registro!=0){
                   ?>
                   <center><h4><u>Resultado de la Consulta</u></h4></center>
                   <table border="0" align="center">
                       <tr class="cajas">
                          <td>Para ver el detalle del empleado, Presione Click Sobre el Documento del Empleado</td>
                       </tr>
                   </table>
                  <table border="0" align="center">
                     <tr  class="cajas">
                      <th>#</th>
                      <th>Documento</th>
                      <th>Empleado</th>
                       <th>Zona</th>
                    </tr>
                    <?
                    $i=1;
                   while($filas_s=mysql_fetch_array($resulta)){
                        ?>
   	                <tr  class="cajas">
                            <th><?echo $i;?></th>
                            <td><a href="DetalleMaestro.php?Cedula=<?echo $Cedula;?>&codigo=<?echo $codigo;?>"><?echo $Cedula;?></a></td>
                            <td><?echo $filas_s["Empleado"];?></td>
                            <td><?echo $filas_s["zona"];?></td>

                        </tr>
                        <?
                        $i=$i+1;
                   }
                   ?>
                  </table>

                <?
              }else{
                   ?>
                   <script language="javascript">
                       alert("Este numero de Documento no existe en el sistema de la Compañia")
                        history.back()
                   </script>
               <?
              }
      }
   }else{
        // CODIGO QUE PERMITE MANEJAR PARTE DEL NOMBRE
         include ("../conexion.php");
          if($codigo == 0){
              $consu="select zona.zona, concat(nomemple, ' ', nomemple1, ' ', apemple, ' ', apemple1) as Empleado,empleado.cedemple from empleado,zona where
                  empleado.codzona=zona.codzona and
                 CONCAT(empleado.nomemple, ' ', empleado.nomemple1, ' ', empleado.apemple, ' ', empleado.apemple1) like '%$Nombre%' order by empleado.cedemple,zona.zona DESC";
          }else{
              $consu="select zona.zona, concat(nomemple, ' ', nomemple1, ' ', apemple, ' ', apemple1) as Empleado,empleado.cedemple from empleado,zona where
                  empleado.codzona=zona.codzona and
                  zona.codzona='$codigo' and
                 CONCAT(empleado.nomemple, ' ', empleado.nomemple1, ' ', empleado.apemple, ' ', empleado.apemple1) like '%$Nombre%' order by empleado.cedemple,zona.zona DESC";
          }
         $resulta=mysql_query($consu)or die ("Error sl buscar relacion ");
        $Reg=mysql_num_rows($resulta);
        if($Reg != 0){
            ?>
            <center><h4><u>Resultado de la Consulta</u></h4></center>
                   <table border="0" align="center">
                       <tr class="cajas">
                          <td>Para ver el detalle del empleado, Presione Click Sobre el Documento del Empleado</td>
                       </tr>
                   </table>
                  <table border="0" align="center">
                     <tr  class="cajas">
                      <th>#</th>
                      <th>Documento</th>
                      <th>Empleado</th>
                       <th>Zona</th>
                    </tr>
                    <?
                    $i=1;
                   while($filas_s=mysql_fetch_array($resulta)){
                        ?>
   	                <tr  class="cajas">
                            <th><?echo $i;?></th>
                            <td><a href="DetalleMaestro.php?Cedula=<?echo $filas_s["cedemple"];?>&codigo=<?echo $codigo;?>"><?echo $filas_s["cedemple"];?></a></td>
                            <td><?echo $filas_s["Empleado"];?></td>
                            <td><?echo $filas_s["zona"];?></td>

                        </tr>
                        <?
                        $i=$i+1;
                   }
                   ?>
                  </table>

                <?
       }else{
                   ?>
                   <script language="javascript">
                       alert("No hay concidencias de este nombre o apellidos en el sistema.!")
                        history.back()
                   </script>
               <?
        }


   }
}
?>
</body>
</html>
