<?php

class GestionCategorie extends GestionBDD {
    public static function getLesCategorie(){
        return self::getLesTuples('categorie');
    }
}
