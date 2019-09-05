<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class Category extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'categories';
    protected $primaryKey = 'id';
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = true;    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['title', 'description', 'status'];
    
    public function post()
    {
        return $this->hasMany( Post::class, 'category_id', 'id' );
    }

}
