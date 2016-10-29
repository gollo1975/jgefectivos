<script language="javascript">
                function imprimir(numero)// para declara funcion
                {
                pagina='../cartalaboral/CartaInvitado.php?Documento=' + numero
                tiempo=80
                ubicacion='_self'
                setTimeout("open(pagina,ubicacion)",tiempo)
                }
</script>
<?
if(empty($CodMuni)){
    ?>
    <script language="javascript">
        alert("favor seleccione el municipio de la lista.!")
        history.back()
    </script>
    <?
}else{
   include("../conexion.php");
   $fechap=date("Y-m-d");
   $Nombres=strtoupper($Nombres);
   $Direccion=strtoupper($Direccion);
   $Empresa=strtoupper($Empresa);
   $Cargo=strtoupper($Cargo);
   $Email=strtolower($Email);
   $Lugar=strtoupper($Lugar);
   if($Estado == 0){
	  $consulta="insert into inscripcion(documento,nombres,direccion,codmuni,telefono,celular,empresa,cargo,email,lugar,codmaestro,fechac)
	   values ('$Documento','$Nombres','$Direccion','$CodMuni','$Telefono','$Celular','$Empresa','$Cargo','$Email','$Lugar','$CodEmpresa','$fechap')";
	   $resultado=mysql_query($consulta)or die("Inserccion incorrecta");
   }else{
         $Sql="update inscripcion set nombres='$Nombres',direccion='$Direccion',codmuni='$CodMuni',telefono='$Telefono',
           celular='$Celular',empresa='$Empresa',cargo='$Cargo',email='$Email',lugar='$Lugar',fechae='$fechap' where inscripcion.documento='$Documento'";
         $resultado=mysql_query($Sql)or die("error al actualizar");
   }
   $registro=mysql_affected_rows();
   echo ("<script language=\"javascript\">");
   echo ("alert (\"Se grabo el registro con exito en el sistema.!\" ,\"\");");
   echo ("open (\"../cartalaboral/CartaInvitado.php?Documento=$Documento\" ,\"\");");
   echo ("</script>");
   ?>
   <script language="javascript">
      open("AgregarInscripcion.php","_self");
   </script>
  <?
}
?>
</body>
</html>
