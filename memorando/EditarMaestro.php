<html>
<head>
  <title>Modificar items</title>
   <LINK  REL="stylesheet" HREF="../estilo.css" type="text/css">
</head>
<body>
<?php
if(!isset($EstadoS)){
   ?>
   <div align="center"><h4><u>Editar Maestro</u></h4></div>
   <form action="" method="post" id="f1" name="f1">
      <table border="0" align="center">
          <tr><td><br></td></tr>
          <tr>
              <td><b>Tipo_Proceso:</b></td>
              <td><input type="radio" name="EstadoS" value="Concepto" id="EstadoS">Editar Conceptos<input type="radio" name="EstadoS" value="Editar Relación" id="EstadoS">Editar Detalle</td>
          </tr>

       <tr><td><br></td></tr>
       <tr>
       <td colspan="6">
	   <input type="submit" Value="Buscar" class="boton" id="buscar" name="buscar"></td>
       </tr>
 </table>
 </form>
<?
}else{
     if(empty($EstadoS)){
        ?>
         <script language="javascript">
            alert("Seleccione el tipo de proceso a editar!")
            history.back()
         </script>
        <?
     }else{

           if($EstadoS=='Concepto'){
	          include("../conexion.php");
	          $conM="select tipoprocesomemo.* from tipoprocesomemo";
		  $resulM=mysql_query($conM) or die("Error al busca procesos");
		  $reg=mysql_num_rows($resulM);
	          if($reg != 0){
	             ?>
	             <div align="center"><h4><u>Editar Procesos</u></h4></div>
	              <table border="0" align="center">
	                  <tr>
	                      <th>Item</th>
	                     <th>Id_Proceso</th>
	                     <th>Proceso</th>
	                     <th>Estado</th>
	                  </tr>
	                 <?
	                 $f=1;
	                 while($filas=mysql_fetch_array($resulM)){
	                     ?>
	                     <tr class="cajas">
	                       <th><?echo $f;?></th>
	                        <td><a href="EditarP.php?NroP=<?echo $filas["idproceso"];?>&EstadoS=<?echo $EstadoS;?>&Concepto=<?echo $filas["concepto"];?>&EstadoP=<?echo $filas["estado"];?>"><div align="center"><?echo $filas["idproceso"];?></div></a></td>
	                        <td><?echo $filas["concepto"];?></td>
	                        <td><?echo $filas["estado"];?></td>
	                     </tr>
	                     <?
	                   $f=$f+1;
	                 }
	                 ?>
	              </table>
	              <div align="center"><h4><u><a href="EditarMaestro.php"><font color="red">Volver</font></a></u></h4></div>
	             <?
	          }
           }else{
                  include("../conexion.php");
	          $conP="select tipoproceso.*,tipoprocesomemo.concepto from tipoprocesomemo,tipoproceso
                        where tipoprocesomemo.idproceso=tipoproceso.idproceso order by tipoprocesomemo.idproceso";
		  $resulP=mysql_query($conP) or die("Error al busca procesos");
		  $regP=mysql_num_rows($resulP);
	          if($regP != 0){
	             ?>
	             <div align="center"><h4><u>Editar Procesos</u></h4></div>
	              <table border="0" align="center">
	                  <tr>
	                      <th>Item</th>
                              <th>Id_Concepto</th>
	                     <th>Id_Proceso</th>
                             <th>Proceso</th>
	                     <th>Descripción</th>
	                  </tr>
	                 <?
	                 $f=1;
	                 while($filas=mysql_fetch_array($resulP)){
	                     ?>
	                     <tr class="cajas">
	                       <th><?echo $f;?></th>
	                        <td><a href="EditarR.php?NroR=<?echo $filas["idpromemo"];?>&EstadoS=<?echo $EstadoS;?>&NroP=<?echo $filas["idproceso"];?>&Concepto=<?echo $filas["concepto"];?>&DetalleNota=<?echo $filas["descripcion"];?>"><div align="center"><?echo $filas["idproceso"];?></div></a></td>
                                <td><?echo $filas["idproceso"];?></td>
                                <td><?echo $filas["concepto"];?></td>
	                        <td colspan="5"><p align="justify"><textarea name="Nota" cols="89" rows="10" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="Nota"><?echo $filas["descripcion"];?></textarea></td>
	                     </tr>
	                     <?
	                   $f=$f+1;
	                 }
	                 ?>
	              </table>
	              <div align="center"><h4><u><a href="EditarMaestro.php"><font color="red">Volver</font></a></u></h4></div>
	             <?
	          }
           }
     }
}
?>
</body>

</html>
