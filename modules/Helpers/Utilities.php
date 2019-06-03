<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 18/08/16
 * Time: 10:16 PM
 */

namespace Modules\Helpers;


use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Contracts\Encryption\EncryptException;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Log;
use App\Http\Schemas\Booking;

class Utilities
{
    /**
     * Codifica y encripta datos para envio seguro
     *
     * @param $_str
     * @return mixed
     */
    public static function encrypt($_str)
    {
        try {
            return Crypt::encrypt(json_encode($_str));
        }
        catch (EncryptException $e) {
            Log::error($e);
        }
    }

    /**
     * Decodifica datos
     *
     * @param $_str
     * @return mixed
     */
    public static function decrypt($_str)
    {
        try {
            return json_decode(Crypt::decrypt($_str));
        }
        catch (DecryptException $e) {
            Log::error($e);
        }
    }

    public static function number_format($_number)
    {
        return number_format( $_number, 2, ',','.');
    }

    public static function number_format2($_number)
    {
        return number_format( $_number, 2, '.',',');
    }

    /*
    -- =============================================
    -- Author:		Luis Antonio Celis Molina
    -- Create date: 20/03/2010
    -- Description: Limpia cadena y regresa sin acentos
    -- Parametros: @text string con la variable a limpiar
    -- =============================================
    */

    public static function elimina_acentos($text)
    {
        $text = htmlentities($text, ENT_QUOTES, 'UTF-8');
        $text = strtolower($text);
        $patron = array (
            // Espacios, puntos y comas por guion
            //'/[\., ]+/' => ' ',

            // Vocales
            '/\+/' => '',
            '/&agrave;/' => 'a',
            '/&egrave;/' => 'e',
            '/&igrave;/' => 'i',
            '/&ograve;/' => 'o',
            '/&ugrave;/' => 'u',

            '/&aacute;/' => 'a',
            '/&eacute;/' => 'e',
            '/&iacute;/' => 'i',
            '/&oacute;/' => 'o',
            '/&uacute;/' => 'u',

            '/&acirc;/' => 'a',
            '/&ecirc;/' => 'e',
            '/&icirc;/' => 'i',
            '/&ocirc;/' => 'o',
            '/&ucirc;/' => 'u',

            '/&atilde;/' => 'a',
            '/&etilde;/' => 'e',
            '/&itilde;/' => 'i',
            '/&otilde;/' => 'o',
            '/&utilde;/' => 'u',

            '/&auml;/' => 'a',
            '/&euml;/' => 'e',
            '/&iuml;/' => 'i',
            '/&ouml;/' => 'o',
            '/&uuml;/' => 'u',

            '/&auml;/' => 'a',
            '/&euml;/' => 'e',
            '/&iuml;/' => 'i',
            '/&ouml;/' => 'o',
            '/&uuml;/' => 'u',

            // Otras letras y caracteres especiales
            '/&aring;/' => 'a',
            '/&ntilde;/' => 'n',

            // Agregar aqui mas caracteres si es necesario

        );

        $text = preg_replace(array_keys($patron),array_values($patron),$text);
        return $text;
    }

    public static function booking_user($_code, $_id)
    {
        $booking_user = Booking::where('booking_ref', $_code)
        ->orderBy('id','DESC')
        ->first();

        if ($booking_user == null){
            return 2;
        }

        if($booking_user->user_id == $_id)
        {
            return true;
        }else
        {
            return false;
        }    
    }
}