<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'role',
        'password',
        'last_name',
        'position',
        'amount',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'password' => 'hashed',
    ];

    protected $appends = [
        'is_admin',
        'is_employer',
        'permission_id_list',
        'full_name',
    ];

    public function getIsAdminAttribute()
    {
        return $this->role == 'admin';
    }

    public function getIsEmployerAttribute()
    {
        return $this->role == 'employer';
    }

    public function getFullNameAttribute()
    {
        $name = $this->name;
        $lastName = $this->last_name;
        return "$name $lastName";
    }

    public function getPermissionIdListAttribute()
    {
        return $this->permissions()->pluck('permissions.id')->toArray();
    }

    public function hasAllPermissions(array $permissions)
    {
        $hasAll = true;
        foreach ($permissions as $permission) {
            if (!$this->hasPermission($permission)) {
                $hasAll = false;
                break;
            }
        }
        return $hasAll;
    }

    public function hasAnyPermissions(array $permissions)
    {
        $hasAll = false;
        foreach ($permissions as $permission) {
            if ($this->hasPermission($permission)) {
                $hasAll = true;
                break;
            }
        }
        return $hasAll;
    }

    public function hasPermission(string $permission)
    {
        return in_array($permission, $this->permissions()->pluck('permission')->toArray());
    }

    public function permissions()
    {
        return $this->belongsToMany(Permission::class, 'permission_user');
    }

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }
}
