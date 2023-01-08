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
 * App\Models\Item
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $price
 * @property int|null $quantity
 * @property int|null $discount
 * @property int|null $kgd_code
 * @property int $sale_id
 * @property array|null $compare_field
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|Item[] $items
 * @property-read int|null $items_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Payment[] $payments
 * @property-read int|null $payments_count
 * @method static \Illuminate\Database\Eloquent\Builder|Item newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Item query()
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCompareField($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereDiscount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereKgdCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereQuantity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Item whereUpdatedAt($value)
 */
	class IdeHelperItem {}
}

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
 * @property string|null $tis_token
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Sale[] $sales
 * @property-read int|null $sales_count
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
 * @method static \Illuminate\Database\Eloquent\Builder|MoySkladConfig whereTisToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|MoySkladConfig whereUpdatedAt($value)
 */
	class IdeHelperMoySkladConfig {}
}

namespace App\Models{
/**
 * App\Models\Payment
 *
 * @property int $id
 * @property int|null $method
 * @property string|null $sum
 * @property int $sale_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Sale|null $sale
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment query()
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereSaleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereSum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Payment whereUpdatedAt($value)
 */
	class IdeHelperPayment {}
}

namespace App\Models{
/**
 * App\Models\Sale
 *
 * @property int $id
 * @property string $price
 * @property int $type
 * @property int $moy_sklad_config_id
 * @property array|null $fiscal_receipt
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string $order_id
 * @property-read \App\Models\Item|null $items
 * @property-read \App\Models\Item|null $moySkladConfig
 * @method static \Illuminate\Database\Eloquent\Builder|Sale newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale query()
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereFiscalReceipt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereMoySkladConfigId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale wherePrice($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Sale whereUpdatedAt($value)
 */
	class IdeHelperSale {}
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

