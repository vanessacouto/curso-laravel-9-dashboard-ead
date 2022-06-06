<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\ReplySupportRepositoryInterface;

class ReplySupportController extends Controller
{
    protected $repository;

    public function __construct(ReplySupportRepositoryInterface $repository) 
    {
        $this->repository = $repository;
    }

    public function store(Request $request)
    {
        
    }
}
