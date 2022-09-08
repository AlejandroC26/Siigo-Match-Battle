<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// MODELS
use App\Models\UserMatchModel;
use App\Models\CardsThrowModel;
use App\Models\CardsMatchModel;
use App\Models\RoundsMatchModel;

class RoundController extends Controller
{
    public function getThrowCards(Request $request, $id){
        $cards_of_round = CardsThrowModel::where('fk_round_match', $id)
            ->join('cards_match', 'cards_match.id', 'fk_cards_match')
            ->join('cards', 'cards.id', 'fk_card')
            ->get();
        return response()->json($cards_of_round);
    }
    public function throwCard(Request $request, $id_match){
        try {
            $users = UserMatchModel::where(['fk_match'=>$id_match])->get();
            foreach ($users as $user) {
                $user_card = CardsMatchModel::where('fk_user_match', $user->id)
                    ->orderByRaw('fk_card ASC')
                    ->limit(1)
                    ->get();
                // VALIDA SI EL USUARIO LANZÓ CARTA EN ESE TURNO
                $round_validation = CardsThrowModel::where('fk_match', $id_match)
                    ->where('fk_user_match', $user->id)
                    ->join('rounds_match', 'rounds_match.id', 'fk_round_match')
                    ->join('users_match', 'users_match.id', 'fk_user_match')
                    ->get();
                $get_round = RoundsMatchModel::select('rounds_match.id')
                    ->where('fk_match', $id_match)
                    ->join('users_match', 'users_match.id', 'fk_user_match')
                    ->orderByRaw('rounds_match.id DESC')
                    ->limit(1)
                    ->get();
                // SI NO HA LANZADO CARTA JUEGA
                if(count($round_validation) == 0) {
                    CardsThrowModel::create([
                        "fk_cards_match"=>$user_card[0]->id,
                        "fk_round_match"=>$get_round[0]->id
                    ]);
                }
            }
            return response()->json(['message'=>'cartas lanzadas exitosamente']);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getMessage()], 400);
        }
    }
    public function compareCards(Request $request, $id) {
        $charasteristic = CardsThrowModel::where('fk_round_match', $id)
            ->join('rounds_match', 'rounds_match.id', 'fk_round_match')
            ->limit(1)
            ->get();
        $winner_card = CardsThrowModel::where('fk_round_match', $id)
            ->join('cards_match', 'cards_match.id', 'fk_cards_match')
            ->join('cards', 'cards.id', 'fk_card')   
            ->join('users', 'users.id', 'fk_user_match')
            ->orderByRaw('cards.'.$charasteristic[0]->charasteristic.' DESC')
            ->limit(1)
            ->get();
        $round = RoundsMatchModel::find($winner_card[0]->fk_round_match);
        $round->fk_user_win = $winner_card[0]->fk_user_match;
        $round->save();
        CardsThrowModel::where('fk_round_match', $id)
            ->join('cards_match', 'cards_match.id', 'fk_cards_match')
            ->update(['fk_user_match'=>$winner_card[0]->fk_user_match]);
        // SELECCIONA LA CARTA QUE INICIA
        $new_round_cart = CardsMatchModel::where('fk_user_match', $winner_card[0]->fk_user_match)
            ->orderByRaw('fk_card ASC')
            ->limit(1)
            ->get();
        // CREA LA SIGUIENTE RONDA
        $round_match = RoundsMatchModel::create([
            'fk_user_match'=>$winner_card[0]->fk_user_match,
        ]);
        // LANZA LA SIGUIENTE CARTA
        $cards_throw = CardsThrowModel::create([
            "fk_round_match"=>$round_match->id,
            "fk_cards_match"=>$new_round_cart[0]->id,
        ]);
        
        return response()->json(['status'=>'continue', 'data'=>$winner_card]);  
    }
}
