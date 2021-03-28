<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\Personas;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

/**/
use App\Mail\ValidacionRegistro;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected $redirectTo = '/login_';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'per_nombres' => ['required', 'string', 'max:50'],
            'per_paterno' => ['required', 'string', 'max:50'],
            'per_materno' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'email', 'max:50', 'unique:personas'],
            //'password' => ['required', 'string', 'min:8', 'confirmed'],
            'per_subd_extension' => ['required', 'string'],
            'per_num_documentacion' => ['required', 'max:11'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890-";
        $password = "";
        for($i=0;$i<8;$i++) {
        $password .= substr($str,rand(0,62),1);
        }
        /******************************************* */
        $crear_persona= Personas::create([
            'per_ua_id' =>'UA-EA0001',
            'per_nombres' => trim($data['per_nombres']),
            'per_paterno' => trim($data['per_paterno']),
            'per_materno' => trim($data['per_materno']),
            'name' => trim($data['per_nombres']).' '.trim($data['per_paterno']).' '.trim($data['per_materno']),
            'email' => trim($data['email']),
            'per_correo_personal' => trim($data['email']),
            //'password' => Hash::make($data['password']),
            'password' => Hash::make($password),
            'per_subd_estado' => 1,
            'per_telefono' => trim($data['per_telefono']),
            'per_subd_extension' => trim($data['per_subd_extension']),
            'per_num_documentacion' => trim($data['per_num_documentacion']).trim($data['per_alfanumerico']),
            'per_rol' => '4', //revisar si el 1 2 3 4 .... corresponde a per_rol = estudiante y cambiarlo si corresponde
            'per_foto_personal' => '/assets/img/usuario.ico',
        ]);
        /******************************************* */

        $details = [
            'password'=> $password,
            'name'=>trim($data['per_nombres']).' '.trim($data['per_paterno']).' '.trim($data['per_materno'])
        ];
        Mail::to($data['email'])->send(new ValidacionRegistro($details));

        return $crear_persona;
    }
}
