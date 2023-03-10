<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Meal extends Model
{
    use HasFactory,Notifiable;

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'meals';

    /**

     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'check_meal',
        'meal_date',
        'meal_time',
    ];




}
