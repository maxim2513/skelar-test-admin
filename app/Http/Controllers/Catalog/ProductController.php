<?php
declare(strict_types=1);

namespace App\Http\Controllers\Catalog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Catalog\ProductRequest;
use App\Models\Catalog\Product;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response as HttpResponse;
use Inertia\Inertia;
use Inertia\Response;
use function response as baseResponse;

class ProductController extends Controller
{
    public function create(): Response
    {
        return Inertia::render('Catalog/Product/CreateProduct');
    }

    public function save(ProductRequest $productRequest): RedirectResponse
    {
        $product = new Product($productRequest->all());

        $product->save();

        return redirect()->route('product.list');
    }

    public function list(): Response
    {
        return Inertia::render('Catalog/Product/ListProducts', [
                'paginatedProduct' => Product::paginate(5),
            ]
        );
    }

    public function edit(Product $product): Response
    {
        return Inertia::render('Catalog/Product/EditProduct', [
            'product' => $product,
        ]);
    }

    public function update(ProductRequest $productRequest, Product $product): RedirectResponse
    {
        $product->fill($productRequest->all());
        $product->save();

        return redirect()->route('product.list');
    }

    public function delete(Product $product): RedirectResponse
    {
        $product->delete();

        return redirect()->route('product.list');
    }
}
