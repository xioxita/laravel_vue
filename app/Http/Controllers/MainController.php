<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;

class MainController extends Controller
{
    public function index()
    {
        // 1. Aquí defines tu array de datos (simulando una base de datos)
        $cards = [
            [
                'title' => 'Profesores',
                'description' => 'Gestión de la plantilla docente.',
                'img' => 'https://img.daisyui.com/images/stock/photo-1559181567-c3190ca9959b.webp',
                'buttonText' => 'Acceder'
            ],
            [
                'title' => 'Alumnos',
                'description' => 'Listado y matriculación de estudiantes.',
                'img' => 'https://img.daisyui.com/images/stock/photo-1507358522600-9f71e620c44e.webp',
                'buttonText' => 'Acceder'
            ],
            [
                'title' => 'Usuarios',
                'description' => 'Listado de usuarios.',
                'img' => 'https://img.daisyui.com/images/stock/photo-1507358522600-9f71e620c44e.webp',
                'buttonText' => 'Acceder'
            ],
            [
                'title' => 'Proyectos',
                'description' => 'Listado de proyectos',
                'img' => 'https://img.daisyui.com/images/stock/photo-1606107557195-0e29a4b5b4aa.webp',
                'buttonText' => 'Acceder'
            ],

        ];

        // 2. Enviamos los datos a la vista 'Main' usando Inertia
        // La clave 'cards' será el nombre de la prop en Vue
        return Inertia::render('Main', [
            'cards' => $cards
        ]);
    }
}
