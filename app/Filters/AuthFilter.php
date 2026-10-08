<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;

class AuthFilter implements FilterInterface
{
    /**
     * Run before a protected route.
     *
     * If the visitor is not authenticated, remember the requested
     * URL and redirect them to the login page.
     */
    public function before(
        RequestInterface $request,
        $arguments = null
    ) {
        if (! session()->get('isLoggedIn')) {
            session()->set(
                'intended_url',
                (string) $request->getUri()
            );

            return redirect()
                ->to('/login')
                ->with(
                    'error',
                    'Please sign in before accessing that page.'
                );
        }
    }

    /**
     * Run after a protected route.
     *
     * No after-filter action is required.
     */
    public function after(
        RequestInterface $request,
        ResponseInterface $response,
        $arguments = null
    ) {
        // Intentionally left empty.
    }
}