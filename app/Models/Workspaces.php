<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Workspaces extends Model
{
    protected $table = 'workspaces';
    protected $primaryKey = 'ws_id';

    protected $fillable = [
        'ws_name',
        'isDefault',
        'isDeleted'
    ];

    protected function createdAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('F j, Y g:i A')
        );
    }

    protected function updatedAt(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => Carbon::parse($value)->format('F j, Y g:i A')
        );
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->ws_id)) {
                $model->ws_id = (string) \Illuminate\Support\Str::uuid();
            }
        });
    }
}
