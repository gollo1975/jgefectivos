<html>
        <head>
                <title>Configuracion de Examenes</title>
                 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">

        </head>
        <body>
<?php
     /*CODIGO PARA EXAMENES*/
     include("../conexion.php");
     $Sql="select detalladoparametroexamenzona.* from detalladoparametroexamenzona
           where detalladoparametroexamenzona.codzona='$CodZona' and detalladoparametroexamenzona.estado='ACTIVO'  order by detalladoparametroexamenzona.concepto";
     $Rs=mysql_query($Sql)or die ("Error al buscar examenes");
     $Cont=mysql_num_rows($Rs);
     ?>
     <center><h4><u>Examenes Contratados</u></h4></center>
     <table border="0" align="center">
      <tr>
	            <td><b>Zona</b></td>
	            <td><input type="text" name="Zona" value="<? echo $Zona;?>" class="cajas"size="55" readonly id="Zona"></td>
      </tr>
      </table>
       <tr><td><br></td></tr>
       <table border="0" align="center">

            <tr class="cajas">
                <th>Id</th><th><b>&nbsp;<u>Descripción</u></b></th><th><b><u>Estado</u></b></th>
            </tr>
            <tr><td><br></td></tr>
	     <?
             $i=0;
              while ($filas_s = mysql_fetch_array($Rs)):
                                       $i++;
                                      ?>
                                       <tr class="cajas">
                                        <td><input type="text" value="<?echo $filas_s['idexamen'];?>" class="cajas" readonly size="5"></td>
                                        <td><input type="text" value="<?echo $filas_s["concepto"];?>"  size="56"  readonly class="cajas"> </td>
                                        <td><input type="text" value="<? echo $filas_s["estado"];?>"  size="15"  readonly class="cajas"> </td>

                                      </tr>
                                       <?
             endwhile;
         ?>
         </table>
</body>
</html>
