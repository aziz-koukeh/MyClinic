<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\App;
use Carbon\Carbon;
class Locale
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
        if (config('locale.status')) {
            if (Session::has('locale') && array_key_exists(Session::get('locale') , config('locale.languages'))) {

                App::setLocale(Session::get('locale'));

            }else {

                $userLanguages = preg_split('/[,;]/',$request->server('HTTP_ACCEPT_LANGUAGE'));
                foreach ($userLanguages as $language) {

                    if (array_key_exists($language , config('locale.languages'))) {
                        App::setLocale($language);

                        setLocale(LC_TIME , config('locale.languages')[$language][2]);

                        Carbon::setLocale( config('locale.languages')[$language][0]);

                        if (config('locale.languages')[$language][2]) {
                            \session(['lang-rtl' => true]);
                        }else {
                            Session::forget('lang-rtl');
                        }
                        // عند تعليق البريك يعود إلى اللغة المحددة إفتراضياَ في البرنامج
                        break;
                    }
                }
            }
        }


        return $next($request);
    }
}
