DROP TABLE IF EXISTS User;
CREATE TABLE User (
    username TEXT PRIMARY KEY,
    password TEXT NOT NULL,
    name     TEXT NOT NULL,
    email    TEXT NOT NULL
);

DROP TABLE IF EXISTS Owner;
CREATE TABLE Owner(
    username TEXT PRIMARY KEY 
                  REFERENCES User(username)
);

DROP TABLE IF EXISTS Tourist;
CREATE TABLE Tourist(
    username TEXT PRIMARY KEY 
                  REFERENCES User(username)
);

DROP TABLE IF EXISTS Location;
CREATE TABLE Location(
    id      INTEGER PRIMARY KEY,
    city    TEXT NOT NULL,
    country TEXT NOT NULL
);

DROP TABLE IF EXISTS Place;
CREATE TABLE Place(
    id              INTEGER PRIMARY KEY,
    title           TEXT NOT NULL,
    price_day       FLOAT NOT NULL,
    description     TEXT,
    address         TEXT,
    location_id     INTEGER REFERENCES Location(id)
);


DROP TABLE IF EXISTS Notification;
CREATE TABLE Notification(
    id          INTEGER PRIMARY KEY,
    type        TEXT    NOT NULL,
    description TEXT    NOT NULL,
    seen        INTEGER NOT NULL,
    date        DATE    NOT NULL,
    user        TEXT    REFERENCES User(username)
);

DROP TABLE IF EXISTS Reservation;
CREATE TABLE Reservation (
    id          INTEGER  PRIMARY KEY,
    date        DATE     NOT NULL,
    duration    DATETIME NOT NULL,
    total_price INTEGER  NOT NULL,
    place_id    INTEGER  REFERENCES Place(id),
    tourist     TEXT     REFERENCES Tourist(username)
);





