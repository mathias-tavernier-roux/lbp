<?php

namespace App\Controllers;

use App\Core\Form;
use App\Models\AdresseProModel;
use App\Models\BoutiqueParticulierModel;
use App\Models\BoutiqueProModel;
use App\Models\PhotoAvatarModel;
use App\Models\UserModel;

class BoutiqueProfilController extends Controller
{
    /**
     * Profil de la boutique pro
     *
     * @return void
     */
    public function profilPro()
    {
        if (Form::validate($_POST, ['nom', 'email', 'adresse', 'code', 'ville', 'siret', 'password'])) {
            $nom = strip_tags($_POST['nom']);
            $email = strip_tags($_POST['email']);
            $adresse_post = strip_tags($_POST['adresse']);
            $code =  $_POST['code'];
            $ville = strip_tags($_POST['ville']);
            $siret = $_POST['siret'];
            $pass = strip_tags($_POST['password']);
            if ($_POST['new_password'] != null) {
                $password = password_hash($_POST['new_password'], PASSWORD_ARGON2I);
            } else {
                $password = null;
            }

            // On instancie la class Boutiquepro, Boutiqueparticulier et user
            $boutiquepro = new BoutiqueProModel;
            $boutiquepar = new BoutiqueParticulierModel;
            $user = new UserModel;

            // On recupere la boutique
            $boutique_pass = $boutiquepro->findOneByEmail($_SESSION['user']['email']);

            // On vérifie que le mot de passe est correct
            if (password_verify($pass, $boutique_pass->password)) {


                // On vérifie que le nom de boutique n'a pas été changé
                $nom_exist = $boutiquepro->findBy(['nom' => $nom, 'id' => $_SESSION['user']['id']]);
                if (empty($nom_exist)) {
                    // Pas trouvé le nom avec l'id de la boutique cela veut dire que le nom à été changé
                    // On vérifie donc qu'il n'y a pas une autre boutique qui porte le meme nom
                    $nom_exist = $boutiquepro->findBy(['nom' => $nom]);
                    // On vérifie qu'une boutique de particulier ne porte pas ce nom
                    $nom_existe = $boutiquepar->findBy(['nom_boutique' => $nom]);

                    if (!empty($nom_exist)) {
                        // On a trouvé un résultat ce qui veut dire que le nom est déjà pris par une autre boutique pro
                        $_SESSION['erreur'] = "Ce nom de société existe déjà";
                        header('location: ' . ACCUEIL . '/boutiqueprofil/profilPro');
                        exit;
                    }
                    if (!empty($nom_existe)) {
                        // On a trouvé un résultat ce qui veut dire que le nom est déjà pris par une boutique de particulier
                        $_SESSION['erreur'] = "Ce nom est pris par une boutique de particulier";
                        header('location: ' . ACCUEIL . '/boutiqueprofil/profilPro');
                        exit;
                    }
                }
                // On hydrate l'objet
                $boutiquepro->setId($_SESSION['user']['id'])
                    ->setNom($nom)
                    ->setEmail($email)
                    ->setSiret($siret)
                    ->setPassword($password);
                // On modifie la boutique en BDD
                $boutiquepro->update();

                // On instancie la classe Adressepro
                $adress = new AdresseProModel;
                $adresse = $adress->findAdresse($_SESSION['user']['id']);
                $adresse_id = $adresse->id;
                unset($adresse);
                // On hydrate l'objet Adressepro
                $adress->setId($adresse_id)
                    ->setAdresse($adresse_post)
                    ->setCode($code)
                    ->setVille($ville)
                    ->setBoutique_id($_SESSION['user']['id']);
                // On modifie l'adresse en bdd 
                $adress->update();

                if (isset($_FILES['avatar']) and !empty($_FILES['avatar']['name'])) {
                    // Une photo à bien été mise dans le formulaire
                    //Taille max
                    $tailleMax = 2000000;
                    // Extensions valides
                    $extensionValides = ['jpg', 'jpeg', 'gif', 'png'];

                    if ($_FILES['avatar']['size'] <= $tailleMax) {
                        // La taille du fichier est bien inféreur à ce que l'on demande
                        // On vérifie l'extension
                        $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));

                        if (in_array($extensionUpload, $extensionValides)) {
                            // La taille et l'extension de la photo sont valides
                            // On recherche en BDD si une photo existe
                            $photo = new PhotoAvatarModel;
                            $photos = $photo->findBy(['boutique_pro_id' => $_SESSION['user']['id']]);
                            if (!empty($photos)) {
                                // Une photo de profil est déjà enregistrée
                                // On supprime la photo de profil enregistrée dans le fichier
                                $chemin_supp = 'public/img/boutique_pro/' . $photos[0]->photo;
                                unlink($chemin_supp);
                                // On supprime la photo de profil enregistrée dans la bdd
                                $photo->deletePhotoBoutique($_SESSION['user']['id']);
                                //Chemin et nom du fichier que l'on va enregistrer 
                                $chemin = 'public/img/boutique_pro/' . $_SESSION['user']['id'] . '.' . $extensionUpload;
                                // On enregistre le fichier grace à move et $resultat = false ou true
                                $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
                                if ($resultat) {
                                    // On hydrate l'objet
                                    $photo->setBoutique_pro_id($_SESSION['user']['id'])
                                        ->setPhoto($_SESSION['user']['id'] . '.' . $extensionUpload);
                                    // On crée insert la photo en BDD
                                    $photo->create();
                                } else {
                                    $_SESSION['erreur'] = "Erreur durant l'importation du fichier";
                                    header('location: ' . ACCUEIL . 'user/profil');
                                    exit;
                                }
                            } else {
                                // Pas de photo de profil enregistrée 
                                // Chemin et nom du fichier que l'on va enregistrer 
                                $chemin = 'public/img/boutique_pro/' . $_SESSION['user']['id'] . '.' . $extensionUpload;
                                // On enregistre le fichier grace à move et $resultat = false ou true
                                $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
                                if ($resultat) {
                                    // On hydrate l'objet
                                    $photo->setBoutique_pro_id($_SESSION['user']['id'])
                                        ->setPhoto($_SESSION['user']['id'] . '.' . $extensionUpload);
                                    // On crée la photo en BDD
                                    $photo->create();
                                    $_SESSION['success'] = "Profil modifié avec succes";
                                    header('location: ' . ACCUEIL . 'boutiqueAccueil/accueilPro');
                                    exit;
                                } else {
                                    $_SESSION['erreur'] = "Erreur durant l'importation du fichier";
                                    header('location: ' . ACCUEIL . 'boutiqueprofil/profilpro');
                                    exit;
                                }
                            }
                        } else {
                            $_SESSION['erreur'] = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
                            header('location: ' . ACCUEIL . 'boutiqueprofil/profilpro');
                            exit;
                        }
                    } else {
                        $_SESSION['erreur'] = "Votre photo de profil ne doit pas dépasser 2 mo";
                        header('location: ' . ACCUEIL . 'boutiqueprofil/profilpro');
                        exit;
                    }
                }
                $_SESSION['success'] = "Profil de la boutique modifié avec succes";
                header('location: ' . ACCUEIL . 'boutiqueaccueil/accueilpro');
                exit;
            }else {
                $_SESSION['erreur'] = "Mot de passe incorrect";
                header('location: ' . ACCUEIL . 'boutiqueprofil/profilpro');
                exit;
            }
        }

        $boutique = new BoutiqueProModel;
        
        $boutique = $boutique->find($_SESSION['user']['id']);
        $adresse = new AdresseProModel;
        $adresse = $adresse->findAdresse($_SESSION['user']['id']);
        $form = new Form;

        $form->debutForm('post', '#', ['enctype' => 'multipart/form-data'])
            ->ajoutLabelFor('avatar', 'Photo de la boutique')
            ->ajoutInput('file', 'avatar', ['id' => 'avatar', 'class' => 'form-control'])
            ->ajoutLabelFor('nom', 'Nom de la société')
            ->ajoutInput('text', 'nom', ['id' => 'nom', 'class' => 'form-control', 'value' => $boutique->nom, 'required' => true])
            ->ajoutLabelFor('email', 'E-mail')
            ->ajoutInput('email', 'email', ['id' => 'email', 'class' => 'form-control', 'value' => $boutique->email, 'required' => true])
            ->ajoutLabelFor('adresse', 'Adresse')
            ->ajoutInput('text', 'adresse', ['id' => 'adresse', 'class' => 'form-control', 'value' => $adresse->adresse, 'required' => true])
            ->ajoutLabelFor('code', 'Code postal')
            ->ajoutInput('number', 'code', ['id' => 'code', 'class' => 'form-control', 'value' => $adresse->code, 'required' => true])
            ->ajoutLabelFor('ville', 'Ville')
            ->ajoutInput('text', 'ville', ['id' => 'ville', 'class' => 'form-control', 'value' => $adresse->ville, 'required' => true])
            ->ajoutLabelFor('siret', 'Numéro Siret')
            ->ajoutInput('number', 'siret', ['id' => 'siret', 'class' => 'form-control', 'value' => $boutique->siret, 'required' => true])
            ->ajoutLabelFor('new_password', 'Modifier mon mot de passe?')
            ->ajoutInput('password', 'new_password', ['id' => 'new_password', 'class' => 'form-control'])
            ->ajoutLabelFor('password', 'Mot de passe')
            ->ajoutInput('password', 'password', ['id' => 'password', 'class' => 'form-control', 'required' => true])
            ->ajoutBouton('Valider les modifications', ['class' => 'btn btn-primary col-12'])
            ->finForm();

        $this->render('boutique_profil/profilpro', ['boutiqueprofil' => $form->create()]);
    }

    /**
     * Modifier le profil de la boutique de particulier
     *
     * @return void
     */
    public function profilParticulier()
    {
        if (Form::validate($_POST, ['nom'])) {
            $nom = strip_tags($_POST['nom']);

            // On instancie la class Boutiquepro, Boutiqueparticulier et user
            $boutiquepro = new BoutiqueProModel;
            $boutiquepar = new BoutiqueParticulierModel;

            // On vérifie que le nom de boutique n'a pas été changé
            $nom_exist = $boutiquepar->findBy(['nom_boutique' => $nom, 'id' => $_SESSION['user']['boutique_id']]);
            if (empty($nom_exist)) {
                // Pas trouvé le nom avec l'id de la boutique cela veut dire que le nom à été changé

                // On vérifie donc qu'il n'y a pas une autre boutique qui porte le meme nom
                $nom_exist = $boutiquepar->findBy(['nom_boutique' => $nom]);

                // On vérifie qu'une boutique de pro ne porte pas ce nom
                $nom_existe = $boutiquepro->findBy(['nom' => $nom]);

                if (empty($nom_exist and empty($nom_existe))) {
                    // Le nom n'est pas pris par boutique pro et boutique particulier
                    // On hydrate l'objet
                    $boutiquepar->setId($_SESSION['user']['boutique_id'])
                        ->setNom_boutique($nom);

                    // On modifie la boutique en BDD
                    $boutiquepar->update();
                } elseif (!empty($nom_existe)) {
                    // On a trouvé un résultat ce qui veut dire que le nom est déjà pris par une boutique de particulier
                    $_SESSION['erreur'] = "Ce nom est pris par une boutique de particulier";
                    header('location: ' . ACCUEIL . '/boutiqueprofil/profilPro');
                    exit;
                } else {
                    // On a trouvé un résultat ce qui veut dire que le nom est déjà pris par une autre boutique pro
                    $_SESSION['erreur'] = "Ce nom de société existe déjà";
                    header('location: ' . ACCUEIL . '/boutiqueprofil/profilPro');
                    exit;
                }
            }

            if (isset($_FILES['avatar']) and !empty($_FILES['avatar']['name'])) {
                // Une photo à bien été mise dans le formulaire
                //Taille max
                $tailleMax = 2000000;
                // Extensions valides
                $extensionValides = ['jpg', 'jpeg', 'gif', 'png'];

                if ($_FILES['avatar']['size'] <= $tailleMax) {
                    // La taille du fichier est bien inféreur à ce que l'on demande
                    // On vérifie l'extension
                    $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));

                    if (in_array($extensionUpload, $extensionValides)) {
                        // La taille et l'extension de la photo sont valides
                        // On recherche en BDD si une photo existe
                        $photo = new PhotoAvatarModel;
                        $photos = $photo->findBy(['boutique_particulier_id' => $_SESSION['user']['boutique_id']]);
                        if (!empty($photos)) {
                            // Une photo de profil est déjà enregistrée
                            // On supprime la photo de profil enregistrée dans le fichier
                            $chemin_supp = 'public/img/boutique_par/' . $photos[0]->photo;
                            unlink($chemin_supp);
                            // On supprime la photo de profil enregistrée dans la bdd
                            $photo->deletePhotoBoutiquePar($_SESSION['user']['boutique_id']);
                            //Chemin et nom du fichier que l'on va enregistrer 
                            $chemin = 'public/img/boutique_par/' . $_SESSION['user']['boutique_id'] . '.' . $extensionUpload;
                            // On enregistre le fichier grace à move et $resultat = false ou true
                            $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
                            if ($resultat) {
                                // On hydrate l'objet
                                $photo->setBoutique_particulier_id($_SESSION['user']['boutique_id'])
                                    ->setPhoto($_SESSION['user']['boutique_id'] . '.' . $extensionUpload);
                                // On crée insert la photo en BDD
                                $photo->create();
                            } else {
                                $_SESSION['erreur'] = "Erreur durant l'importation du fichier";
                                header('location: ' . ACCUEIL . 'boutiqueaccueil/accueilpar');
                                exit;
                            }
                        } else {
                            // Pas de photo de profil enregistrée 
                            // Chemin et nom du fichier que l'on va enregistrer 
                            $chemin = 'public/img/boutique_par/' . $_SESSION['user']['boutique_id'] . '.' . $extensionUpload;
                            // On enregistre le fichier grace à move et $resultat = false ou true
                            $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
                            if ($resultat) {
                                // On hydrate l'objet
                                $photo->setBoutique_particulier_id($_SESSION['user']['boutique_id'])
                                    ->setPhoto($_SESSION['user']['boutique_id'] . '.' . $extensionUpload);
                                // On crée la photo en BDD
                                $photo->create();
                                
                            } else {
                                $_SESSION['erreur'] = "Erreur durant l'importation du fichier";
                                header('location: ' . ACCUEIL . 'boutiqueprofil/profilparticulier');
                                exit;
                            }
                        }
                    } else {
                        $_SESSION['erreur'] = "Votre photo de profil doit être au format jpg, jpeg, gif ou png";
                        header('location: ' . ACCUEIL . 'boutiqueprofil/profilparticulier');
                        exit;
                    }
                } else {
                    $_SESSION['erreur'] = "Votre photo de profil ne doit pas dépasser 2 mo";
                    header('location: ' . ACCUEIL . 'boutiqueprofil/profilparticulier');
                    exit;
                }
            }
            $_SESSION['success'] = "Profil modifié avec succès";
            header('location: ' . ACCUEIL . 'boutiqueaccueil/accueilpar');
            exit;
        }
        $boutique = new BoutiqueParticulierModel;
        $boutique = $boutique->findBoutiqueById($_SESSION['user']['boutique_id']);
        $form = new Form;

        $form->debutForm('post', '#', ['enctype' => 'multipart/form-data'])
            ->ajoutLabelFor('avatar', 'photo de ma boutique')
            ->ajoutInput('file', 'avatar', ['id' => 'avatar', 'class' => 'form-control'])
            ->ajoutLabelFor('nom', 'Nom de ma boutique')
            ->ajoutInput('text', 'nom', ['id' => 'nom', 'class' => 'form-control', 'value' => $boutique->nom_boutique, 'required' => true])
            ->ajoutBouton('Valider les modifications', ['class' => 'btn btn-primary col-12'])
            ->finForm();

        $this->render('boutique_profil/profilpar', ['boutiqueprofil' => $form->create()]);
    }
}
