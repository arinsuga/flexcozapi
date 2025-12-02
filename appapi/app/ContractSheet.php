<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ContractSheet extends Model
{
    /**
     * The table associated with the model.
     */
    protected $table = 'contractsheets';

    /**
     * The attributes that should be cast to native types.
     */
    protected $dates = [
        'sheet_dt',
        'sheet_payment_dt',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'contract_id',
        'sheet_code',
        'sheet_name',
        'sheet_description',
        'sheet_dt',
        'sheet_type',
        'sheet_payment_dt',
        'sheet_payment_status',
        'sheet_notes',
        'is_active',
    ];

    /**
     * Get the contract that owns this contract sheet.
     */
    public function contract()
    {
        return $this->belongsTo('App\Contract', 'contract_id');
    }

    /**
     * Get all worksheets for this contract sheet.
     */
    public function worksheets()
    {
        return $this->hasMany('App\Worksheet', 'contractsheet_id');
    }
}