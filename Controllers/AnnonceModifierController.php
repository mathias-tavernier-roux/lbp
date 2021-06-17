<?php

namespace App\Controllers;

use App\Core\Form;
use App\Models\AnnonceModel;
use App\Models\BoutiqueParticulierModel;
use App\Models\CategorieModel;
use App\Models\PhotoAnnonceModel;

class AnnonceModifierController extends Controller
{
    public function pro($annonce_id, $boutique_id)
    {
        // On vérifie que  le formulaire est complet
        if (Form::validate($_POST, ['titre', 'description', 'prix', 'stock'])) {
            // Le forumlaire est complet
            // On se protège des failles xss
            $titre = strip_tags($_POST['titre']);
            $description = strip_tags($_POST['description']);
            $prix = (float) $_POST['prix'];
            $poids = (float) $_POST['poids'];
            $stock = (float) $_POST['stock'];

            // On instancie notre modele
            $annonce = new AnnonceModel;

            // On hydrate l'objet
            $annonce->setId($annonce_id)
                ->setTitre($titre)
                ->setCategorie_id($_POST['categorie_0='])
                ->setDescription($description)
                ->setPrix($prix)
                ->setPoids($poids)
                ->setStock($stock)
                ->setBoutique_pro_id($boutique_id);

            // On crée l'annonce en BDD
            $annonce->update();
            



            if (isset($_FILES) AND !empty($_FILES['photo_principale']['name'])) {
                //Taille max de la photo
                $tailleMax = 2000000;

                // Extensions valides pour la photo
                $extensionValides = ['jpg', 'jpeg', 'gif', 'png'];

                if ($_FILES['photo_principale']['size'] <= $tailleMax) {
                    // La taille du fichier est bien inféreur à ce que l'on demande
                    // On vérifie l'extension
                    $extensionUpload = strtolower(substr(strrchr($_FILES['photo_principale']['name'], '.'), 1));
                    if (in_array($extensionUpload, $extensionValides)) {
                        // La taille et l'extension de la photo sont valides

                        // On instancie la classe photo
                        $photos = new PhotoAnnonceModel;

                        // On trouve la photo en BDD et on la supprime
                        $photo = $photos->findPhotoByAnnonceId($annonce_id);
                        $photos->delete($photo->id);

                        //On supprime la photo contenu dans le fichier
                        unlink('public/img/annonce/' . $photo->photo);

                        // Chemin et nom du fichier que l'on va enregistrer 
                        $chemin = 'public/img/annonce/' . $annonce_id . '.' . $extensionUpload;

                        // On enregistre le fichier grace à move et $resultat = false ou true
                        $resultat = move_uploaded_file($_FILES['photo_principale']['tmp_name'], $chemin);
                        if ($resultat) {
                            // On hydrate l'objet
                            $photos->setAnnonce_id($annonce_id)
                                ->setPhoto($annonce_id . '.' . $extensionUpload);
                            // On crée insert la photo en BDD
                            $photos->create();
                        } else {
                            $_SESSION['erreur'] = "Erreur durant l'importation du fichier";
                            header('location: ' . ACCUEIL . 'boutiqueAccueil/accueilPro');
                            exit;
                        }
                    } else {
                        $_SESSION['erreur'] = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
                        header('location: ' . ACCUEIL . 'boutiqueAccueil/accueilPro');
                        exit;
                    }
                } else {
                    $_SESSION['erreur'] = "Votre photo de profil ne doit pas dépasser 2 mo";
                    header('location: ' . ACCUEIL . 'boutiqueAccueil/accueilPro');
                    exit;
                }
            }
            // On redirige 
            $_SESSION['success'] = "votre annonce à été enregistrée avec succès";
            header('location: ' . ACCUEIL . 'boutiqueAccueil/accueilPro');
        }
        $annonces = new AnnonceModel;
        $annonce = $annonces->findAnnonceByPro($boutique_id);

        $categorie = new CategorieModel;
        $categories = $categorie->findCategories();

        foreach ($categories  as  $key => $value) {
            $categoriees[$value->id] = $value->nom;
        }

        // L'utilisateur est connecté
        $form = new Form;
        $form->debutForm('post', '#', ['enctype' => 'multipart/form-data'])
            ->ajoutLabelFor('titre', 'titre de l\'annonce :')
            ->ajoutInput('text', 'titre', ['id' => 'titre', 'required' => true, 'class' => 'form-control', 'value' => $annonce->titre])
            ->ajoutLabelFor('categorie', 'categorie : ')
            ->ajoutSelect('categorie', $categoriees, [null, 'id' => 'categorie', 'class' => 'form-control'])
            ->ajoutLabelFor('description', 'description de l\'article')
            ->ajoutTextarea('description', $annonce->description, ['id' => 'description', 'required' => true, 'class' => 'form-control'])
            ->ajoutLabelFor('prix', 'prix de l\'article :')
            ->ajoutInput('number', 'prix', ['id' => 'prix', 'required' => true, 'class' => 'form-control', 'min' => 0.1, 'max' => 1000000, 'step' => 0.01, 'value' => $annonce->prix])
            ->ajoutLabelFor('poids', 'poids de l\'article en kg;  0.600 = 0.6kg')
            ->ajoutInput('number', 'poids', ['id' => 'poids', 'required' => true, 'class' => 'form-control', 'step' => '0.001', 'min' => 0.001, 'max' => 120, 'value' => $annonce->poids])
            ->ajoutLabelFor('stock', 'nombre d\'articles en stock')
            ->ajoutInput('number', 'stock', ['id' => 'stock', 'class' => 'form-control', 'min' => 0, 'max' => 1000, 'value' => $annonce->stock])
            ->ajoutLabelFor('photo_principale', 'photo principale :')
            ->ajoutInput('file', 'photo_principale', ['id' => 'photo_principale', 'class' => 'form-control'])
            ->ajoutBouton('Modifier mon annonce', ['class' => 'btn btn-primary'])
            ->finForm();

        $this->render('annonce_modifier/pro', ['form' => $form->create()]);
    }

    public function par($annonce_id, $boutique_id)
    {
        // On vérifie que  le formulaire est complet
        if (Form::validate($_POST, ['titre', 'description', 'prix', 'stock'])) {
            // Le forumlaire est complet
            // On se protège des failles xss
            $titre = strip_tags($_POST['titre']);
            $description = strip_tags($_POST['description']);
            $prix = (float) $_POST['prix'];
            $poids = (float) $_POST['poids'];
            $stock = (float) $_POST['stock'];

            // On instancie notre modele
            $annonce = new AnnonceModel;

            // On hydrate l'objet
            $annonce->setId($annonce_id)
                ->setTitre($titre)
                ->setCategorie_id($_POST['categorie_0='])
                ->setDescription($description)
                ->setPrix($prix)
                ->setPoids($poids)
                ->setStock($stock)
                ->setBoutique_particulier_id($boutique_id)
            ;

            // On crée l'annonce en BDD
            $annonce->update();

            if (isset($_FILES) AND !empty($_FILES['photo_principale']['name'])) {
                //Taille max de la photo
                $tailleMax = 2000000;

                // Extensions valides pour la photo
                $extensionValides = ['jpg', 'jpeg', 'gif', 'png'];

                if ($_FILES['photo_principale']['size'] <= $tailleMax) {
                    // La taille du fichier est bien inféreur à ce que l'on demande
                    // On vérifie l'extension
                    $extensionUpload = strtolower(substr(strrchr($_FILES['photo_principale']['name'], '.'), 1));
                    if (in_array($extensionUpload, $extensionValides)) {
                        // La taille et l'extension de la photo sont valides

                        // On instancie la classe photo
                        $photos = new PhotoAnnonceModel;

                        // On trouve la photo en BDD et on la supprime
                        $photo = $photos->findPhotoByAnnonceId($annonce_id);
                        $photos->delete($photo->id);

                        //On supprime la photo contenu dans le fichier
                        unlink('public/img/annonce/' . $photo->photo);

                        // Chemin et nom du fichier que l'on va enregistrer 
                        $chemin = 'public/img/annonce/' . $annonce_id . '.' . $extensionUpload;

                        // On enregistre le fichier grace à move et $resultat = false ou true
                        $resultat = move_uploaded_file($_FILES['photo_principale']['tmp_name'], $chemin);
                        if ($resultat) {
                            // On hydrate l'objet
                            $photos->setAnnonce_id($annonce_id)
                                ->setPhoto($annonce_id . '.' . $extensionUpload);
                            // On crée insert la photo en BDD
                            $photos->create();
                        } else {
                            $_SESSION['erreur'] = "Erreur durant l'importation du fichier";
                            header('location: ' . ACCUEIL . 'boutiqueAccueil/accueilpar');
                            exit;
                        }
                    } else {
                        $_SESSION['erreur'] = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
                        header('location: ' . ACCUEIL . 'boutiqueAccueil/accueilpar');
                        exit;
                    }
                } else {
                    $_SESSION['erreur'] = "Votre photo de profil ne doit pas dépasser 2 mo";
                    header('location: ' . ACCUEIL . 'boutiqueAccueil/accueilpar');
                    exit;
                }
            }
            // On redirige 
            $_SESSION['success'] = "votre annonce à été enregistrée avec succès";
            header('location: ' . ACCUEIL . 'boutiqueAccueil/accueilpar');
        }
        $annonces = new AnnonceModel;
        $annonce = $annonces->findAnnonceByPar($boutique_id);

        $categorie = new CategorieModel;
        $categories = $categorie->findCategories();

        foreach ($categories  as  $key => $value) {
            $categoriees[$value->id] = $value->nom;
        }

        // L'utilisateur est connecté
        $form = new Form;
        $form->debutForm('post', '#', ['enctype' => 'multipart/form-data'])
            ->ajoutLabelFor('titre', 'titre de l\'annonce :')
            ->ajoutInput('text', 'titre', ['id' => 'titre', 'required' => true, 'class' => 'form-control', 'value' => $annonce->titre])
            ->ajoutLabelFor('categorie', 'categorie : ')
            ->ajoutSelect('categorie', $categoriees, [null, 'id' => 'categorie', 'class' => 'form-control'])
            ->ajoutLabelFor('description', 'description de l\'article')
            ->ajoutTextarea('description', $annonce->description, ['id' => 'description', 'required' => true, 'class' => 'form-control'])
            ->ajoutLabelFor('prix', 'prix de l\'article :')
            ->ajoutInput('number', 'prix', ['id' => 'prix', 'required' => true, 'class' => 'form-control', 'min' => 0.1, 'max' => 1000000, 'step' => 0.01, 'value' => $annonce->prix])
            ->ajoutLabelFor('poids', 'poids de l\'article en kg;  0.600 = 0.6kg')
            ->ajoutInput('number', 'poids', ['id' => 'poids', 'required' => true, 'class' => 'form-control', 'step' => '0.001', 'min' => 0.001, 'max' => 120, 'value' => $annonce->poids])
            ->ajoutLabelFor('stock', 'nombre d\'articles en stock')
            ->ajoutInput('number', 'stock', ['id' => 'stock', 'class' => 'form-control', 'min' => 0, 'max' => 1000, 'value' => $annonce->stock])
            ->ajoutLabelFor('photo_principale', 'photo principale :')
            ->ajoutInput('file', 'photo_principale', ['id' => 'photo_principale', 'class' => 'form-control'])
            ->ajoutBouton('Modifier mon annonce', ['class' => 'btn btn-primary'])
            ->finForm();

        $this->render('annonce_modifier/par', ['form' => $form->create()]);
    }
}
