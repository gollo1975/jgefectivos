<?
 session_start();
?>
<html>
        <head>
                <title>Crear Relación</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
<?  if(session_is_registered("xsession")):
    include("../conexion.php");
    $consulta="select comisionomina.* from comisionomina where codigo='$nro'";
    $resultado=mysql_query($consulta)or die("Consulta incorrecta");
    $registro=mysql_num_rows($resultado);
    if ($registro==0):
     ?>
     <script language="javascript">
       alert("No existe el registro en la bd ?")
       history.back()
     </script>
    <?
     else:
     ?><center><h4><u>Editar Relación</u></h4></center><?
     while($filas=mysql_fetch_array($resultado)):
       ?>

         <form action="GrabarEditado.php" method="post">
         <input type="hidden" value="<?echo $nro;?>" name="nro">
          <input type="hidden" value="<?echo $cedula;?>" name="cedula">
           <table border="0" align="center"width="310">
           <tr><td><br></td></tr>
             <tr>
              <td><b>Cod_Zona:</b></td>
             <td><input type="text" name="codzona"  value="<?echo $filas["codzona"];?>" size="4" readonly class="cajas" ></td>
             </tr>
             <tr>
              <td><b>Zona:</b></td>
             <td><input type="text" name="zona"  value="<?echo $filas["zona"];?>" size="50" readonly class="cajas" ></td>
             </tr>
              <td><b>Vendedor:</b></td>
               <td colspan="1"><select name="trabajador" class="cajasletra">
                 <?
                 $sucaux=$cedula;
                 $consulta_s="select empleado.cedemple,concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' ,apemple) as empleado from empleado,zona,contrato
                                     where  empleado.codzona=zona.codzona and
                                           empleado.codemple=contrato.codemple and
                                           contrato.fechater='0000-00-00' and
                                           zona.tipoempresa='SI'  order by empleado.cedemple";
                 $resultado_s=mysql_query($consulta_s)or die("Error al buscar eñ vendedor");
                 while($filas_s=mysql_fetch_array($resultado_s)):
                   if ($sucaux==$filas_s["cedemple"]):
                 ?>
                 <option value="<?echo $filas_s["cedemple"];?>" selected><?echo $filas_s["empleado"];?>
                 <?
                   else:
                   ?>
                     <option value="<?echo $filas_s["cedemple"];?>"><?echo $filas_s["empleado"];?>
                   <?
                   endif;
                 endwhile;
                 ?> </selet></td>
             </tr>
          <tr>
              <td> <b>Comparte:</b></td>
               <td ><select name="comparte" class="cajasletra">
                <option value="<?echo $filas["comparte"];?>"selected><?echo $filas["comparte"];?>
                  <option value="NO">NO
                  <option value="SI">SI
                  </select>
                </td>
        </tr>

         <tr><td><br></td></tr>
            <td colspan="2"><input type="submit" value="Guardar" class="boton">&nbsp;<input type="reset" value="Limpiar" class="boton"></td>
        </tr>
<tr><td><br></td></tr>
</table>

  </form>

        <?
                   endwhile;
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
 </body>
</html>
