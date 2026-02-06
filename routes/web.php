<?php

use Illuminate\Support\Facades\Route;

// SITE
use App\Http\Controllers\Site\HomeController as SiteHome;
use App\Http\Controllers\Site\AboutController as SiteAbout;
use App\Http\Controllers\Site\BlogController as SiteBlog;
use App\Http\Controllers\Site\EventController as SiteEventController;
use App\Http\Controllers\Site\ContactController as SiteContact;
use App\Http\Controllers\Site\ServicePublicController;
use App\Http\Controllers\Site\ProjectPublicController;
use App\Http\Controllers\Site\GalleryController as SiteGalleryController;
use App\Http\Controllers\Site\TeamController as SiteTeam;

// ADMIN (SYS)
use App\Http\Controllers\Sys\DashboardController;
use App\Http\Controllers\Sys\PostController;
use App\Http\Controllers\Sys\EventController as SysEventController;
use App\Http\Controllers\Sys\GalleryController as SysGalleryController;
use App\Http\Controllers\Sys\GalleryItemController as SysGalleryItemController;

use App\Http\Controllers\Sys\HomePageController;
use App\Http\Controllers\Sys\HeroSlideController;
use App\Http\Controllers\Sys\ServiceController;
use App\Http\Controllers\Sys\ProjectController;

use App\Http\Controllers\Sys\MissionSectionController;
use App\Http\Controllers\Sys\MissionItemController;
use App\Http\Controllers\Sys\CtaSectionController;
use App\Http\Controllers\Sys\CtaItemController;
use App\Http\Controllers\Sys\TeamMemberController;
use App\Http\Controllers\Sys\CategoryController;
use App\Http\Controllers\Sys\PartnerController;
use App\Http\Controllers\Sys\UserController as SysUserController;
use App\Http\Controllers\Sys\GeneralSettingsController;

/*
|--------------------------------------------------------------------------
| FRONTEND ROUTES
|--------------------------------------------------------------------------
| Public pages should NEVER use Sys controllers.
| Name prefix: site.*
*/
Route::name('site.')->group(function () {
    Route::get('/', [SiteHome::class, 'index'])->name('home');
    Route::get('/about', [SiteAbout::class, 'index'])->name('about');

    // Blog (public)
    Route::get('/blog', [SiteBlog::class, 'index'])->name('blog');
    Route::get('/blog/{post:slug}', [SiteBlog::class, 'show'])->name('blog.show');

    // Events (public)
    Route::get('/events', [SiteEventController::class, 'index'])->name('events.index');
    Route::get('/events/{slug}', [SiteEventController::class, 'show'])->name('events.show');

    // Gallery (public)
    Route::get('/gallery', [SiteGalleryController::class, 'index'])->name('gallery.index');
    Route::get('/gallery/{gallery:slug}', [SiteGalleryController::class, 'show'])->name('gallery.show');

    // Contact (public)
    Route::get('/contact', [SiteContact::class, 'index'])->name('contact');
    Route::post('/contact', [SiteContact::class, 'submit'])->name('contact.submit');

    // Public service/project details
    Route::get('/services/{service}-{slug}', [ServicePublicController::class, 'show'])
        ->whereNumber('service')
        ->name('services.show');

    Route::get('/projects', [ProjectPublicController::class, 'index'])->name('projects.index');
    Route::get('/our-projects', [ProjectPublicController::class, 'ProjectsAll'])->name('projects.all');

    Route::get('/projects/{project}/{slug?}', [ProjectPublicController::class, 'show'])
        ->whereNumber('project')
        ->name('projects.show');

    Route::get('/team/{type?}', [SiteTeam::class, 'index'])->name('team');
});

/*
|--------------------------------------------------------------------------
| ADMIN ROUTES (BREEZE)
|--------------------------------------------------------------------------
| Admin URLs live under /admin and are named sys.*
*/
Route::middleware(['auth'])->group(function () {

    // Breeze default landing
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Admin area
    Route::prefix('admin')->name('sys.')->group(function () {

        Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

        // Homepage modules CRUD
        Route::resource('home-pages', HomePageController::class);
        Route::resource('hero-slides', HeroSlideController::class);
        Route::resource('services', ServiceController::class);
        Route::resource('projects', ProjectController::class);

        // Mission (section + items)
        Route::resource('mission', MissionSectionController::class)->only(['index','edit','update']);
        Route::resource('mission.items', MissionItemController::class);

        // CTA (section + items)
        Route::resource('cta', CtaSectionController::class)->only(['index','edit','update']);
        Route::resource('cta.items', CtaItemController::class);

        // Team members
        Route::resource('team-members', TeamMemberController::class);

        // Blog posts (admin)
        Route::resource('posts', PostController::class)->names('posts');
        Route::resource('categories', CategoryController::class)->except(['show']);
        Route::resource('partners', PartnerController::class)->names('partners');
        Route::resource('events', SysEventController::class)->except(['show']);

        // Galleries
        Route::resource('galleries', SysGalleryController::class);

        Route::prefix('galleries/{gallery}')->name('galleries.')->group(function () {
            Route::get('items', [SysGalleryItemController::class, 'index'])->name('items.index');
            Route::get('items/create', [SysGalleryItemController::class, 'create'])->name('items.create');
            Route::post('items', [SysGalleryItemController::class, 'store'])->name('items.store');
            Route::get('items/{item}/edit', [SysGalleryItemController::class, 'edit'])->name('items.edit');
            Route::put('items/{item}', [SysGalleryItemController::class, 'update'])->name('items.update');
            Route::delete('items/{item}', [SysGalleryItemController::class, 'destroy'])->name('items.destroy');

            // drag/drop order + inline alt
            Route::patch('items/order', [SysGalleryItemController::class, 'order'])->name('items.order');
            Route::patch('items/{item}/alt', [SysGalleryItemController::class, 'updateAlt'])->name('items.alt');
        });

        // About page CRUD
        Route::get('/about', [\App\Http\Controllers\Sys\AboutPageController::class, 'index'])->name('about.index');
        Route::get('/about/create', [\App\Http\Controllers\Sys\AboutPageController::class, 'create'])->name('about.create');
        Route::post('/about', [\App\Http\Controllers\Sys\AboutPageController::class, 'store'])->name('about.store');
        Route::get('/about/{about}/edit', [\App\Http\Controllers\Sys\AboutPageController::class, 'edit'])->name('about.edit');
        Route::put('/about/{about}', [\App\Http\Controllers\Sys\AboutPageController::class, 'update'])->name('about.update');
        Route::delete('/about/{about}', [\App\Http\Controllers\Sys\AboutPageController::class, 'destroy'])->name('about.destroy');


       
        Route::resource('settings', GeneralSettingsController::class)
            ->parameters(['settings' => 'setting']);

        Route::post('settings/{setting}/logo',  [GeneralSettingsController::class, 'updateLogo'])->name('settings.logo');
        Route::post('settings/{setting}/crumb', [GeneralSettingsController::class, 'updateCrumb'])->name('settings.crumb');
    
       

        /*
        |--------------------------------------------------------------------------
        | USERS MODULE (ADMIN ONLY)
        |--------------------------------------------------------------------------
        */
        // Route::middleware(['admin.only'])->group(function () {
        Route::get('/users', [SysUserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [SysUserController::class, 'create'])->name('users.create');
        Route::post('/users', [SysUserController::class, 'store'])->name('users.store');

        Route::get('/users/{id}/edit', [SysUserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{id}', [SysUserController::class, 'update'])->name('users.update');

        Route::post('/users/{id}/avatar', [SysUserController::class, 'updateAvatar'])->name('users.avatar.update');
        Route::delete('/users/{id}/avatar', [SysUserController::class, 'deleteAvatar'])->name('users.avatar.delete');

        Route::delete('/users/{id}', [SysUserController::class, 'destroy'])->name('users.destroy');
        // });

        /*
        |--------------------------------------------------------------------------
        | Optional: Contact Messages
        |--------------------------------------------------------------------------
        */
        // Route::resource('contact-messages', ContactMessageController::class)->only(['index','show','destroy']);
    });
});

require __DIR__ . '/auth.php';