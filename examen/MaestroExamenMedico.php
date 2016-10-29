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
                            alert ("Digite el documento del empleado para la busqueda.!");
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
     <center><h4><u>MAESTRO EXAMEN MEDICO</u></h4></center>
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
           $consulta="select examen.*,zona.zona from examen,zona where
                     zona.codzona=examen.codzona and
                      examen.cedula='$Cedula' order by examen.nro DESC limit 1";
      }else{
              $consulta="select examen.*,zona FROM examen,zona where
                         zona.codzona=examen.codzona and
                         examen.nombre like '%$Nombre%'";
       }
         $resultado=mysql_query($consulta)or die ("Consulta incorrecta");
         $registro=mysql_num_rows($resultado);
        if ($registro==0){
             ?>
             <script language="javascript">
                alert ("Este Numero de Documento no existe en Sistemas o no pertenece a esta Empresa. ...?")
                history.back()
             </script>
             <?
        }else{
            ?>
             <center><h4><u>MAESTRO EXAMEN MEDICO</u></h4></center>
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
                   while($filas_s=mysql_fetch_array($resultado)){
                        ?>
   	                <tr  class="cajas">
                            <th><?echo $i;?></th>
                            <td><a href="DetalleMaestroExamen.php?Cedula=<?echo $filas_s["cedula"];?>"><?echo $filas_s["cedula"];?></a></td>
                            <td><?echo $filas_s["nombre"];?></td>
                            <td><?echo $filas_s["zona"];?></td>

                        </tr>
                        <?
                        $i=$i+1;
                   }
                   ?>
                  </table>
       <?
       }
  }
?>
</body>
</html>
