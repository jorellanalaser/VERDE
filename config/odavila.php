<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 16/08/16
 * Time: 09:04 PM
 */

return [
    'Pagination'             =>      '10',    // Cantidad de elementos por pagina

    'Kiu_URL'			     => env('KIU_HOST'), // URL to send request
    'Kiu_Target'		     => env('KIU_TARGET'), // Enviroment
    'Kiu_USER'			     => env('KIU_USER'), // Webservice Users
    'Kiu_PASSWD'		     => env('KIU_PASSWD'), // Webservice Password
    //Asigno la Compañia Para la cual busco Disponibilidad
    'Kiu_Airline'		     => '', //Para traer los itinerarios K8 Y QL DEBE ESTAR EN VACIO
    //Asigno la Compañia o Carrier del Vuelo para el Bookingphp artisan 
    'Kiu_CompanyVE'          => 'QL', // Se setea en la solicitud de Booking a QL
    'Kiu_CompanyMIA'         => 'WQ', // Se setea en la solicitud de Booking a QL

    'Kiu_AgentSine'	     => 'NET00QLWW', // Agensine
    //Asigno la El terminal ID para moneda VES y USD
    'Kiu_TerminalIDVE'       => 'NET00QL000', // Terminal ID venezuela
    'Kiu_TerminalID'         => 'PTY00QLW01', // Terminal ID panama
    'Kiu_MaxResponses'	     => '',    // Max responses
    'Kiu_QueryLastDays'      => '0',   // Quantity days for decrfement to day request
    'Kiu_QueryMaxDays'       => '',    // Quantity days for increment to day request
    'Kiu_PseudoCityCode'     => 'NET', // City code from request
    //Asigno la Moneda para airdeman, booking y avail
    'Kiu_ISOCountry'         => 'PA',  // Country code from request
    'Kiu_ISOCountryVE'       => 'VE',  // Country code from request
    
    'Kiu_ISOCurrency'        => 'VES', // Currency code
    'Kiu_BookingChannelType' => '1',   // Type booking channel
    'Kiu_RequestorIDType'    => '5',   // requestor id,
    'Kiu_TimeLimit'          => '1',   // Tiempo limite en hora que dura la reserva

    'shopping_cart'          => 'cart.item', // Shopping cart ID
    'bookig_cart'            => 'cart.booking',  // Booking ready to emit

    'location_exception'     => [ // Forzar una IP a cotizar en moneda indicada
	//'190.159.190.15'         => 'VES',
	//'181.143.187.218'        => 'VES',
        //'192.168.1.117'          => 'VES',
	//'192.168.1.126'        => 'VES', // Equipo de Albin Suarez
    //'192.168.1.82'         => 'VES', //Equipo de Pedro Lopez
    //'192.168.1.171'        => 'VES', //Equipo de JOEL ABREU
	//'192.168.1.176'          => 'VES',
	//'192.168.1.242'          => 'VES',
    //'192.168.1.246'          => 'VES',
    //'127.0.0.1'              => 'VES',
    //'201.249.203.194'        => 'VES'
    //'localhost'              => 'VES',
    //'::1' => 'VES', // Local
    ],
    'maintenance' => [
        //'127.0.0.0',
        //'192.168.1.82',

    ]
];
