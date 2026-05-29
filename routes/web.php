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

// DEBUG TEMPORAIRE - à supprimer après
Route::get('/debug-auth', function () {
    $user = \App\Models\User::where('email', 'admin@gestion-stock.com')->first();
    $hashCheck = $user ? \Illuminate\Support\Facades\Hash::check('password123', $user->password) : false;
    $attempt = \Illuminate\Support\Facades\Auth::attempt([
        'email' => 'admin@gestion-stock.com',
        'password' => 'password123'
    ]);
    return response()->json([
        'user_found' => $user ? true : false,
        'user_id' => $user->id ?? null,
        'email_verified' => $user->email_verified_at ?? null,
        'hash_check' => $hashCheck,
        'auth_attempt' => $attempt,
        'db_name' => \Illuminate\Support\Facades\DB::connection()->getDatabaseName(),
        'db_host' => config('database.connections.mysql.host'),
    ]);
});

// CRÉATION ADMIN TEMPORAIRE - à supprimer après
Route::get('/create-admin', function () {
    \Illuminate\Support\Facades\DB::table('users')->insert([
        'name' => 'Admin',
        'email' => 'admin@gestion-stock.com',
        'password' => \Illuminate\Support\Facades\Hash::make('password123'),
        'email_verified_at' => now(),
        'created_at' => now(),
        'updated_at' => now(),
    ]);
    return 'Admin créé avec succès !';
});

// IMPORT DONNÉES TEMPORAIRE - à supprimer après
Route::get('/import-data', function () {
    $data = json_decode(file_get_contents(base_path('database_export.json')), true);

    // Catégories
    \Illuminate\Support\Facades\DB::table('categories')->truncate();
    foreach ($data['categories'] as $item) {
        \Illuminate\Support\Facades\DB::table('categories')->insert($item);
    }

    // Fournisseurs
    \Illuminate\Support\Facades\DB::table('fournisseurs')->truncate();
    foreach ($data['fournisseurs'] as $item) {
        \Illuminate\Support\Facades\DB::table('fournisseurs')->insert($item);
    }

    // Produits
    \Illuminate\Support\Facades\DB::table('produits')->truncate();
    foreach ($data['produits'] as $item) {
        \Illuminate\Support\Facades\DB::table('produits')->insert($item);
    }

    // Mouvements
    \Illuminate\Support\Facades\DB::table('mouvements')->truncate();
    foreach ($data['mouvements'] as $item) {
        \Illuminate\Support\Facades\DB::table('mouvements')->insert($item);
    }

    return response()->json([
        'status' => 'success',
        'categories' => count($data['categories']),
        'fournisseurs' => count($data['fournisseurs']),
        'produits' => count($data['produits']),
        'mouvements' => count($data['mouvements']),
    ]);
});

// Routes protégées par authentification
Route::middleware(['auth'])->group(function () {

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
