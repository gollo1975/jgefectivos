<?
if($contra==$confirmar):
	include("../conexion.php");
	$clave=strtoupper($clave);
        $email=strtoupper($email);
        $contra=strtoupper($contra);
	$fecha=date("Y-m-d");
	$con="select accesoasociado.usuario from accesoasociado where usuario='$cedula'";
	$res=mysql_query($con)or die ("Error al buscar usuarios");
	$reg=mysql_num_rows($res);
	if($reg==0):
	    $consulta="insert into accesoasociado (usuario,nombre,clave,email,telefono,celular,fechar)
	    values('$cedula','$asociado','$contra','$email','$telefono','$celular','$fecha')";
	    $resultad=mysql_query($consulta)or die("Error al grabar Usuarios");
	    $registros=mysql_affected_rows();
	    if($registros==0):
	       ?>
	       <script language="javascript">
	         alert("Los datos no se grabaron con exito en sistemas?")
	         history.back()
	       </script>
	       <?
	    else:
	        ?>
	       <script language="javascript">
	         alert("El registro se grabó con exito  en el sistemas?")
	         open("registrarse.php","_self");
	       </script>
	       <?
	    endif;
	else:
	    ?>
	    <script language="javascript">
	      alert("Lo siento, este usuario ya existe en sistema, verifique la información")
	      history.back()
	    </script>
	    <?
	endif;
else:
  ?>
   <script language="javascript">
       alert("Error al confirmar la contraseña o clave, vuelva a intentarlo?")
       history.back()
   </script>
   <?
endif;
	?>
</body>
</html>
