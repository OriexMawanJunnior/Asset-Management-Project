<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Borrowing extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'borrowing';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'date_of_receipt',
        'date_of_return',
        'status',
        'asset_id',
        'employee_id',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'date_of_receipt' => 'date',
        'date_of_return' => 'date',
    ];

    /**
     * Get the asset associated with the borrowing.
     */
    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }

    /**
     * Get the employee associated with the borrowing.
     */
    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }
}
