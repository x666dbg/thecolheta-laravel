<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CorsPolicy
{
    public function handle(Request $request, Closure $next): Response
    {
        // Tentukan asal (origin) yang diizinkan secara dinamis
        // Tambahkan semua domain production dan development lu di sini
        $allowedOrigins = [
            'https://thecolheta.com',
            'https://www.thecolheta.com', // Jaga-jaga jika pake www
            'http://localhost:5173',      // Biar local dev lu tetap jalan
        ];
        
        // Ambil domain asal (origin) dari request browser
        $origin = $request->headers->get('Origin');

        // Tentukan header CORS yang akan dikirim
        $corsHeaders = [
            'Access-Control-Allow-Methods' => 'GET, POST, PUT, PATCH, DELETE, OPTIONS',
            'Access-Control-Allow-Headers' => 'Origin, Content-Type, Accept, Authorization, X-Requested-With, X-CSRF-TOKEN, X-XSRF-TOKEN, Cookie',
            'Access-Control-Allow-Credentials' => 'true',
        ];

        // Hanya set 'Access-Control-Allow-Origin' jika origin request ada di daftar yang diizinkan
        if (in_array($origin, $allowedOrigins)) {
             $corsHeaders['Access-Control-Allow-Origin'] = $origin;
        } else {
             // Jika tidak ada di daftar, set ke domain utama sebagai fallback (opsional)
             $corsHeaders['Access-Control-Allow-Origin'] = 'https://thecolheta.com'; 
        }

        // Tangani request 'OPTIONS' (Pre-flight)
        if ($request->getMethod() === 'OPTIONS') {
            return response('', 204)->withHeaders($corsHeaders);
        }

        // Tangani request utama (GET, POST, dll)
        $response = $next($request);

        // Set header CORS ke response utama
        foreach ($corsHeaders as $key => $value) {
            $response->headers->set($key, $value);
        }

        return $response;
    }
}