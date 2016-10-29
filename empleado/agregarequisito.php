<html>
<head>
  <title>Consejo de admon</title>
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
if(!isset($codigo)):
include("../conexion.php");
?>
  <center><h4><u>Requisitos Asociados</u></h4></center>
  <form action="" method="post" id="matfactura">
     <table border="0" align="center">
       <tr>
       <tr><td><br></td></tr>
          <td colspan="3"><b>Empresa:</b>&nbsp;
              <select name="codigo" class="cajas">
                 <option value="0">Seleccione la empresa
                    <?
                     $consulta="select maestro.codmaestro,maestro.nomaestro from maestro";
                     $resultado=mysql_query($consulta) or die("consulta de vendedor Incorrecta");
                      while ($filas=mysql_fetch_array($resultado)):
                          ?>
                          <option value="<?echo $filas["codmaestro"];?>"><?echo $filas["nomaestro"];?>
                          <?
                     endwhile;
                        ?>
               </select>
           </td>
        </tr>
         <tr>
          <td colspan="3"><b>Grupo:</b>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <select name="grupo" class="cajas">
                 <option value="0">Seleccione el grupo
                    <?
                     $consulta="select itemrequisito.codigo,itemrequisito.descripcion from itemrequisito";
                     $resultado=mysql_query($consulta) or die("consulta de vendedor Incorrecta");
                      while ($filas=mysql_fetch_array($resultado)):
                          ?>
                          <option value="<?echo $filas["codigo"];?>"><?echo $filas["descripcion"];?>
                          <?
                     endwhile;
                        ?>
               </select>
           </td>
        </tr>
      <tr><td><br></td></tr>
        <td colspan="5">
          <input type="submit" value="Crear Factura" class="boton" ></td>
    </table>
  </form>
<?
elseif(empty($codigo)):
  ?>
  <script language="javascript">
    alert("Seleccione la empresa de la lista ?")
    history.back()
  </script>
  <?
  elseif(empty($grupo)):
  ?>
  <script language="javascript">
    alert("Seleccione el grupo de la lista ?")
    history.back()
  </script>
  <?
else:
  include("../conexion.php");
  $con1="select maestro.codmaestro,maestro.nomaestro from maestro
        where maestro.codmaestro='$codigo'";
          $resu1=mysql_query($con1)or die("Error de busqueda de empresa");
  $reg1=mysql_affected_rows();
  $filas=mysql_fetch_array($resu1);
  $empresa=$filas["nomaestro"];
  $codigo=$filas["codmaestro"];
  $con="select itemrequisito.codigo,itemrequisito.descripcion from itemrequisito
        where itemrequisito.codigo='$grupo'";
  $resu=mysql_query($con)or die("Error de busqueda grupo");
  $reg=mysql_affected_rows();
  $filas_g=mysql_fetch_array($resu);
  $codbusca=$filas_g["codigo"];
  $descripcion=$filas_g["descripcion"];
   header("location: agregardetallado.php?empresa=$empresa&codigo=$codigo&codbusca=$codbusca&descripcion=$descripcion");
endif;
  ?>
</body>
</html>
