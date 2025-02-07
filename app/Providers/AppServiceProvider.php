<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Response;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Response::macro('success', function (array $data){

            $message = $data['message'] ?? "Api Request has been processed successfully";
            $action = $data['action'] ?? "Api Request";
            $code = $data['code'] ?? 200;
            $result = $data['result'] ?? null;

            return response()->json([
                'success' => true,
                'timestamp' => time(),
                'message' => $message,
                'action' => $action,
                'result' => $result
            ], $code);
        });

        Response::macro('fail', function (array $data){
            $message = $data['message'] ?? "Api Request has failed";
            $action = $data['action'] ?? "Api Request";
            $code = $data['code'] ?? 500;
            $error = $data['error'] ?? "Error";

            return response()->json([
                'success' => false,
                'timestamp' => time(),
                'message' => $message,
                'action' => $action,
                'error' => $error,
            ], $code);
        });
    }
}
