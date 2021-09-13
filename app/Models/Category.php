<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;

class Category extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "image","name",
    ];

    // public function setCreatedatAttribute( $value ) {
    //     $this->attributes['created_at'] = (new Carbon($value))->format('d/m/y');
    //   }
    public function getCreatedatAttribute( $value ) {
             return date('d-M-Y',strtotime($value));
          }
    public function product()
    {
        return $this->hasMany(product::class);
    }


}
