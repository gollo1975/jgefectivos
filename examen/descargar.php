<html>
<head>
  <title>Registrar Descargar</title>
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
  <center><h4><u>Registrar descarga.</u></h4></center>
  <form action="" method="post" id="matfactura" name="f1">
     <table border="0" align="center">
       <tr>
       <tr><td><br></td></tr>
          <td colspan="3"><b>Proveedor:</b>&nbsp;
              <select name="codigo" class="cajas">
                 <option value="0">Seleccione el proveedor
                    <?
                     $consulta="select provedor.nitprove,provedor.nomprove from provedor where alianzaexamen='SI' and estado='ACTIVO' order by nomprove";
                     $resultado=mysql_query($consulta) or die("consulta de vendedor Incorrecta");
                      while ($filas=mysql_fetch_array($resultado)):
                          ?>
                          <option value="<?echo $filas["nitprove"];?>"><?echo $filas["nomprove"];?>
                          <?
                     endwhile;
                        ?>
               </select>
           </td>
        </tr>
      <tr><td><br></td></tr>
        <td colspan="5">
          <input type="submit" value="Procesar" class="boton" id="procesar" name="procesar"></td>
    </table>
  </form>
<?
elseif(empty($codigo)):
  ?>
  <script language="javascript">
    alert("Digite el proveedor para el descargue ?")
    history.back()
  </script>
  <?
else:
  include("../conexion.php");
  $con1="select  provedor.* from provedor
        where provedor.nitprove='$codigo'";
          $resu1=mysql_query($con1)or die("Error de busqueda de provedores");
  $reg1=mysql_affected_rows();
  $filas=mysql_fetch_array($resu1);
  $provedor=$filas["nomprove"];
  $codigo=$filas["nitprove"]; 
   header("location: agregar.php?provedor=$provedor&codigo=$codigo");
endif;
  ?>
</body>
</html>
