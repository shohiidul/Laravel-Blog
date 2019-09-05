<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use App\Category;
use App\Tag;
use App\User;

class Post extends Model
{
    use Sluggable;
    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'name' => [
                'source' => 'title'
            ]
        ];
    }
        
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';
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
    protected $fillable = ['title', 'name', 'description', 'status', 'created_by', 'category_id'];

    public function category()
    {
        return $this->belongsTo( Category::class, 'category_id', 'id' );
    }

    public function tags()
    {        
        return $this->belongsToMany( Tag::class, 'post_tag', 'post_id', 'tag_id' );
    }

    public function user()
    {        
        return $this->belongsTo( User::class, 'created_by', 'id' );
    }

}
