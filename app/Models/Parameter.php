<?php

namespace App\Models;

use App\Traits\ImageableTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parameter extends Model
{
    use HasFactory;
    use ImageableTrait;

    public $timestamps = false;
    
    protected $fillable = ['title', 'type'];

    public function icon() {
        return $this->imageByType(1);
    }

    public function iconGray() {
        return $this->imageByType(2);
    }

    public function type()
    {
        return $this->belongsTo(ParameterType::class);
    }
}
