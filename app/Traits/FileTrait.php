<?php


namespace App\Traits;

use App\Models\File;

trait FileTrait
{
    public function files()
    {
        return $this->morphMany(File::class, 'fileable')
            ->withPivot(['path', 'type']);
    }

    public function saveFile(File $file)
    {
        $this->files()->sync($file);
    }

    public function getFile($query, $type)
    {
        return $query->whereHas('files', function ($query) use ($type) {
            $query->where('type', $type);
        })->pluck('path');
    }
}
