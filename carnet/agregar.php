<html>
<head>
  <title>Matricular Carnets</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
	<script language="javascript">
	function inicio_index() {
	
		form1.cedula.value="";
  		form1.cedula.focus() 
	}
	</script>
</head>
<body  onload = "inicio_index ()">
<?

   if (!isset($documento)):
      ?>
      <center><h4>Matricula de Carnets</h4></center>
      <form action="" method="post">
         <table border="0" align="center"
            <tr><td><br></td></tr>
            <tr>
               <td><b>Documento de Indentidad:</b></td>
              <td><input type="text" name="documento" value="" size="13" mexlength="13"></td>
            </tr>
            <tr><td><br></td></tr>
            <tr>
               <td colspan="8"><input type="submit" Value="Buscar" class="boton"></td>
            </tr>
        </table>
      </form>
      <?
   elseif (empty($documento)):
      ?>
     <script language="javascript">
       alert("El campo Documento no puede ser Vacio ?")
       history.back()
     </script>
     <?
   else:
     include("../conexion.php");
     $consulta="select empleado.cedemple,empleado.nomemple,empleado.nomemple1,empleado.apemple,empleado.apemple1 from contrato,empleado
          where empleado.codemple=contrato.codemple and
           contrato.fechater='0000-00-00' and
          empleado.cedemple='$documento'";
     $resu=mysql_query($consulta)or die ("Error de Consulta");
     $reg=mysql_num_rows($resu);
     if ($reg!=0):
        while($filas=mysql_fetch_array($resu)):
          ?>
         <center><h4>Datos Del Carnet</h4></center>
         <form name="form1" id="form1" action="grabarcarnet.php" method="post">
         <table border="0" align="center">
           <tr><td><br></td></tr>
           <tr>
              <td><b>Documento:</b></td>
              <td><input type="text" name="documento" value="<?echo $filas["cedemple"];?>"class="cajas" size="13" mexlength="13" readonly></td>
           </tr>
           <tr>
              <td><b>Empleado:</b></td>
              <td><input type="text" name="nombres" value="<?echo $filas["nomemple"];?>&nbsp;<?echo $filas["nomemple1"];?>&nbsp;<?echo $filas["apemple"];?>&nbsp;<?echo $filas["apemple1"];?>"class="cajas" size="48" mexlength="48" readonly></td>
           </tr>
           <tr>
              <td><b>Fecha_Grabado:</b></td>
              <td><input type="text" name="fecha" value="<?echo date("Y-m-d");?>" class="cajas"size="10" mexlength="10" readonly></td>
           </tr>
           <tr>
              <td><b>Estado:</b></td>
                 <td><select name="estado" class="cajas">
                 <option value="bueno">BUENO
                 <option value="malo">MALO
                 </select></td>
           </tr>
          <tr>
            <td><b>Cantidad:</b></td>
            <td><input type="text" name="cantidad" value="" size="11" mexlength="11"></td>
          </tr>
          <tr>
              <td><b>Tipo_Carnet:</b></td>
                 <td><select name="tipo" class="cajas">
                 <option value="0">Seleccione la opción   
                 <option value="EMPRESA USUARIA">EMPRESA USUARIA
                 <option value="EPS">EPS
                 <option value="PENSION">FONDO DE PENSION
                 <option value="CAJA DE COMPENSACION">CAJA DE COMPENSACION
                 <option value="FUNERARIA">FUNERARIA
                 <option value="CODIGO DE BARRA">CODIGO DE BARRA
                 </select></td>
           </tr>
          <tr><td><br></td></tr>
          <tr>
               <td colspan="8"><input type="submit" Value="Grabar" class="boton"></td>
            </tr>
        </table>
      </form>
          <?
        endwhile;
     else:
        ?>
             <script language="javascript">
               alert("Este Documento no existe, o el Empleado esta retirado ?")
               open("agregar.php","_self")
             </script>
             <?
     endif;
   endif;

                      ?>
       </body>
</html>
