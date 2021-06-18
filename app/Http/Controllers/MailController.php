<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;
use Exception;

use App\Mail\ValidacionRegistro;
use App\Mail\ContrasenaCambio;
use App\Models\User;
use App\Models\Personas;
use App\Models\Subdominios;


class MailController extends Controller
{
    public function index()
    {
        try{
            return view('ebid-views-login.contrasena-mail');
        } 
        catch(QueryException $err){
            if($err){
                $e = json_decode(json_encode($err), true);
                $numeroError = $e['errorInfo'][1];
                $nombreError = $e['errorInfo'][2];
                return view('error', [
                    'numero'=> $numeroError,
                    'nombre'=> $nombreError
                ]);
            }
            else{
                return view('error', [
                    'numero'=> '',
                    'nombre'=> ''
                ]);
            }
        }
    }
    public function sendEmail(Request $request)
    {
        $email = $request->email;
        $str = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890-";
        $password = "";
        for($i=0;$i<8;$i++) {
        $password .= substr($str,rand(0,62),1);
        }
        
        $details = [
            'fecha'=> date('d-m-Y', time()),
            'hora'=> date('h:i:s a', time()),
            'password'=> $password
        ];
        Mail::to($email)->send(new ContrasenaCambio($details));
        //return "Email Sent_".$password;

        $persona_edit = Personas::select('*')
                        ->where('email','=',$email)
                        ->first();
        $persona_edit->password = Hash::make($password);

        $persona_edit->save();
    
        return redirect('/login_')->with('contrasena', 'Se cambio la contraseña, verifique su correo electronico');

    }
}
