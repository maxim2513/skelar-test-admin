<?php
declare(strict_types=1);

namespace App\Models\Catalog;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $fillable = [
        'name',
        'price',
        'description',
    ];
}
