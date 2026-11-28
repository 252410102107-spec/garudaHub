<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Model;

#[Fillable(['bid_id', 'skor', 'komentar'])]
class Rating extends Model
{
    public function bid()
    {
        return $this->belongsTo(Bid::class);
    }
}
