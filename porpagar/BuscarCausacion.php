<html>
<head>
  <title>Causaciones</title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<script language="javascript">
                    function ColorFoco(obj)	{
					
                        document.getElementById(obj).style.background="#9DFF9D"
                    }

                    function QuitarFoco(obj)	{
					
                        document.getElementById(obj).style.background="white"
                    }
</script>
</head>
<body>
<?
if(!isset($desde)):
include("../conexion.php")
?>
  <center><h4><u>Causaciones</u></h4></center>
  <form action="" method="post">
  <table border="0" align="center">
  <tr><td><br></td></tr>
   <tr>
     <td><b>Desde:&nbsp;</b></td>
     <td><input type="text" name="desde" value="<?echo date("Y-m-d");?>" size="10" maxlength="10" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="desde">&nbsp;</td>
      <td><b>Hasta:&nbsp;</b></td>
     <td><input type="text" name="hasta" value="<?echo date("Y-m-d");?>"  size="10" maxlength="10" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="hasta">&nbsp;</td>
   </tr>
   <tr>
     <td><b>Empresa:</b></td>
     <td colspan="3">
              <select name="empresa" class="cajas" onFocus="ColorFoco(this.id)" onBlur="QuitarFoco(this.id)" id="cedulaven">
                  <?
                  $consulta="select nomaestro,codmaestro from maestro";
                  $resultado=mysql_query($consulta) or die("Error al buscar empresa");
                   while ($filas=mysql_fetch_array($resultado))
                      {
                      ?>
                      <option value="<?echo $filas["codmaestro"];?>"><?echo $filas["nomaestro"];?>
                      <?
                      }
                      ?>
              </select>
       </td>
   </tr>
      <tr><td><br></td></tr>
      <tr>
        <td colspan="5">
          <input type="submit" value="Buscar Datos" class="boton">
    </table>
  </form>
<?
elseif(empty($desde)):
 ?>
 <script language="javascript">
   alert("Digite la fecha de inicio. ? ")
   history.back()
 </script>
 <?
 else:
  include("../conexion.php");
  /*$con1="select causacion.*,provedor.nomprove,pagar.conse from sucursal,maestro,provedor,pagar,causacion
         where maestro.codmaestro=sucursal.codmaestro and
               sucursal.codsucursal=provedor.codsucursal and
               provedor.nitprove=pagar.nitprove and
               pagar.nrofactura=causacion.nrofactura and
               maestro.codmaestro='$empresa' and
               causacion.fechac between '$desde' and '$hasta' group by causacion.nrocausa order by causacion.fechac ";*/
			   
	$con1 = "select causacion.*, provedor.nomprove, pagar.conse from
causacion
inner join pagar on causacion.nrofactura = pagar.nrofactura
inner join provedor on pagar.nitprove = provedor.nitprove
inner join sucursal on sucursal.codsucursal = provedor.codsucursal
where causacion.fechac between '$desde' and '$hasta' and
pagar.fechaini >= '$desde' and pagar.fechaini <= '$hasta'
group by causacion.nrocausa order by causacion.fechac";

			   
			   
   $resu1=mysql_query($con1)or die("Error al buscra causaciones");
  $reg1=mysql_num_rows($resu1);
  if($reg1==0):
       ?>
      <script language="javascript">
        alert("No hay causaciones en este rango de fechas ?")
       history.back()
      </script>
     <?
  else:
    ?>
    <center><h5>Listado_Causaciones</h5></center>
      <table border="0" align="center">
         <tr>
            <td class="cajas"><b>Desde:</b>&nbsp;<?echo $desde;?></td>
         </tr>
          <tr>
            <td class="cajas"><b>Hasta:</b>&nbsp;<?echo $hasta;?></td>
         </tr>
      </table>
       <table border="0" align="center">
          <tr>
          <th>Item</th>
            <th>Nro</th>
            <th>Nro_Factura</div></th>
            <th>Proveedor</th>
            <th>F_Causación</th>
           </tr>
         <?$a=1;
       while($filas=mysql_fetch_array($resu1)):
         ?>
             <tr class="cajas">
                 <th><?echo $a;?></h>
                  <td><a href="../porpagar/imprimircausacion.php?nrocausa=<?echo $filas["nrocausa"];?>"><font color="red"><?echo $filas["nrocausa"];?></a></font></td>
				 <!-- <td><a href="../porpagar/imprimircausacion.php?nrocausa=<?echo $filas["conse"];?>"><font color="red"><?echo $filas["nrocausa"];?></a></font></td>-->
                  <td><?echo $filas["nrofactura"];?>&nbsp;</div></td>
                  <td><?echo $filas["nomprove"];?></div></td>
                  <td><?echo $filas["fechac"];?></div></td>
       </tr>
        <?
        $a=$a+1;

        endwhile;
        ?>
       </table>

       <?
  endif;
endif;
  ?>
</body>
</html>
