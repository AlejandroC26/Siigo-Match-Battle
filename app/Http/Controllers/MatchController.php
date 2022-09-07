<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
/* MODELS */
use App\Models\CardsModel;
use App\Models\MatchModel;
use App\Models\UserMatchModel;
use App\Models\CardsMatchModel;
use App\Models\RoundsMatchModel;

class MatchController extends Controller
{
    public function __construct(){
        $this->middleware('auth:api');
    }



    public function register (Request $request) {
        try {
            $user = auth()->user();
            $validator = Validator::make($request->all(),[
                "time_match"=>"required|integer",
            ]);
            if($validator->fails()){return response()->json(["message"=>"fields validation fails", "fields"=>$validator->errors()]);}
            $match = MatchModel::create(array_merge($validator->validated()));
            UserMatchModel::create([
                'fk_match'=>$match->id,
                'fk_user'=>$user->id
            ]);
            return response()->json([
                "message"=>"succesfully match created", 
                'data'=>$match]
            ,201);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getMessage()], 400);
        }
    }
    // AGREGA USUARIO AL JUEGO
    public function addUser (Request $request, $id, $userId) {
        try {
            $id = base64_decode($id);
            $userexists = UserMatchModel::where(['fk_user'=>$userId])
                ->where(['fk_match'=>$id])->count();
            $limite = UserMatchModel::where(['fk_match'=>$id])->count();
            if($userexists) return response()->json(['message'=>'este usuario ya ingresó al juego'], 400);
            if($limite >= 7) return response()->json(['message'=>'ya no hay cupos en esta partida'], 400);
            UserMatchModel::create([
                'fk_match'=>$id,
                'fk_user'=>$userId
            ]);
            return response()->json(['message'=>'Usuario agregado exitosamente'], 201);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getMessage()], 400);
        }
    }
    // OBTIENE LOS USUARIOS DE LA SALA
    public function activeUsers (Request $request, $id) {
        try {
            $id = base64_decode($id);
            $matchUsers = UserMatchModel::where(['fk_match'=>$id])->get();
            return response($matchUsers);
        } catch (\Throwable $th) {
            //throw $th;
        }
        
    }
    // INICIA EL JUEGO
    public function startMatch (Request $request, $id){
        $id = base64_decode($id);
        $match = MatchModel::where('id','=', $id)
            ->where('state_match','=', 'waiting')->get();
        if(!count($match)) return response()->json(['message'=>'esta sala ya no se encuentra disponible'], 400);
        $matchUsers = UserMatchModel::where(['fk_match'=>$id])->get();
        if(count($matchUsers) < 2) return response()->json(['message'=>'faltan usuarios para iniciar el juego'], 400); 
        $cards = CardsModel::all();

        $shuffled_cards = $cards->shuffle();
        $chunks = $shuffled_cards->chunk(count($matchUsers));

        $i = 0;
        $leftover = [];
        $userChunk = [];
        foreach ($chunks as $chunk) {
            $i++;
            if($i > count($matchUsers)) {
                // REGISTRA LA CARTA SIN USUARIOS
                array_push($leftover, $chunk);
            } else {
                $index_user = 0;
                foreach ($chunk as $carta) {
                    array_push($userChunk, $carta);

                    CardsMatchModel::create([
                        "fk_card"=>$carta->id,
                        "fk_user_match"=>$matchUsers[$index_user]->id
                    ]);
                    $index_user ++;
                }
            }
        }
        // CREA LA PRIMERA RONDA
        RoundsMatchModel::create([
            'fk_user_match'=>1,
        ]);
        // CAMBIA EL ESTADO DE LA PARTIDA A INICIADA
        MatchModel::where(['id'=>$match[0]->id])
            ->update(['state_match'=>'playing']);
        return response()->json([
            'message'=>'juego iniciado correctamente', 
            'data'=>[
                "machine_cards" => $leftover
        ]]);
    }
}
