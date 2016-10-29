<html>

<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
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
</head>

<body>
<?php
if (!isset($Desde)):
	?>
	 <center><h4><u>Cerrar Periodo[[Cesantias]</u></h4></center>
	<form action="" method="post">
	  <table border="0" align="center">
	  <tr>
	       <td colspan="2"><br></td>
	  </tr>
	   <tr>
	     <td><b>Desde:</b></td>
	     <td><input type="text" name="Desde" value="<?echo date('Y-m-d');?>" size="12" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Desde"></td>
             <td><b>Hasta:</b></td>
	     <td><input type="text" name="Hasta" value="<?echo date('Y-m-d');?>" size="12" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Hasta"></td>
	   </tr>
            <tr>
	     <td><b>Año:</b></td>
	     <td><input type="text" name="Ano" value="" size="12" maxlength="10" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Ano"></td>
	   </tr>
	   <tr><td><br></td></tr>
	  <tr>
	    <td colspan="2">
	      <input type="submit" value="Buscar" class="boton">
	    </td>
	  </tr>
	</table>
	</form>
<?
elseif(empty($Ano)):
   ?>
    <script language="javascript">
       alert ("Digite el año para la validacion!")
       history.back()
    </script>
   <?
else:
       include("../conexion.php");
       $conV="select periodocesantia.* from periodocesantia where
	periodocesantia.desde='$Desde' and
	periodocesantia.hasta='$Hasta' and
	periodocesantia.estado='ACTIVO' and
        periodocesantia.ano='$Ano'";
	$reV=mysql_query($conV)or die("Error al buscar el periodo");
	$regV=mysql_num_rows($reV);
        $filas=mysql_fetch_array($reV);
	if($regV !=0 ):
            ?>
		    <center><h4><u>Cerrar Periodo</u> </h4></center>
		    <form action="CerrarC.php" method="post" id="f1" name="f1">
		     <table border="0" align="center" width="300">
		         <tr>
		          <td><b>Nro_Periodo:</b></td>
		         <td><input type="text" name="NroP" value="<? echo $filas["nroc"];?>"class="cajas" size="13" readonly></td>
		         <td><b>Desde:</b></td>
		         <td><input type="text" name="Desde" value="<? echo $Desde;?>"class="cajas" size="13" readonly></td>
		       </tr>
		       <tr>
		         <td><b>Hasta:</b></td>
		         <td><input type="text" name="Hasta" value="<? echo $Hasta;?>" class="cajas"size="13" readonly></td>
                          <td><b>Año:</b></td>
		         <td><input type="text" name="" value="<? echo $Ano;?>" class="cajas"size="13" readonly></td>
		       </tr>
                        <tr>
                           <td><b>Estado:</b></td>
                           <td><select name="Estado" class="cajas">
                               <option value="<?echo $filas["estado"];?>" selected><?echo $filas["estado"];?>
                               <option value="ACTIVO">ACTIVO
                               <option value="INACTIVO">INACTIVO
                               </select></td>
                        </tr>
		        <tr>
                        <td><br></td>
                        </tr>
		      <tr>
		         <td colspan="9"><input type="submit" value="Validar" class="boton"></td>
		      </tr>
		   </table>
		  </form>
            <?
        else:
           ?>
	    <script language="javascript">
	        alert("No hay periodos abierto de prima para el cierre, Favor verificar!")
	        history.back()
	    </script>
	    <?
        endif;
endif;
?>
