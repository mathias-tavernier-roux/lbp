<?php

namespace App\Controllers;

use App\Models\AdresseParticulierModel;
use App\Models\AdresseProModel;
use App\Models\AnnonceModel;
use App\Models\BoutiqueParticulierModel;
use App\Models\BoutiqueProModel;
use App\Models\PhotoAvatarModel;

class BoutiqueAccueilController extends Controller
{
    /**
     * Affiche le profil de la boutique pro
     *
     * @return void
     */
    public function accueilPro()
    {
        if (isset($_SESSION['user']) and $_SESSION['user']['droit'] == 20) {

            (int) $id = $_SESSION['user']['id'];
            $photo = new PhotoAvatarModel;
            $photo = $photo->findPhotoBoutique($_SESSION['user']['id']);

            $boutique = new BoutiqueProModel;
            $boutique = $boutique->find($id);

            $adresse = new AdresseProModel;
            $adresse = $adresse->findAdresse($id);

            $annonce = new AnnonceModel;
            $annonce = $annonce->findAnnoneProLimit($id);

            $this->render('boutique_accueil/accueil_pro', ['boutique' => $boutique, 'adresse' => $adresse, 'annonce' => $annonce, 'photo' => $photo]);
        } else {
            $_SESSION['erreur'] = "Vous n'avez pas les accès pour cette page";
            header('location: ' . ACCUEIL);
        }
    }

    /**
     * Affiche le profil de la boutique de particulier
     *
     * @return void
     */
    public function accueilPar()
    {
        if (isset($_SESSION['user']) and $_SESSION['user']['droit'] = 10) {

            (int) $id = $_SESSION['user']['id'];
            $photos = new PhotoAvatarModel;
            $photo = $photos->findPhotoBoutiquePar($_SESSION['user']['boutique_id']);
            $photo_boutique = $photos->findPhotoBoutiquePar($_SESSION['user']['boutique_id']);

            $boutiques = new BoutiqueParticulierModel;
            $boutique = $boutiques->findBoutiqueByUser($id);

            $adresse = new AdresseParticulierModel;
            $adresse = $adresse->findAdresse($id);

            $annonce = new AnnonceModel;
            $annonce = $annonce->findAnnonceParLimit($boutique->id);

            $this->render('boutique_accueil/accueil_par', ['boutique' => $boutique, 'adresse' => $adresse, 'annonce' => $annonce, 'photo' => $photo, 'photo_boutique' => $photo_boutique]);
        } else {
            $_SESSION['erreur'] = "Vous n'avez pas les accès pour cette page";
            header('location: ' . ACCUEIL);
        }
    }

    /**
     * Affiche la boutique pro 
     *
     * @return void
     */
    public function Pro($boutique_pro_id)
    {
        $boutique = new BoutiqueProModel;
        $boutique = $boutique->find($boutique_pro_id);

        $photo = new PhotoAvatarModel;
        $photo = $photo->findPhotoBoutique($boutique->id);

        $adresse = new AdresseProModel;
        $adresse = $adresse->findAdresse($boutique->id);

        $annonce = new AnnonceModel;
        $annonce = $annonce->findAnnoneProLimit($boutique->id);

        $this->render('boutique_accueil/pro', ['boutique' => $boutique, 'adresse' => $adresse, 'annonce' => $annonce, 'photo' => $photo]);
    }

    /**
     * Affiche la boutique de particulier
     *
     * @return void
     */
    public function Par($boutique_par_id)
    {
        $boutiques = new BoutiqueParticulierModel;
        $boutique = $boutiques->findBoutiqueById($boutique_par_id);
        
        $photos = new PhotoAvatarModel;
        $photo_boutique = $photos->findPhotoBoutiquePar($boutique->id);

        $adresse = new AdresseParticulierModel;
        $adresse = $adresse->findAdresse($boutique->user_id);

        $annonce = new AnnonceModel;
        $annonce = $annonce->findAnnonceParLimit($boutique->id);

        $this->render('boutique_accueil/par', ['boutique' => $boutique, 'adresse' => $adresse, 'annonce' => $annonce, 'photo_boutique' => $photo_boutique]);
    }
}
