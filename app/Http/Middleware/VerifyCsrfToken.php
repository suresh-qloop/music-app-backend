<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * The URIs that should be excluded from CSRF verification.
     *
     * @var array<int, string>
     */
    protected $except = [
        //
        '/songs',
        '/distinct-songs',
        '/add-new-song',
        '/now-trending',
        '/articles',
        '/artists',
        '/users',
        '/videos',
        '/randVideos',
        '/lyrics-lines',
        '/sign-up',
        '/sign-in',
        '/update-song',
        '/reset-password',
        '/add-explanation',
        '/search-result',
        '/browse-by-letter',
    ];
}
