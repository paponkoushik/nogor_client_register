<?php


namespace App\Http\Controllers;


use App\Models\Client;
use App\Services\RegistrationService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RegistrationController extends Controller
{
    protected $service;

    public function __construct(RegistrationService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        cache()->forget('clients');
        return cache()->rememberForever("clients", fn() => Client::query()->with('skills')->get());
    }

    public function show(Client $client)
    {
        return view('clients.edit_client', ['client' => $client->load('skills')]);
    }

    public function store(Request $request): JsonResponse
    {
        DB::transaction(fn()=> $this->service
            ->setAttrs($request->all())
            ->validate()
            ->store()
            ->syncSkills()
        );

        return response()->json(['message' => 'Data has been stored successfully']);
    }

    public function update(Request $request, Client $client): JsonResponse
    {
        DB::transaction(fn()=> $this->service
            ->setAttrs($request->only('name','email', 'gender', 'skills'))
            ->validate()
            ->update($client)
            ->syncSkills()
        );

        return response()->json(['message' => 'Data has been stored successfully']);
    }

    public function delete(Client $client): JsonResponse
    {
        $client->delete();

        return response()->json(['message' => 'data has been deleted successfully']);
    }
}
