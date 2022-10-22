<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    const STATUS = [
        'published' => 'Published',
        'un-published' => 'Un-Published',
        'draft' => 'Draft'
    ];

    /**
     * Model image url
     * @return mixed
     */
    public function mainImageUrl()
    {
        return $this->image_name
            ? Storage::disk('projects')->url($this->image_name)
            : url('/svg/placeholder.svg');
    }
}
