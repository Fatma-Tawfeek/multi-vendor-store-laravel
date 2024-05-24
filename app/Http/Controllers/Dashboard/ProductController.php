<?php

namespace App\Http\Controllers\Dashboard;

use App\Models\Tag;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::with(['category', 'store'])->paginate();

        return view('dashboard.products.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'required|numeric|min:0',
            'category_id' => 'required|integer|exists:categories,id',
            'store_id' => 'required|integer|exists:stores,id',
            'image' => 'required|image',
            'description' => 'required|string',
            'status' => 'required|in:active,archived,draft',
            'featured' => 'required|boolean',
        ]);

        $request->merge([
            'slug' => Str::slug($request->name)
        ]);

        $product = Product::create($request->except('tags', 'image'));

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $path = $file->store('uploads/products', 'public'); // store('folder', 'disk')
            $product->image = $path;
            $product->save();
        }

        // $tags = explode(',', $request->tags);

        // because tagify return json with value and name
        $tags_array = json_decode($request->tags);
        $tags = array_column($tags_array, 'value');

        $tag_id = [];
        $saved_tags = Tag::all();
        foreach ($tags as $t_name) {
            $slug = \Illuminate\Support\Str::slug($t_name);
            $tag = $saved_tags->where('slug', $slug)->first();
            if (!$tag) {
                $tag = \App\Models\Tag::Create(['name' => $t_name, 'slug' => $slug]);
            }
            $tag_id[] = $tag->id;
        }

        $product->tags()->attach($tag_id);

        return redirect()->route('dashboard.products.index')->with('success', 'Product created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $tag_names = $product->tags->pluck('name')->toArray();
        $tags = implode(',', $tag_names);
        return view('dashboard.products.edit', compact('product', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|min:3|max:255',
            'price' => 'required|numeric|min:0',
            'compare_price' => 'required|numeric|min:0',
            'category_id' => 'required|integer|exists:categories,id',
            'store_id' => 'required|integer|exists:stores,id',
            'image' => 'nullable|image',
            'description' => 'required|string',
            'status' => 'required|in:active,archived,draft',
            'featured' => 'required|boolean',
        ]);

        $product->update($request->except('tags', 'image'));

        if ($request->hasFile('image')) {
            unlink(public_path($product->image));
            $file = $request->file('image');
            $path = $file->store('uploads/products', 'public'); // store('folder', 'disk')
            $product->image = $path;
            $product->save();
        }

        $tags = json_decode($request->tags);

        $tag_id = [];
        foreach ($tags as $item) {
            $slug = \Illuminate\Support\Str::slug($item->value);
            $tag = \App\Models\Tag::firstOrCreate(['name' => $item->value, 'slug' => $slug]);
            $tag_id[] = $tag->id;
        }

        $product->tags()->sync($tag_id);

        return redirect()->route('dashboard.products.index')->with('success', 'Product updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->tags()->detach();
        $product->delete();
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        return redirect()->route('dashboard.products.index')->with('success', 'Product deleted successfully.');
    }
}
