<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    public $timestamps = true;
    protected $fillable = [
        "image","description","approved_by_Admin","created_at",
    ];

    public function getCreatedatAttribute( $value ) {
        return date('d-M-Y',strtotime($value));
     }

}
