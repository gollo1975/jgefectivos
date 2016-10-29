<html>
<head>
  <title></title>
</head>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<body>
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
          if (document.getElementById("Cedula").value.length <=0)
          {
             alert ("Digite el documento de Identidad ?");
             document.getElementById("Cedula").focus();
             return;
          }
             document.getElementById("matcrea").submit();
      }
        </script>
<?
if(!isset($Cedula)):
$UsuarioPreparador= strtoupper($UsuarioPreparador);
   include("../conexion.php");
	   ?>
	  <div align="center"><h4><u>LISTA DE REQUISITOS</u></h4></div>
	  <form action="" method="post" id="matcrea">
      <table border="0" align="center">
	        <tr><td><br></td></tr>
	        <tr>
	            <td><b>Documento de Identidad:&nbsp;</b></td>
	            <td><input type="text" name="Cedula" size="15" maxlength="15" onFocus="ColorFoco(this.id)" class="cajas"onblur="QuitarFoco(this.id)" id="Cedula"></td>
	        </tr>
	        <tr><td><br></td></tr>
	       <td colspan="5">
	       <input type="button" value="Buscar" class="boton" onClick="chequearcampos()"></td>
	     </table>
	    </form>
<?
else:
   include("../conexion.php");
   $con="select maestrorequisito.* from maestrorequisito where maestrorequisito.cedula='$Cedula' order by maestrorequisito.idRequisito DESC";
   $res=mysql_query($con)or die ("Error al buscar el examen ?");
   $reg=mysql_num_rows($res);
   if($reg != 0):
           ?>
	     <div align="center"><h4><u>LISTA DE REQUISITOS</u></h4></div>
              <input type="hidden" name="UsuarioPreparador" value="<?echo $UsuarioPreparador;?>">
              <table border="0" align="center">
                  <tr class="cajas">
                     <th>#</th>
                     <th>Radicado</th>
                     <th>Documento</th>
                     <th>Empleado</th>
                     <th>Tipo_Requisito</th>
                     <th>Usuario</th>
                     <th>F_Proceso</th>
                     <th>F_Editado</th>
                     <th>Cerrado</th>
                  </tr>
                  <?
                  $a=1;
                  while($fila=mysql_fetch_array($res)){
                       ?>
                       <tr class="cajas">
	                       <th><?echo $a;?></th>
	                       <td><a href="ImprimirReporteChequeo.php?IdChequeo=<?echo $fila["idRequisito"];?>"><?echo $fila["idRequisito"];?></a></td>
	                       <td><?echo $Cedula;?></td>
	                       <td><?echo $fila["nombre"];?></td>
	                       <td><?echo $fila["tiporequisito"];?></td>
	                       <td><?echo $fila["usuarioproceso"];?></td>
	                       <td><?echo $fila["fechap"];?></td>
	                       <td><?echo $fila["fecham"];?></td>
	                       <td><?echo $fila["cerrado"];?></td>
                       </tr>
	                       <?
	                       $a += 1;
                  }
                  ?>

	         </table>


         <?
      else:
         ?>
         <script language="javascript">
            alert("El Documento digitado no presente Check de Lista en el sistema, favor verificar.!")
            history.back()
         </script>
         <?
      endif;
endif;
?>
</body>
</html>
