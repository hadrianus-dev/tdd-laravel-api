<?php

namespace App\Http\Controllers\Api\User;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\V1\User\UserUpdateRequest;

class Update extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(UserUpdateRequest $request, User $user)
    {
        return $user->update($request->validated());
    }
}
