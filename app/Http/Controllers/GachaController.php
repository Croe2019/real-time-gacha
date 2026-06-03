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

    public function index()
    {
        return view('gacha.index'); 
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

        // GachaApiController - APIレスポンスを修正
        $result = [
            'id' => $history->id,
            'item_name' => $item->name,
            'rarity' => $item->rarity,
            'created_at' => $history->created_at,
        ];

        //return view('gacha.index', ['items' => $items]);
    }
}
