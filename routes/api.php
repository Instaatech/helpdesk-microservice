<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TicketController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('help-desk')->group(function(){
    Route::post('login',[AuthController::class,'Login']);
    Route::middleware('auth:api')->group(function(){
        Route::get('categories',[CategoryController::class,'fetchCategory']);
        Route::post('ticket',[TicketController::class,'createTicket'])->middleware('canCreateTicket');
        Route::get('ticket/{ticket_id}/details',[TicketController::class,'ticketDetails']);
        Route::get('tickets',[TicketController::class,'ticketList']);
        Route::post('ticket/add/message',[TicketController::class,'addMessage']);
        Route::post('ticket/{ticket_id}/close',[TicketController::class,'closeTicket']);
    });
});






