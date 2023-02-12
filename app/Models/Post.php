<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Like;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    protected $fillable = [
        'title', 'description', 'image', 'created_by', 'schedule', 'status'
    ];

    public function user(){
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function likes(){
        return $this->hasMany(Like::class, 'product_id', 'id');
    }
}
