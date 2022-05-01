create table Player(
    id int primary key AUTO_INCREMENT,
    email text,
    name text,
    password varchar(128),
    contact varchar(12),
    Xp int,
    level int,
    isActive bit
);