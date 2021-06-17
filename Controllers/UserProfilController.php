<?php
namespace App\Controllers;

use App\Models\AdresseParticulierModel;
use App\Models\BoutiqueParticulierModel;
use App\Models\PhotoAvatarModel;
use App\Models\UserModel;

class UserProfilController extends Controller
{
    public function profil()
    {
        if (isset($_SESSION['user']) AND $_SESSION['user']['droit'] == 10 OR $_SESSION['user']['droit'] == 1) {
            $id = $_SESSION['user']['id'];

            $user = new UserModel;
            $user = $user->find($id);

            $adresse = new AdresseParticulierModel;
            $adresse = $adresse->findAdresse($id);

            $photo = new PhotoAvatarModel;
            $photo = $photo->findPhotoAvatar($id);

            $boutique = new BoutiqueParticulierModel;
            $boutique = $boutique->findBoutiqueByUser($id);

            $this->render('user/profil', ['user' => $user, 'adresse' => $adresse, 'photo' => $photo, 'boutique' => $boutique]);
        }else {
            $_SESSION['erreur'] = "Vous n'avez pas les accès pour cette page";
            header('location: '.ACCUEIL);
        }
    }
}