<html>

<head>
  <title></title>
</head>
<body>
<input type="hidden" name="Desde" value="<?echo $Desde;?>">
<input type="hidden" name="Hasta" value="<?echo $Hasta;?>">
<input type="hidden" name="EstadoC" value="<?echo $EstadoC;?>">
<input type="hidden" name="EstaPerma" value="<?echo $EstaPerma;?>">
<input type="hidden" name="SaldarS" value="<?echo $SaldarS;?>">
 <?
if(empty($datoN)){
   ?>
   <script language="javascript">
       alert("Debe chequear todas las cajas de verificacion para hecer la integración!")
       history.back()
   </script>
   <?
}elseif(empty($CodSalario)){
   ?>
   <script language="javascript">
       alert("Debe de activar el código asociado  a los intereses de las cesantias!")
       history.back()
   </script>
   <?
}else{
     include("../conexion.php");
      $conS="select salario.* from salario
          where salario.codsala='$CodSalario'";
    $reS=mysql_query($conS)or die ("Error en la consulta de auxilio");
    $Linea=mysql_fetch_array($reS);
    $Concepto=$Linea["desala"];
    $Presta=$Linea["prestacion"];
    $Estado=$Linea["control"];
    $Datos=$Linea["insertar"];
    for ($k=1 ; $k<=$tActualizaciones; $k ++){
          $Sw = 0;
          $conI="select cesantiainteres.pagointeres from cesantiainteres
             where  cesantiainteres.inicioperiodo='$Desde' and
                    cesantiainteres.fechafinal='$Hasta' and
                    cesantiainteres.cedemple='$datoN[$k]'";
	 $reE=mysql_query($conI)or die("Error al buscar Empleado");
         $VectorE=mysql_fetch_array($reE);
         $ValorC=$VectorE["pagointeres"]. ' ';
         $conE="select decentro.*,centro.codcentro from centro,decentro
         where  centro.codcentro=decentro.codcentro and
                centro.cedemple='$datoN[$k]'";
         $resuE=mysql_query($conE)or die ("Error al validar la Empleado");
         /*CODIGO QUE PERMITE RECORRER EL DETALLE DEL CENTRO DE NOMINA*/
         while($filas=mysql_fetch_array($resuE)){
             $CodSalaInterno=$filas["codsala"];
             $CodCentro=$filas["codcentro"];
             $Variable=$filas["variacion"];
             if (strcmp($CodSalario , $CodSalaInterno) == 0){
                 $Sw=1;
                 break;
             }
         }
        if($Sw == 0){
              $Dato="insert into decentro(codcentro,codsala,descripcion,salario,prestacion,variacion,estado,datos,activo,permanente)
              values('$CodCentro','$CodSalario','$Concepto','$ValorC','$Presta','$Variable','$Estado','$Datos','$EstadoC','$EstaPerma')";
              $reA=mysql_query($Dato)or die ("Error al insertar el item");
         }else{
              if($SaldarS=='NO'){
                   $ConA="update decentro set salario='$ValorC', activo='$EstadoC',permanente='$EstaPerma' where decentro.codcentro='$CodCentro' and decentro.codsala='$CodSalario'";
                   $Res=mysql_query($ConA)or die("Error al actualizar informacion de la tabla decentro");
              }else{
                  $ConA="update decentro set salario=0, activo='$EstadoC',permanente='$EstaPerma' where decentro.codcentro='$CodCentro' and decentro.codsala='$CodSalario'";
                   $Res=mysql_query($ConA)or die("Error al actualizar informacion de la tabla decentro");
              }
         }
     }
     ?> <script language="javascript">
	       alert("Se grabaron con Exito : <?echo $tActualizaciones;?> registros de la Empresa : <?echo $Zona;?>")
	       open("ImportarInteres.php","_self")
           </script>
      <?
}
?>
</body>
</html>
