<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Support\Facades\Auth;

class XSSProtection
{
    /**
     * The following method loops through all request input and strips out all tags from
     * the request. This to ensure that users are unable to set ANY HTML within the form
     * submissions, but also cleans up input.
     *
     * @param Request $request
     * @param callable $next
     * @return mixed
     */
    public function handle($request, \Closure $next)
    {
        if (!in_array(strtolower($request->method()), ['put', 'post'])) {
            return $next($request);
        }
        
        $input = $request->all();
        
        $removeElements = [
            'script',
            'html',
            'body',
            'form',
            'marquee',
            'img',
            'IMG'
        ];
        $removeMethods = [
            'onload',
            'onLoad',
            'onclick',
            'onClick',
        ];
        $findArr = array();
        foreach($removeElements as $rE)
        {
            $findArr[] = '<'.$rE;
            $findArr[] = '&lt;'.$rE;
            $findArr[] = '</'.$rE.'>';
            $findArr[] = '&lt;/'.$rE.'&gt;';
            $replaceArr[] = '[removed]';
            $replaceArr[] = '[removed]';
            $replaceArr[] = '[removed]';
            $replaceArr[] = '[removed]';
            $replaceArr[] = '[removed]';
            $replaceArr[] = '[removed]';
        }
        foreach($removeMethods as $rE)
        {
            $findArr[] = $rE;
            $replaceArr[] = '[removed]';
        }
        array_walk_recursive($input, function(&$input) use($findArr,$replaceArr) {
            $input = str_replace($findArr, $replaceArr, $input);
        });
        $request->merge($input);

        return $next($request);
    }
}