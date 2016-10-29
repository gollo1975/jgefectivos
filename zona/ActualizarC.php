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
if (!isset($estado)):
?>
<center><h4><u>Actualizar Contratos</u></h4></center>
  <form  action="" method="post" id="matlibra"   >
    <table border="0" align="center">
       <tr><td><br></td></tr>
       <tr>
         <td><b>Tipo de Contrato:&nbsp;</b></td>
         <td><input type="radio" name="estado" value="Comercial" class="cajas">Comercial</td>
       </tr>
              <tr><td><br></td></tr>
    <tr>
         <td colspan="2">
           <input type="submit" value="Buscar" class="boton">
       </tr>
      <tr><td><br></td></tr>
    </table>
    <br>
 </form>
<?
elseif(empty($estado)):
   ?>
   <script language="javascript">
     alert("Favor Seleccione el estado de la actualización.!")
     history.back()
   </script>
   <?
else:
  include("../conexion.php");
   $con="select modelocontrato.concepto,modelocontrato.codigo from modelocontrato where estado='$estado'";
   $res=mysql_query($con)or die("Consulta incorrecta");
   $reg=mysql_num_rows($res);
   if($reg!=0):
     while($filas=mysql_fetch_array($res)):

	       ?>
	       <center><h4><u>Actualizar Contratos</u></h4></center>
	         <form action="GuardarA.php" method="post" name='f1'>
	           <table border="0" align="center">
	             <tr><td><br></td></tr>
	             <tr>
	               <td><b>Cód_Cont.:</b></td>
	               <td><input type="text" value="<?echo $filas["codigo"];?>" name="CodC" size="2" class="cajas" readonly></td>
	             </tr>
	              <tr>
	             <tr>
	               <td><b>Observaciones:</b></td>
	               <td><textarea name="nota" cols="140" rows="35"class="cajas" ><?echo $filas["concepto"];?></textarea></td>
	             </tr>
	              <tr>
	               <td colspan="2">
	                 <input type="submit" value="Guardar" class="boton">
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
