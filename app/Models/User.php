<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'age',
        'points',
        'address',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'name' => 'string',
        'points' => 'integer',
        'age' => 'integer',
        'address' => 'string',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * {@inheritdoc}
     */
    public $sortable = [
        'order_column_name' => 'points',
    ];

    public function toArray()
    {
        return [
            'id'    => $this->id,
            'name'  => $this->name,
            'age'   => $this->age,
            'points' => $this->points,
            'address'   => $this->address,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at
        ];
    }
}
