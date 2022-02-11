<?php

namespace Models;



class Restaurant extends AbstractModel implements \JsonSerializable
{
    protected string $nomDeLaTable = "restaurants";
    private int $id;
    private string $name;
    private string $adress;
    private string $city;




    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getAdress(): string
    {
        return $this->adress;
    }

    /**
     * @param string $adress
     */
    public function setAdress(string $adress): void
    {
        $this->adress = $adress;
    }

    /**
     * @return string
     */
    public function getCity(): string
    {
        return $this->city;
    }

    /**
     * @param string $city
     */
    public function setCity(string $city): void
    {
        $this->city = $city;
    }

    /**
     * Sauvegarde un restaurant dans la BDD
     * @param Restaurant $restaurant
     * @return void
     */
    public function save(Restaurant $restaurant):void
    {
        $sql = $this->pdo->prepare("INSERT INTO {$this->nomDeLaTable} 
             (name, adress, city) VALUES (:name,:adress, :city)
            ");

        $sql->execute([
            'name'=>$restaurant->name,
            'adress'=>$restaurant->adress,
            'city'=>$restaurant->city
        ]);

    }

    /**
     * retourne un tableau de plats associés a ce restaurant en question
     * @return array|bool
     */
    public function getPlat(){

        $modelPlat = new \Models\Plat();
        return $modelPlat->findAllByRestaurant($this);


    }



    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            "id"=>$this->id,
            "name"=>$this->name,
            "adress"=>$this->adress,
            "city"=>$this->city,
            "plats"=>$this->getPlat()
        ];
    }
}