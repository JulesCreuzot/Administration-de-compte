<?php
/**
 * Classe Mail : envoi d'un mail
 * Version          : 2020.2
 * Date mise à jour : 03/05/2020
 * Auteur           : Guy Verghote
 * Remarque         : nécessite php 7.1
 */

class Mail
{
    // constante à definir dans l'application
    private static $serveur = "smtp.free.fr"; // adresse du serveur smtp à personnaliser
    private static $expediteur = "test"; // adresse de l'expéditeur à personnaliser

    // attribut
    private $destinataire; // adresse mail du destinataire
    private $objet;  // objet du mail
    private $contenu; // contenu du mail

    /**
     * Constructeur d'un objet Message à partir de trois paramètres
     *
     * @param int $contenu
     * @param string $objet
     * @param string $destinataire
     */
    public function __construct($objet, $contenu, $destinataire)
    {
        $this->destinataire = $destinataire;
        $this->objet = $objet;
        $this->contenu = $contenu;
    }

    // accesseur

    public function setContenu($contenu)
    {
        $this->contenu = $contenu;
    }

    public function setObjet($objet)
    {
        $this->objet = $objet;
    }

    public function setDestinataire($destinataire)
    {
        $this->destinataire = $destinataire;
    }

    // accesseur à porter classe

    public static function setExpediteur($expediteur)
    {
        self::$expediteur = $expediteur;
    }

    public static function setServeur($serveur)
    {
        self::$serveur = $serveur;
    }

    // méthode

    public function envoyer()
    {
        $serveur = self::$serveur;
        $expediteur = self::$expediteur;

        ini_set("SMTP", $serveur);
        ini_set("sendmail_from", $expediteur );

        $entete = "MIME-Version: 1.0\r\n";
        $entete .= "Content-type: text/html; charset=utf-8\n";
        $entete .= "Reply-to: $expediteur \r\n";
        $entete .= "From: $expediteur \r\n";




        $resultat = mail($this->destinataire, $this->objet, $this->contenu, $entete);
    }
}
