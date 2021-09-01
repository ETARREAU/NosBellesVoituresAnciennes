CREATE DATABASE IF NOT EXISTS Voiture

/*Pour la version avec les liens*/
CREATE TABLE vehicule (
    id INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    idConstru INT NOT NULL,
    NomModèle VARCHAR(100),
    Année INT,
    lienImg VARCHAR(1000)
)

CREATE TABLE constructeurAuto (
    id INT UNSIGNED PRIMARY KEY NOT NULL AUTO_INCREMENT,
    NomConstru VARCHAR(100),
    description VARCHAR(1000),
    bio VARCHAR(10000),
    lienLogo VARCHAR(250)
)

ALTER TABLE Voiture.vehicule ADD CONSTRAINT FK_vehicule_constructeurAuto FOREIGN KEY(idConstru)
REFERENCES Voiture.constructeurAuto (id)
ON DELETE CASCADE

CREATE TABLE utilisateurs (
    id INT PRIMARY KEY NOT NULL AUTO_INCREMENT,
    pseudo VARCHAR(50),
    mdp VARCHAR(250),
    pouvoir INT
)

INSERT INTO constructeurAuto(id,NomConstru,description,bio,lienLogo)
VALUES
(1,'Bugatti','Bugatti Automobiles est un constructeur automobile français, aujourd\'hui filiale du groupe allemand Volkswagen AG.','Bugatti Automobiles est un constructeur automobile français, aujourd\'hui filiale du groupe allemand Volkswagen AG. Fondée en 1909 par le constructeur franco-italien Ettore Bugatti, l’entreprise est longtemps considérée comme pionnière dans le domaine de l’automobile et produit de luxueuses sportives de prestige marquées par l’adage cher à Ettore :« Rien n’est trop beau, rien n’est trop cher ».','img/Bugatti_logo.svg.png'),
(2, 'Delage', 'Delage est une marque automobile française, fondée en 1905 par Louis Delâge à Levallois-Perret, rachetée par Delahaye en 1935 et disparue en 1953.', 'Delage est une marque automobile française, fondée en 1905 par Louis Delâge à Levallois-Perret, rachetée par Delahaye en 1935 et disparue en 1953. En novembre 2019, l\'association « Les Amis de Delage » créée en 1956 et propriétaire de la marque Delage annonce la refondation de la société Delage Automobiles.','img/Delage_logo.svg.png'),
(3, 'Delahaye', 'Delahaye était un constructeur français d\'automobiles de luxe, de poids lourds et de véhicules d\'incendie, pionnier de l\'automobile','Delahaye était un constructeur français d\'automobiles de luxe, de poids lourds et de véhicules d\'incendie, pionnier de l\'automobile depuis 1895. La firme reprit Delage en 1935 puis disparut en 1954 rachetée par Hotchkiss.','img/Delhaye_logo.svg.png'),
(4, 'Avions Voisin', 'Avions Voisin est une marque française de fabriquant automobiles dérivant directement de la société créée par Charles et Gabriel Voisin.','Dès 1919, à la fin de la Première Guerre mondiale, la société se reconvertit dans la construction de voiture. Les automobiles sont majoritairement équipées de moteur type Knight sans soupape et produites a Issy-les-Moulineaux au sud-ouest de Paris. Une des réalisations marquantes de la jeune entreprise est la Laboratoire de 1923. Ce fut une des premières voitures à utiliser un châssis monocoque et une petite hélice pour actionner la pompe du circuit de refroidissement.','img/Voisin-logo.jpg'),
(5, 'Hotchkiss', 'Hotchkiss étaient des voitures de luxe construites entre 1903 et 1955 par la société française Hotchkiss et Cie à Saint-Denis, Paris. L\'insigne de la marque montrait une paire de canons croisés évoquant l\'histoire de la société en tant que fabricant d\'armes.', 'Une marque automobile célèbre en son temps, mais qui a disparu, comme bien d’autres. Cependant, Hotchkiss c’est davantage : des armes, le retour du Nouveau Monde dans la vieille Europe, des voitures particulières de standing, des camions et des véhicules militaires…','img/hotchkiss_logo.png'),
(6, 'Talbot','Talbot était un constructeur automobile français d\'origine anglaise. La branche française, devenue indépendante grâce à Anthony Lago, fut vendue à Simca en 1958. Rachetée par Peugeot à Chrysler Europe en 1978, la marque appartient depuis au Groupe PSA', 'Pour le profane une Talbot est souvent une voiture d’origine anglaise, et pas seulement en raison de la conduite à droite. Le nom lui-même semble d’origine anglaise. Talbot, étymologiquement est un nom d’origine germanique déformation de Talbald (tal = vallée + bald = audacieux). Alors, vouloir retracer l’histoire de la marque Talbot nécessite de vous parler un peu d’histoire.','img/logo-Talbot.png')

INSERT INTO vehicule (idConstru,NomModèle,Année,lienImg)
VALUES
(1,'Bugatti B73','1947','img/Bugatti-B73-1947.png'),
(1,'Bugatti type 28','1922','img/Bugatti-Type28-1922.png'),
(1,'Bugatti type 32','1923','img/Bugatti32-1923.png'),
(2,'Delage 1936','1936','img/Delage-1936.png'),
(2,'Delage DSD8','1930','img/DelageDSD8-1930.png'),
(2,'Delage HS','1938','img/Delage-HS-1938-2.png'),
(3,'Delahaye 135','1937','img/Delahaye-135-1937:1939.png'),
(3,'Delahaye 148','1947','img/Delahaye-148I-1947:1950.png'),
(3,'Delahaye 175','1947','img/Delahaye-175-1947.png'),
(4,'Voisin C28','1937','img/Voisin-C28-1937:1939.png'),
(4,'Voisin C15','1930','img/VoisinC15-1930-1931.png'),
(4,'Voisin C22','1931','img/VoisinC22-1931:1935.png'),
(5,'Hotchkiss 686','1936','img/Hotchkiss-686-1936:1949.png'),
(5,'Hotchkiss Anjou','1950','img/Hotchkiss-Anjou-1950:1954.png'),
(5,'Hotchkiss Gregoire','1950','img/HotchKiss-Gregoire-1950:1953(1).png'),
(6,'Talbot 129','1946','img/Talbot-129-1946.png'),
(6,'Talbot Baby','1951','img/Talbot-Baby-1951:1954.png'),
(6,'Talbot Sport','1955','img/Talbot-Sport-1955:1957.png')


INSERT INTO utilisateurs (pseudo,mdp,pouvoir)
VALUES
('SuperAdmin','$2y$10$6q4ALlynCXDmUKFx5UAwFuGj8C7Ix5mdXh.11gIW7q/Bsw8etI6Uu',2),
('EdgarT','$2y$10$l9GahwncFMYFpZHWOe/oce8CV3ncfC.k9nz45SP0UvUZZ.KvPKgQi',1)
