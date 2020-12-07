<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Device;

class CheckDevice
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
        // Verify if device is registered
        if (!$deviceId = $request->cookie('device_id'))
            $deviceId = Device::generateDeviceId();

        // Add
        $device = Device::where('code', $deviceId)->first();
        $request->attributes->add(['device_id' => $device->id]);

        // Set response device cookie
        $response = $next($request);
        $response->withCookie(cookie()->forever('device_id', $deviceId));

        return $response;
    }
}
