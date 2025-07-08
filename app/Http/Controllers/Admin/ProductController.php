<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::with('category')
            ->latest()
            ->paginate(10);
            
        return view('admin.products.index', compact('products'));
    }

    public function shopDetails($slug)
    {
        $product = Product::with('category')
            ->where('slug', $slug)
            ->where('is_active', true)
            ->firstOrFail();
        
        $product->increment('views');
        
        $relatedProducts = Product::where('category_id', $product->category_id)
            ->where('id', '!=', $product->id)
            ->where('is_active', true)
            ->inRandomOrder()
            ->take(4)
            ->get();
        
        return view('frontend.shop-details', compact('product', 'relatedProducts'));
    }

    public function create()
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.create', compact('categories'));
    }

    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255|unique:products',
        'category_id' => 'required|exists:categories,id',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'discount_price' => 'nullable|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'is_active' => 'sometimes|in:0,1',
        'is_featured' => 'sometimes|in:0,1',
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        'sizes' => 'nullable|array',
        'sizes.*' => 'string|max:10',
        'colors' => 'nullable|array',
        'colors.*' => 'string|max:20'
    ]);

    // Upload main image to Cloudinary
    if ($request->hasFile('image')) {
        $uploaded = Cloudinary::upload($request->file('image')->getRealPath())->getSecurePath();
        $validated['image_url'] = $uploaded;
    }

    // Upload gallery images
    $galleryPaths = [];
    if ($request->hasFile('gallery_images')) {
        foreach ($request->file('gallery_images') as $image) {
            $galleryPaths[] = Cloudinary::upload($image->getRealPath())->getSecurePath();
        }
        $validated['gallery_images'] = json_encode($galleryPaths);
    }

    $validated['slug'] = Str::slug($validated['name']);
    $validated['is_active'] = (bool)($request->input('is_active', false));
    $validated['is_featured'] = (bool)($request->input('is_featured', false));

    Product::create($validated);

    return redirect()->route('admin.products.index')
        ->with('success', 'Product created successfully!');
}


    public function show(Product $product)
    {
        $product->load('category');
        return view('admin.products.show', compact('product'));
    }

    public function edit(Product $product)
    {
        $categories = Category::where('is_active', true)->get();
        return view('admin.products.edit', compact('product', 'categories'));
    }

public function update(Request $request, Product $product)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255|unique:products,name,' . $product->id,
        'category_id' => 'required|exists:categories,id',
        'description' => 'nullable|string',
        'price' => 'required|numeric|min:0',
        'discount_price' => 'nullable|numeric|min:0',
        'stock' => 'required|integer|min:0',
        'is_active' => 'sometimes|boolean',
        'is_featured' => 'sometimes|boolean',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        'gallery_images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:5120',
        'sizes' => 'nullable|array',
        'sizes.*' => 'string|max:10',
        'colors' => 'nullable|array',
        'colors.*' => 'string|max:20'
    ]);

    // ✅ Upload main image to Cloudinary
    if ($request->hasFile('image')) {
        $uploadedImage = \CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary::upload(
            $request->file('image')->getRealPath()
        )->getSecurePath();

        $validated['image_url'] = $uploadedImage;
    }

    // ✅ Upload new gallery images
    if ($request->hasFile('gallery_images')) {
        $galleryPaths = [];

        foreach ($request->file('gallery_images') as $image) {
            $galleryPaths[] = \CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary::upload(
                $image->getRealPath()
            )->getSecurePath();
        }

        $validated['gallery_images'] = json_encode($galleryPaths);
    }

    // Other fields
    $validated['slug'] = \Illuminate\Support\Str::slug($validated['name']);
    $validated['is_active'] = $request->boolean('is_active');
    $validated['is_featured'] = $request->boolean('is_featured');

    $product->update($validated);

    return redirect()->route('admin.products.index')
        ->with('success', 'Product updated successfully!');
}


    public function destroy(Product $product)
    {
        // Delete associated images
        if ($product->image_url) {
            Storage::disk('public')->delete($product->image_url);
        }
        
        if ($product->gallery_images) {
            foreach (json_decode($product->gallery_images) as $image) {
                Storage::disk('public')->delete($image);
            }
        }
        
        $product->delete();
        
        return redirect()->route('admin.products.index')
               ->with('success', 'Product deleted successfully!');
    }
}