<?php

namespace App\Http\Controllers;

use App\Models\reportes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Fx\Chartjs\Factory\Chartjs;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class InformesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function InfoGeneral()
    {
        return view('informes.informeGeneral');
    }
    public function InfoDia()
    {
        return view('informes.informeDia');
    }


}
