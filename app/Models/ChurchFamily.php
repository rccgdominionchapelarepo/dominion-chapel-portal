<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChurchFamily extends Model
{
    use HasFactory;

    // Allows all fields from the form to be saved to the database without restriction
    protected $guarded = [];

    /**
     * Get the individual members associated with this family.
     */
    public function members()
    {
        return $this->hasMany(ChurchMember::class);
    }
}