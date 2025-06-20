<?php

namespace App\Http\Controllers;

use App\Models\Slider;
use App\Models\Feature;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $data['sliders'] = Slider::where('status', Slider::STATUS_ACTIVE)->latest()->get();
        $data['features'] = Feature::where('status', Feature::STATUS_ACTIVE)->get();
        
        return view('site.pages.home', $data);
    }
} 
