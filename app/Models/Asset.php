<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Asset extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    // public $timestamps = false;
    protected $table = 'assets';

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
        'remaks',
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

    public static function boot()
    {
        parent::boot();

        static::creating(function ($asset) {
            // Cek jika asset_id belum ada, buat asset_id baru
            if (empty($asset->asset_id)) {
                $asset->asset_id = self::generateAssetId($asset);
            }
        });
    }

    private static function monthToRoman($month)
    {
        $romans = [
            1 => 'I',
            2 => 'II',
            3 => 'III',
            4 => 'IV',
            5 => 'V',
            6 => 'VI',
            7 => 'VII',
            8 => 'VIII',
            9 => 'IX',
            10 => 'X',
            11 => 'XI',
            12 => 'XII'
        ];

        return $romans[$month] ?? '';
    }


    public static function generateAssetId($asset)
    {
        $locationCode = 'HQR'; // Ganti sesuai kebutuhan lokasi
        $se = 'SE';
        $categoryCode = $asset->category->code ?? 'NNN'; // Ambil kode dari kategori
        $subCategoryCode = $asset->subcategory->code ?? 'NNN'; // Ambil kode dari subkategori

        $receiptMonth = self::monthToRoman(Carbon::parse($asset->date_of_receipt)->format('m'));
        $receiptYear = Carbon::parse($asset->date_of_receipt)->format('Y');

         // Cari urutan terakhir berdasarkan kolom number
         $lastAsset = self::where('category_id', $asset->category_id)
                        ->where('subcategory_id', $asset->subcategory_id)
                        ->orderBy('number', 'desc')
                        ->first();

        // Tentukan urutan selanjutnya dengan kolom `number`
        $nextNumber = $lastAsset ? $lastAsset->number + 1 : 1;

        // Set nilai number untuk asset baru
        $asset->number = $nextNumber;

        // Format asset_id
        $sequence = str_pad($nextNumber, 6, '0', STR_PAD_LEFT);
        $assetId = "{$locationCode}/{$categoryCode}-{$subCategoryCode}/{$receiptMonth}/{$receiptYear}/{$se}/{$sequence}";

        return $assetId;
    }
}
