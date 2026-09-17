<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sermon extends Model
{
    use HasFactory;

    protected $fillable = [
        'type', 'title', 'speaker', 'date', 'image_path', 'document_path', 'content', 'quotes'
    ];

    protected $casts = [
        'quotes' => 'array',
        'date' => 'date',
    ];
}