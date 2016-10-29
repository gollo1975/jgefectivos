<html>
<head>
  <title>Entregas</title>
  <link rel="stylesheet" href="../estilo.css" type="text/css">
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
                        if (document.getElementById("cedula").value.length <=0)
                        {
                            alert ("Digite el ducumento del Responsable");
                            document.getElementById("cedula").focus();
                            return;
                        }
                        document.getElementById("matelimi").submit();
                   }
                     function validar()
                    {
                        if (document.getElementById("responsable").value.length <=0)
                        {
                            alert ("Digite el nombre del resposable de la carpeta !");
                            document.getElementById("responsable").focus();
                            return;
                        }
                        if (document.getElementById("motivo").value.length <=0)
                        {
                            alert ("Digite el motivo del prestamo de la carpeta !");
                            document.getElementById("motivo").focus();
                            return;
                        }
                        document.getElementById("matentrega").submit();
                   }
    </script>
</head>
<body>
<?
if(!isset($cedula)):
?>
  <center><h4><u>Devoución de Carpetas</u></h4></center>
  <form action="" method="post" >
    <table border="0" align="center">
    <tr><td><br></td></tr>
       <td><b>Tipo Busqueda:</b></td>
     <td><select name="cedula" class="cajas">
         <option value="0">Seleccione la Opci&oacute;n 
         <option value="1">Documento
         <option value="2">Cod_Empleado 
         </select></td>
   </tr>
   <tr>
     <td><b>Documento Empleado:</b></td>
     <td><input type="text" name="valor" value="" size="20" maxlength="20" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="valor"></td>
   </tr>
        <tr><td><br></td></tr>
        <tr>
        <td colspan="5">
        <input type="submit" value="Buscar" class="boton" ></td>
        </tr>
    </table>
  </form>
<?
elseif(empty($cedula)):
  ?>
   <script language="javascript">
      alert("Seleccione el tipo de busqueda ?");
      history.back()
   </script>
  <?
elseif(empty($valor)):
 ?>
   <script language="javascript">
      alert("Digite el dato a buscar en sistema ?");
      history.back()
   </script>
  <?
 else:
  include("../conexion.php");
  $opc=$cedula;
  switch($opc)
    {
    case 1:
  $con="select carpeta.* from carpeta
        where carpeta.cedemple='$valor' and estado='ACTIVA'";
   break;
    case 2:
  $con="select carpeta.* from carpeta
        where carpeta.codemple='$valor' and estado='ACTIVA'";
   break;
   
   }
  $res=mysql_query($con)or die("Error al busar datos");
  $reg=mysql_num_rows($res);
  if($reg==0):
       ?>
       <script language="javascript">
          alert ("Esta carpeta no ha salido del archivo?");
          history.back()
       </script>
       <?
  else: ?>
  <center><h4><u>Listado de Salidas</u></h4></center>
       <table border="0" align="center">
        <tr><td></td> </tr>
        <tr class="cajas">
         <th>Item</th>
             <th>Nro_Entrega</th>
             <th>Código</th>
             <th>Ducumento</th>
             <th>Empleado</th>
             <th>F_Entrega</th>
             <th>Estado</th>
             </tr>
            <?
            $i=1;
             while($filas=mysql_fetch_array($res)):
           ?>
             <tr class="cajas">
             <th><?echo $i;?></th>
              <td> <a href="detallado.php?nroentrega=<?echo $filas["nroentrega"];?>"><?echo $filas["nroentrega"];?></a></td>
              <td><?echo $filas["codemple"];?></td>
              <td><?echo $filas["cedemple"];?></td>
               <td><?echo $filas["empleado"];?></td>
               <td><?echo $filas["fechaentrega"];?></td>
               <td><?echo $filas["estado"];?></td>
               </tr>
               <?
               $i=$i + 1;
             endwhile;
             ?>
             </table>
	       <?
  endif;
endif;
?>
</body>

</html>
