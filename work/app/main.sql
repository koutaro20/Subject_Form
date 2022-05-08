CREATE TABLE form (
    id INT NOT NULL AUTO_INCREMENT,
    lastname VARCHAR(20),
    firstname VARCHAR(20),
    mailaddress VARCHAR(256),
    PRIMARY KEY (id)
);

INSERT INTO form (lastname) VALUES ('komori');
INSERT INTO form (lastname) VALUES ('koutaro');
INSERT INTO form (lastname) VALUES ('kouki');

SELECT * FROM form;
    