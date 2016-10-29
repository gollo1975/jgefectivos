<?
  if(empty($buscar)):
   ?>
     <script language="javascript">
       alert("Para Eliminar el Registro, Debe de seleccionar un Item ?")
       history.back()
       </script>
   <?
  else:
       include("../conexion.php");
        $lista=$_POST["buscar"];
         foreach ($lista as $dato)
        {
                $consulta="delete from funeraria where documento='$dato' and cedemple='$cedula'";
                $resultado=mysql_query($consulta) or die ("eliminacion incorrecta");
                $registros=mysql_affected_rows();
               }
        if ($registros==0)
        {
?>
                <script language="javascript">
                        alert("El Registro NO Fue Eliminado")
                        history.back();
                </script>
<?
        }
        else
        {
        ?>
        <script language="javascript">
          alert("El Registro se Elimino con Exito ?")
          open("eliminar.php","_self")
        </script>
        <?
         // header("location: modificar.php?cedemple=$cedemple");
        }
   endif;
?>
