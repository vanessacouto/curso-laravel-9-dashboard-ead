<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\StoreUser;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    protected $service;

    public function __construct(UserService $service) 
    {
        $this->service = $service;
    }

    public function index(Request $request) 
    {
        $users = $this->service->getAll(
            filter: $request->get('filter', '') // pega o filter, ou o valor default é vazio
        );

        return view('admin.users.index', compact('users'));
    }

    public function create() 
    {
        return view('admin.users.create');
    }

    public function store(StoreUser $request) 
    {
        $this->service->create($request->validated()); // validated: traz somente os dados que foram validados
     
        return redirect()->route('users.index');
    }
    
}
