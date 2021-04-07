<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class PreloadAssets
{
    protected static $assets = [
        'style' => [
            'assets/frontend/css/base.css',
            'assets/frontend/css/app.css',
            'assets/frontend/css/main.css',
        ],
        'script' => [
            'assets/frontend/js/plugins.js',
            'assets/frontend/js/main.js',
            'assets/frontend/js/app.js',
        ]
    ];

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        /** @var Response $response */
        $response = $next($request);
        $values = [];

        foreach (self::$assets as $type => $paths) {
            foreach ($paths as $path) {
                $values[] = "<$path>; rel=preload; as=$type";
            }
        }

        if ($values !== []) {
            $response->header('Link', $values);
        }

        return $response;
    }
}
