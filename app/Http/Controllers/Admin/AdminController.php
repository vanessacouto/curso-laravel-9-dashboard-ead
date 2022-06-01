<?php

namespace App\Http\Controllers\Admin;

use App\Services\UploadFile;
use Illuminate\Http\Request;
use App\Services\AdminService;
use App\Http\Requests\Admin\{
    StoreAdmin,
    UpdateAdmin
};
use App\Http\Requests\StoreImage;
use App\Http\Controllers\Controller;

class AdminController extends Controller
{
    protected $service;

    public function __construct(AdminService $service) 
    {
        $this->service = $service;
    }

    public function index(Request $request) 
    {
        $admins = $this->service->getAll(
            filter: $request->filter ?? ""
            // filter: $request->get('filter', '') // pega o filter, ou o valor default é vazio
        );

        return view('admin.admins.index', compact('admins'));
    }

    public function create() 
    {
        return view('admin.admins.create');
    }

    public function store(StoreAdmin $request) 
    {
        $data = $request->validated();
        $data['password'] = bcrypt($data['password']);

        $this->service->create($data); // validated: traz somente os dados que foram validados
     
        return redirect()->route('admins.index');
    }

    public function edit($id) 
    {
        if (!$admin = $this->service->findById($id)) { // se não encontrar o admin
            return redirect()->back(); // retorna pra pagina que fez o request
        }

        return view('admin.admins.edit', compact('admin'));
    }

    public function update(UpdateAdmin $request, $id) 
    {
        $data = $request->only(['name', 'email']);

        if ($request->password) {
            $data['password'] = bcrypt($data['password']);
        }

        if(!$this->service->update($id, $data)) {
            return back();
        }

        return redirect()->route('admins.index');
    }
    
    public function changeImage($id) {

        if(!$admin = $this->service->findById($id)) {
            return back();
        }

        return view('admin.admins.change-image', compact('admin'));
    }

    public function uploadFile(StoreImage $request, UploadFile $uploadFile, $id) {
        $path = $uploadFile->store($request->image, 'admins'); // retorna o path onde armazenou

        // atualiza o usuario
        if(!$this->service->update($id, ['image' => $path])) {
            return back();
        }

        return redirect()->route('admins.index');
    }
}
