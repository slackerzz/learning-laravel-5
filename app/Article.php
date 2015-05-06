<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Article
 *
 * @property integer $id 
 * @property string $title 
 * @property string $body 
 * @property \Carbon\Carbon $created_at 
 * @property \Carbon\Carbon $updated_at 
 * @property \Carbon\Carbon $published_at 
 * @property string $excerpt 
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereTitle($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereBody($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereCreatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article wherePublishedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Article whereExcerpt($value)
 * @method static \App\Article published()
 * @method static \App\Article unpublished()
 */
class Article extends Model {

    // attributes that can be massAssigned
	protected $fillable = [
        'title',
        'body',
        'published_at'
  ];

  protected $dates = ['published_at'];
  public function scopePublished($query)
  {
    $query->where('published_at', '<=', Carbon::now());
  }

  public function scopeUnpublished($query)
  {
    $query->where('published_at', '>', Carbon::now());
  }

  // setNameAttribute -> convention used by laravel for attribute mutator
  public function setPublishedAtAttribute($date)
  {
    $this->attributes['published_at'] = Carbon::parse($date);
  }

}
