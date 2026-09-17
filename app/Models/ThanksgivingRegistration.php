<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ThanksgivingRegistration extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'display_name',
        'family_members',
        'quarter',
    ];

     // This automatically casts the 'family_members' JSON field to an array when accessed, and back to JSON when saved.   
    protected $casts = [
        'family_members' => 'array', // Casts the JSON field to an array
    ];

    // Relationship back to the User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
