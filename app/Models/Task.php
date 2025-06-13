<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    // use SoftDeletes;

    const STATUS = [
        0 => '未着手',
        1 => '進行中',
        2 => '完了',
    ];
}
