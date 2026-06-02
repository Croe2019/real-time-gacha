<?php

namespace App\Services;
use App\Models\GachaItem;

class GachaService
{
    public function draw()
    {
        $items = GachaItem::all();
        // $totalWeight = $items->sum('weight');
        // $randomWeight = rand(1, $totalWeight);

        // foreach ($items as $item) {
        //     $randomWeight -= $item->weight;
        //     if ($randomWeight <= 0) {
        //         return $item;
        //     }
        // }

        // return null;

        $totalWeight = array_sum(array_column($items->toArray(), 'weight'));
        $results = [];

        // 10連ガチャのループ
        for($i = 0; $i < 10; $i++){
            $random = rand(1, $totalWeight);
            $currentWeight = 0;

            foreach($items as $item) {
                $currentWeight += $item->weight;
                if($random <= $currentWeight) {
                    $results[] = $item;
                    break;
                }
            }
        }
        return $results;
    }
}
