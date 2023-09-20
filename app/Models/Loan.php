<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Morilog\Jalali\Jalalian;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'amount',
        'status',
        'user_id',
        'accepted_at',
        'rejected_at',
        'approver_id',
    ];

    protected $appends = [
        'status_fa',
        'accepted_at_fa',
        'rejected_at_fa',
        'action_time_fa',
    ];

    public function getStatusFaAttribute()
    {
        return match ($this->status) {
            'accepted' => 'تایید شده',
            'rejected' => 'رد شده',
            default => 'در انتظار بررسی',
        };
    }

    public function getActionTimeFaAttribute()
    {
        return match ($this->status) {
            'accepted' => $this->accepted_at_fa,
            'rejected' => $this->rejected_at_fa,
            default => '-',
        };
    }

    public function getAcceptedAtFaAttribute()
    {
        return $this->accepted_at ? Jalalian::forge($this->accepted_at)->format('%A, %d %B %Y') : '';
    }

    public function getRejectedAtFaAttribute()
    {
        return $this->rejected_at ? Jalalian::forge($this->rejected_at)->format('%A, %d %B %Y') : '';
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function approver()
    {
        return $this->belongsTo(User::class, 'approver_id', 'id');
    }
}
