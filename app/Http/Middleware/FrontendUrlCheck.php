<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Symfony\Component\HttpFoundation\Response;

class FrontendUrlCheck
{
    /**
     * @var array $allowedUrls
     */
    private array $allowedUrls;

    public function __construct()
    {
        $this->allowedUrls = [
            'landing' => config('frontend.landing'),
            'admin_management' => config('frontend.admin_management'),
            'business' => config('frontend.business'),
        ];
    }

    /**
     * Check if the given URL or URLs are allowed to access to the route.
     *
     * @param Request $request
     * @param Closure $next
     * @param string|array $urlKeys
     * @return Response
     */
    public function handle(Request $request, Closure $next, string|array $urlKeys): Response
    {
        if (is_array($urlKeys)) {
            $allowedUrls = [];
            foreach ($urlKeys as $urlKey) {
                if (array_key_exists($urlKey, $this->allowedUrls)) {
                    $allowedUrls[] = $this->allowedUrls[$urlKey];
                }
            }
        } elseif (is_string($urlKeys)) {
            if (array_key_exists($urlKeys, $this->allowedUrls)) {
                $allowedUrls[] = $this->allowedUrls[$urlKeys];
            }
        }

        if (!empty($allowedUrls)) {
            $referer = parse_url($request->headers->get('referer'), PHP_URL_HOST);
            $origin = parse_url($request->headers->get('origin'), PHP_URL_HOST);

            if (app()->environment('local') && $this->isPostmanRequest($request)) {
                return $next($request);
            }

            if (in_array($referer, $allowedUrls) || in_array($origin, $allowedUrls)) {
                return $next($request);
            }
        }

        return response()->json(['message' => 'Unauthorized.'], Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Check if the request is coming from Postman.
     *
     * @param Request $request
     * @return bool
     */
    private function isPostmanRequest(Request $request): bool
    {
        return Str::contains($request->header('user-agent'), 'PostmanRuntime');
    }
}
