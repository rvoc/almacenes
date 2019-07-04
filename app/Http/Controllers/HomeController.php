<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Ufv;
use Auth;
use Carbon\Carbon;
use Session;
class HomeController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user = Auth::user()->getStorage(); //importante no borrar obliga a que el usuario se le asigne un almacen de acuerdo a base
        
        $carbon = new Carbon();
        $date = $carbon->now();
        $day = Carbon::parse($date)->day;
        $month = Carbon::parse($date)->month;
        $year = Carbon::parse($date)->year;
        $extracto = null;
        // $content = file_get_contents('https://www.bcb.gob.bo/librerias/indicadores/ufv/gestion.php?sdd=04&smm=07&saa=2019&Button=++Ver++&reporte_pdf=07*04*2019**07*04*2019*&edd=04&emm=07&eaa=2019&qlist=1');
        $content = file_get_contents('https://www.bcb.gob.bo/librerias/indicadores/ufv/gestion.php?sdd=' . $day . '&smm=' . $month . '&saa=' . $year . '&Button=++Ver++&reporte_pdf=' . $month . '*' . $day . '*' . $year . '**' . $month . '*' . $day . '*' . $year . '*&edd=' . $day . '&emm=' . $month . '&eaa=' . $year . '&qlist=1');
        $patron = '|<div align="center">(.*?)</div>|is';
            if (preg_match_all($patron, $content, $extracto) > 0) {
                $ufv_exist = Ufv::where('date',$date)->first();
                if ($ufv_exist) {
                    // dd('EXISTE UFV');
                    // dd('La ufv de hoy es: '.$ufv_exist->price);
                    Session::put('UFV', $ufv_exist->price);
                }else{
                    // dd('NO EXISTE');
                    $new_ufv = new Ufv();
                    $numero = trim($extracto[1][1]);
                    $numero_dos= floatval(str_replace(',', '.', str_replace('.', '', $numero)));
                    $new_ufv->price = $numero_dos;
                    $new_ufv->date = $date;
                    $new_ufv->save();
                    Session::put('UFV', $numero_dos);
                }
                
            } else {
                return false;
            }
        // dd(trim($extracto[1][1]));

        return view('home');
    }
}
