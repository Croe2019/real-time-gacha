<?php

// @formatter:off
// phpcs:ignoreFile
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * @property int $id
 * @property string $name 名称
 * @property string $password パスワード
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\AdminFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|Admin whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class Admin extends \Eloquent {}
}

namespace App\Models{
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
	class GachaHistory extends \Eloquent {}
}

namespace App\Models{
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
	class GachaItem extends \Eloquent {}
}

namespace App\Models{
/**
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User query()
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder<static>|User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class User extends \Eloquent {}
}

