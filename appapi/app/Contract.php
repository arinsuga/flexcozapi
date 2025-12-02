<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'contracts';

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
        'contract_code',
        'contract_name',
        'contract_description',
        'is_active',
    ];

    /**
     * Worksheets in this contract.
     */
    public function worksheets()
    {
        return $this->hasMany('App\Worksheet', 'contract_id');
    }
}
