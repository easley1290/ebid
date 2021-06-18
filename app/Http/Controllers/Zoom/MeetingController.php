<?php

namespace App\Http\Controllers\Zoom;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\QueryException;

use App\Http\Traits\ZoomJWT;

class MeetingController extends Controller
{
    use ZoomJWT;

    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;

    public function list(Request $request)
    {
        try{
            $path = 'users/me/meetings';
            $response = $this->zoomGet($path);

            $data = json_decode($response->body(), true);
            $data['meetings'] = array_map(function ($m) {
                $m['start_at'] = $this->toUnixTimeStamp($m['start_time'], $m['timezone']);
                return $m;
            }, $data['meetings']);
            /*return [
                'success' => $response->ok(),
                'data' => $data,
            ];*/
            $status = $response->ok();
            $datos=$data['meetings'];
            
            $aux = [$status, $datos];
            return view('ebid-views-administrador.zoom.meeting')->with('aux', $aux);
        }
        catch(QueryException $err){
            if($err){
                $e = json_decode(json_encode($err), true);
                $numeroError = $e['errorInfo'][1];
                $nombreError = $e['errorInfo'][2];
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual ('.$numeroError.' - '.$nombreError.')');
            }
            else{
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
            }
        }
    }

    public function create(Request $request)
    {
        try{
            $validator = Validator::make($request->all(), [
                'topic' => 'required|string',
                'start_time' => 'required|date',
                'agenda' => 'string|nullable',
            ]);
            
            if ($validator->fails()) {
                return [
                    'success' => false,
                    'data' => $validator->errors(),
                ];
            }
            $data = $validator->validated();
        
            $path = 'users/me/meetings';
            $response = $this->zoomPost($path, [
                'topic' => $data['topic'],
                'type' => self::MEETING_TYPE_SCHEDULE,
                'start_time' => $this->toZoomTimeFormat($data['start_time']),
                'duration' => 30,
                'agenda' => $data['agenda'],
                'settings' => [
                    'host_video' => false,
                    'participant_video' => false,
                    'waiting_room' => true,
                ]
            ]);
        
            /*
            return [
                'success' => $response->status() === 201,
                'data' => json_decode($response->body(), true),
            ];*/
    
            return redirect()->route('listZoom');
        }
        catch(QueryException $err){
            if($err){
                $e = json_decode(json_encode($err), true);
                $numeroError = $e['errorInfo'][1];
                $nombreError = $e['errorInfo'][2];
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual ('.$numeroError.' - '.$nombreError.')');
            }
            else{
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
            }
        }

    }

    public function get(Request $request, string $id) 
    {
        try{
            $path = 'meetings/' . $id;
            $response = $this->zoomGet($path);

            $data = json_decode($response->body(), true);
            if ($response->ok()) {
                $data['start_at'] = $this->toUnixTimeStamp($data['start_time'], $data['timezone']);
            }

            return [
                'success' => $response->ok(),
                'data' => $data,
            ]; 
        }
        catch(QueryException $err){
            if($err){
                $e = json_decode(json_encode($err), true);
                $numeroError = $e['errorInfo'][1];
                $nombreError = $e['errorInfo'][2];
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual ('.$numeroError.' - '.$nombreError.')');
            }
            else{
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
            }
        }
    }

    public function update(Request $request, string $id)
    {
        try{
            $validator = Validator::make($request->all(), [
                'topic_' => 'required|string',
                'start_time_' => 'required|date',
                'agenda_' => 'string|nullable',
            ]);
    
            if ($validator->fails()) {
                return [
                    'success' => false,
                    'data' => $validator->errors(),
                ];
            }
            $data = $validator->validated();
    
            $path = 'meetings/' . $id;
            $response = $this->zoomPatch($path, [
                'topic' => $data['topic_'],
                'type' => self::MEETING_TYPE_SCHEDULE,
                'start_time' => (new \DateTime($data['start_time_']))->format('Y-m-d\TH:i:s'),
                'duration' => 30,
                'agenda' => $data['agenda_'],
                'settings' => [
                    'host_video' => false,
                    'participant_video' => false,
                    'waiting_room' => true,
                ]
            ]);
    
            /*return [
                'success' => $response->status() === 204,
                'data' => json_decode($response->body(), true),
            ];*/
            return redirect()->route('listZoom');
        }
        catch(QueryException $err){
            if($err){
                $e = json_decode(json_encode($err), true);
                $numeroError = $e['errorInfo'][1];
                $nombreError = $e['errorInfo'][2];
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual ('.$numeroError.' - '.$nombreError.')');
            }
            else{
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
            }
        }
    }
    
    public function delete(Request $request, string $id)
    {
        try{
            $path = 'meetings/' . $id;
            $response = $this->zoomDelete($path);
            /*
            return [
                'success' => $response->status() === 204,
                'data' => json_decode($response->body(), true),
            ];*/
            return redirect()->route('listZoom');
        }
        catch(QueryException $err){
            if($err){
                $e = json_decode(json_encode($err), true);
                $numeroError = $e['errorInfo'][1];
                $nombreError = $e['errorInfo'][2];
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual ('.$numeroError.' - '.$nombreError.')');
            }
            else{
                return view('ebid-views-administrador.home')->with('status', 'Hubo un error inusual');
            }
        }
    }
}
