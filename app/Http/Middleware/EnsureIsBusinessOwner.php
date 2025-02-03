<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsBusinessOwner
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $business_id = $request->route('business_id') ?? $request->route('business')?->id ?? $request->route('queue_entry')?->business?->id;
        if ($business_id != Auth::user()->business->id) {
            return redirect()->route('home')->with([
                'status' => 'warning',
                'message' => 'No tienes permiso para esa acción'
            ]);
        }

        return $next($request);
    }
}
