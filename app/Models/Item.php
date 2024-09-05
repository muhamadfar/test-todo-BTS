<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name', 'checklist_id', 'is_completed'];

    public function checklist()
    {
        return $this->belongsTo(Checklist::class);
    }
}
