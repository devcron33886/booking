<?php

namespace App\Models;

use DateTimeInterface;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;


class Booking extends Model
{
    use SoftDeletes;
    use HasFactory;

    public const STATUS_SELECT = [
        '0' => 'Pending',
        '1' => 'Confirmed',
        '2' => 'Cancelled',
    ];

    public $table = 'bookings';

    protected $dates = [
        'meeting_time',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected $fillable = [
        'service_id',
        'staff_id',
        'meeting_time',
        'name',
        'email',
        'address',
        'phone_number',
        'notes',
        'status',
        'privacy',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class, 'service_id');
    }

    public function staff(): BelongsTo
    {
        return $this->belongsTo(User::class, 'staff_id');
    }

    /**
     * Scope a query to only include popular users.
     *
     * @param Builder $query
     * @return Builder
     */
    public function scopePending(Builder $query): Builder
    {
        return $query->where('status', '=', 0);
    }

    public function scopeConfirmed(Builder $query): Builder
    {
        return $query->where('status', '=', 1);
    }

    public function scopeCancelled(Builder $query):Builder
    {
        return $query->where('status', '=', 2);
    }

    public function getMeetingTimeAttribute($value): ?string
    {
        return $value ? Carbon::createFromFormat('Y-m-d H:i:s', $value)->format(config('panel.date_format') . ' ' . config('panel.time_format')) : null;
    }

    public function setMeetingTimeAttribute($value)
    {
        $this->attributes['meeting_time'] = $value ? Carbon::createFromFormat(config('panel.date_format') . ' ' . config('panel.time_format'), $value)->format('Y-m-d H:i:s') : null;
    }

    protected function serializeDate(DateTimeInterface $date): string
    {
        return $date->format('Y-m-d H:i:s');
    }
}
