<html>

<head>
<title>Modificación de Incapacidad</title>
<LINK  REL="stylesheet" HREF="../estilo.css" type="text/css">
</head>
<body>
<?
if (!isset($opcion)):
?>
    <center><h4>Modificar Incapacidades</h4></center>
  <form action="" method="post">
    <table border="0" align="center">
      <tr>
        <td colspan="2" class="fondo"><br></td>
      </tr>
      <tr>
        <td><b>Tipo de Selección</b></td>
        <td><select name="opcion" class="cajas">
          <option value="0">Seleccióne Una Opción
          <option value="1">Nro_Incapacidad
          <option value="2">Documento
        </select></td>
      </tr>
      <tr>
        <td><b>Digite el Dato: </b></td>
         <td><input type="text" name="valor" value="" size="20"></td>
       </tr>
       <tr><td><br></td></tr>
       <tr>
         <td colspan="2">
           <input type="submit" value="Buscar" class="boton">
           <input type="reset" value="Limpiar" class="boton">
           </td>
         </tr>
    </table>
    <br>
  </form>
  <?
elseif (empty($valor)):
   ?>
   <script language="javascript">
     alert("Debe de Digitar un valor a consultar")
     history.back()
   </script>
     <?
elseif (empty($opcion)):
   ?>
   <script language="javascript">
     alert("Debe de seleccionar una Opción")
     history.back()
   </script>
   <?
   else:
     include("../conexion.php");
     $aux=$opcion;
     switch($aux)
       {
       case 1:
         $variable="select incapacidad.*,empleado.cedemple, empleado.nomemple,empleado.nomemple1,empleado.apemple1,empleado.apemple,eps.*,tipoinca.* from incapacidad,empleado,eps,tipoinca where
                   empleado.cedemple=incapacidad.cedemple and
                    empleado.codeps=eps.codeps and
                    incapacidad.tipoinca=tipoinca.tipoinca and
                   incapacidad.nroinca='$valor'";
         break;
       case 2:
          $variable="select incapacidad.*,empleado.cedemple, empleado.nomemple,empleado.nomemple1,empleado.apemple1,empleado.apemple,eps.*,tipoinca.* from incapacidad,empleado,eps,tipoinca where
                    empleado.cedemple=incapacidad.cedemple and
                    empleado.codeps=eps.codeps and
                     incapacidad.tipoinca=tipoinca.tipoinca and
                    empleado.cedemple='$valor'";
         break;
       }
        $resultado=mysql_query($variable)or die("consulta incorrecta");
        $registro=mysql_num_rows($resultado);
        if ($registro==0):
          ?>
          <script language="javascript">
            alert("El dato No existe en la BD.")
            history.back()
          </script>
         <?
         else:
         ?>
         <center><h4>Datos de la Incapacidad</h4></center>
         <table border="0" align="center">
           <tr>
             <td colspan="9"></td>
           </tr>
           <tr class="cajas">
              <th>Nro_Inca.</th>
              <th>Documento</th>
              <th>Nombres</th>
              <th>Apellidos</th>
              <th>Fecha_Inicio</th>
              <th>Fecha_Final</th>
              <th>Dias</th>
              <th>Descripción</th>
              <th>Eps</th>
              <th>Estado</th>
            </tr>

            <?
             while($filas=mysql_fetch_array($resultado)):
             ?>
               <tr class="cajas">

                 <td><a href="detalladoincapacidad.php?nroinca=<?echo $filas["nroinca"];?>&codigo=<?echo $codigo;?>"> <?echo $filas["nroinca"];?></td>
                 <td><?echo $filas["cedemple"];?></td>
                 <td><?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?></td>
                 <td><?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?></td>
                 <td><?echo $filas["fechaini"];?></td>
                 <td><?echo $filas["fechater"];?></td>
                 <td><?echo $filas["dias"];?></td>
                 <td><?echo $filas["concepto"];?></td>
                 <td><?echo $filas["eps"];?></td>
                 <td><?echo $filas["estado"];?></td>
                 </tr>
                <?
              endwhile;
            endif;
           endif;
         ?>
        </table>

       </body>


</html>
