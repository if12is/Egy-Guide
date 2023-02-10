<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bio extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'job', 'dob', 'contact_number', 'extra_email', 'country', 'city'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
