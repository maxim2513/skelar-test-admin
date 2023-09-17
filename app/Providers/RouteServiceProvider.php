<?php
declare(strict_types=1);

namespace App\Providers;

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\VerifyEmailController;
use App\Http\Controllers\Catalog\ProductController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Response;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to your application's "home" route.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/dashboard';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->middleware('web')->group(function () {
            $this->webRoutes();
        });
        $this->get('/', function () {
            return Response::redirectTo('login');
        });
    }

    protected function webRoutes(): void
    {
        $this->middleware('auth')->group(function () {
            $this->baseAuthRoutes();
            $this->profileRoutes();
            $this->catalogProductRoutes();
        });

        $this->middleware('guest')->group(function () {
            $this->guestRoutes();
        });
    }

    protected function baseAuthRoutes(): void
    {
        $this->get('/dashboard', [DashboardController::class, 'index'])
            ->middleware('verified')
            ->name('dashboard');

        $this->get('verify-email', EmailVerificationPromptController::class)
            ->name('verification.notice');

        $this->get('verify-email/{id}/{hash}', VerifyEmailController::class)
            ->middleware(['signed', 'throttle:6,1'])
            ->name('verification.verify');

        $this->post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
            ->middleware('throttle:6,1')
            ->name('verification.send');

        $this->get('confirm-password', [ConfirmablePasswordController::class, 'show'])
            ->name('password.confirm');

        $this->post('confirm-password', [ConfirmablePasswordController::class, 'store']);

        $this->put('password', [PasswordController::class, 'update'])
            ->name('password.update');

        $this->post('logout', [AuthenticatedSessionController::class, 'destroy'])
            ->name('logout');
    }

    protected function profileRoutes(): void
    {
        $this->get('/profile', [ProfileController::class, 'edit'])
            ->name('profile.edit');
        $this->patch('/profile', [ProfileController::class, 'update'])
            ->name('profile.update');
        $this->delete('/profile', [ProfileController::class, 'destroy'])
            ->name('profile.destroy');
    }

    protected function catalogProductRoutes(): void
    {
        $this->controller(ProductController::class)->group(function () {
            $this->get('/products', 'list')
                ->name('product.list');
            $this->get('/product', 'create')
                ->name('product.create');
            $this->post('/product', 'save')
                ->name('product.save');
            $this->get('/product/{product}', 'edit')
                ->name('product.edit')
                ->where('{product}', '[0-9]+');
            $this->post('/product/{product}', 'update')
                ->name('product.update')
                ->where('{product}', '[0-9]+');
        });

    }

    protected function guestRoutes(): void
    {
        $this->get('register', [RegisteredUserController::class, 'create'])
            ->name('register');

        $this->post('register', [RegisteredUserController::class, 'store']);

        $this->get('login', [AuthenticatedSessionController::class, 'create'])
            ->name('login');

        $this->post('login', [AuthenticatedSessionController::class, 'store']);

        $this->get('forgot-password', [PasswordResetLinkController::class, 'create'])
            ->name('password.request');

        $this->post('forgot-password', [PasswordResetLinkController::class, 'store'])
            ->name('password.email');

        $this->get('reset-password/{token}', [NewPasswordController::class, 'create'])
            ->name('password.reset');

        $this->post('reset-password', [NewPasswordController::class, 'store'])
            ->name('password.store');
    }
}
