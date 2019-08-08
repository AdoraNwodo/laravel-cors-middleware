<?php

namespace AdoraNwodo\LaravelCorsMiddleware;

class LaravelCorsMiddleware
{
    public function __construct()
    {
    	$cors = config('laravelcorsmiddleware');
        $this->headers = $this->transform($cors);
    }

	/**
     * Transforms header options to upper and lower case respectively
     *
     * @return response
     */
    private function transform($headers)
    {
        if (!in_array('*', $headers['allowedHeaders'])) {
            $headers['allowedHeaders'] = array_map('strtolower', $headers['allowedHeaders']);
        }

        if (!in_array('*', $headers['allowedMethods'])) {
            $headers['allowedMethods'] = array_map('strtoupper', $headers['allowedMethods']);
        }

        return $headers;
    }

    /**
     * Checks if the header has unsupported values
     *
     * @return response
     */
    private function isBadHeader($headers)
    {
        if (!is_bool($headers['allowCredentials'])) {
            return $this->returnErrorResponse("Allow credentials should be boolean");
        }

        if (!is_array($headers['allowedOrigins'])) {
            return $this->returnErrorResponse("Allowed origins should be an array");
        }

        if (!is_array($headers['allowedMethods'])) {
            return $this->returnErrorResponse("Allowed methods should be an array");
        }

        if (!is_array($headers['allowedHeaders'])) {
            return $this->returnErrorResponse("Allowed headers should be an array");
        }

        if (!is_int($headers['maxAge']) || $headers['maxAge'] < 0) {
            return $this->returnErrorResponse("Max age should be a positive integer");
        }

        return false;
    }

    /**
     * Returns an error response
     *
     * @param  $message
     * @return response
     */
    private function returnErrorResponse($message)
    {    
        $response = array();
        $response["status"] = "Settings error";
        $response["message"] = $message;
        return response()
                ->json($response, 500, $this->headers);
    }

    /*
     * A preflight request has the OPTIONS request. 
     * It also checks to see that the CORS protocol is understood
     * This function checks if the request is a CORS preflight request
     * 
     * @param \Illuminate\Http\Request  $request
     * @return boolean
     */
    private function isAPreflightRequest($request)
    {
        return $this->isACorsRequest($request) && $request->isMethod('OPTIONS');
    }

    /*
     * Checks if the request is a CORS request
     *
     * @param \Illuminate\Http\Request  $request
     * @return boolean
     */
    private function isACorsRequest($request)
    {
        return !$this->isSameHost($request) && $request->headers->has('Origin');
    }

    /*
     * Checks if the current origin is in the list of allowed origins
     *
     * @param \Illuminate\Http\Request  $request
     * @return boolean
     */
    private function isInAllowedOrigins($request)
    {
        $allowedOriginsList = $this->headers['allowedOrigins'];
        $origin = $request->headers->get('Origin');

        if (in_array('*', $allowedOriginsList)) {
            return true;    // If '*'' exists, then allow all origins
        }

        if (in_array($origin, $allowedOriginsList)) {
            return true;    // If origin exists in list of allowed origins, then allow
        }
    }

    /*
     * Checks if the current origin is the same as the host
     *
     * @param \Illuminate\Http\Request  $request
     * @return boolean
     */
    private function isSameHost($request)
    {
        return $request->getSchemeAndHttpHost() === $request->headers->get('Origin');
    }

    /**
     * Handle an incoming request.
     * Adds the Access Control headers based on users config/laravelcorsmiddleware.php as expected
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $isBadHeader = $this->isBadHeader($this->headers);

        if($isBadHeader !== false) {
            return $isBadHeader;
        }

        if ($this->isAPreflightRequest($request)) {
            return response()->json('{"method":"OPTIONS"}', 200, $this->headers);
        }

        $response = $next($request);

        foreach ($this->headers as $key => $value) {
        	// Replace keys with actual labels and add to header
            if ($key = 'allowCredentials') {
                $response->header('Access-Control-Allow-Credentials', $value);
            }

            // Pick the origin from the list of origins
            if ($key = 'allowedOrigins') {
                if ($this->isInAllowedOrigins($request)) {
                    $response->header('Access-Control-Allow-Origin', $request->headers->get('Origin'));
                }   
            }

            if ($key = 'allowedMethods') {
                $response->header('Access-Control-Allow-Methods', implode(', ', $this->headers['allowedMethods']));
            }

            if ($key = 'allowedHeaders') {
                $response->header('Access-Control-Allow-Headers', implode(', ', $this->headers['allowedHeaders']));
            }

            if ($key = 'maxAge') {
                $response->header('Access-Control-Max-Age', $value);
            }
        }

        return $response;
    }
}