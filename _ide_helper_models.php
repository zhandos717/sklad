<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\MoySkladConfig
 *
 * @property int $id
 * @property string|null $app_id
 * @property string|null $account_id
 * @property string|null $info_message
 * @property string|null $store
 * @property string|null $access_token
 * @property int|null $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|MoySkladConfig newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MoySkladConfig newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|MoySkladConfig query()
 * @method static \Illuminate\Database\Eloquent\Builder|MoySkladConfig whereAccessToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MoySkladConfig whereAccountId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MoySkladConfig whereAppId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MoySkladConfig whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MoySkladConfig whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MoySkladConfig whereInfoMessage($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MoySkladConfig whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MoySkladConfig whereStore($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MoySkladConfig whereUpdatedAt($value)
 * @mixin \Eloquent
 */
	class IdeHelperMoySkladConfig {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\Laravel\Sanctum\PersonalAccessToken[] $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class IdeHelperUser {}
}

