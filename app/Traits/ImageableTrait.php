<?php

namespace App\Traits;

use App\Models\Image;
use App\Models\ImageType;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

trait ImageableTrait
{
    
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    public function storeImage($file, $type)
    {
        $title = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $transliteratedTitle = Str::slug($title);
        $lowercaseTitle = mb_strtolower($transliteratedTitle, 'UTF-8');

        $title = $lowercaseTitle . '.' . $file->extension();

        $found = Image::where('type', $type)->where('imageable_id', $this->id);
        if ($found->exists()) {
            $image = $found->first();
            $image->delete();
        }
        $image = new Image();
        $image->type = $type;
        $image->title = $title;
        $this->images()->save($image);
        Storage::putFileAs($image->getFolder(), $file, $image->title, ['visibility' => 'public', 'permissions' => '0777']);
        chgrp(Storage::path($image->getFolder()), 'www-data');
        chgrp(Storage::path($image->getPathToSave()), 'www-data');
        chmod(Storage::path($image->getFolder()), 0755);
        chmod(Storage::path($image->getPathToSave()), 0644);
    }

    public function imageByTypeId($type)
    {
        return $this->morphOne(Image::class, 'imageable')->where('type', $type);
    }

    public function imageByType($type)
    {
        $typeId = ImageType::where('title', $type)->first()->id;
        return $this->imageByTypeId($typeId);
    }

    public function delete() {
        foreach($this->images as $image) {
            $image->delete();
        }
        parent::delete();

        return 1;
    }

    public function deleteImage($type) {
        $this->imageByType($type)->delete();
        return 1;
    }
}