CREATE DATABASE objet;
USE objet;
CREATE TABLE membre (
    id_membre INT PRIMARY KEY AUTO_INCREMENT,
    nom VARCHAR(100) NOT NULL,
    date_naissance DATE NOT NULL,
    genre VARCHAR(20),
    email VARCHAR(100) UNIQUE NOT NULL,
    ville VARCHAR(100),
    mdp VARCHAR(255) NOT NULL,
    image_profil VARCHAR(255)
);

CREATE TABLE categorie_object (
    id_categorie INT PRIMARY KEY AUTO_INCREMENT,
    nom_categorie VARCHAR(50) NOT NULL
);

CREATE TABLE objet (
    id_object INT PRIMARY KEY AUTO_INCREMENT,
    nom_object VARCHAR(100) NOT NULL,
    id_categorie INT NOT NULL,
    id_membre INT NOT NULL,
    FOREIGN KEY (id_categorie) REFERENCES categorie_object(id_categorie),
    FOREIGN KEY (id_membre) REFERENCES membre(id_membre)
);

CREATE TABLE images_object (
    id_image INT PRIMARY KEY AUTO_INCREMENT,
    id_object INT NOT NULL,
    nom_image VARCHAR(255) NOT NULL,
    FOREIGN KEY (id_object) REFERENCES objet(id_object)
);

CREATE TABLE emprunt (
    id_emprunt INT PRIMARY KEY AUTO_INCREMENT,
    id_object INT NOT NULL,
    id_membre INT NOT NULL,
    date_emprunt DATE NOT NULL,
    date_retour DATE,
    FOREIGN KEY (id_object) REFERENCES objet(id_object),
    FOREIGN KEY (id_membre) REFERENCES membre(id_membre)
);

INSERT INTO membre (nom, date_naissance, genre, email, ville, mdp) VALUES
('Jean Dupont', '1985-05-15', 'Homme', 'jean.dupont@email.com', 'Paris', 'motdepasse1'),
('Marie Martin', '1990-08-22', 'Femme', 'marie.martin@email.com', 'Lyon', 'motdepasse2'),
('Pierre Durand', '1978-03-10', 'Homme', 'pierre.durand@email.com', 'Marseille', 'motdepasse3'),
('Sophie Lambert', '1995-11-30', 'Femme', 'sophie.lambert@email.com', 'Bordeaux', 'motdepasse4');

INSERT INTO categorie_object (nom_categorie) VALUES
('esthétique'),
('bricolage'),
('mécanique'),
('cuisine');

INSERT INTO objet (nom_object, id_categorie, id_membre) VALUES
('Perceuse', 2, 1),
('Ponceuse', 2, 1),
('Tondeuse à gazon', 3, 1),
('Set de tournevis', 2, 1),
('Mixeur', 4, 1),
('Sèche-cheveux', 1, 1),
('Pince à épiler', 1, 1),
('Casserole', 4, 1),
('Clé à molette', 3, 1),
('Marteau', 2, 1);

INSERT INTO objet (nom_object, id_categorie, id_membre) VALUES
('Robot cuiseur', 4, 2),
('Pinceau maquillage', 1, 2),
('Scie sauteuse', 2, 2),
('Fer à lisser', 1, 2),
('Coffret à outils', 2, 2),
('Plaque chauffante', 4, 2),
('Pince coupante', 2, 2),
('Balance de cuisine', 4, 2),
('Pince à sourcils', 1, 2),
('Pistolet à colle', 2, 2);

INSERT INTO objet (nom_object, id_categorie, id_membre) VALUES
('Cric hydraulique', 3, 3),
('Set de maquillage', 1, 3),
('Fouet électrique', 4, 3),
('Clé à pipe', 3, 3),
('Pistolet à peinture', 2, 3),
('Mixeur plongeant', 4, 3),
('Épilateur', 1, 3),
('Scie circulaire', 2, 3),
('Boîte à outils', 2, 3),
('Pince multifonction', 2, 3);

INSERT INTO objet (nom_object, id_categorie, id_membre) VALUES
('Machine à pain', 4, 4),
('Lisseur', 1, 4),
('Défroisseur vapeur', 1, 4),
('Plaque induction', 4, 4),
('Valise à outils', 2, 4),
('Pince monseigneur', 2, 4),
('Balance électronique', 4, 4),
('Trousse de maquillage', 1, 4),
('Fer à souder', 2, 4),
('Pince à sertir', 2, 4);

INSERT INTO emprunt (id_object, id_membre, date_emprunt, date_retour) VALUES
(1, 2, '2023-01-10', '2023-01-20'),
(5, 3, '2023-02-15', '2023-02-25'),
(12, 1, '2023-03-05', NULL),
(18, 4, '2023-04-10', '2023-04-20'),
(22, 1, '2023-05-12', '2023-05-22'),
(27, 2, '2023-06-08', NULL),
(33, 1, '2023-07-20', '2023-07-30'),
(38, 3, '2023-08-15', NULL),
(7, 4, '2023-09-10', '2023-09-20'),
(15, 2, '2023-10-05', '2023-10-15');

CREATE or replace view v_liste_objet as
SELECT co.nom_categorie, o.*, e.date_retour from objet as o JOIN emprunt as e on o.id_object = e.id_object JOIN categorie_object as  co on co.id_categorie = o.id_categorie;


CREATE OR REPLACE VIEW v_liste_objet AS
SELECT 
    o.id_object,
    o.nom_object,
    o.id_categorie,
    o.id_membre,
    co.nom_categorie,
    MAX(e.date_retour) AS date_retour,
    (SELECT nom_image FROM images_object WHERE id_object = o.id_object LIMIT 1) AS image_principale
FROM 
    objet o
JOIN 
    categorie_object co ON co.id_categorie = o.id_categorie
LEFT JOIN 
    emprunt e ON o.id_object = e.id_object
GROUP BY 
    o.id_object;