<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
/* MODELS */
use App\Models\CardsModel;
use App\Models\MatchModel;
use App\Models\UserMatchModel;
use App\Models\CardsMatchModel;
use App\Models\RoundsMatchModel;
use App\Models\CardsThrowModel;


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
            $users = [];
            $matchUsers = UserMatchModel::select('users_match.id', 'users_match.state', 'fk_match', 
                'fk_user', 'name')
                ->where(['fk_match'=>$id])
                ->join('users', 'users.id', 'fk_user')
                ->get();
            foreach ($matchUsers as $user) {
                $cards_user = CardsMatchModel::select(DB::raw('COUNT(*) as count_cards'))
                    ->where('fk_user_match', $user->id)
                    ->get();
                $user_push = [
                    "id"          =>$user->id,
                    "state"       =>$user->state,
                    "fk_match"    =>$user->fk_match,
                    "fk_user"     =>$user->fk_user,
                    "name"        =>$user->name,
                    "count_cards" =>$cards_user[0]->count_cards
                ];
                array_push($users, $user_push);
            }
            return response()->json($users);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getMessage()], 400);
        }
        
    }
    // INICIA EL JUEGO
    public function startMatch (Request $request, $id){
        try {
            $match = MatchModel::where('id','=', $id)
                ->where('state_match','=', 'waiting')->get();
            if(!count($match)) return response()->json(['message'=>'esta sala ya no se encuentra disponible'], 400);
            // SELECCIONA LOS USUARIOS DE LA PARTIDA
            $matchUsers = UserMatchModel::where(['fk_match'=>$id])->get();
            if(count($matchUsers) < 2) return response()->json(['message'=>'faltan usuarios para iniciar el juego'], 400); 
            $cards = CardsModel::all();

            $shuffled_cards = $cards->shuffle();



            $chunks = $shuffled_cards->chunk((count($cards) / count($matchUsers)));

            $i = 0;
            $leftover = [];
            $userChunk = [];
            $index_user = 0;
            foreach ($chunks as $chunk) {
                $i++;
                if($i > count($matchUsers)) {
                    // REGISTRA LA CARTA SIN USUARIOS
                    array_push($leftover, $chunk);
                } else {
                    foreach ($chunk as $carta) {
                        array_push($userChunk, $carta);

                        CardsMatchModel::create([
                            "fk_card"=>$carta->id,
                            "fk_user_match"=>$matchUsers[$index_user]->id
                        ]);
                    }
                }
                $index_user ++;
            }
            // SELECCIONA LA PRIMERA CARTA
            $first_card = CardsMatchModel::select('cards_match.id', 'cards_match.fk_user_match')
                ->join('users_match', 'users_match.fk_user', '=', 'cards_match.fk_user_match')
                ->where('fk_match', '=', $id)
                ->orderByRaw('fk_card ASC')
                ->limit(1)
                ->get();
            // CREA LA PRIMERA RONDA
            $round_match = RoundsMatchModel::create([
                'fk_user_match'=>$first_card[0]->fk_user_match,
            ]);
            // LANZA LA PRIMERA CARTA
            $cards_throw = CardsThrowModel::create([
                "fk_round_match"=>$round_match->id,
                "fk_cards_match"=>$first_card[0]->id,
            ]);
            // CAMBIA EL ESTADO DE LA PARTIDA A INICIADA
            MatchModel::where(['id'=>$match[0]->id])
                ->update(['state_match'=>'playing']);
            return response()->json([
                'message'=>'juego iniciado correctamente', 
                'data'=>[
                    "machine_cards" => $leftover
            ]]);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getMessage()], 400);
        }
        
    }
    // OBTIENE PRIMERA CARTA DEL JUEGO
    public function firstCard(Request $request){
        try {
            $first_card = CardsThrowModel::select('cards_throw.fk_round_match', 'cards_match.fk_card', 'users_match.id as user_match',
            'cylinder', 'year', 'torque', 'top_speed', 'weight', 'name', 'image')
                ->join('cards_match', 'cards_match.id', '=', 'cards_throw.fk_cards_match')
                ->join('users_match', 'users_match.id', '=', 'cards_match.fk_user_match')
                ->join('cards', 'cards.id', 'fk_card')
                ->where('fk_match', '=',1)
                ->get();
            return response()->json($first_card);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getMessage()], 400);
        }
    }
    // EDITA LA PRIMERA JUGADA DEL JUEGO
    public function firstGame(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'round_match_id'=>'required',
                'characteristic'=>'required'
            ]);
            if($validator->fails()){return response()->json(["message"=>"fields validation fails", "fields"=>$validator->errors()]);}
            $rounds_match = RoundsMatchModel::find($request->round_match_id);
            $rounds_match->charasteristic = $request->characteristic;
            $rounds_match->save();
            return response()->json(['message'=>'característica seleccionada', 'data'=>$rounds_match]);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getMessage()], 400);
        }
    }

    // OBTIENE LAS CARTAS DE LOS USUARIOS
    public function getCards(Request $request, $id){
        try {
            $users = UserMatchModel::where(['fk_match'=>$id])->get();
            $cards = [];
            foreach ($users as $user) {
                $user_card = CardsMatchModel::where('fk_user_match', $user->id)
                    ->orderByRaw('fk_card ASC')
                    ->limit(1)
                    ->get();
                if($user_card) array_push($cards, $user_card[0]);
            }
            return response()->json($cards);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getMessage()], 400);
        }
    }
}
