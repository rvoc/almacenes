<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\DB;
use App\Article;
class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;

    // protected $connection = 'public';
    protected $guard_name = 'web';
    protected $table = 'siscor._bp_usuarios';
    protected $primaryKey = "usr_id";
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function person(){
        $person = DB::table('siscor._bp_personas')
                ->where('prs_id','=',$this->usr_prs_id)
                ->first();
        return $person;
    }

    public function getFullName(){
        $person = DB::table('siscor._bp_personas')
                ->where('prs_id','=',$this->usr_prs_id)
                ->first();
        return $person->prs_nombres.' '.$person->prs_paterno.' '.$person->prs_materno;
    }

    public function getArticles()
    {
        $articles = Article::all();//validar de acuerdo a tabla de user_storage
        return $articles;
    }

    public function getStorages(){
        $storages = Storage::all();
        return $storages;
    }

    public function getStorage(){
        $storage = Storage::find(session('storage_id'));
        return $storage;
    }


}
