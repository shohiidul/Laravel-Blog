<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Post;

class Tag extends Model
{

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tags';
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

    public function posts()
    {
        return $this->belongsToMany(Post::class, 'post_tag', 'tag_id', 'post_id');
    }    

}
