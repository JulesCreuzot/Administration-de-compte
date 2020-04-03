create table TypeCompte (
    typeCompte varchar(15) not null,
    primary key (typeCompte)
) engine = InnoDB;

create table Comptes (
    id int auto_increment,
    email varchar(255) unique not null,
    pswd varchar(255) not null,
    nom varchar(50),
    prenom varchar(50),
    pseudo varchar(15),
    description text,
    typeCompte varchar(15) not null default 'Visiteur',
    primary key (id),
    foreign key (typeCompte) references TypeCompte(typeCompte)
)engine = InnoDB;


-- insersion des données
insert into TypeCompte(typeCompte) values
                                          ('Administrateur'),
                                          ('Visiteur');

insert into Comptes(email, pswd, pseudo) values
                                             ('jules.creuzot@saint-remi.net', '1234', 'Luzko'),
                                             ('corentin.posson@saint-remi.net','1111', 'CorPos');

