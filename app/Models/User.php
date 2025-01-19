<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\Role;
use Carbon\Carbon;
use Filament\Models\Contracts\FilamentUser;
use Filament\Panel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @poperty int $id
 * @property string $name
 * @property string $email
 * @property string $password
 * @property bool $active
 * @property Role $role
 * @property Carbon $email_verified_at
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property-read bool $isAdmin
 */
class User extends Authenticatable implements FilamentUser
{
    use HasApiTokens;
    use HasFactory;
    use Notifiable;

    protected $fillable = [
        "name",
        "email",
        "password",
        "role",
        "active",
    ];
    protected $hidden = [
        "password",
        "remember_token",
    ];
    protected $casts = [
        "active" => "boolean",
        "email_verified_at" => "datetime",
        "password" => "hashed",
        "role" => Role::class,
    ];

    #[\Override]
    public function canAccessPanel(Panel $panel): bool
    {
        return $this->active && ($this->isAdmin());
    }

    public function isAdmin(): bool
    {
        return $this->role === Role::Admin;
    }
}
