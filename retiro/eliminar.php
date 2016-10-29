<?
  if(empty($busca)):
   ?>
     <script language="javascript">
       alert("Para Eliminar el Registro, Debe de seleccionar un Item ?")
       history.back()
       </script>
   <?
  else:
       include("../conexion.php");
        $lista=$_POST["busca"];
         foreach ($lista as $dato)
        {
                $consulta="delete from retiroprovision where codretiro='$dato'";
                $resultado=mysql_query($consulta) or die ("eliminacion incorrecta");
                $registros=mysql_affected_rows();
               }
        if ($registros==0)
        {
?>
                <script language="javascript">
                        alert("Registro(s) NO Eliminado(s)")
                        history.back();
                </script>
<?
        }
        else
        {
        ?>
        <script language="javascript">
          alert("El Registro se Elimino con Exito ?")
          open("modificaretiro.php?desde=<?echo $desde;?>&hasta=<?echo $hasta;?>&auxcodigo=<?echo $nit;?>","_self")
        </script>
        <?
         // header("location: modificar.php?cedemple=$cedemple");
        }
   endif;
?>
