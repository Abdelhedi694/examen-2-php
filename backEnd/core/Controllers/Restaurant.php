<?php

namespace Controllers;

class Restaurant extends AbstractController
{
protected $defaultModelName = \Models\Restaurant::class;

public function index(){
    $restaurants = $this->defaultModel->findAll();
    $this->json($restaurants);
}

public function new(){
    $request = $this->post('json', ['name'=>'text', 'adress'=>'text', 'city'=>'text']);
    if (!$request){
        $this->json('non valide');
    }

    $restaurant = new \Models\Restaurant();
    $restaurant->setName($request['name']);
    $restaurant->setAdress($request['adress']);
    $restaurant->setCity($request['city']);
    $this->defaultModel->save($restaurant);
    $this->json('Restaurant ajoutée');

}

public function suppr(){

    $request = $this->delete('json', ['id'=>'number']);
    if (!$request){
        $this->json('requête impossible', 'delete');
    }

    $restaurant = $this->defaultModel->findById($request['id']);

    if (!$restaurant){
        $this->json('id innexistant', 'delete');
    }

    $this->defaultModel->remove($restaurant);
    $this->json('restaurant supprimé', 'delete');

}


}