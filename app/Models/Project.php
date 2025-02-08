<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;

class Project extends Model
{
    protected $table = 'projects';
    protected $primaryKey = 'proj_id';

    protected $fillable = [
        'project_name',
        'project_description',
        'project_logo'
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
            if (empty($model->proj_id)) {
                $model->proj_id = (string) 'proj_' . \Illuminate\Support\Str::uuid();
            }
        });
    }
}
