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
 * App\Models\User
 *
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $api_token
 * @property string $expires_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Message[] $jobs
 * @property-read int|null $jobs_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereExpiresToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Admin
 *
 * @method static Builder|User newModelQuery()
 * @method static Builder|User newQuery()
 * @method static Builder|User query()
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property string|null $api_token
 * @property string $expires_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereApiToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereExpiresToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Admin whereUpdatedAt($value)
 */
	class Admin extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Message
 *
 * @property int $id
 * @property string $title
 * @property string $description
 * @property string $status
 * @property mixed|null $workplace
 * @property float|null $salary
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static Builder|\App\Models\Message newModelQuery()
 * @method static Builder|\App\Models\Message newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Message onlyTrashed()
 * @method static Builder|\App\Models\Message query()
 * @method static bool|null restore()
 * @method static Builder|\App\Models\Message whereCreatedAt($value)
 * @method static Builder|\App\Models\Message orderBy($value)
 * @method static Builder|\App\Models\Message whereDeletedAt($value)
 * @method static Builder|\App\Models\Message whereDescription($value)
 * @method static Builder|\App\Models\Message whereId($value)
 * @method static Builder|\App\Models\Message whereRaw($value)
 * @method static Builder|\App\Models\Message whereJsonContains($json, $value)
 * @method static Builder|\App\Models\Message whereSalary($value)
 * @method static Builder|\App\Models\Message whereStatus($value)
 * @method static Builder|\App\Models\Message whereTitle($value)
 * @method static Builder|\App\Models\Message whereUpdatedAt($value)
 * @method static Builder|\App\Models\Message whereWorkplace($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Message withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Message withoutTrashed()
 */
	class Job extends \Eloquent {}
}

