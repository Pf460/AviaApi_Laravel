<?php

namespace App\Http\Resources\Auth;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        return [
            'fio' => $this->fio,
            'email' => $this->email,
            'avatar' => $this->avatar
        ];
    }
}
