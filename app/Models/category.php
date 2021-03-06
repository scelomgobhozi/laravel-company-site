<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class category extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'categories';
    protected $fillable  = ['user_id', 'category_name'];

//    for elequent orm
    public function user(){
       return $this->hasOne(User::class, 'id','user_id');
    }




}
