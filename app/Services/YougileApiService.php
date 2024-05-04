<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;

class YougileApiService
{
    private string $token;
    private string $url;

    public function __construct(string $token, string $url)
    {
        $this->token = $token;
        $this->url = $url;
    }

    public function getTasks()
    {
        $response = Http::withHeaders([
            'Authorization' => "Bearer ".$this->token,
            'Content-Type' => 'application/json',
        ])->post("$this->url" . "/tasks");

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
            'Authorization' => "Bearer ".$this->token,
            'Content-Type' => 'application/json',
        ])->post("$this->url" . "/tasks", $data);

        return $response->json();
    }
}
