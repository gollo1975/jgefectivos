<?
        if (empty($cedemple))
        {
?>
                <script language="javascript">
                        alert("Digite un centro")
                        history.back()
                </script>
<?
                      }
                        elseif(empty($nomemple))
                        {
                ?>
                                <script language="javascript">
                                        alert("Digite un Nombre " )
                                        history.back()
                                </script>
              <?
                      }
                        elseif(empty($apemple))
                        {
                ?>
                                <script language="javascript">
                                        alert("Digite una Cedula " )
                                        history.back()
                                </script>
              <?
                      }
                        elseif(empty($telemple))
                        {
                ?>
                                <script language="javascript">
                                        alert("Digite un Telefono" )
                                        history.back()
                                </script>
              <?
                      }
                        elseif(empty($diremple))
                        {
                ?>
                                <script language="javascript">
                                        alert("Digite una Direccion " )
                                        history.back()
                                </script>
              <?
                        }
                        elseif(empty($municipio))
                        {
                ?>
                                <script language="javascript">
                                        alert("Digite un Municipio" )
                                        history.back()
                                </script>
              <?
                      }
                        elseif(empty($fechanac))
                        {
              ?>
                                <script language="javascript">
                                        alert("Digite Una Fecha" )
                                        history.back()
                                </script>
              <?

                        }

                         elseif(empty($nomina))
                        {
                ?>
                                <script language="javascript">
                                        alert("Digite una Nomina" )
                                        history.back()
                                </script>
                <?
        }
        else
        {
                include("../conexion.php");
                include("validarfecha.php");
                if ($sw==0)
                {
                       $nomemple=strtoupper($nomemple);
                       $apemple=strtoupper($apemple);
                       $diremple=strtoupper($diremple);
                       $municipio=strtoupper($municipio);
                       $sexo=strtoupper($sexo);
                       $estcivil=strtoupper($estcivil);
                       $nomina=strtoupper($nomina);
                        $consulta="UPDATE empleado SET
                                
                                nomemple = '$nomemple',
                                apemple = '$apemple',
                                telemple = '$telemple',
                                diremple = '$diremple',
                                municipio = '$municipio',
                                bepper = '$bepper',
                                codbeper = '$codbeper',
                                celular = '$celular',
                                sexo='$sexo',
                                fechanac='$fechanac',
                                estcivil='$estcivil',
                                cuenta = '$cuenta',
                                codbanco='$codbanco',
                                codzona='$codzona',
                                codeps='$codeps',
                                codpension='$codpension',
                                nomina = '$nomina',
                                codcosto='$codcosto',
                                estado = '$estado' WHERE  cedemple='$cedemple'";
                        $resultado=mysql_query($consulta) or die("Actualizacion Incorrecta");
                        $registros=mysql_affected_rows();
                        if ($registros==0)
                        {
?>
                                <script language="javascript">
                                        alert("No se Actualizo el Registro correctamente")
                                        history.go(-2)
                                </script>
<?
                        }
                        else
                        {
?>
                                <script language="javascript">
                                        alert("Registro Actualizado")
                                        history.go(-2)
                         </script>
<?
                        }
                }
                else
                {
?>
                        <script language="javascript">
                                alert("Fecha No Valida")
                                history.back()
                        </script>
<?
                }
        }
?>
