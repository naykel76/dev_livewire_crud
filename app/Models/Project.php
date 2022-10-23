<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Naykel\Gotime\Casts\CurrencyCast;
use Naykel\Gotime\Casts\DateCast;

class Project extends Model
{
    use HasFactory;

    protected $guarded = [];

    const STATUS = [
        'published' => 'Published',
        'draft' => 'Draft'
    ];

    protected $casts = [
        'project_value' => CurrencyCast::class,
        // 'published_at' => DateCast::class
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
