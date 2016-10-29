<html>
        <head>
                <title>Crear Nonima</title>
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
                     function chequearcampos()
                    {
                      if (document.getElementById("dias").value.length <=0)
                        {
                            alert ("Digite el total maximo de dias para el pago de prima ?");
                            document.getElementById("dias").focus();
                            return;
                        }
                         document.getElementById("matcentro").submit();
                    }
               </script>
        </head>
<body>
<?if(!isset($Empresa)):
	include("../conexion.php");
	  ?>
	<center><h4><u>Crear Periodos</u></h4></center>
	<form action="" method="post" id="matcentro">
	<table border="0" align="center">
	<tr>
	<td><b>Empresa</b></td>
	<td colspan="10"><select name="Empresa" class="cajasletra">
	<option value="0">Seleccione
	                                                                                                     <?
	        $consulta_z="select codmaestro,nomaestro from maestro  order by nomaestro";
	        $resultado_z=mysql_query($consulta_z) or die("Error al buscar empresas");
	        while ($filas_z=mysql_fetch_array($resultado_z)):
	              ?>
	              <option value="<?echo $filas_z["codmaestro"];?>"><?echo $filas_z["nomaestro"];?><?
	        endwhile;
	        ?>
	</select></td>
	<tr>
	<tr>
	  <td><b>Desde:</b></td>
	  <td> <input type="text" value="<? echo date("Y-m-d");?>" name="desde"size="10" class="cajas"maxlength="10"onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="desde"></td>
	  <td><b>Hasta:</b></td>
	  <td><input type="text" value="<? echo date("Y-m-d");?>"name="hasta" size="10"class="cajas" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="hasta"></td>
	</tr>
        <tr>
        <td><b>Dias:</b></td>
	  <td><input type="text" value="" name="dias" size="10"class="cajas" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="dias"></td>
	  <td><b>Periodo:</b></td>
          	<td><select name="Periodo" class="cajas">
	       <option value="1">1-UNO
        	<option value="2">2-DOS
	</select></td>
         <td><b>Año:</b></td>
	  <td><input type="text" value="<? echo date("Y");?>"name="Ano" size="10"class="cajas" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="Ano"></td>
	</tr>
	<tr>
	<td><b>Estado:</b></td>
	<td><select name="Estado" class="cajas">
	<option value="FALTA">FALTA
	</select></td>
	</tr>
	<tr>
	<td><b>Nota:</b></td>
	<td colspan="5"><textarea  name="nota" cols="53" rows="3" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nota"></textarea></td>
	</tr>
	<tr><td><br></td></tr>
	<tr>
	<td colspan="2"><input type="button" value="Guardar" class="boton" onclick="chequearcampos()"></td>
	</tr>
	</table>
     </form>
        <?
elseif(empty($Empresa)):
  ?>

  <script language="javascript">
          alert("Seleccione la empresa de la lista!")
          history.back()
  </script>
 <?
else:
   include("../conexion.php");
    $FechaP=date("Y-m-d");
    $nota=strtoupper($nota);
    $conP="select periodoprima.nrop from periodoprima
      where periodoprima.desde='$desde' and
            periodoprima.hasta='$hasta' and
            periodoprima.ano='$Ano'";
	$reP=mysql_query($conP)or die("Error al buscar el periodo");
	$regP=mysql_num_rows($reP);
	if($regP==0):
            $conE="select periodoprima.estado from periodoprima
            where periodoprima.estado='FALTA'";
            $reE=mysql_query($conE)or die("Error al buscar el estado");
	    $regE=mysql_num_rows($reE);
            if($regE==0):
	        $consulta = "select count(*) from periodoprima";
	          $result = mysql_query ($consulta);
	          $answ = mysql_fetch_row($result);
	          if($answ[0]>0):
	             $consulta = "select max(cast(nrop as unsigned)) + 1 from periodoprima";
	             $result = mysql_query ($consulta) or die ("Fallo en la consulta");
	             $codc = mysql_fetch_row($result);
	             $codca= str_pad($codc[0], 4, "0", STR_PAD_LEFT);
	          else:
	              $codca="0001";
	          endif;
	         $consulta="insert into periodoprima(nrop,codmaestro,desde,hasta,dias,periodo,ano,estado,nota,fechap)
	                       values('$codca','$Empresa','$desde','$hasta','$dias','$Periodo','$Ano','$Estado','$nota','$FechaP')";
	             $resultado=mysql_query($consulta) or die("error al grabar datos del fondo");
	             $registro=mysql_affected_rows();
	             ?>
	            <script language="javascript">
	               alert("Registros grabados con éxito en sistema ?")
	               open("CrearPeriodo.php","_self")
	            </script>
	            <?
             else:
                 ?>
		    <script language="javascript">
		          alert("Debe de cerrar el periodo anterior!")
		          history.back()
		     </script>
		   <?
             endif;
        else:
            ?>
	    <script language="javascript">
	          alert("Este periodo para corte de primas semestrales, ya esta creado!")
	          history.back()
	     </script>
	   <?
        endif;
endif;

        ?>
              </body>
</html>
