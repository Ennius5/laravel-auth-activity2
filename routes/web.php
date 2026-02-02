<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\PageViewController;

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/register', [PageViewController::class,'showRegister'])->name('show.register');
Route::post('/register', [AuthController::class,'register'])->name('process.register');

Route::get('/login', [PageViewController::class,'showLogin'])->name('show.login');
Route::post('/login', [AuthController::class, 'login'])->name('process.login');

Route::post('/logout',[AuthController::class, 'logout'])->name('process.logout');

Route::get('/home',[PageViewController::class, 'showHome'])->name('show.home');




use App\Http\Controllers\ProfileController; // I'd rather put this close to where it's used...
use App\Http\Controllers\TaskController;
Route::middleware('needsAuth')->group(function(){
    // Route::get('/tasks', [TaskController::class, 'index'])->name('tasks.index');
    // Route::get('/tasks/create', [TaskController::class, 'create'])->name('tasks.create');
    // Route::post('/tasks', [TaskController::class, 'store'])->name('tasks.store');
    // Route::get('/tasks/{id}/edit', [TaskController::class, 'edit'])->name('tasks.edit');
    // Route::put('/tasks/{id}', [TaskController::class, 'update'])->name('tasks.update');
    // Route::delete('/tasks/{id}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    // Route::patch('/tasks/{id}/toggle-complete', [TaskController::class, 'toggleComplete'])->name('tasks.toggle');
//Route::resource does the same as above

    Route::resource('tasks', TaskController::class);
    Route::get('/profile', [ProfileController::class, 'profile'])->name('profile');
    Route::get('/profile/edit', function() {
        return view('profile.edit');
    })->name('profile.edit');
    Route::put('/profile', [ProfileController::class, 'update'])->name('profile.update');
});


Route::get('/session-check', function() {
    return [
        'session_id' => session()->getId(),
        'session_data' => session()->all(),
        'cookies' => request()->cookie(),
        'auth_check' => auth()->check(),
        'auth_user' => auth()->user() ? auth()->user()->email : 'null',
        'laravel_session_exists' => request()->hasCookie('laravel_session'),
    ];
});



// debugging vite because styles are not applying
Route::get('/debug-vite', function() {
    echo "<h1>Vite Debug</h1>";

    // What does @vite generate?
    echo "<h2>Vite Output:</h2>";
    echo htmlspecialchars(
        app(Illuminate\Foundation\Vite::class)(['resources/css/app.css', 'resources/js/app.js'])->toHtml()
    );

    // Check manifest
    echo "<h2>Manifest Contents:</h2>";
    $manifestPath = public_path('build/manifest.json');
    if (file_exists($manifestPath)) {
        $manifest = json_decode(file_get_contents($manifestPath), true);
        echo "<pre>" . json_encode($manifest, JSON_PRETTY_PRINT) . "</pre>";
    } else {
        echo "Manifest not found at: " . $manifestPath;
    }

    // Check generated files
    echo "<h2>Generated Files:</h2>";
    $files = glob(public_path('build/assets/*'));
    foreach ($files as $file) {
        echo basename($file) . " (" . round(filesize($file)/1024, 2) . " KB)<br>";
    }
});
