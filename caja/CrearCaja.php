<?
 session_start();
?>
<html>
        <head>
                <title>Agregar Cajas de compensación</title>
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

                    function chequearcampos()
                    {
                         if (document.getElementById("Nit").value.length <=0)
                        {
                            alert ("Digite el nit de la caja de compensación.!");
                            document.getElementById("Nit").focus();
                            return;
                        }
                        if (document.getElementById("Caja").value.length <=0)
                        {
                            alert ("Digite el nombre de la caja de compensación.!");
                            document.getElementById("Caja").focus();
                            return;
                        }
                        if (document.getElementById("dirCaja").value.length <=0)
                        {
                            alert ("Digite la dirección de la caja de compensación.!");
                            document.getElementById("dirCaja").focus();
                            return;
                        }
                        if (document.getElementById("Telefono").value.length <=0)
                        {
                            alert ("Digite el telefono de la caja de compensación.!");
                            document.getElementById("Telefono").focus();
                            return;
                        }
                        document.getElementById("matcaja").submit();

                    }
                </script>

</head>
<body>
<? if(session_is_registered("xsession")){
      if (!isset($Nit)){
         include("../conexion.php");
                ?>
                <center><h4><u>Cajas de Compensación</u></h4></center>
                <form action="" method="post" id="matcaja" name="matcaja">
                        <table border="0" align="center"
                                <tr>
                                        <td colspan="2"><br></th>
                                </tr>
                                <tr>
                                        <td><b>Nit_Caja:</b></td>
                                        <td><input type="text" name="Nit" value="" size="13" maxlength="13" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Nit">
                                </tr>
                                <tr>
                                        <td><b>Caja:</b></td>
                                        <td><input type="text" name="Caja" value="" size="45" maxlength="45" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Caja">
                                </tr>
                                <tr>
                                        <td><b>Dirección:</b></td>
                                        <td><input type="text" name="dirCaja" value="" size="45" maxlength="45" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="dirCaja">
                                </tr>
                                <tr>
                                        <td><b>Teléfono:</b></td>
                                        <td><input type="text" name="Telefono" value="" size="13" maxlength="7" class="cajas"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Telefono">
                                </tr>
                                  <tr>
			       <td><b>Municipio:</b></td>
			          <td colspan="5"><select name="CodMuni" class="cajas" id="CodMuni">
			          <option value="0">Seleccione el Municipio
			          <?
			            $consulta_d="select codmuni,municipio from municipio order by municipio ";
			            $resultado_d=mysql_query($consulta_d)or die ("Error al buscar municipios");
			            while($filas_d=mysql_fetch_array($resultado_d)):
			              ?>
			              <option value="<?echo $filas_d["codmuni"];?>"> <?echo $filas_d["municipio"];?>
			              <?
			              endwhile;
			              ?></select></td>
			       </tr>
                                <tr><td><br></td></tr>
                                <tr>
                                                <td colspan="2"><input type="button" Value="Guardar" class="boton" onclick="chequearcampos()">&nbsp;<input type="reset" Value="Limpiar" class="boton"></td>
                                        </tr>
                       </table>
                </form>
                <?
  }elseif(empty($CodMuni)){
             ?>
             <script language="javascript">
                  alert("Seleccione un municipio de la lista.! ?")
                  history.back()
             </script>
            <?
  }else{
         include("../conexion.php");
         $Caja = strtoupper($Caja);
         $dirCaja = strtoupper($dirCaja);
         $consulta = "select caja.nit from caja where caja.nit='$Nit'";
         $result = mysql_query ($consulta);
         $sw = mysql_fetch_row($result);
         if ($sw==0){
             $consulta="insert into caja (nit,nombre,direccion,telefono,codmuni)
               value('$Nit','$Caja','$dirCaja','$Telefono','$CodMuni')";
             $resultado=mysql_query($consulta) or die("Insercion incorrecta");
             echo "<script language=\"javascript\">";
	     echo "open (\"../pie.php?msg=Se Grabó $registro registro para la Caja: $Caja\",\"pie\");";
             echo ("open (\"CrearCaja.php\",\"_self\");");
	     echo "</script>";
         }else{
             ?>
              <script language="javascript">
                   alert("Este nit ya esta creado en el sistema ?")
                   history.back()
              </script>
              <?
        }
  }
}else{
?>
 <script language="javascript">
    alert("Debe de hacer Inicio de Sección")
    pagina='../acceso/agregar.php'
    tiempo=10
    ubicacion='_self'
    setTimeout("open(pagina,ubicacion)",tiempo)
 </script>
<?
}
                 ?>
        </body>
</html>
