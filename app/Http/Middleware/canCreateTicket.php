<?php

namespace App\Http\Middleware;

use App\Exceptions\CustomErrorException;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use function PHPUnit\Framework\throwException;

class canCreateTicket
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(auth()->check())
        {
            if(auth()->user()->role == '1')
            {
                return $next($request);
            }else{
                throw new CustomErrorException('You are not authorized to create ticket');
            }
        }
        
    }
}
