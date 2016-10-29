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
                $consulta="delete from decentro where codsala='$dato' and codcentro='$codcentro'";
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
          open("modificar.php?cedemple=<?echo $cedemple;?>","_self")
        </script>
        <?
         // header("location: modificar.php?cedemple=$cedemple");
        }
   endif;
?>
