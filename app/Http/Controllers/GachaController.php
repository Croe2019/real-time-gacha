<?php

namespace App\Http\Controllers;

use App\Events\GachaPulled;
use App\Models\GachaHistory;
use App\Events\DashboardUpdated;
use App\Services\GachaService;
use Illuminate\Support\Facades\Redis;


class GachaController extends Controller
{
    public function index()
    {
        return view('gacha.index');
    }

    // ここから再開 TODO
    public function draw(GachaService $gachaService)
    {
        $userId = auth()->id();

        $start = microtime(true);

        $items = $gachaService->draw();

        $responseTime =
            round(
                (microtime(true) - $start) * 1000,
                2
            );

        $rps = Redis::get('current_rps') ?? 0;

        foreach ($items as $item) {

            GachaHistory::create([
                'user_id' => $userId,
                'gacha_item_id' => $item->id,
                'rarity' => $item->rarity,
            ]);

            event(
                new GachaPulled(
                    $userId,
                    $item->name,
                    $item->rarity
                )
            );

            if ($item->rarity === 20) {
                cache()->increment('ssr_count');
            }
        }

        cache()->put('response_time', $responseTime);


        return response()->json([
            'success' => true,
            'results' => $items
        ]);
    }
}
