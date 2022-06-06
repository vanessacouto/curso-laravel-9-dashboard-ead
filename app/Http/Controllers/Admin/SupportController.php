<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\SupportService;
use App\Http\Controllers\Controller;

class SupportController extends Controller
{
    protected $service;

    public function __construct(SupportService $service) 
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $supports = $this->service->getSupports(
            status: $request->get('status', 'P')
        );
        
        return view('admin.supports.index', compact('supports'));
    }
}
