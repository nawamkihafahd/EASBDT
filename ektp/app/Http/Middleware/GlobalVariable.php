<?php

namespace App\Http\Middleware;

use App\Models\CategoryArticle;
use App\Models\CategoryEvent;
use App\Models\Contact;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\SocialMedia;
use App\Models\Article;
use Closure;
use Illuminate\Support\Facades\View;

class GlobalVariable
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
		/*
        $data['footerarticles'] = Article::latest()->take(2)->get();
        $data['contact'] = Contact::find(1);
		$data['address'] = explode(',', $data['contact']->address);
        $data['setting'] = Setting::find(1);
        $data['meta'] = $data['setting'];
        $data['socialMedia'] = SocialMedia::all();
		
        View::share($data);
		*/
        return $next($request);
    }
}
