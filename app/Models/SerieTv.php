<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SerieTv extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = "SerieTV";
    protected $primaryKey = "idSerieTv";

    protected $fillable = [
        "titolo",
        "durata",
        "stagioni",
        "episodi",
        "regista",
        "categoria",
        "anno",
        "trama",
    ];
}
