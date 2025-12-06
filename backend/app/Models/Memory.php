<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Memory extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'path',
        'type',
        'taken_at',
        'is_featured',
        'name',
        'description',
        'parent_id',
    ];

    protected $casts = [
        'taken_at' => 'datetime',
        'is_featured' => 'boolean',
    ];

    protected $appends = ['url'];

    public function getUrlAttribute()
    {
        // CHANGEMENT ICI : Utiliser la route web.php au lieu de asset()
        return url('/storage/' . $this->path);
    }

    // Relation pour la galerie
    public function gallery()
    {
        return $this->hasMany(Memory::class, 'parent_id');
    }

    // Relation pour le parent
    public function parent()
    {
        return $this->belongsTo(Memory::class, 'parent_id');
    }
}