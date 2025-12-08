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
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'project_id',
        'contract_id',
        'sheet_dt',
        'sheet_type',
        'sheetgroup_id',
        'sheetheader_id',
        'sheet_code',
        'sheet_name',
        'sheet_description',
        'sheet_notes',
        'sheet_qty',
        'sheet_price',
        'sheet_grossamt',
        'sheet_discountrate',
        'sheet_discountvalue',
        'sheet_taxrate',
        'sheet_taxvalue',
        'sheet_netamt',
        'uom_id',
        'uom_name',
        'sheetgroup_seqno',
        'sheet_seqno',
    ];

    /**
     * Get the contract that owns this contract sheet.
     */
    public function contract()
    {
        return $this->belongsTo('App\Contract', 'contract_id');
    }

}