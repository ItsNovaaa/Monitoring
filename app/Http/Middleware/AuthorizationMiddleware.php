<?php

namespace App\Http\Middleware;

use App\Models\LogActivity;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class AuthorizationMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect()->route('user.login');
        }
        LogActivity::create([
            'class' => explode('@', $request->route()->action['controller'])[0], 
            'action' => explode('@', $request->route()->action['controller'])[1], 
            'url' => env('APP_URL').'/'.$request->route()->uri, 
            'method' => $request->route()->methods()[0], 
            'activity' => $request->route()->methods()[0].' class '.explode('@', $request->route()->action['controller'])[0].' action '.explode('@', $request->route()->action['controller'])[1],
            'created_at' => date('Y-m-d H:i:s'), 
            'created_by' => auth()->user()->username, 
        ]);
        return $next($request);
    }
}
