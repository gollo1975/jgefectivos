<td><input type="hidden" name="depart" value="<? echo $depart;?>"</td>
<?
                include("../conexion.php");
               $municipio=strtoupper($municipio);
                $consulta="update municipio set municipio='$municipio',codepart='$depart' where codmuni='$codmuni'";
                $resultado=mysql_query($consulta) or die("Se present� error en la acutalizaci�n");
                $regis=mysql_affected_rows();
                echo "<script language=\"javascript\">";
                    echo "open (\"../pie.php?msg=Se actualiz� $regis registro, para el Municipio: $municipio\",\"pie\");";
                    echo "open (\"listado.php\",\"_self\");";
                echo "</script>";


?>
