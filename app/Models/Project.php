<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    const STATUS = [
        'published' => 'Published',
        'un-published' => 'Un-Published',
        'draft' => 'Draft'
    ];
}
