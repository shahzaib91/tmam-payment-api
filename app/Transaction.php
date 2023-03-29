<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    protected $primaryKey = 'transaction_id';

    /**
     * Function to establish eloquent relation
     *
     * @return Illuminate\Database\Eloquent\Concerns\HasRelationships::hasOne
     */
    public function merchant()
    {
        return $this->hasOne(User::class, 'id', 'merchant_code');
    }
}
