<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;
class Students extends Authenticatable
{
    use HasUuids,HasApiTokens, HasFactory, Notifiable, HasRoles;
    public $guard_name = 'student';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'name',
        'department',
        'course',
        'email',
        'password',
        'age',
        'bday',
        'linkedIn',
        'employment_status',
        'current_company',
        'position',
        'employment_duration',
        'employment_date',
        'contact_number_mobile',
        'contact_number_tel',
        'current_address',
        'approved',
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
        'email_verified_at' => 'datetime',
    ];
      /**
     * Get the surveys for the student
     */
    public function surveys()
    {
        return $this->hasMany(Survey::class, 'name', 'name');
    }

    /**
     * Check if student has taken a specific survey
     */
    public function hasTakenSurvey($questionnaireId)
    {
        return $this->surveys()
                    ->where('questionnaire_id', $questionnaireId)
                    ->exists();
    }
}
