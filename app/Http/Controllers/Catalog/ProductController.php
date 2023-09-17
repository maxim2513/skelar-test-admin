<?php
declare(strict_types=1);

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\ProductRequest;
use App\Models\Catalog\Product;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;

class ProductController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Catalog/Product/CreateProduct');
    }

    public function save(ProductRequest $productRequest)
    {
        $product = new Product($productRequest->all());

        $product->save();

        return redirect()->route('product.list');
    }

    public function list(Request $request): Response
    {
        return Inertia::render('Catalog/Product/ListProducts', [
                'paginatedProduct' => Product::paginate(5),
            ]
        );
    }
}
