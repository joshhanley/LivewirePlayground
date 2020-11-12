<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function template()
    {
        $this->belongsTo(Template::class);
    }

    public function categories()
    {
        $this->hasMany(Category::class);
    }
}
