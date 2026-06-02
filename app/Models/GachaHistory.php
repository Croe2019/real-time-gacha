<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property int $user_id
 * @property int $gacha_item_id
 * @property int $rarity
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GachaHistory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GachaHistory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GachaHistory query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GachaHistory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GachaHistory whereGachaItemId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GachaHistory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GachaHistory whereRarity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GachaHistory whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GachaHistory whereUserId($value)
 * @mixin \Eloquent
 */
class GachaHistory extends Model
{
    protected $table = 'gacha_histories';
    protected $fillable = ['user_id', 'gacha_item_id', 'rarity'];
}
