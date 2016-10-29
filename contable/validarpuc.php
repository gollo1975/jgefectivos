<?php
        if (strlen($IdCuenta) == 3 or strlen($IdCuenta) == 5 or strlen($IdCuenta) == 7 or strlen($IdCuenta) == 9)
                {
                ?>
                        <script language="javascript">
                                alert("cuenta incorrecta")
                                history.back()
                        </script>
                <?
                }
                elseif (strlen($IdCuenta)==2)
                {
                        $n1=substr($IdCuenta,0,1);
                        $consulta="select * from puc where IdCuenta='$n1'";
                        $resultado=mysql_query($consulta) or die("Consulta Incorrecta");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==1)
                        {
                                $Sw=1;
                        }
                        else
                        {
                        ?>
                                <script language="javascript">
                                        alert("esta cuenta no tiene un proceso previo, es incorrecta")
                                        history.back()
                                </script>
                        <?
                        }
                }
                elseif (strlen($IdCuenta)==4)
                {
                        $n1=substr($IdCuenta,0,1);
                        $n2=substr($IdCuenta,0,2);
                        $consulta="select * from puc where IdCuenta='$n1' or IdCuenta='$n2'";
                        $resultado=mysql_query($consulta) or die("Consulta Incorrecta");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==2)
                        {
                                $Sw=1;
                        }
                        else
                        {
                        ?>
                                <script language="javascript">
                                        alert("esta cuenta no tiene un proceso previo, es incorrecta")
                                        history.back()
                                </script>
                        <?
                        }
                }
                elseif (strlen($IdCuenta)==6)
                {
                        $n1=substr($IdCuenta,0,1);
                        $n2=substr($IdCuenta,0,2);
                        $n3=substr($IdCuenta,0,4);
                        $consulta="select * from puc where IdCuenta='$n1' or IdCuenta='$n2' or IdCuenta='$n3'";
                        $resultado=mysql_query($consulta) or die("Consulta Incorrecta");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==3)
                        {
                                $Sw=1;
                        }
                        else
                        {
                        ?>
                                <script language="javascript">
                                        alert("esta cuenta no tiene un proceso previo, es incorrecta")
                                        history.back()
                                </script>
                        <?
                        }
                }
                elseif (strlen($IdCuenta)==8)
                {
                        $n1=substr($IdCuenta,0,1);
                        $n2=substr($IdCuenta,0,2);
                        $n3=substr($IdCuenta,0,4);
                        $n4=substr($IdCuenta,0,6);
                        $consulta="select * from puc where IdCuenta='$n1' or IdCuenta='$n2' or IdCuenta='$n3' or IdCuenta='$n4'";
                        $resultado=mysql_query($consulta) or die("Consulta Incorrecta $consulta");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==4)
                        {
                                $Sw=1;
                        }
                        else
                        {
                        ?>
                                <script language="javascript">
                                        alert("esta cuenta no tiene un proceso previo, es incorrecta")
                                        history.back()
                                </script>
                        <?
                        }
                }
                elseif (strlen($IdCuenta)==10)
                {
                        $n1=substr($IdCuenta,0,1);
                        $n2=substr($IdCuenta,0,2);
                        $n3=substr($IdCuenta,0,4);
                        $n4=substr($IdCuenta,0,6);
                        $n5=substr($IdCuenta,0,8);
                        $consulta="select * from puc where IdCuenta='$n1' or IdCuenta='$n2' or IdCuenta='$n3' or IdCuenta='$n4' or IdCuenta='$n5'";
                        $resultado=mysql_query($consulta) or die("Consulta Incorrecta");
                        $registros=mysql_num_rows($resultado);
                        if ($registros==5)
                        {
                                $Sw=1;
                        }
                        else
                        {
                        ?>
                                <script language="javascript">
                                        alert("esta cuenta no tiene un proceso previo, es incorrecta")
                                        history.back()
                                </script>
                        <?
                        }
                }
?>
