<?php

namespace App\Services;
use App\Models\GachaItem;
use Illuminate\Support\Collection;

class GachaService
{
    public function draw()
    {
        $items = GachaItem::all();
        $totalWeight = $items->sum('weight');
        $results = [];

        if ($items->isEmpty() || $totalWeight <= 0) {
            return $results;
        }

        // 10連ガチャのループ
        for ($i = 0; $i < 10; $i++) {
            $results[] = $this->drawOne($items, $totalWeight);
        }

        return $results;
    }

    private function drawOne(Collection $items, int $totalWeight): GachaItem
    {
        $random = rand(1, $totalWeight);
        $currentWeight = 0;

        foreach ($items as $item) {
            $currentWeight += $item->weight;
            if ($random <= $currentWeight) {
                return $item;
            }
        }


        return $items->last();
    }
}
