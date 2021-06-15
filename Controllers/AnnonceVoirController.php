<?php

namespace App\Controllers;


use App\Models\AnnonceModel;
use App\Models\BoutiqueParticulierModel;
use App\Models\BoutiqueProModel;
use App\Models\CategorieModel;
use App\Models\LivraisonModel;
use App\Models\PhotoAnnonceModel;
use App\Models\PhotoAvatarModel;


class AnnonceVoirController extends Controller
{
    /**
     * Permet a une boutique de particulier de voir son annonce et d'acceder à sa modification ou sa suppression
     *
     * @param int $annonce_id Id de l'annonce
     * @return void
     */
    public function boutiquePar($boutique_id, $id_annonce)
    {
        if ($boutique_id = $_SESSION['user']['boutique_id']) {
            if (isset($_POST['supprimer'])) {
                // On instancie la classe PhotoAnnonceModel et et on recherche une photo par rapport à  id photo
                $photos = new PhotoAnnonceModel();
                $photo = $photos->findPhotoByAnnonceId($id_annonce);

                unlink('public/img/annonce/' . $photo->photo);

                $annonces = new AnnonceModel;
                $annonces->delete($id_annonce);
                $_SESSION['success'] = "votre annonce a été supprimée";
                header('location: ' . ACCUEIL . 'boutiqueaccueil/accueilpar');
            }

            // On instancie la classe annonceModel et et on recherche une annonce par rapport à son id
            $annonces = new AnnonceModel();
            $annonce = $annonces->find($id_annonce);

            // On instancie la classe LivraisonModel et on recupere le prix de la livraison par rapport au poid de l'annonce
            $livraisons = new LivraisonModel;
            $livraison = $livraisons->prixLivraison($annonce->poids);

            // On instancie la classe PhotoAnnonceModel et et on recherche une photo par rapport à  id photo
            $photos = new PhotoAnnonceModel();
            $photo = $photos->findPhotoByAnnonceId($id_annonce);


            // On instancie la classe BoutiqueParticulierModel et on recherche une boutique par rapport à boutique_id
            $boutiques = new BoutiqueParticulierModel();
            $boutique = $boutiques->findBoutiqueById($boutique_id);

            $categorie_id = $annonce->categorie_id;


            // On instancie la classe CategorieModel et on recherche la categorie de l'article par rapport à son categorie_id
            $categories = new CategorieModel();
            $categorie = $categories->findByIdCategorie($categorie_id);

            // On instancie la classe PhotoAvatar et on recherche la photo de la boutique de particulier
            $photo_boutiques = new PhotoAvatarModel();
            $photo_boutique = $photo_boutiques->findPhotoBoutiquePar($boutique_id);

            $this->render('annonce_voir/boutique_par', ['annonce' => $annonce, 'livraison' => $livraison, 'photo' => $photo, 'boutique' => $boutique, 'categorie' => $categorie, 'photo_boutique' => $photo_boutique]);
        } else {
            $_SESSION['erreur'] = "Vous n'avez pas accès à cette page";
            header('location: ' . ACCUEIL);
            exit;
        }
    }

    /**
     * Permet a une boutique de pro de voir son annonce et d'acceder à sa modification ou sa suppression
     *
     * @param int $annonce_id Id de l'annonce
     * @return void
     */
    public function boutiquePro($boutique_id, $id_annonce)
    {
        if ($boutique_id = $_SESSION['user']['id']) {
            if (isset($_POST['supprimer'])) {
                // On instancie la classe PhotoAnnonceModel et et on recherche une photo par rapport à  id photo
                $photos = new PhotoAnnonceModel();
                $photo = $photos->findPhotoByAnnonceId($id_annonce);

                unlink('public/img/annonce/' . $photo->photo);

                $annonces = new AnnonceModel;
                $annonces->delete($id_annonce);
                $_SESSION['success'] = "votre annonce a été supprimée";
                header('location: ' . ACCUEIL . 'boutiqueaccueil/accueilpro');
            }
            // On instancie la classe annonceModel et et on recherche une annonce par rapport à son id
            $annonces = new AnnonceModel();
            $annonce = $annonces->find($id_annonce);

            // On instancie la classe LivraisonModel et on recupere le prix de la livraison par rapport au poid de l'annonce
            $livraisons = new LivraisonModel;
            $livraison = $livraisons->prixLivraison($annonce->poids);

            // On instancie la classe PhotoAnnonceModel et et on recherche une photo par rapport à  id photo
            $photos = new PhotoAnnonceModel();
            $photo = $photos->findPhotoByAnnonceId($id_annonce);

            // On instancie la classe BoutiqueProModel et on recherche une boutique par rapport à boutique_id
            $boutiques = new BoutiqueProModel();
            $boutique = $boutiques->findbyId($boutique_id);

            $categorie_id = $annonce->categorie_id;

            // On instancie la classe CategorieModel et on recherche la categorie de l'article par rapport à son categorie_id
            $categories = new CategorieModel();
            $categorie = $categories->findByIdCategorie($categorie_id);

            // On instancie la classe PhotoAvatar et on recherche la photo de la boutique de particulier
            $photo_boutiques = new PhotoAvatarModel();
            $photo_boutique = $photo_boutiques->findPhotoBoutique($boutique_id);

            $this->render('annonce_voir/boutique_pro', ['annonce' => $annonce, 'livraison' => $livraison, 'photo' => $photo, 'boutique' => $boutique, 'categorie' => $categorie, 'photo_boutique' => $photo_boutique]);
        } else {
            $_SESSION['erreur'] = "Vous n'avez pas accès à cette page";
            header('location: ' . ACCUEIL);
            exit;
        }
    }

    public function voirPro($id_annonce)
    {
        // On instancie la classe annonceModel et et on recherche une annonce par rapport à son id
        $annonces = new AnnonceModel();
        $annonce = $annonces->find($id_annonce);

        // On instancie la classe BoutiqueProModel et on recupere la boutique grace à l'id boutique de l'annonce
        $boutiques = new BoutiqueProModel;
        $boutique = $boutiques->findbyId($annonce->boutique_pro_id);

        // On instancie la classe LivraisonModel et on recupere le prix de la livraison par rapport au poid de l'annonce
        $livraisons = new LivraisonModel;
        $livraison = $livraisons->prixLivraison($annonce->poids);

        // On instancie la classe PhotoAnnonceModel et et on recherche une photo par rapport à  id photo
        $photos = new PhotoAnnonceModel();
        $photo = $photos->findPhotoByAnnonceId($id_annonce);

        $categorie_id = $annonce->categorie_id;

        // On instancie la classe CategorieModel et on recherche la categorie de l'article par rapport à son categorie_id
        $categories = new CategorieModel();
        $categorie = $categories->findByIdCategorie($categorie_id);

        // On instancie la classe PhotoAvatar et on recherche la photo de la boutique de particulier
        $photo_boutiques = new PhotoAvatarModel();
        $photo_boutique = $photo_boutiques->findPhotoBoutique($boutique->id);

        // On Ajoute L'ID de L'Annonce Pour le bouton d'achat

        $this->render('annonce_voir/voir_pro', ['id' => $id_annonce, 'annonce' => $annonce, 'livraison' => $livraison, 'photo' => $photo, 'boutique' => $boutique, 'categorie' => $categorie, 'photo_boutique' => $photo_boutique]);
    }

    public function voirPar($id_annonce)
    {

        // On instancie la classe annonceModel et et on recherche une annonce par rapport à son id
        $annonces = new AnnonceModel();
        $annonce = $annonces->find($id_annonce);

        // On instancie la classe boutiqueParModel et on recherche la boutique par rapport à id boutique de l'annonce
        $boutiques = new BoutiqueParticulierModel;
        $boutique = $boutiques->findBoutiqueById($annonce->boutique_particulier_id);

        // On instancie la classe LivraisonModel et on recupere le prix de la livraison par rapport au poid de l'annonce
        $livraisons = new LivraisonModel;
        $livraison = $livraisons->prixLivraison($annonce->poids);

        // On instancie la classe PhotoAnnonceModel et et on recherche une photo par rapport à  id photo
        $photos = new PhotoAnnonceModel();
        $photo = $photos->findPhotoByAnnonceId($id_annonce);

        // Cherche la catégorie
        $categorie_id = $annonce->categorie_id;

        // On instancie la classe CategorieModel et on recherche la categorie de l'article par rapport à son categorie_id
        $categories = new CategorieModel();
        $categorie = $categories->findByIdCategorie($categorie_id);

        // On instancie la classe PhotoAvatar et on recherche la photo de la boutique de particulier
        $photo_boutiques = new PhotoAvatarModel();
        $photo_boutique = $photo_boutiques->findPhotoBoutiquePar($boutique->id);

        $this->render('annonce_voir/voir_par', ['id' => $id_annonce, 'annonce' => $annonce, 'livraison' => $livraison, 'photo' => $photo, 'boutique' => $boutique, 'categorie' => $categorie, 'photo_boutique' => $photo_boutique]);
    }
}
