<?php

date_default_timezone_set('America/Sao_Paulo');


function diasFeriados($ano = null)
{
    if ($ano === null)
    {
      $ano = intval(date('Y'));
    }
   
    $pascoa     = easter_date($ano); // Limite de 1970 ou após 2037 da easter_date PHP consulta http://www.php.net/manual/pt_BR/function.easter-date.php
    $dia_pascoa = date('j', $pascoa);
    $mes_pascoa = date('n', $pascoa);
    $ano_pascoa = date('Y', $pascoa);
   
    $feriados = array(
        // Tatas Fixas dos feriados Nacionail Basileiras
        mktime(0, 0, 0, 1,  1,   $ano), // Confraternização Universal - Lei nº 662, de 06/04/49
        mktime(0, 0, 0, 4,  21,  $ano), // Tiradentes - Lei nº 662, de 06/04/49
        mktime(0, 0, 0, 5,  1,   $ano), // Dia do Trabalhador - Lei nº 662, de 06/04/49
        mktime(0, 0, 0, 9,  7,   $ano), // Dia da Independência - Lei nº 662, de 06/04/49
        mktime(0, 0, 0, 10,  12, $ano), // N. S. Aparecida - Lei nº 6802, de 30/06/80
        mktime(0, 0, 0, 11,  2,  $ano), // Todos os santos - Lei nº 662, de 06/04/49
        mktime(0, 0, 0, 11, 15,  $ano), // Proclamação da republica - Lei nº 662, de 06/04/49
        mktime(0, 0, 0, 12, 25,  $ano), // Natal - Lei nº 662, de 06/04/49

        // Feriados municipais de sp
        mktime(0, 0, 0, 7, 9, $ano),
        mktime(0, 0, 0, 11, 20, $ano),
        mktime(0, 0, 0, 1, 25, $ano),
    
        // These days have a date depending on easter
        mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 48,  $ano_pascoa),//2ºferia Carnaval
        mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 47,  $ano_pascoa),//3ºferia Carnaval	
        mktime(0, 0, 0, $mes_pascoa, $dia_pascoa - 2 ,  $ano_pascoa),//6ºfeira Santa  
        mktime(0, 0, 0, $mes_pascoa, $dia_pascoa     ,  $ano_pascoa),//Pascoa
        mktime(0, 0, 0, $mes_pascoa, $dia_pascoa + 60,  $ano_pascoa),//Corpus Cirist
    );
   
    sort($feriados);
    
    return $feriados;
}

$feriados = [];

$ano=date("Y");

foreach(diasFeriados($ano) as $a)
{
    array_push($feriados,date("d-m-Y",$a));						 
}

echo "<pre>";

print_r($feriados);

echo "<br>----------------------------------------------------------------------<br>";

$data_prazo = new DateTime('2018-11-14'); 

echo "dia inicial: " . date_format($data_prazo, "d-m-Y") . "<br><br>";

$cout = 0;

while ($cout < 5) {

    if(in_array(date_format($data_prazo, "d-m-Y"), $feriados)){
        echo date_format($data_prazo, "d-m-Y") . ' Feriado <br>';
        $data_prazo->modify('+1 weekday');
    }else{
        echo date_format($data_prazo, "d-m-Y") . ' Útil <br>';
    }

    $data_prazo->modify('+1 weekday'); 
    $cout++;
}

echo "<br>Dia fim: " .date_format($data_prazo, "d-m-Y") . "<br>";

