<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model {

    // attributes that can be massAssigned
	protected $fillable = [
        'title',
        'body',
        'published_at'
    ];

}
