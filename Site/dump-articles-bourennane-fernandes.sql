--
--DROP TABLES
--
DROP TABLE IF EXISTS langues CASCADE;
DROP TABLE IF EXISTS articles CASCADE;
DROP TABLE IF EXISTS laboratoires CASCADE;
DROP TABLE IF EXISTS auteur CASCADE;
DROP TABLE IF EXISTS administrateur CASCADE;
DROP TABLE IF EXISTS revue CASCADE;
DROP TABLE IF EXISTS comite CASCADE;
DROP TABLE IF EXISTS domaines CASCADE;
DROP TABLE IF EXISTS ecrit CASCADE;
DROP TABLE IF EXISTS cite CASCADE;
DROP TABLE IF EXISTS appartient CASCADE;
DROP TABLE IF EXISTS est_membre CASCADE;
DROP VIEW IF EXISTS statLab CASCADE;



---
--- Create table langues
---
CREATE TABLE langues(
    id_langue varchar(3) primary key,
    nom_langue varchar(20)
);

---
--- Create table laboratoires
---
CREATE TABLE laboratoires(
    id_labo char(6) primary key,
    lieu varchar(30) NOT NULL,
    adresse varchar(70) NOT NULL,
    ville varchar(40) NOT NULL,
    pays varchar(30) NOT NULL,
    nom_labo varchar(40) NOT NULL,
    site_web varchar(70)
);

---
--- Create table auteur
---
CREATE TABLE auteur(
    id_auteur char(5) primary key,
    nom varchar(30) NOT NULL,
    prenom varchar(30) NOT NULL,
    mail varchar(50) NOT NULL,
    tel varchar(16),
    site_perso varchar(70)
);

---
--- Create table administrateur
---
CREATE TABLE administrateur(
    identifiant varchar(20) primary key,
    mdp varchar(40) NOT NULL
);

---
--- Create table comite
---
CREATE TABLE comite(
    id_comite char(5) primary key,
    nom_comite varchar(30) NOT NULL,
    nb_membre int NOT NULL
);

---
--- Create table revue
---
CREATE TABLE revue(
    ref_revue char(5) primary key,
    nom_revue varchar(40) NOT NULL,
    URL_revue varchar(70),
    id_comite char(5) NOT NULL,
    FOREIGN KEY(id_comite) references comite(id_comite) ON DELETE CASCADE ON UPDATE CASCADE
);

---
--- Create table articles
---
CREATE TABLE articles(
    ref_article char(5) primary key,
    titre varchar(50) NOT NULL,
    nb_pages int NOT NULL,
    annee int NOT NULL,
    URL_article varchar(100),
    id_langue varchar(3) NOT NULL,
    ref_revue char(5) NOT NULL,
    numero int default -1,
    volume int default -1,
    FOREIGN KEY(ref_revue) references revue(ref_revue) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY(id_langue) references langues(id_langue) ON DELETE CASCADE ON UPDATE CASCADE
);

---
--- Create table domaine
---
CREATE TABLE domaines(
    id_domaine char(5) primary key,
    nom_domaine varchar(50) NOT NULL
);

---
--- Create table ecrit
---
CREATE TABLE ecrit(
    ref_article char(5),
    id_labo char(6),
    id_auteur char(5),
    primary key (ref_article, id_labo, id_auteur)
);

---
--- Create table cite
---
CREATE TABLE cite(
    ref_article1 char(5) references articles(ref_article) ON DELETE CASCADE ON UPDATE CASCADE,
    ref_article2 char(5) references articles(ref_article) ON DELETE CASCADE ON UPDATE CASCADE,
    primary key(ref_article1, ref_article2)
);

---
--- Create table appartient
---
CREATE TABLE appartient(
    ref_article char(5) references articles(ref_article) ON DELETE CASCADE ON UPDATE CASCADE,
    id_domaine char(5) references domaines(id_domaine) ON DELETE CASCADE ON UPDATE CASCADE,
    primary key (ref_article, id_domaine)
);

---
--- Create table est_membre
---
CREATE TABLE est_membre(
    id_auteur char(5) references auteur(id_auteur) ON DELETE CASCADE ON UPDATE CASCADE,
    id_comite char(5) references comite(id_comite) ON DELETE CASCADE ON UPDATE CASCADE,
    primary key (id_auteur, id_comite)
);

-- Constraint :
--ALTER TABLE ecrit
--ADD CONSTRAINT opportuniste CHECK (ecrit.id_auteur <> est_membre.id_auteur);

--
-- Create View statLab
--
CREATE VIEW statLab(id_labo, Moyenne_pubication_annuelle, Moyenne_citation) AS
(
	SELECT table_labo.id_labo, ROUND((sum(nb_article_annuel)/(max(table_labo.annee)-min(table_labo.annee))), 2) as Moyenne_pubication_annuelle, Moyenne_citation
    FROM
    (
    	SELECT id_labo, annee, ref_article, count(distinct ref_article) AS nb_article_annuel
    	FROM laboratoires NATURAL JOIN ecrit NATURAL JOIN articles
    	GROUP BY id_labo, annee, ref_article
    	ORDER BY id_labo
	) AS table_labo NATURAL JOIN
    (
        SELECT citations.id_labo,  ROUND(((nb_articles+0.0) / count(citations.id_labo)), 2)as Moyenne_citation
        FROM(
        SELECT DISTINCT id_labo, ref_article1, ref_article2
        FROM cite NATURAL JOIN articles NATURAL JOIN ecrit
        )as citations NATURAL JOIN
        (
        SELECT id_labo, count(id_labo) as nb_articles
        FROM ecrit
        GROUP BY id_labo
        ) as article_labo
        GROUP BY citations.id_labo, nb_articles
    ) as moy
	GROUP BY table_labo.id_labo, Moyenne_citation
);








---Filling table langues:
COPY langues FROM STDIN csv;
deu,allemand
eng,anglais
ara,arabe
bel,bielorusse
bul,bulgare
zho,chinois
kor,coreen
dan,danois
spa,espagnol
est,estonien
fra,francais
ell,grec
ind,indonesien
ita,italien
jpn,japonais
por,portugais
rus,russe
swe,suedois
vie,vietnamien
\.

--------------- Données fictives


---Filling table laboratoire:
COPY laboratoires FROM STDIN csv;
LAB001,Universite,5 bd Descartes,Champs sur Marne,France,Laboratoire d Informatique Gaspard-Monge,ligm.u-pem.fr
LAB002,Laboratoire,4 avenue Diderot,Neuilly sur Marne,France,Laboratoire de Physique Loic-Lanco,
\.


---Filling table Auteur:
COPY auteur FROM STDIN csv;
AU001,Chandler,Bazinet,ChandlerBazinet@gmail.com,06.95.11.55.69,chandler-bazinet.univ-test.fr
AU002,Royce,Vadnais,RoyceVadnais@gmail.com,06.03.03.96.02,royce-vadnais.univ-test.fr
AU003,Ninette,Bondy,NinetteBondy@outlook.com,07.15.73.83.07,ninette-bondy.univ-test.fr
AU004,Jonathan,H. Lowe,JonathanHLowe@gmail.com,801-393-8859,jonathan-hlowe.univ-test.fr
AU005,Jimmy,A. Armstrong,JimmyAArmstrong@gmail.com,860-461-5938,
AU006,Diogo,Martins Cardoso,DiogoMartinsCardoso@gmail.com,(81) 3725-6520,diogo-martins-cardoso.univ-test.fr
AU007,Julia,Freud,JuliaFreud@gmail.com,04821 47 32 44,
AU008,Stefan,Koeni,StefanKoenig@gmail.com,09324 67 12 95,
\.


---Filling table administrateur:
COPY administrateur FROM STDIN csv;
admin_niu,JeSuisUnMotDePasse
admin_handal,motdepasse123
\.


---Filling table comite:
COPY comite FROM STDIN csv;
CO001,Astra,3
CO002,Lottre,1
\.


---Filling table revue:
--(Vrai nom de revue mais contenu factice)
COPY revue FROM STDIN csv;
RV001,Chemical Reviews,chemicalreviews.org,CO001
RV002,Genes and Development,genes-and-development.com,CO001
RV003,Science,science-reviews.com,CO002
RV004,Sciences Eaux & Territoires,science-eaux-territoires.fr,CO002
\.


---Filling table articles:
COPY articles FROM STDIN csv;
AT001,Gravitation universelle,15,1999,https://www.latlmes.com/science/acceleration-de-coriolis-1,fra,RV002,16,2
AT002,Newton,9,1983,,eng,RV002,,
AT003,Anticorps,38,2017,,eng,RV003,2,4
AT004,Roca en el planeta Marte,14,2012,,spa,RV003,18,2
AT005,Intel CPU,7,2018,,deu,RV002,13,5
AT006,Vulcano Etna,11,2020,,ita,RV004,7,5
AT007,Python Upgrade,55,2021,,eng,RV003,21,2
\.


---Filling table domaine:
COPY domaines FROM STDIN csv;
DO001,Astronomie
DO002,Biologie
DO003,Biochimie
DO004,Chimie
DO005,Informatique
DO006,Physique
DO007,Sciences pharmaceutiques
DO008,Sciences de la Terre et de l Environnement
\.


---Filling table ecrit:
COPY ecrit FROM STDIN csv;
AT001,LAB001,AU003
AT001,LAB001,AU002
AT002,LAB001,AU002
AT003,LAB002,AU003
AT004,LAB002,AU005
AT006,LAB002,AU008
AT005,LAB002,AU006
AT006,LAB001,AU004
AT007,LAB001,AU006
\.


---Filling table cite:
COPY cite FROM STDIN csv;
AT001,AT006
AT007,AT004
\.


---Filling table appartient:
COPY appartient FROM STDIN csv;
AT001,DO006
AT001,DO001
AT002,DO006
AT003,DO002
AT003,DO007
AT003,DO003
AT004,DO008
AT005,DO005
AT006,DO008
AT007,DO005
\.


---Filling table est_membre:
COPY est_membre FROM STDIN csv;
AU002,CO001
AU004,CO001
AU005,CO001
AU008,CO002
\.
