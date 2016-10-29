<html>
<head>
  <title></title>
  <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
</head>
<body>
<center><h4><u>Deducciones</u></h4></center>
<form action="" method="post">
  <table border="0" align="center" width="300">
    <tr>
    <tr><td><br></td></tr>
        <?
        include("../conexion.php");?>
        <td><b>Cod_Salario:</b></td><td><select name="select" onChange="location.href=this.value" class="cajas">
        <option>Seleccione el Items</option>
        <?$con="select salario.codsala,salario.desala from salario where salario.prestacion='NO' order by desala";
        $resu=mysql_query($con)or die("Error de busqueda");
        while($filas=mysql_fetch_array($resu)):
        ?>
           <option value="GeneralD.php?CodSala=<? echo $filas["codsala"];?>"><?echo $filas["desala"];?>
        <?
        endwhile;?>
        </select></td>
       </tr>
           <tr><td><br></td></tr>
     </table>
   </form>
</body>
</html>
