DELIMITER $$
DROP PROCEDURE IF EXISTS login$$
CREATE PROCEDURE login(
    IN mail VARCHAR(250),
    IN mdp VARCHAR(250))
BEGIN
    IF EXISTS (SELECT * FROM utilisateur WHERE adrMailUser = mail AND mdpUser = mdp) THEN
        SELECT 1 AS login_success;
    ELSE
        SELECT 0 AS login_success;
    END IF;
END$$
DELIMITER ;


/*call login("jean.dupont@gmail.com",123456);*/




DELIMITER $$
DROP PROCEDURE IF EXISTS changePwd$$
CREATE PROCEDURE changePwd(
    IN mail VARCHAR(250),
    IN mdp VARCHAR(250),
	IN newMdp VARCHAR(250))
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
        SELECT 1 AS insert_successfull;
    ELSE
        SELECT 0 AS insert_successfull;
    END IF;
END$$
DELIMITER ;  
/*call createUser("tesdgrdgdt", "tesdrgdrt", "21A", "test14532@gmail.com", "$2y$10$/WdjsQ3ufADAT5cQBFb.65Z55u");*/