<?php

use App\Http\Controllers\Api\Games\GameController;
use Illuminate\Support\Facades\Route;

Route::post('/gold_api/user_balance', [GameController::class, 'webhookApiPg12UserBalance']);
Route::post('/gold_api/game_callback', [GameController::class, 'webhookApiPg12GameCallback']);

/*
* @dev Thigas Dev contato @link https://t.me/thigasdev
* IMPORTANTE: ESSE ENDPOINT É O QUE VOCÊ VAI COLOCAR APÓS O https://chicobets.sitedominio.com/apipragmatic40/webhook
* NO PAINEL DA API EM Configurações da API no API EndPoint
*/