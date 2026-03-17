<?php

namespace App\Http\Controllers;

use App\Models\Genre_product;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\Product;
use App\Models\Genre;

class ProductController extends Controller
{
    public function index(): Response
    {
        $products = Product::all();
        $genres = Genre::all();
        $genresProducts = Genre_product::all();
        
        return Inertia::render('Index',[
            'products' => Product::with('favorites')->get()->map(function ($product) {
                return [
                    'id' => $product->id,
                    'title' => $product->title,
                    'content' => $product->content,
                    'price' => $product->price,
                    'imageURL' => $product->imageURL,
                    // Возвращаем boolean: есть ли ID текущего юзера в списке лайков
                    'is_favorite' => $product->favorites->contains(auth()->id()),
                ];
            }),
            // 'products' => $products,
            'genres'=> $genres,
            'genresProducts' => $genresProducts
        ]);
    }

    public function aboutGameModalShow(Product $product) {
        return Inertia::modal('productsComponents/smallComponents/AboutGameModal')
        ->with(['product' => $product])
        ->baseRoute('products.index');
    }
}
