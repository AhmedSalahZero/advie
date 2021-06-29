<?php

namespace App\Providers;

use App\Activity;
use App\Language;
use App\Market;
use App\Message;
use App\News;
use App\Page;
use App\Partners;
use App\Project;
use App\Role;
use App\Section;
use App\Service;
use App\Setting;
use App\Slider;
use App\User;
use Illuminate\Support\ServiceProvider;
use View;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $url = '/';
        foreach (request()->segments() as $key => $segment) {
            if ($key !== 0) {
                $url .= $segment . '/';
            }
        }
        \Illuminate\Support\Facades\View::share('url', $url);
        View::share('AlSliders', Slider::all());
        View::share('AllUsers', User::all());
        View::share('AllRoles', Role::all());
        View::share('AllActivities', Activity::all());
        View::share('AllLanguages', Language::all());
        View::share('AllPages', Page::all());
        View::share('AllMessages', Message::all());
        View::share('AllSections', Section::all());
        View::share('settings', Setting::all());
        View::share('AllServices', Service::all());
        View::share('AllProjects', Project::all());
        View::share('partners', Partners::all());
        View::share('partnersSection', Section::where('title->en','OUR PARTNERS')->first());
    //    View::share('marketPage', Page::where('slug','market')->first());
        View::share('AllNews',News::all());
        View::share('AllMarkets',Market::all());
        View::share('latestThreeNews', News::orderBy('created_at','desc')->take(3)->get());
        View::share('pages',Page::where('status',1)->orderBy('sort','asc')->where('page_id',0)->where('position','header')->get());

    }
}
