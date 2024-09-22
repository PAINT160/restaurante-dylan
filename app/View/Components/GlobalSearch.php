<?php

namespace App\View\Components;

use App\Models\User;
use App\Models\Venta;
use Illuminate\View\Component;

class GlobalSearch extends Component
{
    public $items;

    public function __construct()
    {
        $this->items = $this->getSearchableItems();
    }

    public function render()
    {
        return view('components.global-search');
    }

    private function getSearchableItems()
    {
        // Obtener usuarios desde la base de datos
        $users = User::all()->map(function ($user) {
            return (object) [
                'id' => $user->id,
                'name' => $user->name,
                'url' => route('users.show', $user->id),
                'model' => 'user'  // Agregar clave para identificar el tipo
            ];
        });

        // Obtener ventas desde la base de datos
        $ventas = Venta::all()->map(function ($venta) {
            return (object) [
                'id' => $venta->id,
                'name' => $venta->name,
                'description' => $venta->description,
                'url' => route('ventas.show', $venta->id),
                'model' => 'venta'  // Agregar clave para identificar el tipo
            ];
        });

        // Combinar usuarios y ventas en una sola colección
        return $users->concat($ventas)->toArray();
    }
}
