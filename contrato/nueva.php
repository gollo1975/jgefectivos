<?
 session_start();
?>
<html>
<head>
<title>Modificacion de contrato</title>
 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<?
 if(session_is_registered("xsession")):
if (empty($estado)):
?>
<center><h4><u>Matricula de Contratos</u></h4></center>
  <form  action="" method="post" id="matlibra"   >
    <table border="0" align="center">
       <tr><td><br></td></tr>
       <tr>
         <td><b>Tipo de Contrato:&nbsp;</b></td>
         <td><input type="radio" name="estado" value="FIJO" class="cajas">Fijo<input type="radio" name="estado" value="INDEFINIDO" class="cajas">Indefinido<input type="radio" name="estado" value="LABOR" class="cajas">Obra o Labor<input type="radio" name="estado" value="ADICCION" class="cajas">Adcional al Contrato</td>
       </tr>
              <tr><td><br></td></tr>
    <tr>
         <td colspan="2">
           <input type="submit" value="Buscar" class="boton">
           <input type="reset" value="Limpiar"class="boton"> </td>
       </tr>
      <tr><td><br></td></tr>
    </table>
    <br>
 </form>
<?
else:
  include("../conexion.php");
  $con="select modelocon.nota,modelocon.codmodelo from modelocon where estado='$estado'";
   $res=mysql_query($con)or die("Consulta incorrecta");
   $reg=mysql_num_rows($res);
   If($reg!=0):
     while($filas=mysql_fetch_array($res)):

	       ?>
	       <center><h4><u>Matricular Contratos</u></h4></center>
	         <form action="guardarcon.php" method="post" >  
	           <table border="0" align="center">
	             <tr><td><br></td></tr>
	             <tr>
	               <td><b>Nro_Modelo:</b></td>
	               <td><input type="text" value="<?echo $filas["codmodelo"];?>" name="codigo" size="2" class="cajas" readonly></td>
	             </tr>
	              <tr>
	             <tr>
	               <td><b>Observaciones:</b></td>
	               <td><textarea name="nota" cols="90" rows="20"class="cajas" ><?echo $filas["nota"];?></textarea></td>
	             </tr>
	              <tr>
	               <td colspan="2">
	                 <input type="submit" value="Guardar" class="boton">
	                 <input type="reset" value="Limpiar"class="boton">
	               </td>
	              </tr>
	            <?
	            endwhile;
   else:
      ?>
      <script language="javascript">
        alert("No hay Registro en sistema ?")
        history.back()
      </script>
      <?
   endif;
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
