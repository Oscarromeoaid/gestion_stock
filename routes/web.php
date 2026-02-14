<?php
// routes/web.php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProduitController;
use App\Http\Controllers\CategorieController;
use App\Http\Controllers\FournisseurController;
use App\Http\Controllers\MouvementController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ExportController;


// Page d'accueil publique (redirection vers login)
Route::get('/', function () {
    return redirect()->route('login');
});

// Routes protégées par authentification
Route::middleware(['auth', 'verified'])->group(function () {
    
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Produits
    Route::resource('produits', ProduitController::class);

    // Catégories
    Route::resource('categories', CategorieController::class)->except(['show']);

    // Fournisseurs
    Route::resource('fournisseurs', FournisseurController::class);

    // Mouvements de stock
    Route::resource('mouvements', MouvementController::class)->only(['index', 'create', 'store', 'show']);

    // Profile
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

     // Notifications
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::post('/notifications/{id}/read', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::post('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
    Route::delete('/notifications/{id}', [NotificationController::class, 'destroy'])->name('notifications.destroy');
    Route::get('/notifications/unread-count', [NotificationController::class, 'unreadCount'])->name('notifications.unreadCount');

    // Exports PDF
    Route::get('/export/produits/pdf', [ExportController::class, 'exportProduitsPdf'])->name('export.produits.pdf');
    Route::get('/export/inventaire/pdf', [ExportController::class, 'exportInventairePdf'])->name('export.inventaire.pdf');
    Route::get('/export/mouvements/pdf', [ExportController::class, 'exportMouvementsPdf'])->name('export.mouvements.pdf');

    // Exports Excel
    Route::get('/export/produits/excel', [ExportController::class, 'exportProduitsExcel'])->name('export.produits.excel');
    Route::get('/export/mouvements/excel', [ExportController::class, 'exportMouvementsExcel'])->name('export.mouvements.excel');

});

require __DIR__.'/auth.php';