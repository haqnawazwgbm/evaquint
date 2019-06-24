<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Auth;
use Request;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
            // Using Closure based composers
        view()->composer('layouts.notifications', function ($view) {
            $notifications = DB::table('join_event')
                ->select('event_notifications.*')
                ->join('event_notifications', 'event_notifications.poiID', '=', 'join_event.poiID')
                ->where('join_event.user_id', '=', Auth::user()->id)
                ->where('type', 'unread')->get();
            $hostNotifications = DB::table('host_notifications')->where('hostID', '=', Auth::user()->id)->where('type', 'unread')->where('type', 'host')->get();
           $notifications = $notifications->merge($hostNotifications);
            //use laravel collection sort method to sort the collection by created_at
            $notifications = $notifications->sortByDesc('created_at');

            $notifications->totalNotifications = count($notifications);
            if ($notifications->totalNotifications > 0) {
                $notifications->countDown = "data-count=$notifications->totalNotifications";
                $notifications->notificationIcon = "notification-icon";
            } else {
                $notifications->countDown = '';
                $notifications->notificationIcon = "";
            }
            $view->notifications = $notifications;
        });

        // Get friend request notifications
        view()->composer('layouts.friendRequests', function ($view) {
            $requests = DB::table('friends')
                ->select('users.*', 'friends.*')
                ->join('users', 'users.id', '=', 'friends.guest_id')
                ->where('friend_accepted', 'no')
                ->where('host_id', '=', Auth::user()->id)->get();


            $requests->totalRequests = count($requests);
            if ($requests->totalRequests > 0) {
                $requests->countDown = "data-count=$requests->totalRequests";
                $requests->notificationIcon = "notification-icon";
            } else {
                $requests->countDown = '';
                $requests->notificationIcon = '';
            }
            $view->requests = $requests;
        });

        // Get events categories 
        view()->composer('layouts.footerCategories', function($view) {
            $categories = DB::table('event_categories')->get();
            
            $view->categories = $categories;
        });

        // Get popular events 
        view()->composer('layouts.footerTrendingEvents', function($view) {
            $raw = \DB::raw('ROUND ( ( 6371 * acos( cos( radians('.Auth::user()->lat.') ) * cos( radians( poi.lat ) ) * cos( radians( poi.lon ) - radians('.Auth::user()->lng.') ) + sin( radians('.Auth::user()->lat.') ) * sin( radians( poi.lat ) ) ) ) ) AS distance');
            $popularEvents = DB::table('join_event')
                     ->select(DB::raw('count(*) as row_count, poiID'), 'poi.eventPicture', 'poi.eventDescription', 'poi.title')->addSelect($raw)
                     ->join('poi', 'poi.id', '=', 'join_event.poiID')
                     ->groupBy('poiID')
                     ->orderBy('row_count', 'desc')
                     ->take(4)->having('distance', '<', 250)
                     ->get();
            
            $view->popularEvents = $popularEvents;
        });
         // Get private profile 
        view()->composer('layouts.privateProfile', function($view) {
             // Get friends start from here.
        $friends = DB::table('friends')
            ->select('users.*', 'friends.*')
            ->join('users', 'friends.host_id', '=', 'users.id')
            ->where('friend_accepted', 'yes')
            ->where('friends.guest_id', '=', Auth::user()->id)->get();
        $friends->totalFriends = count($friends);
                

        $view->friends = $friends;
        
        });
        
          // Get public profile friends 
        view()->composer('layouts.publicProfile', function($view) {
            $segments = Request::segments(2);
            $id = $segments[2];

             $friends = DB::table('friends')->select('friends.friend_accepted')->where('guest_id', Auth::user()->id)
                        ->where('friend_accepted', 'yes')
                        ->where('host_id', $id)->get();
        if (count($friends) > 0) {
            $friends->friend = 1;
        } else {
            $friend = DB::table('friends')->select('friends.friend_accepted')->where('guest_id', Auth::user()->id)
                        ->where('friend_accepted', 'no')
                        ->where('host_id', $id)->get();
            if (count($friend) > 0)
                $friends->friend = 2;
            else 
                $friends->friend = 3;
        }
        $friends->userID = $id;

        $view->friends = $friends;
        
        });
        
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}