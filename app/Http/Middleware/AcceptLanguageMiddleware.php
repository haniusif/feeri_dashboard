<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Symfony\Component\HttpFoundation\Response;

class AcceptLanguageMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Retrieve the 'Accept-Language' header, defaulting to 'en'
        $locale = $request->header('Accept-Language', 'en');

        // Define supported locales
        $supportedLocales = ['en', 'ar', 'fr', 'es'];

        // Validate locale, default to English if not supported
        if (! in_array($locale, $supportedLocales)) {
            $locale = 'en';
        }

        // Set the application locale
        App::setLocale($locale);

        return $next($request);
    }
}
