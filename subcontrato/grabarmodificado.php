<?
if(empty($contrato)):
?>
  <script language="javascript">
    alert ("Despliegue la vista para eligir El contratista ?")
    history.back()
  </script>
    <?
else:
  include("../conexion.php");
               $consulta="update subcontrato set cedemple='$ced',nombre='$nom',contratista='$contrato'
               where subcontrato.item='$item'";
              $resultado=mysql_query($consulta)or die("inserección incorrecta");
      ?>
            <script language="javascript">
              alert("Datos Modificados  con éxito ?")
              history.go(-2)
             //open("agregar.php","_self");
            </script>
       <?
 endif;
 ?>
