<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Worksheet extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'worksheets';

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'sheet_dt',
        'sheet_payment_dt',
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'contractsheet_id',
        'os_id',
        'os_code',
        'sheet_code',
        'sheet_type',
        'sheetheader_id',
        'sheet_status',
        'sheet_dt',
        'sheet_refftypeid',
        'sheet_reffno',
        'sheet_name',
        'sheet_description',
        'sheet_notes',
        'sheet_qty',
        'sheet_price',
        'sheet_grossamt',
        'sheet_netamt',
        'sheet_discountrate',
        'sheet_discountvalue',
        'sheet_taxrate',
        'sheet_taxvalue',
        'uom_id',
        'uom_name',
        'sheet_payment_dt',
        'sheet_payment_status',
        'vendor_id',
        'vendor_name',
        'vendortype_id',
        'vendortype_name',
        'project_id',
        'contract_id',
        'sheetgroup_id',
        'sheetgroup_seqno',
        'sheet_seqno',
    ];

    /**
     * Items (child worksheets) that belong to this worksheet header.
     */
    public function items()
    {
        return $this->hasMany('App\Worksheet', 'sheetheader_id');
    }

    /**
     * Header (parent worksheet) for this item.
     */
    public function header()
    {
        return $this->belongsTo('App\Worksheet', 'sheetheader_id');
    }

    /**
     * Vendor relation.
     */
    public function vendor()
    {
        return $this->belongsTo('App\Vendor', 'vendor_id');
    }

    /**
     * Vendor type relation.
     */
    public function vendortype()
    {
        return $this->belongsTo('App\VendorType', 'vendortype_id');
    }

    /**
     * Project relation.
     */
    public function project()
    {
        return $this->belongsTo('App\Project', 'project_id');
    }

    /**
     * Contract relation.
     */
    public function contract()
    {
        return $this->belongsTo('App\Contract', 'contract_id');
    }

    /**
     * Sheet group relation.
     */
    public function sheetgroup()
    {
        return $this->belongsTo('App\SheetGroup', 'sheetgroup_id');
    }

    /**
     * Contract sheet relation.
     */
    public function contractSheet()
    {
        return $this->belongsTo('App\ContractSheet', 'contractsheet_id');
    }

    /**
     * OS (order/service) relation.
     */
    public function os()
    {
        return $this->belongsTo('App\Os', 'os_id');
    }
}
