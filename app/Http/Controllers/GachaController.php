<?php

namespace App\Http\Controllers;

use App\Models\GachaHistory;
use Illuminate\Http\Request;
use App\Services\GachaService;

class GachaController extends Controller
{
    public function __invoke(GachaService $gachaService)
    {
        // $item = $gachaService->draw();
        // GachaHistory::create([
        //     'user_id' => auth()->id(),
        //     'gacha_item_id' => $item->id,
        //     'rarity' => $item->rarity,
        // ]);

        // return response()->json();
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

        return response()->json([
            'status' => 'success',
            'items' => $items,
        ]);
    }
}
