<?php
        if (empty($Nit))
        {
?>
                <script language="javascript">
                        alert("Digite el nit de la caja de compensación.!")
                        history.back()
                </script>
<?
        }
        elseif (empty($Caja))
        {
?>
                <script language="javascript">
                        alert("Digite El nombre de la Caja de compensación.!")
                        history.back()
                </script>
<?
       }
        elseif (empty($Telefono))
        {
?>
                <script language="javascript">
                        alert("Digite un Télefono de la Caja de compensación.!")
                        history.back()
                </script>
<?
        }
         elseif (empty($DirCaja))
        {
       ?>
                <script language="javascript">
                        alert("Digite la direccion de la Caja de compensacion.!")
                        history.back()
                </script>
          <?

        }elseif (empty($CodMuni)){
?>
                <script language="javascript">
                        alert("Digite el municipio de la Caja de compensacion.!")
                        history.back()
                </script>
<?
        }
        else
        {
              $municipio=strtoupper($municipio);
              $DirCaja=strtoupper($DirCaja);
              $Caja=strtoupper($Caja);
                include("../conexion.php");
                $consulta="update caja set nit='$Nit',nombre='$Caja',direccion='$DirCaja',telefono='$Telefono',estado='$Estado', codmuni='$CodMuni' where caja.codigo_caja_pk='$Id'";
                $resultado=mysql_query($consulta) or die("Actualizacion Incorrecta");
                $registros=mysql_affected_rows();
                echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualizaron $registros registros para la caja: $Caja\",\"pie\");";
                    echo "open (\"EditarCaja.php\",\"_self\");";
                echo "</script>";
        }
?>
