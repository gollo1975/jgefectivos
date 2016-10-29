<html>
<head>
  <title></title>
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
</script>
</head>
<body>
<?
  if (!isset($Empresa)):
     include("../conexion.php");
  ?>
  <center><h4><u>Activar Colillas</u></h4></center>

<form action="" method="post">
  <table border="0" align="center">
  <tr><td><br></td></tr>
  <tr>
    <td><b>Desde:</b></td>
   <td><input type="text" name="Desde" value="<? echo date("Y-m-d");?>" size="12" class="cajas" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Desde"></td>
    <td><b>Hasta:</b></td>
    <td><input type="text" name="Hasta" value="<? echo date("Y-m-d");?>" size="12" class="cajas"maxlength="10" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Hasta"></td>
  </tr>
<tr>
         <td><b>Empresa:</b></td>
                              <td colspan="10"><select name="Empresa" class="cajas">
                              <option value="0">Seleccione
                                <?
                                 $consulta_z="select codmaestro,nomaestro from maestro";
                                 $resultado_z=mysql_query($consulta_z)or die ("consulta incorrecta");
                                while($filas_z=mysql_fetch_array($resultado_z)):
                                   ?>
                                   <option value="<?echo $filas_z["codmaestro"];?>"> <?echo $filas_z["nomaestro"];?>
                                  <?
                                  endwhile;
                                  ?>
                                  </select></td>
      </tr>
     <tr><td><br></td></tr>
   <tr>
    <td colspan="2">
      <input type="submit" value="Buscar" class="boton">

    </td>
  </tr>
   <tr><td></td></tr>
    <tr><td></td></tr>
</table>

</form>
<?
elseif (empty($Empresa)):
    ?>
     <script language="javascript">
        alert("Seleccione la empresa para la busqueda")
        history.back()
     </script>
    <?
 else:
     include("../conexion.php");
     $consu="select zona.codzona,zona.zona from maestro,sucursal,periodo,zona where
	         maestro.codmaestro=sucursal.codmaestro and
	         sucursal.codsucursal=zona.codsucursal and
	         zona.codzona=periodo.codzona and
                 periodo.pagado='' and
	         periodo.desde='$Desde' and periodo.hasta='$Hasta' and
	         maestro.codmaestro='$Empresa'order by zona.zona";
      $resulta=mysql_query($consu)or die ("Error de busqueda de nomina");
      $registro=mysql_affected_rows();
      if ($registro!=0):?>
		    <center><h4><u>Activar Colillas</u></h4></center>
		    <form action="ActivarC.php" method="post">
		    <input type="hidden" value="<?echo $Desde;?>" name="Desde">
		    <input type="hidden" value="<?echo $Hasta;?>" name="Hasta">

		       <table border="0" align="center" width="510">
		          <tr class="cajas">
			   <th><b>Item</b></td><th>Cod_Zona</th><th><b>Zona</b></th>
		          </tr>
			  <?
			  $i=1;
			  echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resulta) . "\">");
			  while ($filas_Z = mysql_fetch_array($resulta)):
			           ?>
			           <tr class="cajas">
		                   <th><?echo $i;?></th>

			              <?
			              echo ("<td class=\"cajas\"><input type=\"checkbox\" id=name=\"datos[" . $i . "]\" name=\"datos[" . $i . "]\" value=\"" . $filas_Z['codzona'] ."\"\">" .$filas_Z['codzona']."</td>");?>
			              <td class="cajas"><input type="text" value="<?echo $filas_Z["zona"];?>" name="zona[<? echo $i;?>]"id="zona[<? echo $i;?>]" size="67" readonly class="cajas"></td>
			            <tr>
			           <?
			           $i=$i+1;
			  endwhile;
		          ?>
		          <tr><td><br></td></tr>
		       <td colspan="5">
		          <input type="submit" value="Buscar" class="boton" ></td>
		       </table><?
      else:
		       ?>
		       <script language="javascript">
		            alert("No hay empresas activas pendiente por pago de nomina!")
		            history.back()
		       </script>
		       <?
      endif;
 endif;
 ?>
</body>
</html>
