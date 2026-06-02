<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property int $rarity
 * @property int $weight
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GachaItem newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GachaItem newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GachaItem query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GachaItem whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GachaItem whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GachaItem whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GachaItem whereRarity($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GachaItem whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|GachaItem whereWeight($value)
 * @mixin \Eloquent
 */
class GachaItem extends Model
{
    protected $fillable = [
        'name',
        'rarity',
        'weight',
    ];
}
