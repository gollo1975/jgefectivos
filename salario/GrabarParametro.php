<?
if(empty($Codigo)):
?>
	         <script language="javascript">
	         alert("Seleccion el parametro de Pensión!")
	         history.back()
	         </script>
	         <?
else:
     include("../conexion.php");
     $fechaC=date("Y-m-d");
     $Estado='ACTIVO';
         $consulta = "select count(*) from parametropension";
         $result = mysql_query ($consulta);
         $answ = mysql_fetch_row($result);
         if ($answ[0] > 0):
           $consulta = "select max(cast(codigo as unsigned)) + 1 from parametropension";
                $result2 = mysql_query($consulta);
                $codc = mysql_fetch_row($result2);
                $codcur= str_pad($codc[0], 4, "0", STR_PAD_LEFT);
         else:
             $codcur = "0001";
         endif;
             $consulta="insert into parametropension(codigo,codsala,cedemple,estado,fechac)
             values('$codcur','$Codigo','$cedula','$Estado','$fechaC')";
             $resultado=mysql_query($consulta)or die("inserección incorrecta");
              $registro1=mysql_affected_rows();
             ?>
            <script language="javascript">
              alert("Registro Grabado con Exito en la Base de Datos ?")
              open("ParametroPension.php","_self");
            </script>
            <?
endif;
?>
