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
            'products' => $products,
            'genres'=> $genres,
            'genresProducts' => $genresProducts
        ]);
    }
}
