<?php
namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\ContactInfo;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function welcome()
    {
        $categories = Category::withCount(['products' => function($query) {
                $query->where('is_active', true);
            }])
            ->where('is_active', true)
            ->get();

        $featuredProducts = Product::where('is_featured', true)
            ->where('is_active', true)
            ->with(['category'])
            ->take(8)
            ->get();
            
        $newArrivals = Product::where('is_active', true)
            ->with(['category'])
            ->orderBy('created_at', 'desc')
            ->take(8)
            ->get();
        
        return view('frontend.welcome', compact(
            'featuredProducts', 
            'newArrivals', 
            'categories'
        ));
    }
    
    public function shop(Request $request)
    {
        $query = Product::where('is_active', true);
        
        // Search
        if ($request->has('search')) {
            $query->where('name', 'like', '%'.$request->search.'%');
        }
        
        // Filter by price
        if ($request->has('price_range')) {
            $priceRange = explode('-', $request->price_range);
            $query->whereBetween('price', [$priceRange[0], $priceRange[1]]);
        }
        
        // Filter by color
        if ($request->has('color')) {
            $query->whereJsonContains('colors', $request->color);
        }
        
        // Filter by size
        if ($request->has('size')) {
            $query->whereJsonContains('sizes', $request->size);
        }
        
        // Sorting
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'latest':
                    $query->orderBy('created_at', 'desc');
                    break;
                case 'price_asc':
                    $query->orderBy('price', 'asc');
                    break;
                case 'price_desc':
                    $query->orderBy('price', 'desc');
                    break;
                case 'popularity':
                    // You might need to implement a popularity metric
                    $query->orderBy('views', 'desc');
                    break;
            }
        }
        
        $products = $query->paginate(100);
        
        // Get price ranges for filter counts
        $priceRanges = [
            '0-100' => Product::whereBetween('price', [0, 100])->count(),
            '100-200' => Product::whereBetween('price', [100, 200])->count(),
            '200-300' => Product::whereBetween('price', [200, 300])->count(),
            '300-400' => Product::whereBetween('price', [300, 400])->count(),
            '400-500' => Product::whereBetween('price', [400, 500])->count(),
        ];
        
        // Get all available colors and sizes with counts
        $colors = Product::select('colors')
            ->where('is_active', true)
            ->get()
            ->flatMap(function ($product) {
                return $product->colors ?? [];
            })
            ->countBy()
            ->toArray();
            
        $sizes = Product::select('sizes')
            ->where('is_active', true)
            ->get()
            ->flatMap(function ($product) {
                return $product->sizes ?? [];
            })
            ->countBy()
            ->toArray();
        
        return view('frontend.shop', compact('products', 'priceRanges', 'colors', 'sizes'));
    }

    
    public function contact()
    {
        $contactInfo = ContactInfo::first();
        return view('frontend.contact', compact('contactInfo'));
    }
    
    // public function submitContact(Request $request)
    // {
    //     $request->validate([
    //         'name' => 'required',
    //         'email' => 'required|email',
    //         'subject' => 'required',
    //         'message' => 'required',
    //     ]);

    //     // ContactMessage::create($request->all());
        
    //     // Here you would typically save the contact form to database or send email
    //     // For now, we'll just return with success message
        
    //     return back()->with('success', 'Your message has been sent successfully!');
    // }

    public function store(Request $request)
{
    // try {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
            'image_url' => 'nullable|url',
            'is_active' => 'required|boolean',
        ]);

        $category = Category::create([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'image_url' => $request->input('image_url'),
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Category added successfully!');
        
    // } catch (\Exception $e) {
    //     // Log the error for debugging
    //     \Log::error('Category creation failed: ' . $e->getMessage());
        
    //     // Redirect back with error message
    //     return back()->withInput()->with('error', 'Failed to create category. Please try again.');
    // }
}

}