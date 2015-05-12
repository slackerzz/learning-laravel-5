<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

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
 * @method static Builder|\App\Article whereId($value)
 * @method static Builder|\App\Article whereTitle($value)
 * @method static Builder|\App\Article whereBody($value)
 * @method static Builder|\App\Article whereCreatedAt($value)
 * @method static Builder|\App\Article whereUpdatedAt($value)
 * @method static Builder|\App\Article wherePublishedAt($value)
 * @method static Builder|\App\Article whereExcerpt($value)
 * @method static \App\Article published()
 * @method static \App\Article unpublished()
 */
class Article extends Model {

    /*
     * Fillable fields for an Article.
     *
     * @var array
     */
	protected $fillable = [
        'title',
        'body',
        'published_at',
    ];

    /*
     * Additional field to treat as Carbon istances;
     *
     * @var array
     */
    protected $dates = ['published_at'];

    /**
     * Scope queries to articles that have been published.
     *
     * @param $query
     */
    public function scopePublished($query)
    {
        $query->where('published_at', '<=', Carbon::now());
    }

    /**
     * Scope queries to articles that have not been published yet.
     *
     * @param $query
     */
    public function scopeUnpublished($query)
    {
        $query->where('published_at', '>', Carbon::now());
    }

    /**
     * Set the published_at attribute
     * ( setNameAttribute -> convention used by laravel for attribute mutator )
     *
     * @param $date
     */
    public function setPublishedAtAttribute($date)
    {
        $this->attributes['published_at'] = Carbon::parse($date);
    }

    /**
     * Get the published_at attribute
     * @param $date
     * @return string
     */
    public function getPublishedAtAttribute($date)
    {
        return Carbon::parse($date)->format('Y-m-d');
    }
    /**
     * An article is owned by a user.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

    /**
     * Get the tags associated with the given article.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany('App\Tag')->withTimestamps();
    }

    /**
     * Get a list of tags id associated with the current article.
     *
     * @return array
     */
    public function getTagListAttribute()
    {
        return $this->tags->lists('id');
    }
}
