<?php
declare(strict_types=1);

namespace App\Models\Catalog;

use Carbon\Traits\Timestamp;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Query\Builder;
use Lacodix\LaravelModelFilter\Filters\TrashedFilter;
use Lacodix\LaravelModelFilter\Traits\HasFilters;
use Lacodix\LaravelModelFilter\Traits\IsSearchable;

/**
 * @method Builder|self filterByQueryString()
 * @method Builder|self searchByQueryString()
 */
class Product extends Model
{
    use SoftDeletes;
    use HasFactory;
    use HasFilters;
    use IsSearchable;

    protected $fillable = [
        'name',
        'price',
        'description',
    ];

    protected array $filters = [
        TrashedFilter::class,
    ];

    protected array $searchable = [
        'name',
        'description',
    ];
}
