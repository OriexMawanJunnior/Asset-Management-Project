<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Asset extends Model
{
    protected $table = 'assets';

    protected const LOCATION_CODE = 'HQR'; 

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'asset_id',
        'name',
        'merk',
        'color',
        'serial_number',
        'purchase_order_number',
        'purchase_price',
        'quantity',
        'condition',
        'status',
        'remarks', 
        'location',
        'asset_detail_url',
        'qr_code_path',
        'date_of_receipt',
        'number',
        'category_id',  
        'subcategory_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'purchase_price' => 'float',
        'date_of_receipt' => 'date',
    ];

    public function category(){
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function subcategory(){
        return $this->belongsTo(Subcategory::class, 'subcategory_id');
    }

    public function borrowings(){
        return $this->hasMany(Borrowing::class);
    }

    /**
     * Generate asset ID if it is not provided
     */
    public function setAssetIdAttribute($value)
    {
        $this->attributes['asset_id'] = $value ?? self::generateAssetId($this);
    }

    private static function monthToRoman($month)
    {
        $romans = [
            1 => 'I', 2 => 'II', 3 => 'III', 4 => 'IV', 5 => 'V',
            6 => 'VI', 7 => 'VII', 8 => 'VIII', 9 => 'IX', 10 => 'X',
            11 => 'XI', 12 => 'XII'
        ];
        return $romans[$month] ?? '';
    }

    public static function generateAssetId($asset)
    {
        $locationCode = self::LOCATION_CODE;
        $se = 'SE';
        $categoryCode = $asset->category?->code ?? 'NNN';
        $subCategoryCode = $asset->subcategory?->code ?? 'NNN';

        // Handling date_of_receipt null case
        $receiptDate = $asset->date_of_receipt ?? now();
        $receiptMonth = self::monthToRoman(Carbon::parse($receiptDate)->format('m'));
        $receiptYear = Carbon::parse($receiptDate)->format('Y');

        // Find last asset in the same category and subcategory
        $lastAsset = self::where('category_id', $asset->category_id)
                        ->where('subcategory_id', $asset->subcategory_id)
                        ->orderBy('number', 'desc')
                        ->first();

        // Determine next number in sequence
        $nextNumber = $lastAsset ? $lastAsset->number + 1 : 1;
        $asset->number = $nextNumber;

        // Format asset_id
        $sequence = str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
        $assetId = "{$locationCode}/{$categoryCode}-{$subCategoryCode}/{$receiptMonth}/{$receiptYear}/{$se}/{$sequence}";

        return $assetId;
    }

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($asset) {
            if (empty($asset->asset_id)) {
                $asset->asset_id = self::generateAssetId($asset);
            }
        });
    }
}
