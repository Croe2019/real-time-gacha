<?php

namespace App\Http\Controllers;

use App\Events\GachaPulled;
use App\Models\GachaHistory;

use App\Services\GachaService;

class GachaController extends Controller
{
    public function index()
    {
        return view('gacha.index');
    }

    // ここから再開 TODO
    public function draw()
    {
        $gachaService = new GachaService();
        $items = $gachaService->draw();

        foreach($items as $item) {
            GachaHistory::create([
                'user_id' => auth()->id(),
                'gacha_item_id' => $item->id,
                'rarity' => $item->rarity,
            ]);

            event(new GachaPulled(auth()->id(), $item->name, $item->rarity));
        }

        return response()->json([
            'success' => true,
            'results' => $items
        ]);
    }
}
