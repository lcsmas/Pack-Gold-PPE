<?php

/**
 * Contient tous les services de gestion de la boutique
 */
class GestionNews extends GestionBDD {
        
    /**
     * Retourne la liste des catégorie
     * @return type Tableau d'objets
     */
    public static function getLesNews() {
        
        return self::getLesTuples('news');
    }           

    public static function genererClePrimaire(){
        
        return parent::getMaxChamp("idnews","news") + 1;
    }

    /**
     * Retourne un objet produit grâce à son ID
     * @param type $idProduit
     * @return type Un objet produit
     */
    public static function getProduitsByID($idProduit) {
        self::seConnecter();
        self::$request = "SELECT * FROM Produit WHERE id= :idProd";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$request);
        self::$pdoStResults->bindValue('idProd', $idProduit);
        self::$pdoStResults->execute();
        self::$result = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();

        return self::$result;
    }

    /**
     * Retourne le nombre de produits présent dans la base de données
     * @return type String
     */
    public static function getNbProduits() {
        self::seConnecter();
        self::$request = "SELECT Count(*) as nbProduits FROM Produit";

        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$request);
        self::$pdoStResults->execute();
        self::$result = self::$pdoStResults->fetch();

        self::$pdoStResults->closeCursor();

        return self::$result->nbProduits;
    }

    /**
     * Ajoute un produit à la BDD
     * @param type Nom du produit
     * @param type Description du produit
     * @param type Prix du produit
     * @param type Image du produit
     * @param type ID de la catégorie du produit
     */
    public static function ajouterNews($contenu, $titre, $date) {
        $news = (object) array(
            "idnews" => self::genererClePrimaire(),
            "contenu" => $contenu,
            "titre" => $titre,
            "date" => $date
        );
        parent::insertInTable($news, "news");
    }

    /**
     * Ajoute une catégorie à la BDD
     * @param type Libelle de la catégorie
     */
    public static function ajouterCategorie($libelleCateg) {
        self::seConnecter();

        self::$request = "INSERT INTO Categorie(libelle) values(:libelle)";
        self::$pdoStResults = self::$pdoCnxBase->prepare(self::$request);
        self::$pdoStResults->bindValue('libelle', $libelleCateg);
        self::$pdoStResults->execute();
    }

    /**
     * Modifie une catégorie de la BDD
     * @param type ID de la catégorie 
     * @param type libelle de la catégorie
     */
    public static function modifierCategorie($idCategorie, $libelleCateg) {
        self :: seConnecter();
        try {
            self::$request = "UPDATE Categorie SET libelle= :libelleCateg WHERE id= :idCateg";
            self::$pdoStResults = self::$pdoCnxBase->prepare(self::$request);
            self::$pdoStResults->bindValue('idCateg', $idCategorie);
            self::$pdoStResults->bindValue('libelleCateg', $libelleCateg);
            self::$pdoStResults->execute();
        } catch (Exception $ex) {
            echo 'Erreur : ' . $ex->getMessage();
        }
    }

    /**
     * Modifie un produit de la BDD
     * @param type ID du produit 
     * @param type Nom du produit
     * @param type Description du produit
     * @param type Prix du produit
     * @param type Image du produit 
     * @param type ID de la catégorie du produit 
     */
    public static function modifierProduit($id, $nom, $description, $prix, $image, $idCategorie) {
        self :: seConnecter();
        try {
            self::$request = "UPDATE Produit SET id= :id, nom=:nom, description= :description, prix= :prix, image= :image, idCategorie= :idCategorie WHERE id= :id";
            self::$pdoStResults = self::$pdoCnxBase->prepare(self::$request);
            self::$pdoStResults->bindValue('id', $id);
            self::$pdoStResults->bindValue('nom', $nom);
            self::$pdoStResults->bindValue('description', $description);
            self::$pdoStResults->bindValue('prix', $prix);
            self::$pdoStResults->bindValue('image', $image);
            self::$pdoStResults->bindValue('idCategorie', $idCategorie);
            self::$pdoStResults->execute();
        } catch (Exception $ex) {
            echo 'Erreur : ' . $ex->getMessage();
        }
    }

    /**
     * Supprime un produit de la BDD
     * @param type ID du produit
     */
    public static function deleteNews($idnews) {
        parent::deleteFromTable("news", "idnews = $idnews");
    }

    /**
     * Supprime une catégorie de la BDD
     * @param type ID de la catégorie
     */
    public static function deleteCategorie($id) {
        self::seConnecter();
        try {
            self::$request = "DELETE FROM Produit WHERE idCategorie= :id";
            self::$pdoStResults = self::$pdoCnxBase->prepare(self::$request);
            self::$pdoStResults->bindValue('id', $id);
            self::$pdoStResults->execute();

            self::$request = "DELETE FROM Categorie WHERE id= :id";
            self::$pdoStResults = self::$pdoCnxBase->prepare(self::$request);
            self::$pdoStResults->bindValue('id', $id);
            self::$pdoStResults->execute();
        } catch (Exception $ex) {
            echo 'Erreur : ' . $ex->getMessage();
        }
    }

    /**
     * Retourne tous les tuples de la table en paramètre
     * @param type Nom de la table dans la BDD
     * @return type Tous les tuples de la table
     */
    public static function getAllFrom($table) {
        self::seConnecter();
        try {
            self::$request = "SELECT * FROM " . $table;
            self::$pdoStResults = self::$pdoCnxBase->prepare(self::$request);
            self::$pdoStResults->execute();
            self::$result = self::$pdoStResults->fetchAll();

            self::$pdoStResults->closeCursor();

            return self::$result;
        } catch (Exception $ex) {
            echo 'Erreur : ' . $ex->getMessage();
        }
    }

    /**
     * Retourne le tuple correspondant a la valeur d'ID d'une table (id et table sont passés en paramètres
     * @param type Nom de la table
     * @param type ID de la table
     * @return type objet correspondant au tuple de la table
     */
    public static function getLeTupleTableByID($table, $id) {
        self::seConnecter();
        try {
            self::$request = "SELECT * FROM " . $table . " WHERE id=" . $id;
            self::$pdoStResults = self::$pdoCnxBase->prepare(self::$request);
            self::$pdoStResults->execute();
            self::$result = self::$pdoStResults->fetch();

            self::$pdoStResults->closeCursor();

            return self::$result;
        } catch (Exception $ex) {
            echo 'Erreur : ' . $ex->getMessage();
        }
    }

    public static function deleteTupleTableByID($table, $id) {
        self::seConnecter();
        try {
            self::$request = "DELETE FROM Produit WHERE id= :id";
            self::$pdoStResults = self::$pdoCnxBase->prepare(self::$request);
            self::$pdoStResults->bindValue('id', $id);
            self::$pdoStResults->execute();
        } catch (Exception $ex) {
            echo 'Erreur : ' . $ex->getMessage();
        }
    }

    public static function isAdminOK($login, $pass) {
        self::seConnecter();
        try 
        {
            self::$request = "SELECT * From utilisateur where pseudo=:login and passe=:pass";
            self::$pdoStResults = self::$pdoCnxBase->prepare(self::$request);
            self::$pdoStResults->bindValue('login', $login);
            self::$pdoStResults->bindValue('pass', sha1($pass));
            self::$pdoStResults->execute();
            self::$result = self::$pdoStResults->fetch();
            self::$pdoStResults->closeCursor();
            
            if ((self::$result != null) and self::$result->isAdmin) 
            {
                return true;
            } 
            else 
            {
                return false;
            }
        } 
        catch (Exception $exc) 
        {
            echo $exc->getMessage();
        }
    }

    // </editor-fold>
}

//Test des services (méthodes) de la classe ShopManagement
//-------------------------------------------------------


