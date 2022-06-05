create table projects (
                          project_id int(11) NOT NULL AUTO_INCREMENT,
                          name varchar(100) COLLATE utf8_polish_ci NOT NULL UNIQUE ,
                          description varchar(500) COLLATE utf8_polish_ci NOT NULL,
                          creation_date varchar(100) COLLATE utf8_polish_ci NOT NULL,
                          project_manager varchar(100) COLLATE utf8_polish_ci NOT NULL,
                          client_id int(11) NOT NULL,
                          FOREIGN KEY (client_id) REFERENCES clients(client_id),
                          PRIMARY KEY (project_id)
)