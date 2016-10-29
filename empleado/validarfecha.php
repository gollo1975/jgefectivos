<?
        $fecha=$fechanac;
        $a=substr($fecha,0,4);
        $m=substr($fecha,5,2);
        $d=substr($fecha,8,2);
        $ab=$a%4;
        $tam=strlen($fecha);
        $g1=substr($fecha,4,1);
        $g2=substr($fecha,7,1);
        $sw=0;
        if ($tam==10)
        {
                if ($g1=="-" & $g2=="-")
                {
                        if ($a>=1950 && $a<=2008)
                        {
                                if ($m>=1 && $m<=12)
                                {
                                        if ($m==1 or $m==3 or $m==5 or $m==7 or $m==8 or $m==10 or $m==12)
                                        {
                                                if ($d>=1 && $d<=31)
                                                {
                                                        $sw=0;
                                                }
                                                else
                                                {
                                                        $sw=1;
                                                }
                                        }
                                        elseif ($m==2)
                                        {
                                                if ($ab==0)
                                                {
                                                        if ($d>=1 && $d<=29)
                                                        {
                                                                $sw=0;
                                                        }
                                                        elseif ($d>=1 && $d<=28)
                                                        {
                                                                $sw=0;
                                                        }
                                                        else
                                                        {
                                                                $sw=1;
                                                        }
                                                }
                                        }
                                        elseif ($m==4 or $m==6 or $m==9 or $m==11)
                                        {
                                                if ($d>=1 && $d<=30)
                                                {
                                                 $sw=0;
                                                }
                                                else
                                                {
                                                        $sw=1;
                                                }
                                        }
                                }
                                else
                                {
                                        $sw=1;
                                }

                        }
                        else
                        {
                                $sw=1;
                        }
                }
                else
                {
                        $sw=1;
                }
        }
        else
        {
                $sw=1;
        }
        if ($sw==0)
        {
        ?>
                <script language="javascript">
                        pagina='modificar.php?sw=0'
                        tiempo=50
                        ubicacion='_self'
                        setTimeout("open(pagina,ubicacion)",tiempo)

                </script>
        <?
        }
        else
        {
        ?>
                <script language="javascript">
                        pagina='agregar.php?sw=1'
                        tiempo=100
                        ubicacion='_self'
                        setTimeout("open(pagina,ubicacion)",tiempo)

                </script>
        <?
        }
?>
