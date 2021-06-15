<?php

namespace App\Controllers;

use App\Core\Form;
use App\Models\AnnonceModel;
use App\Models\BoutiqueParticulierModel;
use App\Models\CategorieModel;
use App\Models\PhotoAnnonceModel;

class AnnonceController extends Controller
{

    public function search()
    {
        if (!isset($_POST['categorie']))
        {
            $categorie_s = "0";
        }
        else
        {
            $categorie_s = $_POST['categorie'];
        }
        // On instancie le class correspondant à la table annonces
        $annonce = new AnnonceModel;
        // On appelle la méthode search qui va rechercher les annonces pertinante dans la base de données
        $annonces = $annonce->search($_POST['search'],$categorie_s);

        // On génère la vue
        $this->render('search/search', compact('annonces'));
    }

    /**
     * Affiche 1 annonce
     *
     * @param [type] $id
     * @return void
     */
    public function voir(int $id)
    {
        $annonce = new AnnonceModel;
        $annonces = $annonce->find($id);

        $this->render('annonce/voir', compact('annonces'));
    }

    /**
     * Ajouter une annonce
     *
     * @return void
     */
    public function ajouterPro()
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
            $annonce->setTitre($titre)
                ->setCategorie_id($_POST['categorie_0='])
                ->setDescription($description)
                ->setPrix($prix)
                ->setPoids($poids)
                ->setStock($stock)
                ->setBoutique_pro_id($_SESSION['user']['id']);

            // On crée l'annonce en BDD
            $annonce->create();

            // On retour chercher l'annonce crée pour obtenir son id
            $annonce = $annonce->findAnnonceByPro($_SESSION['user']['id']);

            // On instancie la classe photo
            $photo = new PhotoAnnonceModel;

            //Taille max de la photo
            $tailleMax = 3000000;

            // Extensions valides pour la photo
            $extensionValides = ['jpg', 'jpeg', 'gif', 'png'];

            if ($_FILES['avatar']['size'] <= $tailleMax) {
                // La taille du fichier est bien inféreur à ce que l'on demande
                // On vérifie l'extension
                $extensionUpload = strtolower(substr(strrchr($_FILES['photo_principale']['name'], '.'), 1));
                if (in_array($extensionUpload, $extensionValides)) {
                    // La taille et l'extension de la photo sont valides

                    // Chemin et nom du fichier que l'on va enregistrer 
                    $chemin = 'public/img/annonce/' . $annonce->id . '.' . $extensionUpload;

                    // On enregistre le fichier grace à move et $resultat = false ou true
                    $resultat = move_uploaded_file($_FILES['photo_principale']['tmp_name'], $chemin);
                    if ($resultat) {
                        // On hydrate l'objet
                        $photo->setAnnonce_id($annonce->id)
                            ->setPhoto($annonce->id . '.' . $extensionUpload);
                        // On crée insert la photo en BDD
                        $photo->create();
                    } else {
                        // On hydrate l'objet
                        $photo->setAnnonce_id($annonce->id)
                            ->setPhoto('0.png');
                        // On crée insert la photo en BDD
                        $photo->create();
                        
                        $_SESSION['erreur'] = "Erreur durant l'importation du fichier";
                        header('location: ' . ACCUEIL . 'annonce/ajouter');
                        exit;
                    }
                } else {
                    $_SESSION['erreur'] = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
                    header('location: ' . ACCUEIL . 'annonce/ajouter');
                    exit;
                }
            } else {
                $_SESSION['erreur'] = "Votre photo de profil ne doit pas dépasser 2 mo";
                header('location: ' . ACCUEIL . 'annonce/ajouter');
                exit;
            }

            // On redirige 
            $_SESSION['success'] = "votre annonce à été enregistrée avec sucess";
            header('location: ' . ACCUEIL . 'boutiqueAccueil/accueilPro');
        } else {
            // Le formulaire est incomplet
            /* $_SESSION['erreur'] = "Le formulaire est incomplet"; */
        }

        $categorie = new CategorieModel;
        $categories = $categorie->findCategories();
        
        foreach ($categories  as  $key => $value) {
            $categoriees [$value->id] = $value->nom;
        }

        // L'utilisateur est connecté
        $form = new Form;
        $form->debutForm('post', '#', ['enctype' => 'multipart/form-data'])
            ->ajoutLabelFor('titre', 'titre de l\'annonce :')
            ->ajoutInput('text', 'titre', ['id' => 'titre', 'required' => true, 'class' => 'form-control'])
            ->ajoutLabelFor('categorie', 'categorie : ')
            ->ajoutSelect('categorie', $categoriees, [null, 'id' => 'categorie', 'class' => 'form-control'])
            ->ajoutLabelFor('description', 'description de l\'article')
            ->ajoutTextarea('description', '', ['id' => 'description', 'required' => true, 'class' => 'form-control'])
            ->ajoutLabelFor('prix', 'prix de l\'article :')
            ->ajoutInput('number', 'prix', ['id' => 'prix', 'required' => true, 'class' => 'form-control', 'min'=> 0.1, 'max' => 1000000, 'step' => 0.01])
            ->ajoutLabelFor('poids', 'poids de l\'article en kg;  0.600 = 0.6kg')
            ->ajoutInput('number', 'poids', ['id' => 'poids', 'required' => true, 'class' => 'form-control', 'step' =>'0.001', 'min'=> 0.001, 'max' => 120])
            ->ajoutLabelFor('stock', 'nombre d\'articles en stock')
            ->ajoutInput('number', 'stock', ['id' => 'stock', 'class' => 'form-control', 'min'=> 0, 'max' => 1000])
            ->ajoutLabelFor('photo_principale', 'photo principale :')
            ->ajoutInput('file', 'photo_principale', ['id' => 'photo_principale', 'required' => true, 'class' => 'form-control'])
            ->ajoutBouton('Mettre en vente', ['class' => 'btn btn-primary col-12'])
            ->finForm();

        $this->render('annonce/ajouter_pro', ['form' => $form->create()]);
    }

    public function ajouterPar()
    {
        
        // On vérifie que  le formulaire est complet
        if (Form::validate($_POST, ['titre', 'description', 'prix', 'stock'])) {
            // Le forumlaire est complet
            // On se protège des failles xss
            
            var_dump($_POST);
            $titre = strip_tags($_POST['titre']);
            $description = strip_tags($_POST['description']);
            $prix = (int) $_POST['prix'];
            $poids = (int) $_POST['poids'];
            $stock = (int) $_POST['stock'];

            // On instancie notre modele et la classe boutique_par
            $annonce = new AnnonceModel;
            $boutique = new BoutiqueParticulierModel;
            $boutique = $boutique->findBoutiqueByUser($_SESSION['user']['id']);
            

            // On hydrate l'objet
            $annonce->setTitre($titre)
                ->setCategorie_id($_POST['categorie_0='])
                ->setDescription($description)
                ->setPrix($prix)
                ->setPoids($poids)
                ->setStock($stock)
                ->setBoutique_particulier_id($boutique->id);

            // On crée l'annonce en BDD
            $annonce->create();

            // On retour chercher l'annonce crée pour obtenir son id
            $annonce = $annonce->findAnnonceByPar($boutique->id);

            // On instancie la classe photo
            $photo = new PhotoAnnonceModel;

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

                    // Chemin et nom du fichier que l'on va enregistrer 
                    $chemin = 'public/img/annonce/' . $annonce->id . '.' . $extensionUpload;

                    // On enregistre le fichier grace à move et $resultat = false ou true
                    $resultat = move_uploaded_file($_FILES['photo_principale']['tmp_name'], $chemin);
                    if ($resultat) {
                        // On hydrate l'objet
                        $photo->setAnnonce_id($annonce->id)
                            ->setPhoto($annonce->id . '.' . $extensionUpload);
                        // On crée insert la photo en BDD
                        $photo->create();
                    } else {
                        $_SESSION['erreur'] = "Erreur durant l'importation du fichier";
                        header('location: ' . ACCUEIL . 'annonce/ajouterpar');
                        exit;
                    }
                } else {
                    $_SESSION['erreur'] = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
                    header('location: ' . ACCUEIL . 'annonce/ajouterpar');
                    exit;
                }
            } else {
                $_SESSION['erreur'] = "Votre photo de profil ne doit pas dépasser 2 mo";
                header('location: ' . ACCUEIL . 'annonce/ajouterpar');
                exit;
            }

            // On redirige 
            $_SESSION['success'] = "votre annonce à été enregistrée avec succès";
            header('location: ' . ACCUEIL . 'boutiqueAccueil/accueilPar');
        } else {
           
        }

        $categorie = new CategorieModel;
        $categories = $categorie->findCategories();
        
        foreach ($categories  as  $key => $value) {
            $categoriees [$value->id] = $value->nom;
        }
        
        // L'utilisateur est connecté
        $form = new Form;
        $form->debutForm('post', '#', ['enctype' => 'multipart/form-data'])
            ->ajoutLabelFor('titre', 'titre de l\'annonce :')
            ->ajoutInput('text', 'titre', ['id' => 'titre', 'required' => true, 'class' => 'form-control'])
            ->ajoutLabelFor('categorie', 'categorie : ')
            ->ajoutSelect('categorie', $categoriees, [null, 'id' => 'categorie', 'class' => 'form-control'])
            ->ajoutLabelFor('description', 'description de l\'article')
            ->ajoutTextarea('description', '', ['id' => 'description', 'required' => true, 'class' => 'form-control'])
            ->ajoutLabelFor('prix', 'prix de l\'article :')
            ->ajoutInput('number', 'prix', ['id' => 'prix', 'required' => true, 'class' => 'form-control'])
            ->ajoutLabelFor('poids', 'poids de l\'article en kg;  0.600 = 0.6kg')
            ->ajoutInput('number', 'poids', ['id' => 'poids', 'required' => true, 'class' => 'form-control', 'step' =>'any'])
            ->ajoutLabelFor('stock', 'nombre d\'articles en stock')
            ->ajoutInput('number', 'stock', ['id' => 'stock', 'class' => 'form-control'])
            ->ajoutLabelFor('photo_principale', 'photo principale :')
            ->ajoutInput('file', 'photo_principale', ['id' => 'photo_principale', 'required' => true, 'class' => 'form-control'])
            ->ajoutBouton('Mettre en vente', ['class' => 'btn btn-primary col-12'])
            ->finForm();

        $this->render('annonce/ajouter_par', ['form' => $form->create()]);
    }
}
