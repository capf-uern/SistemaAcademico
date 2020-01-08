<?php

function dataetempo($data){
	
	$parte1 = substr($data, 0, 4);
	$parte2 = substr($data, 5, 2);
	$parte3 = substr($data, 8, 2);
	$parte4 = substr($data, 11, 8);
	
	return "$parte3/$parte2/$parte1 $parte4";
	
}

function dataetempo_inverso($data){

	$parte1 = substr($data, 0, 2);
	$parte2 = substr($data, 3, 2);
	$parte3 = substr($data, 6, 4);
	$parte4 = substr($data, 11, 8);

	return "$parte3-$parte2-$parte1 $parte4";

}

function datasemtempo_final($data){

	$parte1 = substr($data, 0, 4);
	$parte2 = substr($data, 5, 2);
	$parte3 = substr($data, 8, 2);

	return "$parte3/$parte2/$parte1";

}

function datasemtempo($data){

	$parte1 = substr($data, 0, 4);
	$parte2 = substr($data, 5, 2);
	$parte3 = substr($data, 8, 2);

	return "$parte3-$parte2-$parte1";

}

function datacomtempo($data){

	$parte4 = substr($data, 11, 8);

	return "$parte4";

}

function retira_dia($data){

	$parte3 = substr($data, 8, 2);

	return "$parte3";

}

function retira_mes($data){

	$parte2 = substr($data, 5, 2);

	return "$parte2";

}

function ConverterBR($data){
        list($a, $m, $d) = explode("-", $data);
        return "$d/$m/$a";
}

function ConverterUS($data) {
        list($d, $m, $a) = explode("/", $data);
        return "$a-$m-$d";
}

function AdicionarDias($data, $dias) {
        list($a, $m, $d) = explode("-", $data);
        return date("Y-m-d", mktime(0, 0, 0, $m, ($d + $dias), $a));
}

function AdicionarMeses($data, $meses) {
        list($a, $m, $d) = explode("-", $data);
        return date("Y-m-d", mktime(0, 0, 0, ($m + $meses), $d, $a));
}

function AdicionarMesesFixo($data, $meses) {
        list($a, $m, $d) = explode("-", $data);

        $ano = $a + (floor($meses / 12));
        $mes = $m + ($meses - (floor($meses / 12) * 12));
        if ($mes > 12) {
            $ano++;
            $mes = ($mes - 12);
        }

        $ultimo_dia_atual = date("t", mktime(0, 0, 0, $m, $d, $a));

        if ($ultimo_dia_atual == $d) {
            $dia = date("t", mktime(0, 0, 0, $mes, 1, $ano));
        } else {
            if (checkdate($mes, $d, $ano)) {
                $dia = $d;
            } else {
                $dia = date("t", mktime(0, 0, 0, $mes, 1, $ano));
            }
        }
        return "$ano-$mes-$dia";
    }

function AdicionarAnos($data, $anos) {
        list($a, $m, $d) = explode("-", $data);
        return date("Y-m-d", mktime(0, 0, 0, $m, $d, ($a + $anos)));
    }

function DiasEntreDatas($data1, $data2) {
        list($a1, $m1, $d1) = explode('-', $data1);
        list($a2, $m2, $d2) = explode('-', $data2);

        if ($data1 > $data2) {
            $dias = floor(((mktime(0, 0, 0, $m1, $d1, $a1) - mktime(0, 0, 0, $m2, $d2, $a2)) / 86400));
        } else {
            $dias = floor(((mktime(0, 0, 0, $m2, $d2, $a2) - mktime(0, 0, 0, $m1, $d1, $a1)) / 86400));
        }
        return $dias;
    }

function MesesEntreDatas($data1, $data2) {
        list($a1, $m1, $d1) = explode('-', $data1);
        list($a2, $m2, $d2) = explode('-', $data2);

        if ($data1 > $data2) {
            $meses = floor(((mktime(0, 0, 0, $m1, $d1, $a1) - mktime(0, 0, 0, $m2, $d2, $a2)) / 2592000));
        } else {
            $meses = floor(((mktime(0, 0, 0, $m2, $d2, $a2) - mktime(0, 0, 0, $m1, $d1, $a1)) / 2592000));
        }
        return $meses;
    }

function AnosEntreDatas($data1, $data2) {
        list($a1, $m1, $d1) = explode('-', $data1);
        list($a2, $m2, $d2) = explode('-', $data2);

        if ($data1 > $data2) {
            $anos = floor(((mktime(0, 0, 0, $m1, $d1, $a1) - mktime(0, 0, 0, $m2, $d2, $a2)) / 31536000));
        } else {
            $anos = floor(((mktime(0, 0, 0, $m2, $d2, $a2) - mktime(0, 0, 0, $m1, $d1, $a1)) / 31536000));
        }
        return $anos;
    }

function UltimoDiaMes($data,$formato_data=false) {
        list($a, $m, $d) = explode('-', $data);
        $ultimo = date("t", mktime(0, 0, 0, $m, $d, $a));
        if($formato_data){
          $retorno = date('Y-m-d',mktime(0,0,0,($m + 1),($d - 1),$a));
        }else{
          $retorno = $ultimo;
        }
        return $retorno;
    }

function ValidaDataUS($data) {
        list($a, $m, $d) = explode('-', $data);
        return checkdate($m, $d, $a);
    }

function ValidaDataBR($data) {
        list($d, $m, $a) = explode('/', $data);
        return checkdate($m, $d, $a);
    }

function LimparFormatacao($data) {
        return str_replace(array("/", "-"), "", $data);
    }

function DiaSemana($data) {// 0=DOMINGO  /  6=SABADO
        list($a, $m, $d) = explode('-', $data);
        return date("w", mktime(0, 0, 0, $m, $d, $a));
    }

function listar_mes($mes) {
    	
	switch ($mes) {
    case '01':
        return "Janeiro";
        break;
    case '02':
        return "Fevereiro";
        break;
    case '03':
        return "Março";
        break;
	case '04':
       	return "Abril";
       	break;
    case '05':
       	return "Maio";
       	break;
    case '06':
       	return "Junho";
       	break;
    case '07':
       	return "Julho";
       	break;
    case '08':
       	return "Agosto";
       	break;
    case '09':
       	return "Setembro";
       	break;
    case '10':
       	return "Outubro";
       	break;
    case '11':
       	return "Novembro";
       	break;
    case '12':
       	return "Dezembro";
       	break;
	default:
		return "";
		break;
	}
}


function mes_abrev($mes) {
    	
	switch ($mes) {
    case 1:
        return "JAN";
        break;
    case 2:
        return "FEV";
        break;
    case 3:
        return "MAR";
        break;
	case 4:
       	return "ABR";
       	break;
    case 5:
       	return "MAI";
       	break;
    case 6:
       	return "JUN";
       	break;
    case 7:
       	return "JUL";
       	break;
    case 8:
       	return "AGO";
       	break;
    case 9:
       	return "SET";
       	break;
    case 10:
       	return "OUT";
       	break;
    case 11:
       	return "NOV";
       	break;
    case 12:
       	return "DEZ";
       	break;
	default:
		return "";
		break;
	}
}