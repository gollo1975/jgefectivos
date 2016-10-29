<script language="javascript">
                function imprimir(numero)// para declara funcion
                {
                pagina='imprimir.php?nrofactura=' + numero
                tiempo=90
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
                }
</script>
<?
if(empty($inicio)):
   ?>
   <script language="javascript">
      alert("Digite la fecha de inicio")
      history.back()
   </script>
   <?
   elseif(empty($fechafinal)):
   ?>
   <script language="javascript">
      alert("Digite la fecha de vencimiento.")
      history.back()
   </script>
   <?
else:
          include("../conexion.php");
         $observacion=strtoupper($observacion);
          $consulta="update factura set codzona='$Codzona',fechaini='$inicio',fechaven='$fechafinal',nroservicio='$Tipo',observacion='$observacion' where factura.nrofactura='$nrofactura'";
            $resultado=mysql_query($consulta) or die("Error al actualizar factura");
             $registro=mysql_affected_rows();
            ?>
            <script language="javascript">
               alert("La Tabla de factura se actualizó con éxito ?")
            </script>
            <?
            echo ("<script language=\"javascript\">");
            echo ("open (\"imprimir.php?nrofactura=$nrofactura\" ,\"\");");
               echo ("open (\"Modificar.php?\",\"_self\");");
            echo ("</script>");
endif;
 ?>
