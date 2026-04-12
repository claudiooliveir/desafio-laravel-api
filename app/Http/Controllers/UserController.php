<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\User;
use App\Services\UserService;

class UserController extends Controller
{
   private $service;

    public function __construct(UserService $service)
    {
        $this->service = $service;
    }

    // GET /api/users?name=&cpf=&from=&to=
    public function index(Request $request)
    {
        $users = $this->service->index(
            $request->only(['name', 'cpf', 'from', 'to'])
        );
        return response()->json($users);
    }

    // GET /api/users/{id}
    public function show(int $id)
    {
        return response()->json($this->service->show($id));
    }

    // POST /api/users
    public function store(Request $request)  // ← era create(array $data)
    {
        $validated = $request->validate([
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:users,email',
            'cpf'        => 'required|string|max:14|unique:users,cpf',
            'password'   => 'required|string|min:6',
            'profile_id' => 'required|exists:profiles,id',
            'addresses'  => 'nullable|array',
        ]);

        return response()->json($this->service->create($validated), 201);
    }

    // PUT /api/users/{id}
    public function update(Request $request, int $id)  // ← adiciona os parâmetros
    {
        $validated = $request->validate([
            'name'       => 'sometimes|string|max:255',
            'email'      => 'sometimes|email|unique:users,email,' . $id,
            'cpf'        => 'sometimes|string|max:14|unique:users,cpf,' . $id,
            'password'   => 'nullable|string|min:6',
            'profile_id' => 'sometimes|exists:profiles,id',
            'addresses'  => 'nullable|array',
        ]);

        return response()->json($this->service->update($id, $validated));
    }

    // DELETE /api/users/{id}
    public function destroy(int $id)  // ← era delete()
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }
}




