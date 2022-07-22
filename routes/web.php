<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\GiftListController;
use App\Http\Controllers\CallPriceController;
use App\Http\Controllers\BankDetailsController;
use App\Http\Controllers\CountryListController;
use App\Http\Controllers\HostProfileController;
use App\Http\Controllers\RechargeAmountController;
use App\Http\Controllers\ReportAndBlockController;
use App\Http\Controllers\GiftTransactionController;
use App\Http\Controllers\AmountConversionController;
use App\Http\Controllers\FreeTokenTransactionController;
use App\Http\Controllers\VideoCallTransactionController;
use App\Http\Controllers\WithdrawlTransactionController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [HomeController::class, 'index'])->name('home');

Route::prefix('/')
    ->middleware('auth')
    ->group(function () {
        Route::resource('users', UserController::class);
        Route::resource(
            'amount-conversions',
            AmountConversionController::class
        );
        Route::get('all-bank-details', [
            BankDetailsController::class,
            'index',
        ])->name('all-bank-details.index');
        Route::post('all-bank-details', [
            BankDetailsController::class,
            'store',
        ])->name('all-bank-details.store');
        Route::get('all-bank-details/create', [
            BankDetailsController::class,
            'create',
        ])->name('all-bank-details.create');
        Route::get('all-bank-details/{bankDetails}', [
            BankDetailsController::class,
            'show',
        ])->name('all-bank-details.show');
        Route::get('all-bank-details/{bankDetails}/edit', [
            BankDetailsController::class,
            'edit',
        ])->name('all-bank-details.edit');
        Route::put('all-bank-details/{bankDetails}', [
            BankDetailsController::class,
            'update',
        ])->name('all-bank-details.update');
        Route::delete('all-bank-details/{bankDetails}', [
            BankDetailsController::class,
            'destroy',
        ])->name('all-bank-details.destroy');

        Route::resource('call-prices', CallPriceController::class);
        Route::resource('country-lists', CountryListController::class);
        Route::resource(
            'free-token-transactions',
            FreeTokenTransactionController::class
        );
        Route::resource('galleries', GalleryController::class);
        Route::resource('gift-lists', GiftListController::class);
        Route::resource('gift-transactions', GiftTransactionController::class);
        Route::resource('recharge-amounts', RechargeAmountController::class);
        Route::resource('report-and-blocks', ReportAndBlockController::class);
        Route::resource(
            'video-call-transactions',
            VideoCallTransactionController::class
        );
        Route::resource('wallets', WalletController::class);
        Route::resource(
            'withdrawl-transactions',
            WithdrawlTransactionController::class
        );
        Route::resource('host-profiles', HostProfileController::class);
    });
