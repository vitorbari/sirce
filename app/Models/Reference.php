<?php namespace Sirce\Models;

use Illuminate\Database\Eloquent\Model;
use Sirce\Models\Traits\ImageableTrait;

class Reference extends Model
{

	use ImageableTrait;

    protected $fillable = [
        'title',
        'markdown',
        'published_at'
    ];

    protected $hidden = ['created_at', 'updated_at'];

    public function getDates()
    {
        return ['published_at', 'created_at', 'updated_at'];
    }

	public function user()
    {
        return $this->belongsTo('Sirce\Models\User');
    }

    public function component()
    {
        return $this->belongsTo('Sirce\Models\Component');
    }

    public function language()
    {
        return $this->belongsTo('Sirce\Models\Language');
    }

    /**
     * Reference __belongs_to_many__ User Favorites
     *
     * @return mixed
     */
    public function favorites()
    {
        return $this->belongsToMany('Sirce\Models\User', 'user_favorites')->withTimestamps();
    }

    /**
     * Reference __belongs_to_many__ Boards
     *
     * @return mixed
     */
    public function boards()
    {
        return $this->belongsToMany('Sirce\Models\Board', 'reference_boards');
    }
}
