<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\WalletController;
use App\Http\Controllers\Api\GalleryController;
use App\Http\Controllers\Api\GiftListController;
use App\Http\Controllers\Api\CallPriceController;
use App\Http\Controllers\Api\BankDetailsController;
use App\Http\Controllers\Api\CountryListController;
use App\Http\Controllers\Api\HostProfileController;
use App\Http\Controllers\Api\RechargeAmountController;
use App\Http\Controllers\Api\ReportAndBlockController;
use App\Http\Controllers\Api\GiftTransactionController;
use App\Http\Controllers\Api\UserHostProfilesController;
use App\Http\Controllers\Api\AmountConversionController;
use App\Http\Controllers\Api\FreeTokenTransactionController;
use App\Http\Controllers\Api\VideoCallTransactionController;
use App\Http\Controllers\Api\WithdrawlTransactionController;
use App\Http\Controllers\Api\HostProfileGalleriesController;
use App\Http\Controllers\Api\HostProfileReportAndBlocksController;
use App\Http\Controllers\Api\HostProfileGiftTransactionsController;
use App\Http\Controllers\Api\HostProfileFreeTokenTransactionsController;
use App\Http\Controllers\Api\HostProfileWithdrawlTransactionsController;
use App\Http\Controllers\Api\HostProfileVideoCallTransactionsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/login', [AuthController::class, 'login'])->name('api.login');

Route::middleware('auth:sanctum')
    ->get('/user', function (Request $request) {
        return $request->user();
    })
    ->name('api.user');

Route::name('api.')
    ->middleware('auth:sanctum')
    ->group(function () {
        Route::apiResource('users', UserController::class);

        // User Host Profiles
        Route::get('/users/{user}/host-profiles', [
            UserHostProfilesController::class,
            'index',
        ])->name('users.host-profiles.index');
        Route::post('/users/{user}/host-profiles', [
            UserHostProfilesController::class,
            'store',
        ])->name('users.host-profiles.store');

        Route::apiResource(
            'amount-conversions',
            AmountConversionController::class
        );

        Route::apiResource('all-bank-details', BankDetailsController::class);

        Route::apiResource('call-prices', CallPriceController::class);

        Route::apiResource('country-lists', CountryListController::class);

        Route::apiResource(
            'free-token-transactions',
            FreeTokenTransactionController::class
        );

        Route::apiResource('galleries', GalleryController::class);

        Route::apiResource('gift-lists', GiftListController::class);

        Route::apiResource(
            'gift-transactions',
            GiftTransactionController::class
        );

        Route::apiResource('recharge-amounts', RechargeAmountController::class);

        Route::apiResource(
            'report-and-blocks',
            ReportAndBlockController::class
        );

        Route::apiResource(
            'video-call-transactions',
            VideoCallTransactionController::class
        );

        Route::apiResource('wallets', WalletController::class);

        Route::apiResource(
            'withdrawl-transactions',
            WithdrawlTransactionController::class
        );

        Route::apiResource('host-profiles', HostProfileController::class);

        // HostProfile Gift Transactions
        Route::get('/host-profiles/{hostProfile}/gift-transactions', [
            HostProfileGiftTransactionsController::class,
            'index',
        ])->name('host-profiles.gift-transactions.index');
        Route::post('/host-profiles/{hostProfile}/gift-transactions', [
            HostProfileGiftTransactionsController::class,
            'store',
        ])->name('host-profiles.gift-transactions.store');

        // HostProfile Free Token Transactions
        Route::get('/host-profiles/{hostProfile}/free-token-transactions', [
            HostProfileFreeTokenTransactionsController::class,
            'index',
        ])->name('host-profiles.free-token-transactions.index');
        Route::post('/host-profiles/{hostProfile}/free-token-transactions', [
            HostProfileFreeTokenTransactionsController::class,
            'store',
        ])->name('host-profiles.free-token-transactions.store');

        // HostProfile Withdrawl Transactions
        Route::get('/host-profiles/{hostProfile}/withdrawl-transactions', [
            HostProfileWithdrawlTransactionsController::class,
            'index',
        ])->name('host-profiles.withdrawl-transactions.index');
        Route::post('/host-profiles/{hostProfile}/withdrawl-transactions', [
            HostProfileWithdrawlTransactionsController::class,
            'store',
        ])->name('host-profiles.withdrawl-transactions.store');

        // HostProfile Report And Blocks
        Route::get('/host-profiles/{hostProfile}/report-and-blocks', [
            HostProfileReportAndBlocksController::class,
            'index',
        ])->name('host-profiles.report-and-blocks.index');
        Route::post('/host-profiles/{hostProfile}/report-and-blocks', [
            HostProfileReportAndBlocksController::class,
            'store',
        ])->name('host-profiles.report-and-blocks.store');

        // HostProfile Galleries
        Route::get('/host-profiles/{hostProfile}/galleries', [
            HostProfileGalleriesController::class,
            'index',
        ])->name('host-profiles.galleries.index');
        Route::post('/host-profiles/{hostProfile}/galleries', [
            HostProfileGalleriesController::class,
            'store',
        ])->name('host-profiles.galleries.store');

        // HostProfile Video Call Transactions
        Route::get('/host-profiles/{hostProfile}/video-call-transactions', [
            HostProfileVideoCallTransactionsController::class,
            'index',
        ])->name('host-profiles.video-call-transactions.index');
        Route::post('/host-profiles/{hostProfile}/video-call-transactions', [
            HostProfileVideoCallTransactionsController::class,
            'store',
        ])->name('host-profiles.video-call-transactions.store');
    });
