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
                        elseif(empty($codbanco))
                        {
                ?>
                                <script language="javascript">
                                        alert("Seleccione el banco de la lista " )
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
         elseif(empty($periodo))
                        {
                ?>
                                <script language="javascript">
                                        alert("Digite el periodo de pago?" )
                                        history.back()
                                </script>
                <?
        }
         elseif(empty($salario))
                        {
                ?>
                                <script language="javascript">
                                        alert("Digite el salario de la persona" )
                                        history.back()
                                </script>
                <?
        }
         elseif(empty($base))
                        {
                ?>
                                <script language="javascript">
                                        alert("Digite el salario por el tiempo del servicio ?" )
                                        history.back()
                                </script>
                <?
        }
         elseif(empty($tiempo))
                        {
                ?>
                                <script language="javascript">
                                        alert("Digite el tiempo de servicio ?" )
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
                       $nomemple1=strtoupper($nomemple1);
                       $apemple=strtoupper($apemple);
                       $apemple1=strtoupper($apemple1);
                       $diremple=strtoupper($diremple);
                       $municipio=strtoupper($municipio);
                       $sexo=strtoupper($sexo);
                       $estcivil=strtoupper($estcivil);
                       $nomina=strtoupper($nomina);
                       $email=strtoupper($email);
                       $consulta="UPDATE empleado SET
                                tipod = '$TipoD',
                                nomemple = '$nomemple',
                                nomemple1 = '$nomemple1',
                                apemple = '$apemple',
                                apemple1 = '$apemple1',
                                telemple = '$telemple',
                                diremple = '$diremple',
                                codmuni = '$codmunicipio', 
                                municipio = '$municipio',
                                celular = '$celular',
                                sexo='$sexo',
                                email='$email',
                                fechanac='$fechanac',
                                estcivil='$estcivil',
                                rh='$rh',
                                cuenta = '$cuenta',
                                codbanco='$codbanco',
                                codzona='$codzona',
                                codeps='$codeps',
                                codpension='$codpension',
                                nomina = '$nomina',
                                codcosto='$codcosto',
                                nivel = '$nivel',
                                eps = '$eps',
                                pension = '$pension',
                                periodo='$periodo',basico='$salario',vlrpagado='$base',tiempo='$tiempo',pagarp='$PagarP',tipoempleado='$TipoEmpleado'   WHERE  codemple='$codemple'";
                            $resultado=mysql_query($consulta) or die("Error al grabar datos");
                            $registros=mysql_affected_rows();
    	                   $Act="update centrotrabajo set codcosto='$codcosto' where centrotrabajo.codcosto='$CodAnterior' and centrotrabajo.cedemple='$cedemple'";
		           $ResAct=mysql_query($Act) or die("Error al actualizar la tabla centro de trabajo");
                       if ($registros==0):
                         ?>
                                <script language="javascript">
                                        alert("No hubo cambios para modificar ?")
                                         open("modificar.php","_self");
                                </script>
                         <?
                        else:
                         ?>
                           <script language="javascript">
                              alert("El registros se grabó con exito en sistemas ?")
                              open ("modificar.php","_self")
                           </script>
                         <?
                        endif;
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
