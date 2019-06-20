CREATE TABLE utenti(
    id int not null AUTO_INCREMENT primary key,
    nome varchar(50) not null,
    cognome varchar(50) not null,
    nickname varchar(50) not null,
    pwd varchar(255) not null,
    email varchar(50) not null
);

CREATE TABLE contenuti(
    id int not null AUTO_INCREMENT primary key,
    risorsa JSON not null
);

CREATE TABLE raccolte(
    id int not null AUTO_INCREMENT primary key,
    titolo varchar(255) not null,
    imgurl varchar(255) not null,
    idUtenti int not null,
    INDEX idxUtenti(idUtenti),
    FOREIGN KEY (idUtenti) REFERENCES utenti(id)

);

CREATE TABLE multimedia(
    id int not null AUTO_INCREMENT primary key,
    idContenuti int not null,
    idRaccolte int not null,
    INDEX idxContenuti(idContenuti),
    INDEX idxRaccolte(idRaccolte),
    FOREIGN KEY (idContenuti) REFERENCES contenuti(id),
    FOREIGN KEY (idRaccolte) REFERENCES raccolte(id)
);
