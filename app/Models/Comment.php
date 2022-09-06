<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'comment' , 'tiding_id', 'reader_id'
    ];

    public function reader()
    {
        return $this->belongsTo(Reader::class);
    }
}
