<?php


namespace App\Http\Controllers;


use App\Services\RegistrationService;

class RegistrationController extends Controller
{
    protected $service;

    public function __construct(RegistrationService $service)
    {
        $this->service = $service;
    }

    public function index()
    {
        dd('called');
    }
}
