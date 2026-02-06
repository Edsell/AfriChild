<?php

namespace App\Support;

use Illuminate\Http\UploadedFile;

class Uploads
{
  public static function store(?UploadedFile $file, string $folder): ?string
  {
    if (!$file) return null;
    $path = $file->store($folder, 'uploads'); // public/uploads/<folder>/*
    return '/uploads/'.$path;
  }
}
