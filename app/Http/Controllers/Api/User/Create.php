<?php

namespace App\Http\Controllers\Api\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\User\UserStoreRequest;

class Create extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UserStoreRequest $request)
    {
        $data = $request->validated();
        return User::create($data);
    }
}
