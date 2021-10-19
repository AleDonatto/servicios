<?php

namespace App\Http\Middleware;

use Closure;

class ResponseWrapper
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);
        if($response instanceof JsonResponse){
            if(!isset($response->getData()->status)){
                $newResponseData['status'] = 'success';
                $newResponseData['code'] = $response->getStatusCode();
                $newResponseData['data'] = $response->getData();

                $response->setData($newResponseData);
            }
        }

        return $response;
    }
}