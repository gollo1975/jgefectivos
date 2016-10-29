<html>

<head>
<title>Novedades de Nomina</title>
 <LINK  REL="stylesheet" HREF="../estilo.css"  type="text/css">
<script type="text/javascript">
     function ColorFoco(obj)
       {
       document.getElementById(obj).style.background="#9DFF9D"
       }
     function QuitarFoco(obj)
       {
       document.getElementById(obj).style.background="white"
       }

     function ActualizarSaldo()
         {
         var suma = 0;
         var suma1 = 0;
         var total = 0;
         var totalitem = document.getElementById("tActualizaciones").value;
         for (j=1; j<=totalitem; j++){
             suma = parseFloat(document.getElementById("vlrhora[" + j + "]").value);
	     suma1 = parseFloat(document.getElementById("nrohora[" + j + "]").value);
	     if (document.getElementById("datoN[" + j + "]").checked == true ){
  		 if (document.getElementById("vlrhora[" + j + "]").value != 0){
                     total = (suma * suma1);
                     document.getElementById("salario["+ j +"]").value= total.toFixed(0);
 		 }

             }
         }
     }

</script>
</head>
<body>
<?php
$auxInicio= 0;
$aux=0;
$Thora=0;
$Tdias=0; $resta=0;
if($Periodo=='SEMANAL')
{

		if ($Modalidad == 'MEDIO TIEMPO')
		{
			if($fechainic <= $desde)
			{
				$Tdias1=7;
				$ThoraInicio=($Tdias1*4);
			}
			else
			{
				if ($fechainic > $desde)
				{

					$mesInicio = substr($desde, 5, 2);
					$diaInicio = substr($fechainic, 8, 2);
					 $UltimoDia= date('d',(mktime(0,0,0,$mesInicio+1,1,$diaInicio)-1));

					$MesActual=substr($desde,5,2);
					$MesNext=substr($fechainic,5,2);
					if($MesActual<>$MesNext)
					{
						$inicio=substr($fechainic,8,2);
						$calculo=substr($hasta,8,2);
						$calculo2 = $calculo - $inicio +1;
						$Tdias1=($calculo2);
						$ThoraInicio=($calculo2*4);
						$Tdias=($calculo2);
					}
					else
					{
						if ($UltimoDia == 31)
						{

							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +1;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*4);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +1;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*4);
							}

						}
						if ($UltimoDia == 30)
						{

							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +1;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*4);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +1;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*4);
							}
						}
						if ($UltimoDia == 29)
						{

							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +1;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*4);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +1;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*4);
							}
						}
						if ($UltimoDia == 28)
						{
							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +1;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*4);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +1;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*4);
							}
						}
					}
				}

			}
		}
		else
		{
			if($fechainic <= $desde)
			{
				$Tdias1=7;
				$ThoraInicio=($Tdias1*8);
			}
			else
			{
				if ($fechainic > $desde)
				{

					$mesInicio = substr($desde, 5, 2);
					$diaInicio = substr($fechainic, 8, 2);
					 $UltimoDia= date('d',(mktime(0,0,0,$mesInicio+1,1,$diaInicio)-1));

					$MesActual=substr($desde,5,2);
					$MesNext=substr($fechainic,5,2);
					if($MesActual<>$MesNext)
					{
						$inicio=substr($fechainic,8,2);
						$calculo=substr($hasta,8,2);
						$calculo2 = $calculo - $inicio +1;
						$Tdias1=($calculo2);
						$ThoraInicio=($calculo2*8);
						$Tdias=($calculo2);
					}
					else
					{
						if ($UltimoDia == 31)
						{

							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +1;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*8);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +1;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*8);
							}

						}
						if ($UltimoDia == 30)
						{

							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +1;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*8);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +1;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*8);
							}
						}
						if ($UltimoDia == 29)
						{

							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +1;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*8);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +1;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*8);
							}
						}
						if ($UltimoDia == 28)
						{
							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +1;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*8);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +1;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*8);
							}
						}
					}
				}

			}
		}
}

if($Periodo=='DECADAL')
{

		if ($Modalidad == 'MEDIO TIEMPO')
		{
			if($fechainic <= $desde)
			{
				$Tdias1=10;
				$ThoraInicio=($Tdias1*4);
			}
			else
			{
				if ($fechainic > $desde)
				{

					$mesInicio = substr($desde, 5, 2);
					$diaInicio = substr($fechainic, 8, 2);
					$anioInicio = substr($fechainic, 8, 2);
					if ($mesInicio == 2)
					{
						if ($diaInicio == 20 or $diaInicio == 28)
						{
							function getUltimoDiaMes($elAnio,$elMes)
							{
								return date('d',(mktime(0,0,0,$elMes+1,0,$elAnio)-1));
							}
								$UltimoDia = getUltimoDiaMes($anioInicio,$mesInicio);
						}
						else
						{
						  $UltimoDia= date('d',(mktime(0,0,0,$mesInicio+1,1,$diaInicio)-1));
					    }
					}
					else
					{
						$UltimoDia= date('d',(mktime(0,0,0,$mesInicio+1,1,$diaInicio)-1));
					}

					$MesActual=substr($desde,5,2);
					$MesNext=substr($fechainic,5,2);
					if($MesActual<>$MesNext)
					{
						$inicio=substr($fechainic,8,2);
						$calculo=substr($hasta,8,2);
						$calculo2 = $calculo - $inicio +1;
						$Tdias1=($calculo2);
						$ThoraInicio=($calculo2*4);
						$Tdias=($calculo2);
					}
					else
					{
						if ($UltimoDia == 31)
						{

							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +1;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*4);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +1;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*4);
							}

						}
						if ($UltimoDia == 30)
						{

							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +1;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*4);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +1;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*4);
							}
						}
						if ($UltimoDia == 29)
						{
							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +2;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*4);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +2;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*4);
							}
						}
						if ($UltimoDia == 28)
						{
							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +3;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*4);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +3;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*4);
							}
						}
					}
				}

			}
		}
		else
		{
			if($fechainic <= $desde)
			{
				$Tdias1=10;
				$ThoraInicio=($Tdias1*8);
			}
			else
			{
				if ($fechainic > $desde)
				{

					$mesInicio = substr($desde, 5, 2);
					$diaInicio = substr($fechainic, 8, 2);
					$anioInicio = substr($fechainic, 8, 2);
					if ($mesInicio == 2)
					{
						if ($diaInicio == 20 or $diaInicio == 28)
						{
							function getUltimoDiaMes($elAnio,$elMes)
							{
								return date('d',(mktime(0,0,0,$elMes+1,0,$elAnio)-1));
							}
								$UltimoDia = getUltimoDiaMes($anioInicio,$mesInicio);
						}
						else
						{
						  $UltimoDia= date('d',(mktime(0,0,0,$mesInicio+1,1,$diaInicio)-1));
					    }
					}
					else
					{
						$UltimoDia= date('d',(mktime(0,0,0,$mesInicio+1,1,$diaInicio)-1));
					}

					$MesActual=substr($desde,5,2);
					$MesNext=substr($fechainic,5,2);
					if($MesActual<>$MesNext)
					{
						$inicio=substr($fechainic,8,2);
						$calculo=substr($hasta,8,2);
						$calculo2 = $calculo - $inicio +1;
						$Tdias1=($calculo2);
						$ThoraInicio=($calculo2*8);
						$Tdias=($calculo2);
					}
					else
					{
						if ($UltimoDia == 31)
						{

							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +1;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*8);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +1;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*8);
							}

						}
						if ($UltimoDia == 30)
						{

							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +1;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*8);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +1;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*8);
							}
						}
						if ($UltimoDia == 29)
						{
							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +2;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*8);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +2;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*8);
							}
						}
						if ($UltimoDia == 28)
						{
							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +3;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*8);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +3;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*8);
							}
						}
					}
				}

			}
		}
}


if($Periodo=='CATORCENAL')
{

		if ($Modalidad == 'MEDIO TIEMPO')
		{
			if($fechainic <= $desde)
			{
				$Tdias1=14;
				$ThoraInicio=($Tdias1*4);
			}
			else
			{
				if ($fechainic > $desde)
				{

					$mesInicio = substr($desde, 5, 2);
					$diaInicio = substr($fechainic, 8, 2);
					 $UltimoDia= date('d',(mktime(0,0,0,$mesInicio+1,1,$diaInicio)-1));

					$MesActual=substr($desde,5,2);
					$MesNext=substr($fechainic,5,2);
					if($MesActual<>$MesNext)
					{
						$inicio=substr($fechainic,8,2);
						$calculo=substr($hasta,8,2);
						$calculo2 = $calculo - $inicio +1;
						$Tdias1=($calculo2);
						$ThoraInicio=($calculo2*4);
						$Tdias=($calculo2);
					}
					else
					{
						if ($UltimoDia == 31)
						{

							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +1;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*4);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +1;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*4);
							}

						}
						if ($UltimoDia == 30)
						{

							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +1;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*4);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +1;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*4);
							}
						}
						if ($UltimoDia == 29)
						{

							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +1;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*4);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +1;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*4);
							}
						}
						if ($UltimoDia == 28)
						{
							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +1;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*4);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +1;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*4);
							}
						}
					}
				}

			}
		}
		else
		{
			if($fechainic <= $desde)
			{
				$Tdias1=14;
				$ThoraInicio=($Tdias1*8);
			}
			else
			{
				if ($fechainic > $desde)
				{

					$mesInicio = substr($desde, 5, 2);
					$diaInicio = substr($fechainic, 8, 2);
					 $UltimoDia= date('d',(mktime(0,0,0,$mesInicio+1,1,$diaInicio)-1));

					$MesActual=substr($desde,5,2);
					$MesNext=substr($fechainic,5,2);
					if($MesActual<>$MesNext)
					{
						$inicio=substr($fechainic,8,2);
						$calculo=substr($hasta,8,2);
						$calculo2 = $calculo - $inicio +1;
						$Tdias1=($calculo2);
						$ThoraInicio=($calculo2*8);
						$Tdias=($calculo2);
					}
					else
					{
						if ($UltimoDia == 31)
						{

							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +1;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*8);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +1;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*8);
							}

						}
						if ($UltimoDia == 30)
						{

							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +1;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*8);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +1;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*8);
							}
						}
						if ($UltimoDia == 29)
						{

							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +1;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*8);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +1;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*8);
							}
						}
						if ($UltimoDia == 28)
						{

							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +1;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*8);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +1;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*8);
							}
						}
					}
				}

			}
		}
}


if($Periodo=='QUINCENAL')
{

		if ($Modalidad == 'MEDIO TIEMPO')
		{
			if($fechainic <= $desde)
			{
				$Tdias1=15;
			      	$ThoraInicio=($Tdias1*4);
			}
			else
			{
				if ($fechainic > $desde)
				{

					$mesInicio = substr($desde, 5, 2);
					$diaInicio = substr($fechainic, 8, 2);
					$anioInicio = substr($fechainic, 8, 2);
					if ($mesInicio == 2)
					{
						if ($diaInicio == 20 or $diaInicio == 28)
						{
							function getUltimoDiaMes($elAnio,$elMes)
							{
								return date('d',(mktime(0,0,0,$elMes+1,0,$elAnio)-1));
							}
								$UltimoDia = getUltimoDiaMes($anioInicio,$mesInicio);
						}
						else
						{
						  $UltimoDia= date('d',(mktime(0,0,0,$mesInicio+1,1,$diaInicio)-1));
					    }
					}
					else
					{
						$UltimoDia= date('d',(mktime(0,0,0,$mesInicio+1,1,$diaInicio)-1));
					}

					$MesActual=substr($desde,5,2);
					$MesNext=substr($fechainic,5,2);
					if($MesActual<>$MesNext)
					{
						$inicio=substr($fechainic,8,2);
						$calculo=substr($hasta,8,2);
						$calculo2 = $calculo - $inicio +1;
						$Tdias1=($calculo2);
						$ThoraInicio=($calculo2*4);
					       	$Tdias=($calculo2);
					}
					else
					{
						if ($UltimoDia == 31)
						{

							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +1;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*4);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +1;
								$calculo3 = $calculo2 + $diaHasta;
							       $Tdias1=($calculo3);
								 $ThoraInicio=($Tdias1*4);
							}

						}
						if ($UltimoDia == 30)
						{

							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +1;
							       	$Tdias1=($calculo2);
								 $ThoraInicio=($Tdias1*4);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +1;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*4);
							}
						}
						if ($UltimoDia == 29)
						{
							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +2;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*4);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +2;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*4);
							}
						}
						if ($UltimoDia == 28)
						{
							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +3;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*4);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +3;
								$calculo3 = $calculo2 + $diaHasta;
							   	$Tdias1=($calculo3);
							    $ThoraInicio=($Tdias1*4);
							}
						}
					}
				}

			}
		}
		else
		{
			if($fechainic <= $desde)
			{
				$Tdias1=15;
				$ThoraInicio=($Tdias1*8);
			}
			else
			{
				if ($fechainic > $desde)
				{

				        $mesInicio = substr($desde, 5, 2);
                                        $diaInicio = substr($fechainic, 8, 2);
					$anioInicio = substr($fechainic, 8, 2);
					if ($mesInicio == 02)
					{
						if ($diaInicio == 20 or $diaInicio == 28)
						{
							function getUltimoDiaMes($anioInicio,$mesInicio)
							{
								return date('d',(mktime(0,0,0,$mesInicio+1,0,$anioInicio)-1));
							}
								$UltimoDia = getUltimoDiaMes($anioInicio,$mesInicio);
						}
						else
						{
                                                 $UltimoDia= date('d',(mktime(0,0,0,$mesInicio+1,1,$diaInicio)-1));
					    }
					}
					else
					{
						$UltimoDia= date('d',(mktime(0,0,0,$mesInicio+1,1,$diaInicio)-1));
					}

				        $MesActual=substr($desde,5,2);
				        $MesNext=substr($fechainic,5,2);
					if($MesActual<>$MesNext)
					{
						$inicio=substr($fechainic,8,2);
						$calculo=substr($hasta,8,2);
						$calculo2 = $calculo - $inicio +1;
						$Tdias1=($calculo2);
						$ThoraInicio=($calculo2*8);
						$Tdias=($calculo2);
					}
					else
					{
						if ($UltimoDia == 31)
						{

							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +1;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*8);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +1;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*8);
							}

						}
						if ($UltimoDia == 30)
						{

							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

							        $inicio=substr($fechainic,8,2);
							       $calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +1;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*8);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +1;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*8);
							}
						}
						if ($UltimoDia == 29)
						{
							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

							      	$inicio=substr($fechainic,8,2);
							        $calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +1;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*8);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +2;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*8);
							}
						}
                                                $UltimoDia;
						if ($UltimoDia == 28)
						{
							 $mesHasta = substr($hasta, 5, 2);
							 $diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio+1;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*8);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +3;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*8);
							}
						}
					}
				}

			}
		}
}


if($Periodo=='MENSUAL')
{

		if ($Modalidad == 'MEDIO TIEMPO')
		{
			if($fechainic <= $desde)
			{
				$Tdias1=30;
				$ThoraInicio=($Tdias1*4);
			}
			else
			{
				if ($fechainic > $desde)
				{

					$mesInicio = substr($desde, 5, 2);
					$diaInicio = substr($fechainic, 8, 2);
					$anioInicio = substr($fechainic, 8, 2);
					if ($mesInicio == 2)
					{
						if ($diaInicio == 20 or $diaInicio == 28)
						{
							function getUltimoDiaMes($elAnio,$elMes)
							{
								return date('d',(mktime(0,0,0,$elMes+1,0,$elAnio)-1));
							}
								$UltimoDia = getUltimoDiaMes($anioInicio,$mesInicio);
						}
						else
						{
						  $UltimoDia= date('d',(mktime(0,0,0,$mesInicio+1,1,$diaInicio)-1));
					    }
					}
					else
					{
						$UltimoDia= date('d',(mktime(0,0,0,$mesInicio+1,1,$diaInicio)-1));
					}

					$MesActual=substr($desde,5,2);
					$MesNext=substr($fechainic,5,2);
					if($MesActual<>$MesNext)
					{
						$inicio=substr($fechainic,8,2);
						$calculo=substr($hasta,8,2);
						$calculo2 = $calculo - $inicio +1;
						$Tdias1=($calculo2);
						$ThoraInicio=($calculo2*4);
						$Tdias=($calculo2);
					}
					else
					{
						if ($UltimoDia == 31)
						{

							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +1;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*4);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +1;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*4);
							}

						}
						if ($UltimoDia == 30)
						{

							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +1;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*4);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +1;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*4);
							}
						}
						if ($UltimoDia == 29)
						{
							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +2;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*4);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +2;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*4);
							}
						}
						if ($UltimoDia == 28)
						{
							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +3;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*4);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +3;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*4);
							}
						}
					}
				}

			}
		}
		else
		{
			if($fechainic <= $desde)
			{
				$Tdias1=30;
				$ThoraInicio=($Tdias1*8);
			}
			else
			{
				if ($fechainic > $desde)
				{

					$mesInicio = substr($desde, 5, 2);
					$diaInicio = substr($fechainic, 8, 2);
					$anioInicio = substr($fechainic, 8, 2);
					if ($mesInicio == 2)
					{
						if ($diaInicio == 20 or $diaInicio == 28)
						{
							function getUltimoDiaMes($elAnio,$elMes)
							{
								return date('d',(mktime(0,0,0,$elMes+1,0,$elAnio)-1));
							}
								$UltimoDia = getUltimoDiaMes($anioInicio,$mesInicio);
						}
						else
						{
						  $UltimoDia= date('d',(mktime(0,0,0,$mesInicio+1,1,$diaInicio)-1));
					    }
					}
					else
					{
						$UltimoDia= date('d',(mktime(0,0,0,$mesInicio+1,1,$diaInicio)-1));
					}

					$MesActual=substr($desde,5,2);
					$MesNext=substr($fechainic,5,2);
					if($MesActual<>$MesNext)
					{
						$inicio=substr($fechainic,8,2);
						$calculo=substr($hasta,8,2);
						$calculo2 = $calculo - $inicio +1;
						$Tdias1=($calculo2);
						$ThoraInicio=($calculo2*8);
						$Tdias=($calculo2);
					}
					else
					{
						if ($UltimoDia == 31)
						{

							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +1;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*8);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +1;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*8);
							}

						}
						if ($UltimoDia == 30)
						{

							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +1;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*8);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +1;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*8);
							}
						}
						if ($UltimoDia == 29)
						{
							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +2;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*8);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +2;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*8);
							}
						}
						if ($UltimoDia == 28)
						{
							$mesHasta = substr($hasta, 5, 2);
							$diaHasta = substr($hasta, 8, 2);
							if ($mesHasta == $MesActual)
							{

								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $calculo - $inicio +3;
								$Tdias1=($calculo2);
								$ThoraInicio=($Tdias1*8);
							}
							else
							{
								$inicio=substr($fechainic,8,2);
								$calculo=substr($hasta,8,2);
								$calculo2 = $UltimoDia - $inicio +3;
								$calculo3 = $calculo2 + $diaHasta;
								$Tdias1=($calculo3);
								$ThoraInicio=($Tdias1*8);
							}
						}
					}
				}

			}
		}
}

include("../conexion.php");
$con = "select empleado.nomina,concat(nomemple, ' ' ,nomemple1, ' ' ,apemple, ' ' , apemple1) as nombre,zona.codzona,zona.zona from empleado,zona,novedadnomina
where zona.codzona=empleado.codzona and
novedadnomina.codzona=zona.codzona and
novedadnomina.desde='$desde' and
novedadnomina.hasta='$hasta' and
novedadnomina.cedemple='$cedula' and
zona.codzona='$codzona' and
empleado.cedemple='$cedula'";
$resu= mysql_query ($con) or die ("Error en la consulta [nomina]");
$registro=mysql_affected_rows();
$fechap=date("Y-m-d");
if($registro!=0):
   ?>
   <script language="javascript">
      alert("Este empleado ya tiene la novedad en este corte de Fecha, Debe de Moficarla ?")
      history.back()
   </script>
   <?
else:
     /*codigo que retira un trabajador*/
         $SwR = 0;
         $conR="select retiroprovision.* from retiroprovision
             where retiroprovision.cedemple='$cedula' and
                   retiroprovision.fechare >= '$desde' and
                   retiroprovision.fechare <= '$hasta' and
                   retiroprovision.estado='ACTIVO' ";
        $resR=mysql_query($conR)or die ("Error al buscar retiro");
        $Reg=mysql_num_rows($resR);
	$filas_R=mysql_fetch_array($resR);
        if($Reg !=0){
            $ValorDia=$filas_R["diasperiodo"];
            $NombresE=$filas_R["nombres"];
            $FechaD=$filas_R["fechare"];
            ?>
            <script language="javascript">
	           alert("El empleado <?echo $NombresE;?>, se retiro en la siguiente fecha: <? echo $FechaD;?>, se le pagan <?echo $ValorDia;?> dias, Favor Verificar!")
            </script>
            <?
            if($Periodo=='MEDIO TIEMPO'){
                 $ValorHora=($ValorDia * 4);
                 $SwR = 1;
            }else{
                 $ValorHora=($ValorDia * 8);
	         $SwR = 1;
            }
            $Mensaje= 'Se Retiro el, ' . $FechaD;
        }
	        /*fin codigo*/
   ?>
    <center><h4><u>Novedades de Nomina</u></h4></center>
    <form action="GrabarNovedad.php" name="f1" id="f1" method="post" width="420">
    <input type="hidden" name="fechap" value="<? echo $fechap;?>" size="11">
    <input type="hidden" name="desde" value="<? echo $desde;?>" size="11">
    <input type="hidden" name="orden" value="<? echo $orden;?>" size="11">
    <input type="hidden" name="hasta" value="<? echo $hasta;?>" size="11">
     <input type="hidden" name="Cedula" value="<? echo $Cedula;?>" size="11">
        <table border="0" align="center">
        <tr>
        <td><br></td>
        </tr>
        <tr>
        <td><b>Documento</b></td>
        <td ><input type="text" name="cedula" value="<?echo $cedula?>" readonly="yes" size="12" maxlength="11" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="cedula"  class ="cajas"></td>
            </tr>
        <tr>
        <td><b>Empleado:</b></td>
        <td colspan="5"> <input type="text" name="nombre" value="<? echo $nombres;?>&nbsp;<? echo $apellidos;?>" readonly="yes" size="55" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="nombre" class="cajas" ></td>
            </tr>
            <tr>
            <td><b>Cod_Zona:</b></td>
            <td colspan="5"><input type="text" name="codzona" value="<?echo $codzona;?>" size="3" maxlength="3" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="codzona" readonly=yes class ="cajas">
                <input type="text" name="zona" value="<?echo $zona;?>" size="55" maxlength="55" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="zona" readonly=yes class ="cajas">
            </tr>
        <tr>
        <td><b>Desde</b></td>
        <td><input type="text" name="desde" value="<? echo $desde;?>" size="11" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="desde" readonly=yesclass ="cajas">
        <td colspan="1"><b>Hasta:</b></td>
        <td><input type="text" name="hasta" value="<? echo $hasta;?>" size="11" maxlength="10" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="hasta" readonly=yesclass ="cajas">
        </tr>
        <tr>
        <?
        if($SwR==1){?>
	    <td><b>Dia_Pagar:</b></td>
            <td><input type="text" name="diaspagar" value="<?echo $ValorDia;?>"  size="5" class="cajas" readonly></td>
	    <td><b>Total_Horas:</b></td>
            <td><input type="text" name="totalhora" value="<?echo $ValorHora;?>"  size="5" class="cajas" readonly></td>
	    </tr>
            <?
         }else{
             if($auxInicio>$aux){?>
	        <td><b>Dia_Pagar:</b></td>
	        <td><input type="text" name="diaspagar" value="<?echo $Tdias;?>"  size="5" class="cajas" readonly></td>
	        <td><b>Total_Horas:</b></td>
                <td><input type="text" name="totalhora" value="<?echo $Thora;?>"  size="5" class="cajas" readonly></td><?
  	      }else{?>
           	  <td><b>Dia_Pagar:</b></td>
		  <td><input type="text" name="diaspagar" value="<?echo $Tdias1;?>"  size="5" class="cajas" readonly></td>
	          <td><b>Total_Horas:</b></td>
	          <td><input type="text" name="totalhora" value="<?echo $ThoraInicio;?>"  size="5" class="cajas" readonly></td>
              <?}
          }
        ?>
	</tr>
        <tr>
        <td><b>Observación:</b></td>
          <td colspan="5"><textarea name="observacion" value="" cols="60" rows="3" class="cajas" onfocus="ColorFoco(this.id)" onblur="QuitarFoco(this.id)" id="observacion"><?echo $Mensaje;?></textarea></td></tr>
        <tr>
        </table>
        <table border="0" align="center" width="420">
	<tr><td>&nbsp;</td></tr>
	<tr class="cajas">
	<th><input type="checkbox" name="calculo" onClick=""></th><th><b>Cod_Sal.</b></th><th><b>Descripción</b></th><th><b>Vlr_Hora</b></th><th><b>Nro_Hora</b></th><th><b>Devengado</b></th><th><b>%Por.</b></th><th><b>Deducción</b></th>
	</tr>
	<tr>
        <td><br></td>
        </tr>
        <?
        $conD="select salario.formapago,salario.totalhoras,salario.codsala from salario where salario.insertar='SI'";
        $resD=mysql_query($conD)or die ("Error de consulta");
	$regD=mysql_affected_rows();
        while($filas_s=mysql_fetch_array($resD)):
            $FormaPago=$filas_s["formapago"];
            $Suma=$filas_s["totalhoras"];
            if ($FormaPago=='HORAS' and $Suma=='SI'):
              $TotalHora=$ThoraInicio;
              $CodSalario=$filas_s["codsala"];
            else:
              $TotalDia=$Tdias1;
             $CodAuxilio=$filas_s["codsala"];
            endif;
        endwhile;
        /*xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx*/
        $conR="select nomina.cedemple from nomina where nomina.cedemple='$cedula'";
        $resR=mysql_query($conR)or die ("Error de consulta");
	$regist=mysql_affected_rows();
        if($regist==0):
            $SwR = 3;
                $con="select decentro.* from centro,decentro,empleado
                     where empleado.cedemple=centro.cedemple and
                           centro.codcentro=decentro.codcentro and
                           empleado.cedemple='$cedula'  and
                           decentro.estado='SI' order by decentro.codsala";
                    $resu=mysql_query($con)or die("Error al buscar datos");
                    $reg=mysql_num_rows($resu);
                    $i=1;
                   	echo "<h4 align='center'><font color='red'>EL EMPLEADO ES NUEVO EN EL SISTEMA DE NOMINA..</font></h4>";
                     echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resu) . "\">");
                    while($filas=mysql_fetch_array($resu)):
                          $AuxiliarT=$filas["codsala"];
                           ?>
		            <tr class="cajasletra">
                               <td>&nbsp;</td><?
                               echo ("<td><input type=\"checkbox\" id=\"datoN[" . $i . "]\" name=\"datoN[" . $i . "]\" value=\"" . $filas['codsala'] ."\"  onclick=\"ActualizarSaldo()\">" .$filas['codsala']."</td>");?>
                               <td><input type="text" value="<?echo $filas["descripcion"];?>" name="concepto[<? echo $i;?>]"id="concepto[<? echo $i;?>]" size="35"  readonly class="cajas"></td>
                               <td><input type="text" value="<?echo $filas["vlrhora"];?>" name="vlrhora[<? echo $i;?>]"id="vlrhora[<? echo $i;?>]"size="8" readonly></td>
                               <?
                               if (strcmp(trim($CodSalario) , trim($AuxiliarT)) == 0){
                                   if ($SwR==0){
                                       ?>
                                        <td><input type="text" value="<?echo $ValorHora;?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="5" maxlength="5"></td>
                                       <?
                                   }else{
                                       if ($SwR==1){
                                            ?>
                                            <td><input type="text" value="<?echo $ValorHora;?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="5" maxlength="5"></td>
                                           <?
                                        }else{
                                           ?>
                                            <td><input type="text" value="<?echo $ThoraInicio;?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="5" maxlength="5"></td>
                                           <?
                                        }
                                   }
                               }else{
                                   if (strcmp(trim($CodAuxilio) , trim($AuxiliarT)) == 0){
                                       if ($SwR==0){
	                                       ?>
	                                        <td><input type="text" value="<?echo $ValorDia;?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="5" maxlength="5"></td>
                                              <?
                                       }else{
                                            if ($SwR==1){
	                                              ?>
	                                              <td><input type="text" value="<?echo $ValorDia;?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="5" maxlength="5"></td>
	                                              <?
                                            }else{
                                                     ?>
	                                                 <td><input type="text" value="<?echo $Tdias1;?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="5" maxlength="5"></td>
	                                               <?
                                              }
                                         }
                                    }else{
                                         ?>
                                         <td><input type="text" value="<?echo $filas["nrohora"];?>" name="nrohora[<? echo $i;?>]" id="nrohora[<? echo $i;?>]"size="5" ></td>
                                         <?
                                    }
                               }
                               ?>
                                      <td><input type="text" value="<?echo $filas["salario"];?>" name="salario[<? echo $i;?>]" id="salario[<? echo $i;?>]"size="11" ></td>
	                               <td><input type="text" value="<?echo $filas["porcentaje"];?>" name="porcentaje[<? echo $i;?>]"id="porcentaje[<? echo $i;?>]"size="5" readonly></td>
	                               <td><input type="text" value="<?echo round($filas["deduccion"],0);?>" name="deduccion[<? echo $i;?>]"id="deduccion[<? echo $i;?>]"size="11" mexlength="11"></td>
	 		               <input type="hidden" value="<?echo $filas["prestacion"];?>" name="prestacion[<? echo $i;?>]"id="prestacion[<? echo $i;?>]"size="11" readonly>
	                               <input type="hidden" value="<?echo $filas["variacion"];?>" name="variacion[<? echo $i;?>]"id="variacion[<? echo $i;?>]"size="5" readonly>
                                  </tr>
                               <?
		       $i=$i+1;
                    endwhile;
        else:
                     $con="select decentro.* from centro,decentro,empleado
                     where empleado.cedemple=centro.cedemple and
                           centro.codcentro=decentro.codcentro and
                           empleado.cedemple='$cedula'  and
                           decentro.estado='SI' and decentro.activo='SI' order by decentro.codsala";
                    $resu=mysql_query($con)or die("Error al buscar datos");
                    $reg=mysql_affected_rows();
                    $i=1;
                     echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resu) . "\">");
                    while($filas=mysql_fetch_array($resu)):
                          $AuxiliarT=$filas["codsala"];
                         if ($Periodo=='SEMANAL' or $Periodo=='CATORCENAL'){
                              ?>
		             <tr class="cajasletra">
                                <td>&nbsp;</td><?
                               echo ("<td><input type=\"checkbox\" id=\"datoN[" . $i . "]\" name=\"datoN[" . $i . "]\" value=\"" . $filas['codsala'] ."\"  onclick=\"ActualizarSaldo()\">" .$filas['codsala']."</td>");?>
                               <td><input type="text" value="<?echo $filas["descripcion"];?>" name="concepto[<? echo $i;?>]"id="concepto[<? echo $i;?>]" size="35"  readonly class="cajas"></td>
                               <td><input type="text" value="<?echo $filas["vlrhora"];?>" name="vlrhora[<? echo $i;?>]"id="vlrhora[<? echo $i;?>]"size="8" readonly></td>
                               <?
                               if (strcmp(trim($CodSalario) , trim($AuxiliarT)) == 0){
                                   if ($SwR==0){
                                       ?>
                                        <td><input type="text" value="<?echo $ThoraInicio;?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="5" maxlength="5"></td>
                                       <?
                                   }else{
                                     ?>
                                       <td><input type="text" value="<?echo $ValorHora;?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="5" maxlength="5"></td>
                                     <?
                                   }
                               }else{
                                   if (strcmp(trim($CodAuxilio) , trim($AuxiliarT)) == 0){
                                       if ($SwR==0){
	                                       ?>
	                                        <td><input type="text" value="<?echo $Tdias1;?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="5" maxlength="5"></td>
                                              <?
                                       }else{
                                              ?>
                                              <td><input type="text" value="<?echo $ValorDia;?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="5" maxlength="5"></td>
                                              <?
                                         }
                                    }else{
                                         ?>
                                         <td><input type="text" value="<?echo $filas["nrohora"];?>" name="nrohora[<? echo $i;?>]" id="nrohora[<? echo $i;?>]"size="5" ></td>
                                         <?
                                    }
                               }
                               ?>
                                      <td><input type="text" value="<?echo $filas["salario"];?>" name="salario[<? echo $i;?>]" id="salario[<? echo $i;?>]"size="11" ></td>
	                               <td><input type="text" value="<?echo $filas["porcentaje"];?>" name="porcentaje[<? echo $i;?>]"id="porcentaje[<? echo $i;?>]"size="5" readonly></td>
	                               <td><input type="text" value="<?echo round($filas["deduccion"],0);?>" name="deduccion[<? echo $i;?>]"id="deduccion[<? echo $i;?>]"size="11" mexlength="11"></td>
	 		               <input type="hidden" value="<?echo $filas["prestacion"];?>" name="prestacion[<? echo $i;?>]"id="prestacion[<? echo $i;?>]"size="11" readonly>
	                               <input type="hidden" value="<?echo $filas["variacion"];?>" name="variacion[<? echo $i;?>]"id="variacion[<? echo $i;?>]"size="5" readonly>
                                  </tr>
                               <?
                         }else{
                             ?>
		             <tr class="cajasletra">
                                <td>&nbsp;</td><?
                               echo ("<td><input type=\"checkbox\" id=\"datoN[" . $i . "]\" name=\"datoN[" . $i . "]\" value=\"" . $filas['codsala'] ."\"  onclick=\"ActualizarSaldo()\">" .$filas['codsala']."</td>");?>
                               <td><input type="text" value="<?echo $filas["descripcion"];?>" name="concepto[<? echo $i;?>]"id="concepto[<? echo $i;?>]" size="35"  readonly class="cajas"></td>
                               <td><input type="text" value="<?echo $filas["vlrhora"];?>" name="vlrhora[<? echo $i;?>]"id="vlrhora[<? echo $i;?>]"size="8" readonly></td>
                               <?
                               if (strcmp(trim($CodSalario) , trim($AuxiliarT)) == 0){
                                   if ($SwR==0){
                                       ?>
                                        <td><input type="text" value="<?echo $ThoraInicio;?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="5" maxlength="5"></td>
                                       <?
                                   }else{
                                     ?>
                                       <td><input type="text" value="<?echo $ValorHora;?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="5" maxlength="5"></td>
                                     <?
                                   }
                               }else{
                                   if (strcmp(trim($CodAuxilio) , trim($AuxiliarT)) == 0){
                                       if ($SwR==0){
	                                       ?>
	                                        <td><input type="text" value="<?echo $Tdias1;?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="5" maxlength="5"></td>
                                              <?
                                       }else{
                                              ?>
                                              <td><input type="text" value="<?echo $ValorDia;?>" name="nrohora[<? echo $i;?>]"id="nrohora[<? echo $i;?>]"size="5" maxlength="5"></td>
                                              <?
                                         }
                                    }else{
                                         ?>
                                         <td><input type="text" value="<?echo $filas["nrohora"];?>" name="nrohora[<? echo $i;?>]" id="nrohora[<? echo $i;?>]"size="5" ></td>
                                         <?
                                    }
                               }
                               ?>
                                      <td><input type="text" value="<?echo $filas["salario"];?>" name="salario[<? echo $i;?>]" id="salario[<? echo $i;?>]"size="11" ></td>
	                               <td><input type="text" value="<?echo $filas["porcentaje"];?>" name="porcentaje[<? echo $i;?>]"id="porcentaje[<? echo $i;?>]"size="5" readonly></td>
	                               <td><input type="text" value="<?echo round($filas["deduccion"],0);?>" name="deduccion[<? echo $i;?>]"id="deduccion[<? echo $i;?>]"size="11" mexlength="11"></td>
	 		               <input type="hidden" value="<?echo $filas["prestacion"];?>" name="prestacion[<? echo $i;?>]"id="prestacion[<? echo $i;?>]"size="11" readonly>
	                               <input type="hidden" value="<?echo $filas["variacion"];?>" name="variacion[<? echo $i;?>]"id="variacion[<? echo $i;?>]"size="5" readonly>
                                  </tr>
                               <?
                           }
		       $i=$i+1;
                    endwhile;
                     $con="select decentro.* from centro,decentro,empleado
                     where empleado.cedemple=centro.cedemple and
                           centro.codcentro=decentro.codcentro and
                           empleado.cedemple='$cedula' and
                           decentro.estado='NO' and decentro.activo='SI' order by decentro.porcentaje";
                    $resu1=mysql_query($con)or die("Error al buscar datos");
                    mysql_num_rows($resu1);
                    $i=(mysql_num_rows($resu)+1);

                  endif;
                  $con2="select decentro.* from centro,decentro,empleado
                     where empleado.cedemple=centro.cedemple and
                           centro.codcentro=decentro.codcentro and
                           empleado.cedemple='$cedula'";
                    $resu2=mysql_query($con2)or die("Error al buscar datos");
                    echo ("<input type=\"hidden\" id=\"tActualizaciones\" name=\"tActualizaciones\" value=\"" . mysql_num_rows($resu2) . "\">");
                     ?>
                    <tr><td><br></td></tr>
                    <tr>
                        <td colspan="2"><input type="submit" Value="Guardar" class="boton"></td>
                    </tr>
                  </table>
                </table>
<tr><td><br></td></tr>
                </form>
      <?
       endif;
 ?>


