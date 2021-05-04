<?php

namespace App\Services;

use App\Models\Client;
use App\Services\Traits\FileHandler;
use App\Services\Traits\HasAttrs;

class RegistrationService
{
    use FileHandler, HasAttrs;

    protected $model;

    public function __construct(Client $model)
    {
        $this->model = $model;
    }
    public function rules(): array
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'image' => 'required|mimes:jpeg,jpg,png,gif|max:2000',
            'gender' => 'required|in:male,female',
            'skills' => 'nullable|array',
        ];
    }

    public function validate(): RegistrationService
    {
        validator(request()->all(), $this->rules())
            ->validate();

        return $this;
    }

    public function store(): RegistrationService
    {
        $this->uploadFile();

        $this->model = $this->model
            ->query()
            ->create($this->getAttrs());

        return $this;
    }

    public function syncSkills(): RegistrationService
    {
        $this->model
            ->skills()
            ->sync($this->getAttribute('skills'));

        return $this;
    }

    public function uploadFile()
    {
        $this->setAttribute(
            'image',
            $this->storeFile($this->getAttribute('image'))
        );
    }
}
