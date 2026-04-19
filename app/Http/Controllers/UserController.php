<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Services\UserService;
use Illuminate\Http\Request;

class UserController extends Controller
{
    private UserService $service;

    public function __construct(UserService $service)
    // O construtor do UserController recebe uma instância de UserService, que é injetada automaticamente pelo Laravel através do mecanismo de injeção de dependência.
    //A instância do serviço é armazenada em uma propriedade privada $service para ser usada nos métodos do controlador.
    {
        $this->service = $service;
    }

    // index responsavel por retornar uma lista de usuários, possivelmente com filtros aplicados.
    // Ele recebe um objeto Request que contém os parâmetros de consulta (name, cpf, from, to) e os passa para o método index do UserService.
    // O resultado é retornado como uma resposta JSON.
    public function index(Request $request)
    {
       $users = $this->service->index(
        $request->only(['name', 'cpf', 'from', 'to'])
       );
       return response()->json($users);
    }

    // show é responsável por retornar os detalhes de um usuário específico com base no ID fornecido.
    //Ele chama o método show do UserService, passando o ID do usuário, e retorna a resposta como JSON.
    public function show(int $id)
    {
       return response()->json(
        $this->service->show($id)
        );
    }

    // store é responsável por criar um novo usuário.
    //Ele recebe um objeto StoreUserRequest, que é uma classe de validação personalizada para garantir que os dados de entrada estejam corretos.
    //O método validated() é chamado para obter os dados validados, que são então passados para o método create do UserService. A resposta é retornada como JSON com um status HTTP 201 (Created).
    public function store(StoreUserRequest $request)
    {
        return response()->json(
            $this->service->create($request->validated()),
            201
        );
    }

    // update é responsável por atualizar um usuário existente.
    //Ele recebe um objeto UpdateUserRequest, que é outra classe de validação personalizada para garantir que os dados de entrada estejam corretos para a atualização.
    //O método validated() é chamado para obter os dados validados, que são então passados para o método update do UserService junto com o ID do usuário a ser atualizado. A resposta é retornada como JSON.
    public function update(UpdateUserRequest $request, int $id)
    {
        return response()->json(
            $this->service->update($id, $request->validated())
        );
    }

    //  destroy é responsável por deletar um usuário com base no ID fornecido. Ele chama o método delete do UserService, passando o ID do usuário a ser deletado. A resposta é retornada com um status HTTP 204 (No Content), indicando que a operação foi bem-sucedida e que não há conteúdo para retornar.
    public function destroy(int $id)
    {
        $this->service->delete($id);
        return response()->json(null, 204);
    }
}

// php artisan make:controller UserController --api
// O comando acima cria um controlador de API para o recurso "User", com métodos pré-definidos para as operações de CRUD (Create, Read, Update, Delete).
// controlador inclui métodos como index(), show(), store(), update() e destroy(), que correspondem às rotas de API para listar, detalhar, criar, atualizar e deletar usuários.
// O controlador também pode ser personalizado

