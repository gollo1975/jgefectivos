<html>
        <head>
                <title>Codigos de Salarios</title>
                <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
        </head>
        <body>
        <?
                include("../conexion.php");
                $consulta="select * from Salario order by ingreso,egreso";
                $resultado=mysql_query($consulta) or die("consulta incorrecta");
                $registros=mysql_num_rows($resultado);
                if ($registros==0)
                {
        ?>

                        <script language="javascript">
                                alert("No Existen Registros")
                                history.back()
                        </script>
        <?
                }
                else
                {
        ?>
                       <center><h4><u>Listado De Códigos</u></h4></center>
                       <table border="1" align="center">
                                <tr>
                                        <td colspan="9"></td>
                                </tr>
                                <tr>
                                        <th>Item</th>
                                        <th>Codigo</th>
                                        <th>Descripción</th>
                                        <th>%Porc.</th>
                                        <th>Aux.Trans.</th>
                                        <th>Prest.</th>
                                        <th>C.Cos.Visi.</th>
                                        <th>V_Directa</th>
                                        <th>S_Credito</th>
                                        <th>Ingreso</th>
                                        <th>Egreso</th>
                                        <th>Forma_Pago</th>
                                        <th>A_Horas</th>
                                        <th>Activo</th>
                                        <th>Permanente</th>
                                        <th>Activo</th>
                                </tr>
        <? $a=1;
                        while ($filas=mysql_fetch_array($resultado))
                        {

        ?>
                                <tr class="cajas">
                                        <th><?echo $a;?></th>
                                        <td><?echo $filas["codsala"];?></td>
                                        <td><?echo $filas["desala"];?></td>
                                        <td><?echo $filas["porcentaje"];?></td>
                                        <td><?echo $filas["ayuda"];?></td>
                                        <td><div align="center"><?echo $filas["prestacion"];?></div></td>
                                        <td><div align="center"><?echo $filas["control"];?></div></td>
                                        <td><div align="center"><?echo $filas["insertar"];?></div></td>
                                         <td><div align="center"><?echo $filas["sumarcupo"];?></div></td>
                                        <td><div align="center"><?echo $filas["ingreso"];?></div></td>
                                        <td><div align="center"><?echo $filas["egreso"];?></div></td>
                                        <td><div align="center"><?echo $filas["formapago"];?></div></td>
                                        <td><div align="center"><?echo $filas["totalhoras"];?></div></td>
                                        <td><div align="center"><?echo $filas["activo"];?></div></td>
                                        <td><div align="center"><?echo $filas["permanente"];?></div></td>
                                        <td><div align="center"><?echo $filas["estado"];?></div></td>
                                </tr>
        <? $a=$a+1;
                        }
                }
        ?>
                        </table>

        </body>
</html>
