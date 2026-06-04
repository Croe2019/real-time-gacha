<?php

namespace App\Http\Controllers;

use App\Events\GachaPulled;
use App\Models\GachaHistory;
use Illuminate\Http\Request;
use App\Models\GachaItem;
use App\Services\GachaService;

class GachaController extends Controller
{


    public function index()
    {
        return view('gacha.index');
    }

    // ここから再開 TODO
    public function draw(GachaService $gachaService)
    {
        $results = collect($gachaService->draw())->map(function (GachaItem $item) {
            $history = GachaHistory::create([
                'user_id' => auth()->id(),
                'gacha_item_id' => $item->id,
                'rarity' => $item->rarity,
            ]);
            return [
                'id' => $history->id,
                'item_name' => $item->name,
                'rarity' => $item->rarity,
                'created_at' => $history->created_at,
            ];
        })->values();

        GachaPulled::dispatch($results->all(), auth()->id());

        return response()->json([
            'status' => 'success',
            'message' => 'ガチャを実行しました',
            'resutls' => $results,
        ]);
    }
}
