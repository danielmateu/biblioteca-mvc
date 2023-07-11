<?php

class UserController extends Controller
{

    public function home()
    {
        Auth::check(); // solo para usuarios identificados

        // método responsable de mostrar la portada

        $this->loadView('user/home', [
            'user' => Login::get()
        ]);
    }

    public function create()
    {
        // Solo para administradores
        Auth::admin();

        // método responsable de mostrar el formulario de creación de usuarios
        $this->loadView('user/create');
    }

    public function store()
    {
    }
}
