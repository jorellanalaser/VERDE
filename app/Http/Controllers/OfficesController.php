<?php
/**
 * Created by PhpStorm.
 * User: Plopez
 * Date: 19/09/16
 * Time: 06:10 AM
 */

namespace App\Http\Controllers;


use App\Http\Schemas\Office;
use Illuminate\Support\Facades\View;

class OfficesController extends Controller
{
    public function index($city = null)
    {
        if(!is_null($city))
            $offices = Office::where([
                            ['city', $city],
                            ['enabled', '=', 1],
                        ])
                ->orderBy('priority')
                ->get();
        else
            $offices = Office::where('enabled', '=', 1)
                ->orderBy('priority', 'ASC')
                ->get();
        //dd($offices);
        return View::make('offices', [
            'offices' => $offices
        ]);
    }
}
