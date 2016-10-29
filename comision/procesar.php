<LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<script language="javascript">

            function Comision()
            {
              a = 0
              b = 0
              c = 0
              e = 0
              a = total = document.getElementById("convenio").value
              b = document.getElementById("porcentaje").value
              c =(a * b)/100 ;
              document.getElementById("comision").value = c.toFixed(0);
            }
          </script>
<?
include("../conexion.php");
$busca="select decartera.remision from decartera
     where decartera.remision='$codigo'";
     $sql1=mysql_query($busca)or die("Error en la busqueda de zonas ");
     $reg1=mysql_num_rows($sql1);
     if($reg1==0):
	 $buscador="select defactura.* from defactura
	     where defactura.remision='$codigo'";
	     $sql=mysql_query($buscador)or die("Error en la busqueda de detalle de admon ");
	     $reg=mysql_num_rows($sql);
	     if($reg!=0):
	       while($filas=mysql_fetch_array($sql)):
	        ?>
                 <center><h5><u>Agregar Registro</u></h5></center>
	        <form action="grabarcartera.php" method="post">
	           <input type="hidden" name="datos" value="<? echo $datos;?>">
	           <input type="hidden" name="desde" value="<? echo $desde;?>">
	           <input type="hidden" name="hasta" value="<? echo $hasta;?>">
	           <input type="hidden" name="zona" value="<? echo $zona;?>">
	           <input type="hidden" name="cedula" value="<? echo $cedula;?>">
	           <input type="hidden" name="codcomision" value="<? echo $codcomision;?>">
                   <input type="hidden" name="servicio" value="<? echo $servicio;?>">
                    <input type="hidden" name="codigo" value="<? echo $codigo;?>">
	           <table border="0" align="center">
	           <tr><td><br></td></tr>
	           <tr>
	             <td><b>Cod_Zona:</b></td>
	             <td colspan=3><input type="text" value="<?echo $codzona;?>"name="codzona" size="3" class="cajas" readonly></td>
	           </tr>
	           <tr>
	              <td><b>Zona:</b></td>
	              <td colspan=3><input type="text" value="<?echo $zona;?>" name="zona" size="50"  class="cajas" readonly></td>
	           </tr>
	           <tr>
	              <td><b>Desde:</b></td>
	              <td colspan=3><input type="text" value="<?echo $desde;?>" name="desde" size="10" class="cajas"  readonly"></td>
	           </tr>
	           <tr>
	              <td><b>Hasta:</b></td>
	              <td colspan=3><input type="text" value="<?echo $hasta;?>" name="hasta" size="10" class="cajas" readonly></td>
	           </tr>
	           <tr>
	              <td><b>Admon:</b></td>
	              <td colspan=3><input type="text" value="<?echo $filas["total"];?>" name="convenio" size="11" readonly class="cajas"></td>
	           </tr>
	           <tr>
	              <td><b>Porcentaje:</b></td>
	              <td colspan=3><input type="text" value="" name="porcentaje" size="11" maxlength="11" class="cajas" ></td>
	           </tr>
	           <tr>
	              <td><b>Vlr_Comisión:</b></td>
	              <td colspan=3><input type="text" value="" name="comision" size="11" maxlength="11" class="cajas" onfocus="Comision()"></td>
	           </tr>
	           <tr><td><br></td></tr>
	           <tr>
	              <td colspan="5"><input type="submit" value="Enviar Dato" class="boton"></td>
	           </tr>
		         <?
	      endwhile;
	    else:
	       ?>
	        <script language="javascript">
	          alert("No hay registro de facturacion ?")
	             history.back()
	        </script>
	       <?

	    endif;
    else:
       ?>
	        <script language="javascript">
	          alert("Este codigo de servicio ya se pago en sistema ?")
	             history.back()
	        </script>
	       <?
    endif;
    ?>
