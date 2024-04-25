<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Drivers\Gd\Driver;
use Intervention\Image\ImageManager;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class Ordenador extends Model
{
    use HasFactory;

    protected $table = 'ordenadores';

    public function aula()
    {
        return $this->belongsTo(Aula::class);
    }

    public function cambios()
    {
        return $this->hasMany(Cambio::class);
    }

    public function dispositivos()
    {
        return $this->morphMany(Dispositivo::class, 'colocable');
    }

    private function imagen_url_relativa()
    {
        return '/uploads/' . $this->foto;
    }

    public function getImagenUrlAttribute()
    {
        return Storage::url(mb_substr($this->imagen_url_relativa(), 1));
    }

    public function existeImagen()
    {
        return Storage::disk('public')->exists($this->imagen_url_relativa());
    }

    public function guardar_imagen(UploadedFile $imagen, string $nombre, int $escala, ?ImageManager $manager = null)
    {
        if ($manager === null) {
            $manager = new ImageManager(new Driver());
        }
        Storage::makeDirectory('public/uploads');
        $imagen = $manager->read($imagen);
        $imagen->scaleDown($escala);
        $ruta = Storage::path('public/uploads/' . $nombre);
        $imagen->save($ruta);
    }
}
