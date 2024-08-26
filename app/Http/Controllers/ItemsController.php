<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Items;
use App\Services\ItemService;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemsController extends Controller
{
    protected $itemService;
    public function __construct(ItemService $itemService)
    {
        $this->itemService = $itemService;
    }
    
    public function index()
    {
        $totalStock = Items::sum('stock'); 
        $lowStockItems = Items::where('stock', '<=', 10)->count();
        $totalCategories = Category::count(); 
        
        
        if (Auth::user()->role_id == 1) {
            return view('admins.pages.dashboard', compact('totalStock', 'lowStockItems', 'totalCategories'));
        } elseif(Auth::user()->role_id == 2) {
            return view('staff.pages.dashboard', compact('totalStock', 'lowStockItems', 'totalCategories'));
        }
    }

    public function items(Request $request)
    {
        $searchTerm = $request->input('search'); // Get the search term from the request
        
        $items = Items::query()
            ->when($searchTerm, function ($query, $searchTerm) {
                return $query->where('name', 'LIKE', '%' . $searchTerm . '%');
            })
            ->paginate(10); // Paginate the results
        
        $categories = Category::all();
    
        if (Auth::user()->role_id == 1) {
            return view('admins.pages.items', compact('items', 'categories', 'searchTerm'));
        } elseif (Auth::user()->role_id == 2) {
            return view('staff.pages.items', compact('items', 'categories', 'searchTerm'));
        }
    }

    public function show($id)
    {
        $result = ['status' => 200];

        try {
            $result['data'] = $this->itemService->findById($id);
        } catch (Exception $e) {
            $result = [
                'status' => 500,
                'error' => $e->getMessage(),
            ];
        }

        return response()->json($result, $result['status']);
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'stock' => 'required|integer',
            'status' => 'required|in:available,unavailable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $userId = Auth::id();

        $item = $this->itemService->create($validatedData, $userId);

        if (Auth::user()->role_id == 1) {
            return redirect()->back()->with('success', 'Item created successfully!');
        } elseif(Auth::user()->role_id == 2) {
            return redirect()->back()->with('success', 'Item created successfully!');
        }
    }

    public function delete($id){
        $item = Items::findOrFail($id);
        $item->delete();
        return redirect()->back()->with('success', 'Item deleted successfully!');
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:available,unavailable',
            'image' => 'nullable|image|max:2048', 
        ]);

        $item = $this->itemService->updateItem($id, $data);

        if ($item) {
            return redirect()->back()->with('success', 'Item updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to update item.');
        }
    }

    public function updateStaff(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'status' => 'required|in:available,unavailable',
            'image' => 'nullable|image|max:2048', 
        ]);

        $item = $this->itemService->updateItem($id, $data);

        if ($item) {
            return redirect()->back()->with('success', 'Item updated successfully!');
        } else {
            return redirect()->back()->with('error', 'Failed to update item.');
        }

    }
}
