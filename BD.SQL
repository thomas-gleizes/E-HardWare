
Clients (idClient, nomClient, prenomClient, villeClient, adresseClient, nbProduitPanier, montantPanier)
Commandes (idCommande, dateCommande, idClient, nbProduit, montantCommande)
ListeCommander (idCommande, idPorduit, quantiteProduit)
Panier (idClient, idProduit, quantiteProduit)
Produits (refProduit, prix, nomMarque, stock, Url)

Alimentation (refAlim, nom, puissance, modularite)
CarteGraphique (refCG, chipset, memoire, nom)
CarteMere (refCM, nom, socket, format)
DisqueDur (refHDD, nom, capacite, interface, vitesseRotation)
Memoire (refMemoire, nom, type, capacite, frequence, cas, nbBarrette)
Pocesseur (refProco, nom, nbCoeur, socket, frequence)
SSD (redSSD, nom, capacite, interface)

----------------------------------------------------------------------------------------------------------------

SELECT p.idProduit, refProduit, prix
FROM Produits p
JOIN ListeCommander lc ON lc.idProduit = p.idProduit
JOIN Commandes c ON c.idCommande = lc.idCommande
JOIN Clients cl ON cl.idClient = c.idClient
WHERE prenomClient = 'Silver';

SELECT SUM (prix)
FROM Produits p 
JOIN ListeCommander lp ON lp.idProduit = p.refProduit
JOIN Commandes c ON c.idCommande = lp.idCommande
WHERE c.idCommande = 'C1'

SELECT nomMarque
FROM Produits
GROUP BY (nomMarque);

SELECT nom
FROM Produits
WHERE nom like '%var%';

SELECT refProduit, nom, nomMarque, prix, Url 
FROM Produits
WHERE stock > 0

SELECT nom, stock, prix
FROM Produits
WHERE refProduit = 'variable'

SELECT refProduit, nom, nomMarque, prix, Url  FROM Produits
WHERE stock > 0
ORDER BY RAND()
LIMIT 10



----------------------------------------------------------------------------------------------------

//INSERT
BEGIN
	DECLARE vprix int(11);
	
	SELECT prix INTO vprix
	FROM Produits
	WHERE refProduit = NEW.idProduit;

	UPDATE Commandes
	SET montantCommande = montantCommande + vprix * NEW.quantiteProduit, nbProduit = nbProduit + NEW.quantiteProduit;
	WHERE idCommande = NEW.idCommande;
END

//DELETE
BEGIN
	DECLARE vprix int(11);
	
	SELECT prix INTO vprix
	FROM Produits
	WHERE refProduit = OLD.idProduit;

	UPDATE Commandes
	SET montantCommande = montantCommande - vprix, nbProduit = nbProduit - NEW.quantiteProduit;
	WHERE idCommande = OLD.idCommande;
END

//UPDATE
BEGIN
	DECLARE vprix int(11);

	SELECT prix INTO vprix
	FROM Produits
	WHERE refProduit = NEW.idProduit;

	UPDATE Commandes
	SET montantCommande = montantCommande + vprix, nbProduit = nbProduit + NEW.quantiteProduit;
	WHERE idProduit = NEW.idProduit;
    
    SELECT prix INTO vprix
	FROM Produits
	WHERE refProduit = OLD.idProduit;
    
    UPDATE Commandes
	SET montantCommande = montantCommande - vprix, nbProduit = nbProduit - NEW.quantiteProduit;
	WHERE idCommande = OLD.idCommande;
END

//INSERT
BEGIN
	DECLARE vStock int (10);

	SELECT stock INTO vStock
	FROM Produits
	WHERE refProduit = NEW.idProduit;

	IF (vStock < quantiteProduit) THEN
		SIGNAL SQLSTATE '20001'
    	SET MESSAGE_TEXT = 'Stock dépasser';
	ELSE 
		UPDATE Produits
		SET stock = stock - NEW.quantiteProduit
		WHERE refProduit = NEW.idProduit;
	END IF;
END;

//DELETE
BEGIN
	UPDATE Produits
	SET stock = stock + OLD.quantiteProduit
	WHERE refProduit = OLD.idProduit;
END;

//UPDATE

BEGIN
	DECLARE vStock int (10);

	SELECT stock INTO vStock
	FROM Produits
	WHERE refProduit = NEW.idProduit;

	IF (vStock < NEW.quantiteProduit) THEN
		SIGNAL SQLSTATE '20001'
    	SET MESSAGE_TEXT = 'Stock dépasser';
	ELSE 
		UPDATE Produits
		SET stock = stock - NEW.quantiteProduit
		WHERE refProduit = NEW.idProduit;

		UPDATE Produits
		SET stock = stock + OLD.quantiteProduit
		WHERE refProduit = OLD.idProduit;
	END IF;
END;


----

BEGIN 
	DECLARE vprix int(11);
	
	SELECT prix INTO vprix
	FROM Produits
	WHERE refProduit = NEW.idProduit;

	UPDATE Clients
	SET montantPanier = montantPanier + vprix * NEW.quantitePorduit, nbProduitPanier = nbProduitPanier + NEW.quantitePorduit
	WHERE idClient = NEW.idClient;
END;

BEGIN
	DECLARE vprix int(11);
	
	SELECT prix INTO vprix
	FROM Produits
	WHERE refProduit = OLD.idProduit;

	UPDATE Clients
	SET montantPanier = montantPanier - vprix * OLD.quantitePorduit, nbProduitPanier = nbProduitPanier - OLD.quantitePorduit
	WHERE idClient = OLD.idClient;
END;


//UPDATE
BEGIN
	DECLARE vprix int(11);

	SELECT prix INTO vprix
	FROM Produits
	WHERE refProduit = NEW.idProduit;

	UPDATE Commandes
	SET montantPanier = montantPanier + vprix * NEW.quantitePorduit, nbProduitPanier = nbProduitPanier + NEW.quantitePorduit
	WHERE idClient = NEW.idClient;
    
    SELECT prix INTO vprix
	FROM Produits
	WHERE refProduit = OLD.idProduit;
    
    UPDATE Commandes
	SET montantPanier = montantPanier - vprix * NEW.quantitePorduit, nbProduitPanier = nbProduitPanier - NEW.quantitePorduit
	WHERE idClient = OLD.idClient;
END;


$marque c JOIN Produits p on p.refProduit = c.refProduit JOIN $categorie ca on p.refProduit = ca.refCM  where p.nom like %.$nom.%""


BEGIN
	DECLARE r int(5);
    DECLARE test int(1);
    
    WHILE test = 0 DO
    	SELECT ROUND( RAND() * 9999 ) INTO r;
        IF r >= 1000 THEN
        	SELECT COUNT (idClient) INTO test
            FROM Clients
            WHERE codeconfirmation = r;
        END IF;
	END WHILE;

	UPDATE Clients
    SET codeConfirmation = r
    WHERE idClient = NEW.idClient;
END
