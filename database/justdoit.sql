PRAGMA FOREIGN_KEYS = ON;
.mode columns
.headers on
.nullvalue NULL

DROP TABLE IF EXISTS User;
DROP TABLE IF EXISTS Team;
DROP TABLE IF EXISTS List;
DROP TABLE IF EXISTS Task;
DROP TABLE IF EXISTS TeamMember;

CREATE TABLE User (
  id INTEGER PRIMARY KEY,
  username TEXT UNIQUE,
  email TEXT UNIQUE,
  phoneNumber TEXT UNIQUE,
  country TEXT,
  fullName TEXT,
  birthDate DATE,
  passwordHash TEXT NOT NULL
);

CREATE TABLE Team (
  id INTEGER PRIMARY KEY,
  name TEXT UNIQUE
  --idUser INTEGER REFERENCES User(id)
);

CREATE TABLE TeamMember (
    idUser INTEGER REFERENCES User(id),
    idTeam INTEGER REFERENCES Team(id),
    accepted INTEGER NOT NULL,
    PRIMARY KEY(idUser, idTeam)
);

CREATE TABLE List (
  id INTEGER PRIMARY KEY,
  name TEXT UNIQUE,
  idGroup INTEGER REFERENCES Team(id)
);

CREATE TABLE Task (
  id INTEGER PRIMARY KEY,
  field TEXT NOT NULL,
  doneState INTEGER NOT NULL,
  idList INTEGER REFERENCES List(id)
);

-- Admin
INSERT INTO User(id, username, fullName, passwordHash) VALUES (1, "admin", "Administrator","$2a$04$CxozQsTaY1Vs0UvWGBa9Y.PGlz8lLkpYmP9NeA87M5kE11DoD3QFG");

INSERT INTO Team(id, name) VALUES (1, "Equipa do Admin");

INSERT INTO TeamMember(idUser, idTeam, accepted) VALUES (1, 1, 1);


INSERT INTO List(id, name, idGroup) VALUES (1, "Lista 1 do Admin", 1);
INSERT INTO List(id, name, idGroup) VALUES (2, "Lista 2 do Admin", 1);

INSERT INTO Task(id, field, doneState, idList) VALUES(1, "Task 1 da lista do Admin", 0, 1);
INSERT INTO Task(id, field, doneState, idList) VALUES(2, "Task 2 da lista do Admin", 1, 1);

INSERT INTO Task(id, field, doneState, idList) VALUES(3, "Task 1 da lista B do Admin", 1, 2);
INSERT INTO Task(id, field, doneState, idList) VALUES(4, "Task 2 da lista B do Admin", 2, 2);
