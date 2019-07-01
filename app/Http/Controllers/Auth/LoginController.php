<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Log;
class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('web')->except('logout');
    }

    public function username()
    {
        return 'usr_usuario';
    }
    //TODO: Revisar la redireccion XD

    protected function redirectTo()
    {
        return redirect('/home');
    }

    private function get_ufv($date)
    {
        return $date;
        $day = Carbon::parse($date)->day;
        $month = Carbon::parse($date)->month;
        $year = Carbon::parse($date)->year;
        $extracto = null;

        $content = file_get_contents('https://www.bcb.gob.bo/librerias/indicadores/ufv/gestion.php?sdd=' . $day . '&smm=' . $month . '&saa=' . $year . '&Button=++Ver++&reporte_pdf=' . $month . '*' . $day . '*' . $year . '**' . $month . '*' . $day . '*' . $year . '*&edd=' . $day . '&emm=' . $month . '&eaa=' . $year . '&qlist=1');
        $patron = '|<div align="center">(.*?)</div>|is';
            if (preg_match_all($patron, $content, $extracto) > 0) {
            return trim($extracto[1][1]);
            } else {
            return false;
            }
    }
}



