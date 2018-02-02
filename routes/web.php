<?php

use Carbon\Carbon;

Route::get('/', function () {
    if(Auth::guest()) {
      $weeks = Carbon::now()->addWeeks(2)->format('l F jS');
      return view('homepage', compact('weeks'));
    } elseif (auth()->user()->role != 'designer') {
      return redirect('/your-app-design');
    } else {
      return redirect('/project-management');
    }
});

Auth::routes();

//profile
Route::get('/designers/{profile}', 'ProfilesController@show')->name('show.profile');
Route::get('/designers/{profile}/edit', 'ProfilesController@edit')->name('edit.profile');
Route::put('/designers/{profile}/update', 'ProfilesController@update')->name('update.profile');

//customers
Route::post('/customer-subscription', 'CustomersController@store')->name('store.customer');
Route::get('/subscribers', 'CustomersController@index')->name('index.customers');

//messages
Route::post('/store-message', 'MessagesController@store')->name('store.message');

//projects
Route::put('/complete-project/{id}', 'ProjectsController@complete')->name('complete.project');
Route::put('/open-project/{id}', 'ProjectsController@open')->name('open.project');
Route::get('/your-app-design', 'ProjectsController@index')->name('index.project');
Route::get('/project-management', 'ProjectsController@management')->name('management.project');
Route::get('/project-management/closed', 'ProjectsController@closed')->name('closed.project');
Route::get('/project-management/{id}', 'ProjectsController@show')->name('show.project');
Route::post('/start-project', 'ProjectsController@store')->name('store.project');

//subscriptions
Route::put('/cancel-membership', 'SubscriptionsController@cancelSubscription')->name('cancel.subscribe');
Route::put('/resume-membership-from-grace', 'SubscriptionsController@resumeFromGrace')->name('resumeFromGrace.subscribe');
Route::get('/payment', 'SubscriptionsController@subscribe')->name('index.subscribe');
Route::get('/account', 'SubscriptionsController@account')->name('account.subscribe');
Route::get('user/invoice/{invoice}', 'SubscriptionsController@invoice')->name('invoice.subscribe');
Route::post('/subscribe-monthly', 'SubscriptionsController@subscribeMonthly')->name('monthly.subscribe');
Route::post('/subscribe-yearly', 'SubscriptionsController@subscribeYearly')->name('yearly.subscribe');

//notifications
Route::get('/push-notifications', 'PushNotificationsController@index')->name('index.notifications');

//reservation
Route::put('/reservations/{id}/archive', 'ReservationsController@archive')->name('archive.reservation');
Route::put('/reservations/{id}/unarchive', 'ReservationsController@unarchive')->name('unarchive.reservation');
Route::post('/add-reservation', 'ReservationsController@store')->name('store.reservations');
Route::get('/reservations', 'ReservationsController@index')->name('index.reservations');
Route::get('/reservations/archived', 'ReservationsController@archived')->name('archived.reservations');
Route::post('/reservation/{id}/delete', 'ReservationsController@destroy')->name('delete.reservation');

//review
Route::get('/api/{id}/reviews', 'ReviewsController@api')->name('api.review');
Route::put('/reviews/{id}/approve', 'ReviewsController@approve')->name('approve.review');
Route::post('/add-review', 'ReviewsController@store')->name('store.reviews');
Route::get('/reviews', 'ReviewsController@index')->name('index.reviews');
Route::post('/review/{id}/delete', 'ReviewsController@destroy')->name('delete.review');

//menu
Route::get('/api/{id}/menus', 'MenusController@api')->name('api.menu');
Route::put('/menus/{menu}/update-menu', 'MenusController@update')->name('update.menu');
Route::post('/menus/{menu}/delete', 'MenusController@destroy')->name('delete.menu');
Route::post('/menus/store-menu', 'MenusController@store')->name('store.menu');
Route::get('/menus', 'MenusController@index')->name('index.menu');
Route::get('/menus/{menu}', 'MenusController@show')->name('show.menu');

//menu item
Route::post('/menus/{menu}/{menuitem}/delete', 'MenuItemsController@destroy')->name('delete.menuitem');
Route::get('/menus/{menu}/{menuitem}', 'MenuItemsController@edit')->name('edit.menuitem');
Route::put('/menus/{menu}/{menuitem}/update-menu-item', 'MenuItemsController@update')->name('update.menuitem');
Route::post('/menus/{menu}/store-menu-item', 'MenuItemsController@store')->name('store.menuitem');

//opening times
Route::get('/api/{id}/opening-times', 'OpeningTimesController@api')->name('api.times');
Route::put('/opening-times/{id}/update', 'OpeningTimesController@update')->name('update.times');
Route::post('/opening-times/store-opening-times', 'OpeningTimesController@store')->name('store.times');
Route::get('/opening-times', 'OpeningTimesController@index')->name('index.times');

//image gallery
Route::get('/api/{id}/image-galleries', 'GalleriesController@api')->name('api.gallery');
Route::put('/image-galleries/{imagegallerie}/update', 'GalleriesController@update')->name('update.gallery');
Route::post('/image-galleries/{imagegallerie}/delete', 'GalleriesController@destroy')->name('delete.gallery');
Route::post('/image-galleries/store-gallery', 'GalleriesController@store')->name('store.gallery');
Route::get('/image-galleries', 'GalleriesController@index')->name('index.gallery');
Route::get('/image-galleries/{imagegallerie}', 'GalleriesController@show')->name('show.gallery');

//gallery item
Route::post('/image-galleries/{imagegallerie}/{id}/delete', 'GalleryItemsController@destroy')->name('delete.galleryitem');
Route::put('/image-galleries/{imagegallerie}/{id}/update', 'GalleryItemsController@update')->name('update.galleryitem');
Route::post('/image-galleries/{imagegallerie}/store-gallery-image', 'GalleryItemsController@store')->name('store.galleryitem');

//event
Route::get('/api/{id}/events', 'EventsController@api')->name('api.event');
Route::put('/events/{event}/update', 'EventsController@update')->name('update.event');
Route::post('/events/{event}/delete', 'EventsController@destroy')->name('delete.event');
Route::get('/events/{event}', 'EventsController@show')->name('show.event');
Route::post('/events/store-event', 'EventsController@store')->name('store.event');
Route::get('/events', 'EventsController@index')->name('index.events');

//deal
Route::get('/api/{id}/offers', 'DealsController@api')->name('api.deal');
Route::put('/offers/{id}/update', 'DealsController@update')->name('update.deal');
Route::post('/offers/{id}/delete', 'DealsController@destroy')->name('delete.deal');
Route::post('/offers/store-deal', 'DealsController@store')->name('store.deal');
Route::get('/offers/{id}', 'DealsController@show')->name('show.deal');
Route::get('/offers', 'DealsController@index')->name('index.deals');

//social networks
Route::get('/api/{id}/social-networks', 'SocialNetworksController@api')->name('api.social');
Route::put('/social-networks/{id}/update', 'SocialNetworksController@update')->name('update.social');
Route::get('/social-networks', 'SocialNetworksController@index')->name('index.social');

//business information
Route::get('/api/{id}/business-information', 'BusinessInfoController@api')->name('api.businessinfo');
Route::put('/business-information/{id}/update', 'BusinessInfoController@update')->name('update.businessinfo');
Route::get('/business-information', 'BusinessInfoController@index')->name('index.businessinfo');
