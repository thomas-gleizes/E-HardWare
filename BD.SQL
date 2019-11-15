


CREATE TRIGGER CalculerCommande AFTER INSERT ON ListeCommander 

DELIMITER
//
FOR EACH ROW

BEGIN
	DECLARE
	vprix NUMBER;
	
	SELECT prix INTO vprix
	FROM Produits
	WHERE idProduit = NEW.idProduit;

	UPDATE Commandes
	SET montantCommande = montantCommande + vprix, nbProduit = nbProduit + 1
	WHERE idProduit = NEW.idProduit;
END;

DELIMITER //
CREATE TRIGGER delCommande AFTER DELETE ON ListeCommander 


BEGIN
	DECLARE
	vprix int(11);
	
	SELECT prix INTO vprix
	FROM Produits
	WHERE idProduit = OLD.idProduit;

	UPDATE Commandes
	SET montantCommande = montantCommande - vprix * , nbProduit = nbProduit - 1
	WHERE idCommande = OLD.idCommande;
END;

BEGIN

	DECLARE
	v_stock int(20);
    
    SELECT Stock INTO v_stock
    FROM produits
    WHERE idProduit = NEW.idProduit;
    
    IF((NEW.quantiteProduit) < 0) THEN
    	SIGNAL SQLSTATE '20000' SET MESSAGE_TEXT = 'Il n y a pas assez de stock';
    ELSE 
    	UPDATE produits
        SET Stock = Stock
        WHERE idProduit = NEW.idProduit;
    END IF;
    
END



//


SELECT SUM prix 
FROM Produits p 
JOIN ListeCommander lp ON lp.idProduit = p.refProduit
WHERE lp.idCommande = 'C2';

SELECT COUNT (idPorduit)
FROM Produits p
JOIN ListeCommander lp ON lp.idProduit = p.refProduit
WHERE lp.idCommande = 'C2';

SELECT nom
FROM Produits
WHERE nom like '%var%';
