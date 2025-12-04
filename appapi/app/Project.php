<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'projects';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'project_number',
        'project_name',
        'project_description',
        'is_active',
    ];

    /**
     * Worksheets in this project.
     */
    public function worksheets()
    {
        return $this->hasMany('App\Worksheet', 'project_id');
    }
}
