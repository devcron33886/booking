<?php

namespace App\Models;

use Cviebrock\EloquentSluggable\Sluggable;
use DateTimeInterface;
use App\Traits\MultiTenantModelTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Service extends Model
{
    use SoftDeletes;
    use MultiTenantModelTrait;
    use HasFactory;
    use Sluggable;

    public const CURRENCY_SELECT = [
        '1' => 'RWF',
        '2' => 'USD',
    ];

    public const STATUS_SELECT = [
        '0' => 'Face to face service',
        '1' => 'Online Meeting',
    ];

    public $table = 'services';

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'service_name',
        'slug',
        'duration',
        'price',
        'currency',
        'status',
        'service_description',
        'created_at',
        'updated_at',
        'deleted_at',
        'team_id',
    ];

    public function team() :BelongsTo
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }


    public function sluggable(): array
    {
        return [
          'slug'=>[
              'source'=>'service_name'
          ]
        ];
    }
}
