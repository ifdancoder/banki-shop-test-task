<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Image extends Model
{
    use HasFactory;
    
    public $timestamps = false;
    
    protected $fillable = ['title', 'type'];
    
    public function getPath()
    {
        return 'storage/images/' . $this->id . '/' . $this->title;
    }

    public function getFolder()
    {
        return 'public/images/' . $this->id;
    }

    public function getPathToSave()
    {
        return 'public/images/' . $this->id . '/' . $this->title;
    }

    public function typeModel() {
        return $this->belongsTo(ImageType::class, 'type');
    }

    public function delete()
    {
        Storage::deleteDirectory('public/images/' . $this->id);
        return parent::delete();
    }
}
