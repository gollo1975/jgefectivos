<html>
<head>
  <title></title>
</head>
<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<body>
<script language="javascript">
                    function ColorFoco(obj)
                    {
                        document.getElementById(obj).style.background="#9DFF9D"

                    }

                    function QuitarFoco(obj)
                    {
                        document.getElementById(obj).style.background="white"
                    }
              </script>
<?
if(!isset($desde)):
include("../conexion.php");
?>
  <div align="center"><h4><u>Control Examenes</u></h4></div>
  <form action="" method="post" >
     <table border="0" align="center">
        <tr><td><br></td></tr>
        <tr>
            <td><b>Desde:&nbsp;</b></td>
            <td><input type="text" name="desde" size="11" value="<?echo date("Y-m-d");?>" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
            <td><b>Hasta:&nbsp;</b></td>
            <td><input type="text" name="hasta" size="11"  value="<?echo date("Y-m-d");?>"maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"></td>
        </tr>
        <tr>
       <td><b>Proveedor:</b></td>
          <td colspan="3"><select name="provedor" class="cajas">
          <option value="0">Seleccione el Proveedor
          <?
            $consulta_s="select provedor.nomprove,provedor.nitprove from provedor,sucursal
            where provedor.codsucursal=sucursal.codsucursal and
                  sucursal.codsucursal='$codigo' and
				  provedor.alianzaexamen='SI' order by nomprove";
            $resultado_s=mysql_query($consulta_s)or die ("Error al buscar provedor");
            while($filas_s=mysql_fetch_array($resultado_s))
            {
              ?>
              <option value="<?echo $filas_s["nitprove"];?>"> <?echo $filas_s["nomprove"];?>
              <?
              }
              ?></select></td>
       </tr>

       <tr><td><br></td></tr>
       <td colspan="3">
       <input type="submit" value="Buscar" class="boton">&nbsp;<input type="reset" value="Limpiar" class="boton"></td>
     </table>
  </form>
<?
elseif(empty($provedor)):
   ?>
      <script language="javascript">
          alert("Seleccion el proveedor de la lista")
          history.back()
      </script>
  <?
else:
    include("../conexion.php");
    $con1="select examen.*,zona.zona from examen,provedor,zona,sucursal
        where provedor.nitprove=examen.nitprove and
              provedor.nitprove='$provedor' and
              examen.codzona=zona.codzona and
			  zona.codsucursal=sucursal.codsucursal and
			  sucursal.codsucursal='$codigo' and
              examen.fechap between '$desde' and '$hasta' order by examen.nro";
    $res1=mysql_query($con1)or die ("Error al buscar de examenes medicos ?");
    $reg1=mysql_num_rows($res1);
    if($reg1!=0):
       ?>
       <div align="center"><h5><u>Listado de Recibos</u></h5></div>
         <table border="0" align="center">
                          <tr class="cajas">
             <th>Item</td>
                <th>Nro_Control</td>
                <th>F_Proceso</td>
                <th>F_Realizo</td>
                <th>Zona</td>
                <th>Tipo_Pago</td>
                <th>Estado</td>
              </tr>
             <?     $a=1;
             while($filas=mysql_fetch_array($res1)):
                ?>
                 <tr class="cajas">
                       <th><?echo $a;?></th>
                       <td><a href="imprimircontrol.php?nropago=<?echo $filas["nro"];?>"><?echo $filas["nro"];?></a></td>
	                <td><?echo $filas["fechap"];?></td>
	                <td><?echo $filas["fechae"];?></td>
                        <td><?echo $filas["zona"];?></td>
	                <td><?echo $filas["pago"];?></td>
                        <td><?echo $filas["posicion"];?></td> 
	             </tr>
	            <? $a=$a+1;
	     endwhile;
	     ?>
	 </table>
	       <?
    else:
             ?>
	      <script language="javascript">
	         alert("No hay recibos de control en este rango de fechas?")
                 history.back()
	      </script>
	      <?
   endif;
endif;
?>
</body>
</html>
