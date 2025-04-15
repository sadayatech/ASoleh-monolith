<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class DetectUnsupportedBrowser
{

    public function handle(Request $request, Closure $next)
    {
        // Lewati pengecekan untuk halaman tertentu
        if ($request->is('unsupported-browser')) {
            return $next($request);
        }

        $userAgent = $request->header('User-Agent');

        // Gabung jadi satu regex biar cuma sekali cek
        if (preg_match('/MiuiBrowser|SamsungBrowser|VivoBrowser|OppoBrowser|HeyTapBrowser|UCWEB|UCBrowser|QQBrowser/i', $userAgent)) {
            return redirect('/unsupported-browser');
        }

        return $next($request);
    }
}
