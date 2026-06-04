<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\GachaHistory;
use App\Models\GachaItem;
use App\Events\GachaPulled;
use Illuminate\Http\Request;
use App\Services\GachaService;

class GachaApiController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = GachaItem::all();
        return response()->json($items);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, GachaService $gachaService)
    {
        $item = $gachaService->draw();
        $history = GachaHistory::create([
            'user_id' => auth()->id(),
            'gacha_item_id' => $item->id,
            'rarity' => $item->rarity,
        ]);

        $result = [
            'id' => $history->id,
            'item_name' => $item->name,
            'rarity' => $item->rarity,
            'created_at' => $history->created_at,

        ];

        // イベントをディスパッチしてReverbでブロードキャスト
        GachaPulled::dispatch($result, auth()->id());

        return response()->json([
            'status' => 'success',
            'message' => 'ガチャを実行しました',
            'result' => $result
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
