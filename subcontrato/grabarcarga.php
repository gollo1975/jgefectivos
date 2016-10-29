<?
if(empty($contratista)):
?>
  <script language="javascript">
    alert ("Despliegue la vista para eligir El contratista ?")
    history.back()
  </script>
    <?
else:
  include("../conexion.php");
              $consulta = "select count(*) from subcontrato";
              $result = mysql_query ($consulta);
              $sw = mysql_fetch_row($result);
              if ($sw[0]>0):
                      $consulta = "select max(cast(item as unsigned)) + 1 from subcontrato";
                      $result = mysql_query($consulta) or die ("Fallo en la consulta");
                      $codco = mysql_fetch_row($result);
                      $item = str_pad ($codco[0], 4, "0", STR_PAD_LEFT);

              else:
                   $item="0001";
              endif;
                   $consulta="insert into subcontrato(item,cedemple,nombre,contratista)
                      values('$item','$cedula','$nombre','$contratista')";
                     $resultado=mysql_query($consulta)or die("inserección incorrecta");
      ?>
            <script language="javascript">
              alert("Datos Adicionados con éxito ?")
              history.go(-2)
             //open("agregar.php","_self");
            </script>
       <?
 endif;
 ?>
