<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class Vacancy extends Model
{
    use HasApiTokens, Notifiable;

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    public function mailable(): bool
    {
        if( ($this['status'] == VacancyStatus::statuses['WAITING_FOR_FEEDBACK']) &&
            (strtotime($this['status_last_update']) < strtotime('-7 days'))) {
            return true;
        }
        return false;
    }
}
