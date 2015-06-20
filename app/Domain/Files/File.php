<?php namespace App\Domain\Files;

use Illuminate\Database\Eloquent\Model;

class File extends Model {

    protected $table = 'files';
    protected $fillable = ['user_id', 'filename', 'extension', 'mime', 'size'];
    protected $hidden = [];

    /**
     * Relationships
     */
    public function user()
    {
        return $this->belongsTo('App\Domain\Profiles\User');
    }

}
