<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RequestBecomeSeller extends Model
{
    protected $table = 'request_become_seller';

    protected $fillable = [
        'user_name',
        'email',
        'contact_number',
        'description',
    ];
}
