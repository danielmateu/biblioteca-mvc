<?php
class StoreController extends Controller
{
    // método responsable de mostrar la portada
    public function index()
    {
        $this->loadView('store');
    }
}
