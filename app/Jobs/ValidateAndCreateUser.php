<?php

namespace App\Jobs;

use App\Models\User;
use App\Mail\IdentifyMail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;

class ValidateAndCreateUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    public function __construct(array $data)
    {
        $this->data = $data;
    }

    public function handle(): void
    {
        $email = $this->data['email'];
        $apiKey = env('EMAILVERIFY_API_KEY');
        \Log::info("User Data: ", $this->data);

        try {
            $response = Http::get(
                "https://app.emailverify.io/api/v1/validate?key={$apiKey}&email={$email}"
            );

            $result = $response->json();

            \Log::info('Email Verify Response:', $result);

            // ✅ Correct validation condition
            if (
                isset($result['status']) &&
                $result['status'] === 'valid' &&
                isset($result['sub_status']) &&
                $result['sub_status'] === 'permitted'
            ) {

                $userData = collect($this->data)->except('role')->toArray();
                $user = User::create($userData);

                \Log::info("User created with email: {$email}");

                $roleToAssign = $this->data['role'] ?? 'user';
                $user->assignRole($roleToAssign);

                Mail::to($user->email)->queue(
                    new IdentifyMail(
                        "Your account has been successfully activated!",
                        "Account Activated"
                    )
                );

                \Log::info("User created successfully: {$email}");

            } else {
                \Log::warning("Invalid email attempted: {$email}", $result);
            }
        } catch (\Exception $e) {
            \Log::error("Email verification failed for $email", [
                'error' => $e->getMessage()
            ]);
        }
    }
}