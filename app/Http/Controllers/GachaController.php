<?php

namespace App\Http\Controllers;

use App\Models\GachaHistory;
use Illuminate\Http\Request;
use App\Services\GachaService;
use App\Events\GachaPulled;

class GachaController extends Controller
{
    public function __invoke(GachaService $gachaService)
    {
        
    }

    // ここから再開 TODO
    public function draw(GachaService $gachaService)
    {
        $items = $gachaService->draw();

        foreach($items as $item) {
            GachaHistory::create([
                'user_id' => auth()->id(),
                'gacha_item_id' => $item->id,
                'rarity' => $item->rarity,
            ]);
        }

        event(new GachaPulled($items, auth()->id()));

        // return response()->json([
        //     'status' => 'success',
        //     'items' => $items,
        //     'message' => 'ガチャ実行中'
        // ]);

        return view('gacha.draw', ['items' => $items]);
    }
}
