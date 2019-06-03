<?php
/**
 * Created by PhpStorm.
 * User: odavila
 * Date: 18/08/16
 * Time: 10:27 AM
 */

namespace App\Http\Controllers;


use App\Http\Schemas\Airport;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Request;
use Cookie;

class HomeController extends Controller
{
    public function index()
    {
        $airports_nac = Airport::where('enabled', true)
            ->orderBy('priority', 'id')
            ->get();
        // Coloco Cookie de Modal pra determinar su tiempo
        Cookie::queue('InputLaser', 'Activo', 30);  
        $VerModal = Request::cookie('InputLaser');

         if($VerModal==='Activo'){
             $VerModal = true;

         }else{
             $VerModal = false;
         }
         // Retorno Inicio
        return View::make('welcome', [
              'airports' => $airports_nac,
              'vermodal' => $VerModal
        ]);


            
    }

    public function getDestinations($_origin)
    {
        $origin = Airport::find($_origin);

        if(!is_null($origin)) {

            $destination['nac'] = Airport::where('id', '!=', $origin->id)
                ->where('int', false)
                ->get();

            $destination['int'] = Airport::where('id', '!=', $origin->id)
                ->where('int', true)
                ->get();

            return Response::json($destination);
        }
    }
}