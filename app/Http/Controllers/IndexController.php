<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use App\Models\Property;
use Illuminate\View\View;

class IndexController extends Controller
{
    public function index(Item $item): View
    {
        $categories = Category::select('id', 'name')->get()->keyBy('id')->pluck('name');
        $properties = Property::all();
        return view('index.index', compact('item', 'categories', 'properties'));
    }
}
