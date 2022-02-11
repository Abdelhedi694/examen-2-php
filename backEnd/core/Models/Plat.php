<?php

namespace Models;



class Plat extends AbstractModel implements \JsonSerializable
{
    protected string $nomDeLaTable = "plats";
    private int $id;
    private string $description;
    private int $price;
    private int $restaurant_id;

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
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return int
     */
    public function getPrice(): int
    {
        return $this->price;
    }

    /**
     * @param int $price
     */
    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getRestaurantId(): int
    {
        return $this->restaurant_id;
    }

    /**
     * @inheritDoc
     */
    public function jsonSerialize()
    {
        return [
            "id"=>$this->id,
            "description"=>$this->description,
            "price"=>$this->price,
            "restaurant_id"=>$this->restaurant_id
        ];
    }

    /**
     * retourne un tableau de plats trouvés grace à l'id du restaurant associé
     * @param Restaurant $restaurant
     * @return array|bool
     */
    public function findAllByRestaurant(Restaurant $restaurant){

        $requete = $this->pdo->prepare("SELECT * FROM {$this->nomDeLaTable} WHERE restaurant_id=:restaurant_id");
        $requete->execute([
            "restaurant_id"=> $restaurant->getId()
        ]);
        $plat = $requete->fetchAll(\PDO::FETCH_CLASS,get_class($this));
        return $plat;
    }


}