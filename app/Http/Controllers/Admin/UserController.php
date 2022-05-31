<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Services\UserService;
use App\Http\Requests\StoreUser;
use App\Http\Requests\UpdateUser;
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
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        $this->service->create($data); // validated: traz somente os dados que foram validados
     
        return redirect()->route('users.index');
    }

    public function edit($id) 
    {
        if (!$user = $this->service->findById($id)) { // se não encontrar o user
            return redirect()->back(); // retorna pra pagina que fez o request
        }

        return view('admin.users.edit', compact('user'));
    }

    public function update(UpdateUser $request, $id) 
    {
        $data = $request->only(['name', 'email']);

        if ($request->password) {
            $data['password'] = bcrypt($data['password']);
        }

        if(!$this->service->update($id, $data)) {
            return back();
        }

        return redirect()->route('users.index');
    }
}
