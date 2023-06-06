<?php

declare(strict_types=1);

namespace src\classes;

use Decimal\Decimal;
use Exception;

class Math
{

    /**
     *Subtrai dois números usando Decimal/Decimal.
     *
     *@param string num1 O primeiro número a ser subtraído.
     *@param string num2 O segundo número a ser subtraído.
     *@param int precision O número de casas decimais para arredondar.
     *
     *@return string O resultado da subtração dos dois números.
     */
    public static function sub(string|int $num1, string|int $num2, int $precision = 0)
    {
        $num1 = new Decimal($num1);
        $num2 = new Decimal($num2);

        if ($precision) {
            return $num1->sub($num2)->toFixed($precision);
        }
        return $num1->sub($num2)->__toString();
    }

    /**
     *Soma dois números usando Decimal/Decimal.
     *
     *@param string num1 O primeiro número a ser somado.
     *@param string num2 O segundo número a ser somado.
     *@param int precision O número de casas decimais para arredondar.
     *
     *@return string O resultado da soma dos dois números.
     */
    public static function add(string|int $num1, string|int $num2, int $precision = 0)
    {
        $num1 = new Decimal($num1);
        $num2 = new Decimal($num2);

        if ($precision) {
            return $num1->add($num2)->toFixed($precision);
        }
        return $num1->add($num2)->__toString();
    }

    /**
     *multiplica dois números usando Decimal/Decimal.
     *
     *@param string num1 O primeiro número a ser somado.
     *@param string num2 O segundo número a ser somado.
     *@param int precision O número de casas decimais para arredondar.
     *
     *@return string O resultado da soma dos dois números.
     */
    public static function mul(string|int $num1, string|int $num2, int $precision = 0)
    {
        $num1 = new Decimal($num1);
        $num2 = new Decimal($num2);

        if ($precision) {
            return $num1->mul($num2)->toFixed($precision);
        }
        return $num1->mul($num2)->__toString();
    }

    /**
     *Divide dois números usando Decimal/Decimal.
     *
     *@param string num1 O primeiro número a ser dividido.
     *@param string num2 O número pelo qual dividir.
     *@param int precision O número de casas decimais para arredondar.
     *
     *@return string O resultado da divisão dos dois números.
     */
    public static function div(string|int $num1, string|int $num2, int $precision = 0)
    {
        $num1 = new Decimal($num1);
        $num2 = new Decimal($num2);


        if ($num2->isZero()) {
            return '0';
        }

        if ($precision) {
            return $num1->div($num2)->toFixed($precision);
        }
        return $num1->div($num2)->__toString();
    }


    /**
     *Leva dois números, divide o primeiro pelo segundo e retorna o resultado como uma porcentagem.
     *
     *@param string|int parcial O valor do qual você deseja calcular a porcentagem.
     *@param string|int total O número total de itens.
     *
     */
    public static function porcentagem(string|int $parcial, string|int $total): string
    {
        $parcial = new Decimal($parcial);
        $total = new Decimal($total);

        $parcial = $parcial->mul(100);
        $result = $parcial->div($total);
        return $result->toFixed(2);
    }

    /**
     * Converte segundos e retorna uma string no formato `HH:MM:SS`
     *
     * @param int seconds O número total de segundos para converter em uma string de hora.
     *@return string Uma string no formato HH:MM:SS
     */
    public static function secondsToTime(int $seconds): string
    {
        $totalTimeSeconds = new Decimal($seconds);

        $hours = $totalTimeSeconds->div(3600)->floor()->__toString();
        $minutes = $totalTimeSeconds->div(60)->mod(60)->floor()->__toString();
        $seconds = $totalTimeSeconds->mod(60)->__toString();

        return "$hours:$minutes:$seconds";
    }

    /**
     * Converte time no formato `HH:MM:SS` para horas
     *
     * @param string $time Uma string no formato HH:MM:SS.
     * @return string Total em horas
     */
    public static function timeToHours(string $time): string
    {
        if ($time == '0') {
            return '0.00';
        }

        $duration = explode(':', $time);

        $hours = new Decimal($duration[0]);
        $minutes = new Decimal($duration[1]);
        $seconds = new Decimal($duration[2]);

        $hours = $hours->add($minutes->div(60));
        $hours = $hours->add($seconds->div(3600));

        return $hours->__toString();
    }

    /**
     * Converte time no formato `HH:MM:SS` para Segundos
     *
     * @param string $time Uma string no formato HH:MM:SS.
     * @return string Total em segundos
     */
    public static function timeToSec(string $time): string
    {
        $duration = explode(':', $time);

        $hours = new Decimal($duration[0]);
        $minutes = new Decimal($duration[1]);
        $seconds = new Decimal($duration[2]);

        $seconds = $seconds->add($hours->mul(3600));
        $seconds = $seconds->add($minutes->mul(60));

        return $seconds->__toString();
    }

    /**
     * Converte graus para radianos usando a extensão decimal.
     *
     * @param string $degrees Valor em graus
     * @return string Valor em radianos
     */

    public static function deg2rad(string $degrees): string
    {

        if (strlen($degrees) > 14) {
            $aux = str_split($degrees, 13);
            $degrees = $aux[0];
        }

        $value = new Decimal($degrees);
        $denominator = new Decimal(strval(180));
        $pi = new Decimal(strval(M_PI));

        try {
            return $value->div($denominator)->mul($pi)->__toString();
        } catch (Exception $e) {
            var_dump($e);
        }
    }

    /**
     * Calculo da distância entre duas coordenadas de GPS utilizando a formula de Haversine com a extensão Decimal do PHP.
     * reference: http://www.codecodex.com/wiki/Calculate_Distance_Between_Two_Points_on_a_Globe#PHP
     * @param string $lat1 Latitude Inicial [deg decimal]
     * @param string $lon1 Longitude Inicial [deg decimal]
     * @param string $lat2 Latitude Final [deg decimal]
     * @param string $lon2 Longitude Final [deg decimal]
     * @return string Distancia entre dois pontos [m] 
     */
    public static function haversine(string $lat1, string $lon1, string $lat2, string $lon2): string
    {
        $radiusOfEarth = new Decimal(6371); // Earth's radius in kilometers.
        $lat_final = new Decimal(self::deg2rad($lat2));
        $lat_inicial = new Decimal(self::deg2rad($lat1));
        $lon_inicial = new Decimal(self::deg2rad($lon1));
        $lon_final = new Decimal(self::deg2rad($lon2));

        $diffLatitude = $lat_final->sub($lat_inicial);
        $diffLongitude = $lon_final->sub($lon_inicial);

        $term1 = (new Decimal(strval(sin($diffLatitude->div(2)->toFloat()))))->pow(2);
        $term2 = (new Decimal(strval(cos($lat_inicial->toFloat()))));
        $term3 = (new Decimal(strval(cos($lat_final->toFloat()))));
        $term4 = (new Decimal(strval(sin($diffLongitude->div(2)->toFloat()))))->pow(2);

        $a = $term2->mul($term3)->mul($term4);
        $a = $term1->add($a);

        $term5 = (new Decimal(strval(asin($a->sqrt()->toFloat()))))->mul(2);
        $distance = $radiusOfEarth->mul($term5)->__toString();

        return $distance;
    }
}