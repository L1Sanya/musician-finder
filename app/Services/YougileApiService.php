<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class YougileApiService
{
    public function getCompanyId(): mixed
    {
        $data = [
            "login" => env('YOUGILE_LOGIN'),
            "password" => env('YOUGILE_PASSWORD'),
            "name" => env('YOUGILE_NAME')
        ];

        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
        ])->post('https://ru.yougile.com/api-v2/auth/companies', $data);

        return $response->json()['content'][0]['id'];
    }

    public function getToken(): string
    {
        return env('YOUGILE_API_TOKEN');
    }

    public function getColumnsList(): mixed
    {
        $response = Http::withHeaders([
            'Content-Type' => 'application/json',
            'Authorization' => "Bearer ".$this->getToken()
        ])->get('https://ru.yougile.com/api-v2/columns');

        return $response->json();
    }

    public function createNewResponseTask($user, $employer)
    {
        $data = [
            "title" => "FROM $user->email \n TO $employer->email",
            "columnId" => "0f57f96c-1ee8-4e31-bf9b-5e4be2ecd69e",
            "description" => "string",
            "archived" => false,
            "completed" => false,
            "deadline" => [
                "deadline" => 1653029146646,
                "startDate" => 1653028146646,
                "withTime" => true
            ],
            "checklists" => [
                [
                    "title" => "list 1",
                    "items" => [
                        [
                            "title" => "option 1",
                            "isCompleted" => false
                        ],
                        [
                            "title" => "option 2",
                            "isCompleted" => false
                        ]
                    ]
                ]
            ]
        ];

        $response = Http::withHeaders([
            'Authorization' => "Bearer ".$this->getToken(),
            'Content-Type' => 'application/json',
        ])->post('https://ru.yougile.com/api-v2/tasks', $data);

        return $response->json();
    }
}
