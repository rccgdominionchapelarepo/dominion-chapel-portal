<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChurchMember extends Model
{
    use HasFactory;

    // Allows all fields from the form to be saved to the database without restriction
    protected $guarded = [];

    // Automatically handles data type conversions
    protected $casts = [
        'areas_to_serve' => 'array', // Automatically encodes/decodes the checkbox JSON data
        'dob' => 'date',
    ];

    /**
     * Get the family that this member belongs to.
     */
    public function family()
    {
        return $this->belongsTo(ChurchFamily::class, 'church_family_id');
    }
}