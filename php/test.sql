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


call login("jean.dupont@gmail.com",123456);