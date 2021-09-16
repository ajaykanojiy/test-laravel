<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "image","name","description","price",
    ];

    public function getCreatedatAttribute( $value ) {
        return date('d-M-Y',strtotime($value));
     }

    //  public function category()
    // {
    //     return $this->belongsTo(Category::class);
    // }


    public function stock()
    {
        return $this->hasOne(Stocks::class);
    }

}
