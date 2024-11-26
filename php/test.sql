-- Suppression des tables si elles existent
DROP TABLE IF EXISTS POSSEDER;
DROP TABLE IF EXISTS APPLIQUER;
DROP TABLE IF EXISTS ACTUALITE;
DROP TABLE IF EXISTS COMMANDE;
DROP TABLE IF EXISTS RESERVATION;
DROP TABLE IF EXISTS UTILISATEUR;
DROP TABLE IF EXISTS VETEMENT;
DROP TABLE IF EXISTS PRODUIT;
DROP TABLE IF EXISTS ROLE;
DROP TABLE IF EXISTS AGENDA;
DROP TABLE IF EXISTS GRADE;
DROP TABLE IF EXISTS EVENEMENT;
DROP TABLE IF EXISTS CODEPROMO;

-- Création des tables
CREATE TABLE CODEPROMO(
   idCode INT AUTO_INCREMENT,
   nomCode VARCHAR(50) NOT NULL,
   dateDebut DATE NOT NULL,
   dateFin DATE NOT NULL,
   pourcentCode FLOAT NOT NULL,
   conditionCode VARCHAR(250) NOT NULL,
   PRIMARY KEY(idCode)
);

CREATE TABLE EVENEMENT(
   idEvent INT AUTO_INCREMENT,
   titreEvent VARCHAR(250),
   descEvent VARCHAR(500),
   capaEvent INT NOT NULL,
   prixEvent FLOAT NOT NULL,
   lieuEvent VARCHAR(250) NOT NULL,
   imgEvent VARCHAR(500),
   dateEvent DATE NOT NULL,
   minRoleEvent INT NOT NULL,
   minGradeEvent INT,
   PRIMARY KEY(idEvent)
);

CREATE TABLE GRADE(
   idGrade INT AUTO_INCREMENT,
   nomGrade VARCHAR(7) NOT NULL,
   prixGrade FLOAT NOT NULL,
   descGrade VARCHAR(250) NOT NULL,
   PRIMARY KEY(idGrade),
   UNIQUE(nomGrade)
);

CREATE TABLE AGENDA(
   idTPAgenda VARCHAR(10),
   urlAgenda VARCHAR(525) NOT NULL,
   PRIMARY KEY(idTPAgenda)
);

CREATE TABLE ROLE(
   idRole INT AUTO_INCREMENT,
   nomRole VARCHAR(50) NOT NULL,
   PRIMARY KEY(idRole),
   UNIQUE(nomRole)
);

CREATE TABLE PRODUIT(
   idProd INT AUTO_INCREMENT,
   nomProd VARCHAR(50) NOT NULL,
   typeProd VARCHAR(50) NOT NULL,
   descProd VARCHAR(50),
   prixProd FLOAT NOT NULL,
   qtProd INT NOT NULL,
   imgProd VARCHAR(500),
   PRIMARY KEY(idProd)
);

CREATE TABLE VETEMENT(
   idVariationVetement INT AUTO_INCREMENT,
   idProd INT,
   couleurVetement VARCHAR(50) NOT NULL,
   tailleVetement VARCHAR(50) NOT NULL,
   PRIMARY KEY(idVariationVetement),
   FOREIGN KEY(idProd) REFERENCES PRODUIT(idProd)
);

CREATE TABLE UTILISATEUR(
   idUser INT AUTO_INCREMENT,
   nomUser VARCHAR(50) NOT NULL,
   prenomUser VARCHAR(50) NOT NULL,
   adrMailUser VARCHAR(80) NOT NULL,
   ppUser VARCHAR(500) NOT NULL,
   mdpUser VARCHAR(257) NOT NULL,
   idTPAgenda VARCHAR(10),
   idGrade INT,
   PRIMARY KEY(idUser),
   UNIQUE(adrMailUser),
   FOREIGN KEY(idTPAgenda) REFERENCES AGENDA(idTPAgenda),
   FOREIGN KEY(idGrade) REFERENCES GRADE(idGrade)
);

CREATE TABLE RESERVATION(
   idReservation INT AUTO_INCREMENT,
   idEvent INT NOT NULL,
   idUser INT NOT NULL,
   PRIMARY KEY(idReservation),
   FOREIGN KEY(idEvent) REFERENCES EVENEMENT(idEvent),
   FOREIGN KEY(idUser) REFERENCES UTILISATEUR(idUser)
);

CREATE TABLE COMMANDE(
   idCommande INT AUTO_INCREMENT,
   quantiteCommande INT NOT NULL,
   dateCommande DATETIME NOT NULL,
   etatCommande SMALLINT NOT NULL,
   idUser INT NOT NULL,
   idProd INT NOT NULL,
   PRIMARY KEY(idCommande),
   FOREIGN KEY(idUser) REFERENCES UTILISATEUR(idUser),
   FOREIGN KEY(idProd) REFERENCES PRODUIT(idProd)
);

CREATE TABLE ACTUALITE(
   idActualite INT AUTO_INCREMENT,
   titreActualite VARCHAR(50) NOT NULL,
   descActualite VARCHAR(500) NOT NULL,
   urlPhotoActualite VARCHAR(500),
   dateActualite DATETIME NOT NULL,
   idUser INT NOT NULL,
   PRIMARY KEY(idActualite),
   FOREIGN KEY(idUser) REFERENCES UTILISATEUR(idUser)
);

CREATE TABLE APPLIQUER(
   idProd INT,
   idCode INT,
   PRIMARY KEY(idProd, idCode),
   FOREIGN KEY(idProd) REFERENCES PRODUIT(idProd),
   FOREIGN KEY(idCode) REFERENCES CODEPROMO(idCode)
);

CREATE TABLE POSSEDER(
   idUser INT,
   idRole INT,
   dateAjout DATE,
   PRIMARY KEY(idUser, idRole),
   FOREIGN KEY(idUser) REFERENCES UTILISATEUR(idUser),
   FOREIGN KEY(idRole) REFERENCES ROLE(idRole)
);








-- Membre : 
-- Vérifier si le membre à le grade minimum nécessaire à l'inscription d'un événement
DROP VIEW IF EXISTS afficher_detail_commande;
CREATE VIEW afficher_detail_commande AS SELECT nomProd,couleurVetement,tailleVetement, quantiteCommande, dateCommande, etatCommande  FROM  VETEMENT RIGHT JOIN (PRODUIT JOIN(COMMANDE JOIN UTILISATEUR ON COMMANDE.idUser = UTILISATEUR.idUser) ON COMMANDE .idProd = PRODUIT.idProd)ON PRODUIT.idProd= VETEMENT.idProd WHERE UTILISATEUR.idUser=1;

SELECT * FROM afficher_detail_commande;


-- Afficher ligne par ligne les événements (rôle visiteur)
-- A l'aide d'un curseur parcout la table événement et l'affiche
DROP PROCEDURE IF EXISTS afficherEvenement;
DELIMITER $$
CREATE PROCEDURE afficherEvenement()
BEGIN
    DECLARE Var_titreEvent VARCHAR(50); 
    DECLARE Var_descEvent VARCHAR(500); 
    DECLARE Var_imgEvent VARCHAR(50); 
    DECLARE Var_dateEvent DATE; 
    DECLARE Var_minRoleEvent INT; 
    DECLARE Var_minGradeEvent INT;

    DECLARE loop_finished INT DEFAULT 0;

    DECLARE cursor_afficherEvenement CURSOR FOR 
        SELECT titreEvent, descEvent, imgEvent, dateEvent, minRoleEvent, minGradeEvent 
        FROM EVENEMENT;

    DECLARE CONTINUE HANDLER FOR NOT FOUND SET loop_finished = 1;

    OPEN cursor_afficherEvenement;

    FETCH cursor_afficherEvenement INTO Var_titreEvent, Var_descEvent, Var_imgEvent, Var_dateEvent, Var_minRoleEvent, Var_minGradeEvent;

    WHILE loop_finished = 0 DO
        SELECT 
            Var_titreEvent AS Titre, 
            Var_descEvent AS Description, 
            Var_imgEvent AS Image, 
            Var_dateEvent AS Date, 
            Var_minRoleEvent AS MinRole, 
            Var_minGradeEvent AS MinGrade;
        FETCH cursor_afficherEvenement INTO Var_titreEvent, Var_descEvent, Var_imgEvent, Var_dateEvent, Var_minRoleEvent, Var_minGradeEvent;
    END WHILE;
    CLOSE cursor_afficherEvenement;
END $$
DELIMITER ;

-- Afficher les évènements à une date précise ou entre deux dates
DELIMITER $$
DROP PROCEDURE IF EXISTS afficheEventDate$$
CREATE PROCEDURE afficheEventDate(
   IN dateDebut DATE,
   IN dateFin DATE
)
BEGIN
   IF dateFin IS NULL THEN
       SET dateFin = dateDebut;
   END IF;

   SELECT *
   FROM EVENEMENT
   WHERE dateEvent BETWEEN dateDebut AND dateFin;
END$$

DELIMITER ;
-- Vérifier si une adresse mail rentré par un visiteur n’est pas déjà connue dans la base de donnée pour l’inscription 
DELIMITER $$
DROP TRIGGER IF EXISTS CheckEmailExistsTrigger$$
CREATE TRIGGER CheckEmailExistsTrigger
BEFORE INSERT ON UTILISATEUR
FOR EACH ROW
BEGIN
    DECLARE existingEmailCount INT;

    -- Vérifier si l'adresse e-mail existe déjà
    SELECT COUNT(*) INTO existingEmailCount 
    FROM UTILISATEUR 
    WHERE adrMailUser = NEW.adrMailUser;

    IF existingEmailCount > 0 THEN
        SIGNAL SQLSTATE '45000' 
        SET MESSAGE_TEXT = 'L''adresse e-mail existe déjà dans la base de données.';
    ELSE
        -- Le déclencheur "BEFORE INSERT" continue si aucune erreur n'est signalée.
        SET @successMessage = 'Le compte a été créé avec succès';
    END IF;
END$$

DELIMITER ;
-- Administrateur:
-- Afficher les personnes avec les événements auquelles elles ont participées
DROP PROCEDURE IF EXISTS affiche_event;
DELIMITER $$
CREATE PROCEDURE affiche_event()
BEGIN
    DECLARE titre, nom, prenom, tp VARCHAR(100) ;
    DECLARE loop_finished INT DEFAULT 0;
    DECLARE cursor_affiche_event CURSOR FOR 
    SELECT titreEvent, nomUser, prenomUser, idTPAgenda  FROM EVENEMENT JOIN (RESERVATION JOIN UTILISATEUR ON RESERVATION.idUser = UTILISATEUR.idUser) ON RESERVATION.idEvent = EVENEMENT.idEvent;
    DECLARE CONTINUE HANDLER FOR NOT FOUND SET loop_finished=1;
    OPEN cursor_affiche_event;
    FETCH cursor_affiche_event INTO titre,nom, prenom, tp;
    WHILE loop_finished = 0 DO
        SELECT  titre,nom, prenom, tp;
        FETCH cursor_affiche_event INTO  titre,nom, prenom, tp;
    END WHILE;
    CLOSE cursor_affiche_event;
END $$
DELIMITER ;



-- Afficher les commandes par personne et une ligne = 1 produits avec son prix et prix remisé si article acheté avec le code promo
DROP PROCEDURE IF EXISTS afficheCommandeUser;

DELIMITER $$
CREATE PROCEDURE afficheCommandeUser(IN idUser INT)
BEGIN

DECLARE var_nomUser VARCHAR(50);
DECLARE var_prenomUser VARCHAR(50);
DECLARE var_idCommande INT;
DECLARE var_dateCommande DATETIME;
DECLARE var_idProduit INT;
DECLARE var_nomProduit VARCHAR(50);
DECLARE var_quantiteProduitCommande INT;
DECLARE var_prixProduit FLOAT;
DECLARE var_remisePromotion FLOAT;
DECLARE var_prixRemise FLOAT;
DECLARE var_etatCommande INT;
DECLARE var_idPromo INT;
DECLARE var_dateDebutPromo DATE;
DECLARE var_dateFinPromo DATE;
DECLARE var_ancienIdCommandeAjouter INT DEFAULT NULL;
DECLARE var_ancienIdProdAjouter INT DEFAULT NULL;

DECLARE loop_finished INT DEFAULT 0;

DECLARE cursor_commandesUse CURSOR FOR 
    SELECT nomUser, prenomUser, idCommande, dateCommande, C.idProd, nomProd, quantiteCommande, prixProd, pourcentCode, etatCommande, A.idCode, dateDebut, dateFin 
    FROM COMMANDE C 
    INNER JOIN UTILISATEUR U ON C.idUser=U.idUser
    INNER JOIN PRODUIT P ON C.idProd=P.idProd
    LEFT JOIN APPLIQUER A ON P.idProd=A.idProd
    LEFT JOIN CODEPROMO CP ON A.idCode=CP.idCode
    WHERE C.idUser=idUser
    ORDER BY dateCommande DESC;
                
DECLARE CONTINUE HANDLER FOR NOT FOUND SET loop_finished=1;
-- Crée une table temporaire pour stocker toutes les informations des commandes de l’utilisateur
CREATE TEMPORARY TABLE commandeUser (
    nomUser VARCHAR(50),
    prenomUser VARCHAR(50),
    idCommande INT,
    dateCommande DATETIME,
    idProduit INT,
    nomProduit VARCHAR(50),
    quantiteProduitCommande INT,
    prixProduit FLOAT,
    remisePromotion FLOAT,
    prixRemise FLOAT,
    idPromo INT,
    etatCommande INT
);
OPEN cursor_commandesUse;
FETCH cursor_commandesUse INTO var_nomUser, var_prenomUser, var_idCommande, var_dateCommande, var_idProduit, var_nomProduit, var_quantiteProduitCommande, var_prixProduit, var_remisePromotion, var_etatCommande, var_idPromo, var_dateDebutPromo, var_dateFinPromo;

WHILE loop_finished=0 DO
-- Regarde si le produit n’a pas de code promotionnel ou les codes ne sont pas valide lors de l’achat et défini les prix en fonctions du résultats
    IF var_dateDebutPromo IS NULL OR NOT (var_dateCommande BETWEEN var_dateDebutPromo AND var_dateFinPromo) THEN
        SET var_prixRemise = var_prixProduit;
        SET var_remisePromotion = 0.0;
    ELSE
        SET var_prixRemise = var_prixProduit * (1.0 - var_remisePromotion / 100);
    END IF;
    IF (var_idCommande<>var_ancienIdCommandeAjouter) OR (var_idProduit<>var_ancienIdProdAjouter) OR (var_ancienIdProdAjouter IS NULL) THEN        
        INSERT INTO commandeUser (nomUser, prenomUser, idCommande, dateCommande, idProduit, nomProduit, quantiteProduitCommande, prixProduit, remisePromotion, prixRemise, idPromo, etatCommande)
        VALUES (var_nomUser, var_prenomUser, var_idCommande, var_dateCommande, var_idProduit, var_nomProduit, var_quantiteProduitCommande, var_prixProduit, var_remisePromotion, var_prixRemise, var_idPromo, var_etatCommande);
        SET var_ancienIdCommandeAjouter = var_idCommande;
        SET var_ancienIdProdAjouter = var_idProduit;
    ELSEIF (var_dateCommande BETWEEN var_dateDebutPromo AND var_dateFinPromo) THEN
        UPDATE commandeUser 
        SET remisePromotion = var_remisePromotion, prixRemise = var_prixRemise 
        WHERE idCommande = var_idCommande AND idProduit = var_idProduit;
    END IF;
    FETCH cursor_commandesUse INTO var_nomUser, var_prenomUser, var_idCommande, var_dateCommande, var_idProduit, var_nomProduit, var_quantiteProduitCommande, var_prixProduit, var_remisePromotion, var_etatCommande, var_idPromo, var_dateDebutPromo, var_dateFinPromo;
END WHILE;
CLOSE cursor_commandesUse;
SELECT * FROM commandeUser;
END $$
DELIMITER ;

-- Si on souhaite supprimer un événement alors qu'il y a encore des réservations, on bloque l'action	
DROP TRIGGER IF EXISTS deleteEvent;
DELIMITER $$
CREATE TRIGGER deleteEvent 
BEFORE DELETE 
ON EVENEMENT
FOR EACH ROW 
BEGIN
	IF EXISTS (SELECT * FROM RESERVATION WHERE reservation.idEvent = OLD.idEvent) THEN 
    	SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'Il reste encore des réservations liées à cet événement. Vous ne pouvez pas le supprimer. La commande à été annulée';
	END IF;
END $$
DELIMITER ;

-- Voir les événements avec le nombre de participants
DROP VIEW IF EXISTS Vue_Evenements_Participants;
CREATE VIEW Vue_Evenements_Participants AS
SELECT E.lieuEvent, E.dateEvent, E.capaEvent, COUNT(R.idReservation) AS NbParticipants
FROM EVENEMENT E
LEFT JOIN RESERVATION R ON E.idEvent = R.idEvent
GROUP BY E.idEvent, E.lieuEvent, E.dateEvent, E.capaEvent;

-- Vérifier si le membre à le grade minimum nécessaire à l'inscription d'un événement
DROP PROCEDURE IF EXISTS checkEventReservation;
DELIMITER $$
CREATE PROCEDURE checkEventReservation(
IN p_idUser INT,
IN p_idEvent INT
)
BEGIN
DECLARE userGradeLevel INT;
DECLARE eventMinGradeLevel INT;
DECLARE userGradeId INT;
DECLARE eventName VARCHAR(250);
SELECT idGrade INTO userGradeId FROM UTILISATEUR WHERE idUser = p_idUser;
SELECT minGradeEvent INTO eventMinGradeLevel FROM EVENEMENT WHERE idEvent = p_idEvent;
IF userGradeId IS NULL THEN
SELECT 'L''utilisateur n''a pas de grade associé. Il ne peut pas réserver cet événement.';
ELSE IF userGradeId >= eventMinGradeLevel THEN
SELECT 'Le membre peut réserver l''événement: ';
INSERT INTO RESERVATION (idEvent, idUser)
VALUES ( p_idEvent, p_idUser);
ELSE
SELECT 'L''utilisateur n''a pas le grade suffisant pour s''inscrire à l''évenment';
END IF;
END IF;
END $$
DELIMITER ;

-- Appliquer une réduction de 10% sur tout les produits de la boutique pour les membres ayant un grade "diamand" identifiant 3
DROP PROCEDURE IF EXISTS AppliquerReductionDiamond;
DELIMITER $$

CREATE PROCEDURE AppliquerReductionDiamond()
BEGIN
DECLARE userId INT;
DECLARE gradeUser INT;
DECLARE curseur CURSOR FOR
SELECT idUser, idGrade FROM UTILISATEUR WHERE idGrade = 3;
DECLARE CONTINUE HANDLER FOR NOT FOUND SET userId = NULL;
OPEN curseur;
FETCH curseur INTO userId, gradeUser;
WHILE userId IS NOT NULL DO
UPDATE PRODUIT
SET prixProd = prixProd * 0.9;
FETCH curseur INTO userId, gradeUser;
END WHILE;
CLOSE curseur;
END$$
DELIMITER ;


-- Interdire l'inscription à un événement si les places disponibles est inférieur 0
DROP TRIGGER IF EXISTS inscriptionEvent;
DELIMITER $$
CREATE TRIGGER inscriptionEvent
BEFORE INSERT ON RESERVATION
FOR EACH ROW
BEGIN
DECLARE nbReservation INT;
DECLARE capacite INT;

SELECT COUNT(*) INTO nbReservation FROM RESERVATION WHERE RESERVATIOn.idEvent = NEW.idEvent;

SELECT capaEvent INTO capacite FROM EVENEMENT WHERE evenement.idEvent= NEW.idEvent;

IF (capacite- nbReservation)<=0 THEN
SIGNAL SQLSTATE '45000'
SET MESSAGE_TEXT = ' Capacité maximale atteinte pour cet événement, insertion annulée';
END IF;
END $$
DELIMITER ;


-- Filtrer les événements pour les membres ayant le grade gold

DROP VIEW IF EXISTS Vue_EvenementsAccessiblesParGrade;
CREATE VIEW Vue_EvenementsAccessiblesParGrade AS
SELECT G.nomGrade, E.lieuEvent, E.dateEvent, E.minGradeEvent
FROM GRADE G
INNER JOIN EVENEMENT E ON G.idGrade >= E.minGradeEvent
WHERE G.nomGrade = 'Gold';



INSERT INTO GRADE (nomGrade, prixGrade, descGrade) VALUES
('Silver', 25.0, 'Accès privilégié aux événements'),
('Gold', 50.0, 'Accès illimité aux événements'),
('Diamond', 200.0, 'Accès exclusif et cadeaux');


INSERT INTO AGENDA (idTPAgenda, urlAgenda) VALUES
('11A', 'https://agenda.univ.com/event1'),
('11B','https://agenda.univ.com/event2'),
('11C','https://agenda.univ.com/event3'),
('11D','https://agenda.univ.com/event4'),
('12A','https://agenda.univ.com/event5'),
('12B','https://agenda.univ.com/event6'),
('12C','https://agenda.univ.com/event7'),
('12D','https://agenda.univ.com/event8'),
('21A','https://agenda.univ.com/event9'),
('21B','https://agenda.univ.com/event10'),
('21C','https://agenda.univ.com/event11'),
('21D','https://agenda.univ.com/event12');

INSERT INTO ROLE (nomRole) VALUES
('Admin 1'),
('Admin 2'),
('Admin 3'),
('Membre'),
('Visiteur');


DELIMITER $$
DROP PROCEDURE IF EXISTS login$$
CREATE PROCEDURE login(
    IN mail VARCHAR(250),
    IN mdp VARCHAR(257))
BEGIN
    IF EXISTS (SELECT * FROM utilisateur WHERE adrMailUser = mail AND mdpUser = mdp) THEN
        SELECT nomUser, prenomUser, adrMailUser, idTPAgenda, ppUser, idGrade, idRole FROM utilisateur NATURAL JOIN POSSEDER WHERE adrMailUser = mail;
    ELSE
        SELECT True as Failed;
    END IF;
END$$
DELIMITER ;
/*call login("jean.dupont@gmail.com",123456);*/




DELIMITER $$
DROP PROCEDURE IF EXISTS changePwd$$
CREATE PROCEDURE changePwd(
    IN mail VARCHAR(250),
    IN mdp VARCHAR(250),
	IN newMdp VARCHAR(257))
BEGIN
    IF EXISTS (SELECT * FROM utilisateur WHERE adrMailUser = mail AND mdpUser = mdp) THEN
        UPDATE utilisateur set mdpUser=newMdp WHERE adrMailUser=mail AND mdpUser=mdp;
        SELECT 1 AS changePwdSuccess;
    ELSE
        SELECT 0 AS changePwdSuccess;
    END IF;
END$$
DELIMITER ;
/*call changePwd("jean.dupont@gmail.com",123456);*/

DELIMITER $$
DROP PROCEDURE IF EXISTS createUser$$
CREATE PROCEDURE createUser (
    IN p_nomUser VARCHAR(255),
    IN p_prenomUser VARCHAR(255),
    IN p_idTPAgenda VARCHAR(3),
    IN p_adrMailUser VARCHAR(255),
    IN p_mdpUser VARCHAR(255))
BEGIN

    IF NOT EXISTS (SELECT idUser FROM utilisateur WHERE adrMailUser=p_adrMailUser) THEN
        INSERT INTO utilisateur (nomUser, prenomUser, adrMailUser, ppUser, mdpUser, idTPAgenda, idGrade) VALUES (p_nomUser, p_prenomUser, p_adrMailUser, 'default.jpg', p_mdpUser, p_idTPAgenda, NULL);
        INSERT INTO POSSEDER (idUser, idRole, dateAjout) VALUES ((SELECT idUser FROM utilisateur WHERE adrMailUser=p_adrMailUser), 5, CURDATE());
        SELECT 1 AS insert_successfull;
    ELSE
        SELECT 0 AS insert_successfull;
    END IF;
END$$
DELIMITER ;
/*call createUser("tesdgrdgdt", "tesdrgdrt", "21A", "test14532@gmail.com", "$2y$10$/WdjsQ3ufADAT5cQBFb.65Z55u");*/