<?php
namespace App\Models;

use App\Models\Model;

class LivraisonModel extends Model
{
    protected $id;
    protected $poids_min;
    protected $poids_max;
    protected $prix;

    public function __construct()
    {
        $this->table = 'livraison';
    }

    public function prixLivraison($poids)
    {
        return $this->requete("SELECT * FROM $this->table WHERE  poids_max >= $poids ORDER BY poids_max  ")->fetch();
    }
}