<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product() {
        return $this->belongsTo('\App\Product');
    }

    protected $fillable = ['username', 'amount', 'product_id'];
}
