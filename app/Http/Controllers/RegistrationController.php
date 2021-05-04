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
        return Client::query()->with('skills')->get();
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
}
