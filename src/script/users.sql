create table users (
    id int(11) NOT NULL AUTO_INCREMENT,
    username varchar(100) COLLATE utf8_polish_ci NOT NULL ,
    user_role int(11) COLLATE utf8_polish_ci NOT NULL ,
    surname varchar(100) COLLATE utf8_polish_ci NOT NULL,
    login varchar(100) COLLATE utf8_polish_ci NOT NULL UNIQUE,
    email varchar(100) COLLATE utf8_polish_ci NOT NULL UNIQUE,
    password varchar(255) COLLATE utf8_polish_ci NOT NULL,
    PRIMARY KEY (id)
)
