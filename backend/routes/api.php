<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\MemoryController;
use App\Http\Controllers\Api\ParcelController;

/*
|--------------------------------------------------------------------------
| API Routes - 3 Clicks to Eternity
|--------------------------------------------------------------------------
*/

// ÉTAPE 1 : Upload de fichiers
Route::post('/upload', [MemoryController::class, 'upload']);
Route::get('/memories', [MemoryController::class, 'index']);
Route::post('/memories/{id}/feature', [MemoryController::class, 'toggleFeature']);
Route::delete('/memories/{id}', [MemoryController::class, 'destroy']);

// ÉTAPE 2 : Timeline
Route::get('/timeline', [MemoryController::class, 'timeline']);
Route::post('/generate-timeline', [MemoryController::class, 'generateTimeline']); // Mock IA

// ÉTAPE 3 : Création et partage de parcelle
Route::post('/parcel', [ParcelController::class, 'store']);
Route::get('/parcel/{uuid}', [ParcelController::class, 'show']);
Route::get('/parcels', [ParcelController::class, 'index']); // Debug

// Health check
Route::get('/health', function () {
    return response()->json(['status' => 'ok', 'message' => '3 Clicks to Eternity API']);
});