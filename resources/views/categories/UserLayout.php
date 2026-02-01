<?php

namespace App\View\Components;

use Illuminate\View\Component;
use Illuminate\View\View;

class UserLayout extends Component
{
    /**
     * Get the view / contents that represents the component.
     */
    public function render(): View
    {
        // Ini memberitahu Laravel: 
        // "Kalau ada yang panggil <x-user-layout>, ambil file di resources/views/layouts/user.blade.php"
        return view('layouts.user');
    }
}