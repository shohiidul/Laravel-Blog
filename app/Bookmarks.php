<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bookmarks extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'bookmarks';
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
    protected $fillable = ['title', 'short_desc', 'details', 'bookmark_url', 'url_unique_key'];
}

