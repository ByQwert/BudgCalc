<?php

namespace App\Http\Middleware;

use App\Models\Bill;
use Illuminate\Http\Request;
use Closure;


class OwnerMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (is_null($request->user())) {
            return redirect()->to('/login');
        }

        $id = $request->route('bill');
        if ($id) {
            $bill = Bill::findOrFail($id);
        } else {
            return $next($request);
        }

        if($bill->user_id == $request->user()->id) {
            return $next($request);
        }

        return abort(403, 'Unauthorized access.');
    }
}
