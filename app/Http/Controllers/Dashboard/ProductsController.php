<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Jobs\ImportProducts;
use App\Models\Category;
use App\Models\Product;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ProductsController extends Controller
{

    public function index()
    {

        //        $this->authorize('view-any', Product::class);
          $products = Product::with(['category', 'store'])->paginate();
        // SELECT * FROM products
        // SELECT * FROM categories WHERE id IN (..)
        // SELECT * FROM stores WHERE id IN (..)
       // $products=Product::paginate();

        return view('Dashboard.products.index', compact('products'));
    }


    public function create()
    {
        $this->authorize('create', Product::class);
    }


    public function store(Request $request)
    {
//        $this->authorize('create', Product::class);
    }


    public function show($id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('view', $product);
    }


    public function edit($id)
    {
        $product = Product::findOrFail($id);
//        $this->authorize('update', $product);


        $tags = implode(',', $product->tags()->pluck('name')->toArray());

        return view('Dashboard.products.edit', compact('product', 'tags'));
    }


    public function update(Request $request, Product $product)
    {
//        $this->authorize('update', $product);

        $product->update( $request->except('tags') );


        $tags = json_decode($request->post('tags'));
//        $tags = explode(',',$request->post('tags'));
        $tag_ids = [];

//        $saved_tags = Tag::all();

        foreach ($tags as $item) {
            $slug = Str::slug($item->value);
            $tag = Tag::where('slug', $slug)->first();
            if (!$tag) {
                $tag = Tag::create([
                    'name' => $item->value,
                    'slug' => $slug,
                ]);
            }
            $tag_ids[] = $tag->id;
        }

        $product->tags()->sync($tag_ids);

        return redirect()->route('products.index')
            ->with('success', 'Product updated');
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $this->authorize('delete', $product);
    }

}
