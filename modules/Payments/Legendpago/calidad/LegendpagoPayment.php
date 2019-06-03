<?php

/**
 * The MIT License (MIT)
 * Copyright (c) 2016 Angel Cruz <me@abr4xas.org>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the “Software”), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
 * THE SOFTWARE.
 *
 * @author Angel Cruz <me@abr4xas.org>
 * @package php-instapago
 * @license MIT License
 * @copyright 2016 Angel Cruz
 */

namespace Modules\Payments\Legendpago;

use Modules\Payments\Legendpago\Exceptions\LegendpagoException;

/**
 * Clase para la pasarela de pagos Instapago
 */

class LegendpagoPayment
{

    protected 	$keyId;
    protected 	$publicKeyId;
    public 	  	$cardHolder;
    public  	$cardHolderId;
    public 		$cardNumber;
    public 		$cvc;
    public 		$expirationDate;
    public 		$amount;
    public 		$description;
    public 		$statusId;
    public    $ipAddres;
    public    $idPago;
    public    $root = 'https://pagos.legendsoft.com/api/api/';
    public    $address1;
    public    $country;
    public    $state;
    public    $city;
    public    $zipcode;
    public    $email;

    /**
     * Crear un nuevo objeto de Instapago
     * @param string $keyId llave privada
     * @param string $publicKeyId llave publica
     * Requeridas.
     */
    public function __construct ($keyId,$publicKeyId)
    {

        try {

            if (empty($keyId) && empty($publicKeyId)) {
                throw new LegendpagoException('Los parámetros "keyId" y "publicKeyId" son requeridos para procesar la petición.');
            }

            if (empty($keyId)) {
                throw new LegendpagoException('El parámetro "keyId" es requerido para procesar la petición. ');
            }

            if (empty($publicKeyId)) {
                throw new LegendpagoException('El parámetro "publicKeyId" es requerido para procesar la petición.');
            }

            $this->publicKeyId = $publicKeyId;
            $this->keyId = $keyId;

        } catch (LegendpagoException $e) {

            echo $e->getMessage();

        } // end try/catch

    } // end construct

    /**
     * Crear un pago
     * Efectúa un pago con tarjeta de crédito, una vez procesado retornar una respuesta.
     * https://github.com/abr4xas/php-instapago/blob/master/help/DOCUMENTACION.md#crear-un-pago
     */
    public function payment($amount,$description,$cardHolder,$cardHolderId,$cardNumber,$cvc,$expirationDate,$statusId,$ipAddres,$address1,$country,$state,$city,$zipcode,$email)
    {
        try {
            $params = array($amount,$description,$cardHolder,$cardHolderId,$cardNumber,$cvc,$expirationDate,$statusId,$ipAddres,$address1,$country,$state,$city,$zipcode,$email);
            $this->checkRequiredParams($params);

            $this->amount           = $amount;
            $this->description      = $description;
            $this->cardHolder       = $cardHolder;
            $this->cardHolderId     = $cardHolderId;
            $this->cardNumber       = $cardNumber;
            $this->cvc 			    = $cvc;
            $this->expirationDate   = $expirationDate;
            $this->statusId		    = $statusId;
            $this->address1        = $address1;
            $this->country        = $country;
            $this->state          = $state;
            $this->city        = $city;
            $this->zipcode        = $zipcode;
            $this->email        = $email;

            $url = $this->root . 'payment'; // endpoint

            $fields = [
                "KeyID"             => $this->keyId, //required
                "PublicKeyId"       => $this->publicKeyId, //required
                "amount"            => $this->amount, //required
                "description"       => $this->description, //required
                "cardHolder"        => $this->cardHolder, //required
                "cardHolderId"      => $this->cardHolderId, //required
                "cardNumber"        => $this->cardNumber, //required
                "cvc"               => $this->cvc, //required
                "expirationDate"    => $this->expirationDate, //required
                "statusId"          => $this->statusId, //required
                "IP"                => $this->ipAddres, //required
                "address"           => $this->address1,//'Av. Aquino Lopez Prueba Pedro',//required
                "City"              => $this->city,//'Panama',//required
                "State"             => $this->state,//'Panama City',//required
                "Country"           => $this->country,//'OT',//required
                "ZipCode"           => $this->zipcode,//'10812',//required
                "UserAgent"         => $_SERVER['HTTP_USER_AGENT'],//required
                "Email"             => $this->email,//'pedrojacosta@legendsoft.com',//required
                "cookie"            => $this->description,//'sjagrsmiteznwriy4bjk03eo',//required
                "description"       => $this->description, //'RPVLRIsssssss'//required
            ];

            $obj = $this->curlTransaccion($url, $fields);
            $result = $this->checkResponseCode($obj);
            //dd($fields); //Aqui veo Array
            return $result;

        } catch (LegendpagoException $e) {

            echo $e->getMessage();

        } // end try/catch
        
        return;

    } // end payment

    /**
     * Completar Pago
     * Este método funciona para procesar un bloqueo o pre-autorización
     * para así procesarla y hacer el cobro respectivo.
     * Para usar este método es necesario configurar en `payment()` el parametro statusId a 1
     * https://github.com/abr4xas/php-instapago/blob/master/help/DOCUMENTACION.md#completar-pago
     */

    public function continuePayment($amount,$idPago)
    {
        try {
            $params = array($amount,$idPago);
            $this->checkRequiredParams($params);

            $this->amount = $amount;
            $this->idPago = $idPago;

            $url = $this->root . 'complete'; // endpoint

            $fields = [
                "KeyID"             => $this->keyId, //required
                "PublicKeyId"       => $this->publicKeyId, //required
                "amount"            => $this->amount, //required
                "id"                => $this->idPago, //required
            ];

            $obj = $this->curlTransaccion($url, $fields);
            
            $result = $this->checkResponseCode($obj);

            return $result;

        } catch (LegendpagoException $e) {

            echo $e->getMessage();

        } // end try/catch

        return;
    } // continuePayment

    /**
     * Anular Pago
     * Este método funciona para procesar una anulación de un pago o un bloqueo.
     * https://github.com/abr4xas/php-instapago/blob/master/help/DOCUMENTACION.md#anular-pago
     */

    public function cancelPayment($idPago)
    {
        try {

            $params = array($idPago);
            $this->checkRequiredParams($params);

            $this->idPago = $idPago;

            $url = $this->root . 'payment'; // endpoint

            $fields = [
                "KeyID"             => $this->keyId, //required
                "PublicKeyId"       => $this->publicKeyId, //required
                "id"                => $this->idPago, //required
            ];

            $obj = $this->curlTransaccion($url, $fields);
            $result = $this->checkResponseCode($obj);

            return $result;

        } catch (LegendpagoException $e) {

            echo $e->getMessage();

        } // end try/catch

        return;
    } // cancelPayment

    /**
     * Información del Pago
     * Consulta información sobre un pago generado anteriormente.
     * Requiere como parámetro el `id` que es el código de referencia de la transacción
     * https://github.com/abr4xas/php-instapago/blob/master/help/DOCUMENTACION.md#información-del-pago
     */

    public function paymentInfo($idPago)
    {
        try {
            $params = array($idPago);

            $this->checkRequiredParams($params);

            $this->idPago = $idPago;

            $url = $this->root . 'payment'; // endpoint

            $myCurl = curl_init();
            curl_setopt($myCurl, CURLOPT_URL, $url.'?'.'KeyID='. $this->keyId .'&PublicKeyId='. $this->publicKeyId .'&id=' . $this->idPago);
            curl_setopt($myCurl, CURLOPT_RETURNTRANSFER, 1);
            //curl_setopt($myCurl, CURLOPT_SSL_VERIFYPEER, false);//esto es para aceder desde local desactiva https por que sin esto no lo lee
            $server_output = curl_exec($myCurl);
            curl_close ($myCurl);
            $obj = json_decode($server_output);
            //dd($obj);
            $result = $this->checkResponseCode($obj);
        
            return $result;

        } catch (LegendpagoException $e) {

            echo $e->getMessage();

        } // end try/catch

        return;
    } // paymentInfo

    /**
     * Realiza Transaccion
     * Efectúa y retornar una respuesta a un metodo de pago.
     *@param $url endpoint a consultar
     *@param $fields datos para la consulta
     *@return $obj array resultados de la transaccion
     * https://github.com/abr4xas/php-instapago/blob/master/help/DOCUMENTACION.md#PENDIENTE
     */
    public function curlTransaccion($url, $fields)
    {

      $myCurl = curl_init();
      curl_setopt($myCurl, CURLOPT_URL,$url );
      curl_setopt($myCurl, CURLOPT_POST, 1);
      curl_setopt($myCurl, CURLOPT_POSTFIELDS,http_build_query($fields));
      curl_setopt($myCurl, CURLOPT_RETURNTRANSFER, true);
      //curl_setopt($myCurl, CURLOPT_SSL_VERIFYPEER, false);//esto es para aceder desde local desactiva https por que sin esto no lo lee
      $server_output = curl_exec ($myCurl);
      curl_close ($myCurl);
      $obj = json_decode($server_output);
      //dd($obj);
      return $obj;
    }

    /**
     * Verifica Codigo de Estado de transaccion
     * Verifica y retornar el resultado de la transaccion.
     *@param $obj datos de la consulta
     *@return $result array datos de transaccion
     * https://github.com/abr4xas/php-instapago/blob/master/help/DOCUMENTACION.md#PENDIENTE
     */
    public function checkResponseCode($obj)
    {
      //dd($obj); // Verifico el envio de 
      $code = $obj->code;
        return $obj;
      
      /*if ($code == 400) {
          throw new LegendpagoException('Error al validar los datos enviados.');
      }elseif ($code == 401) {
          throw new LegendpagoException('Error de autenticación, ha ocurrido un error con las llaves utilizadas.');
      }elseif ($code == 403) {
          throw new LegendpagoException('Pago Rechazado por el banco.');
      }elseif ($code == 500) {
          throw new LegendpagoException('Ha Ocurrido un error interno dentro del servidor.');
      }elseif ($code == 503) {
          throw new ILegendpagoException('Ha Ocurrido un error al procesar los parámetros de entrada. Revise los datos enviados y vuelva a intentarlo.');
      }elseif ($code == 201) {
        return [
            'code'      => $code ,
            'msg_banco' => $obj->message,
            'voucher' 	=> html_entity_decode($obj->voucher),
            'id_pago'	  => $obj->id,
            'reference' =>$obj->reference
        ];
      }*/
    }

    /**
     * Verifica parametros para realizar operación
     * Verifica y retorna exception si algun parametro esta vacio.
     *@param $params Array con parametros a verificar
     *@return new InstapagoException
     * https://github.com/abr4xas/php-instapago/blob/master/help/DOCUMENTACION.md#PENDIENTE
     */
    private function checkRequiredParams(Array $params)
    {
      foreach ($params as $param) {
        if(empty($param))
        {
          throw new LegendpagoException('Parámetros faltantes para procesar el pago. Verifique la documentación.');
        }
      }
    }

} // end class
