<?php
namespace App;
use Illuminate\Database\Eloquent\Model;

class Counterforth extends Model
{

    protected $table = 'counterforths';
    protected $fillable = [
        'number', 'position_number', 'subscription_number',
        'subscriber', 'address', 'counter_number',
        'previous_read','current_read', 'cups_consumption', 
        'shekels_consumption', 'counter_status', 'notes'
    ];
}
