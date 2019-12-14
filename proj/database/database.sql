--
-- File generated with SQLiteStudio v3.2.1 on Thu Dec 5 23:21:27 2019
--
-- Text encoding used: System
--
PRAGMA foreign_keys = off;
BEGIN TRANSACTION;

-- Table: User
DROP TABLE IF EXISTS User;

CREATE TABLE User (
    username TEXT PRIMARY KEY,
    password TEXT NOT NULL,
    name     TEXT NOT NULL,
    email    TEXT NOT NULL
);

-- Table: Owner
DROP TABLE IF EXISTS Owner;

CREATE TABLE Owner (
    username TEXT PRIMARY KEY
                REFERENCES User (username) ON DELETE CASCADE
                                           MATCH [FULL]
                NOT NULL
);

-- Table: Tourist
DROP TABLE IF EXISTS Tourist;

CREATE TABLE Tourist (
    username TEXT PRIMARY KEY
                REFERENCES User (username) 
);

-- Table: Location
DROP TABLE IF EXISTS Location;

CREATE TABLE Location (
    id      INTEGER PRIMARY KEY,
    city    TEXT    NOT NULL,
    country TEXT    NOT NULL
);


-- Table: Place
DROP TABLE IF EXISTS Place;

CREATE TABLE Place (
    id          INTEGER PRIMARY KEY,
    title       TEXT    NOT NULL,
    price_day   FLOAT   NOT NULL,
    description TEXT,
    address     TEXT,
    location_id INTEGER REFERENCES Location (id),
    owner       TEXT    REFERENCES User (username) 
                        NOT NULL,
    capacity    INTEGER NOT NULL
);

-- Table: Reservation
DROP TABLE IF EXISTS Reservation;

CREATE TABLE Reservation (
    id          INTEGER  PRIMARY KEY,
    checkin     DATE     NOT NULL,
    checkout    DATE     NOT NULL,
    total_price INTEGER  NOT NULL,
    place_id    INTEGER  REFERENCES Place (id),
    tourist     TEXT    REFERENCES User (username) 
);


-- Table: Notification
DROP TABLE IF EXISTS Notification;

CREATE TABLE Notification (
    id          INTEGER PRIMARY KEY,
    type        TEXT    NOT NULL,
    description TEXT    NOT NULL,
    seen        INTEGER NOT NULL,
    date        DATE    NOT NULL,
    user        TEXT    REFERENCES User (username) 
);

-- Table: Photo
DROP TABLE IF EXISTS Photo;

CREATE TABLE Photo (
    id    INTEGER PRIMARY KEY,
    path  TEXT    NOT NULL
                  UNIQUE,
    user  TEXT    REFERENCES User,
    place INTEGER REFERENCES Place,
    CHECK ( (user IS NOT NULL AND 
             place IS NULL) OR 
            (user IS NULL AND 
             place IS NOT NULL) ) 
);

-- Table: Reply
DROP TABLE IF EXISTS Reply;

CREATE TABLE Reply (
    id     INTEGER PRIMARY KEY,
    reply  TEXT    NOT NULL,
    review INTEGER REFERENCES Review (id) 
);

-- Table: Review
DROP TABLE IF EXISTS Review;

CREATE TABLE Review (
    id          INTEGER PRIMARY KEY,
    rate        INTEGER CHECK (rate <= 5 AND 
                               rate >= 1) 
                        NOT NULL,
    comment     TEXT,
    reservation INTEGER REFERENCES Reservation (id) 
);

DROP TABLE IF EXISTS [Like];

CREATE TABLE [Like] (
    like_id  INTEGER PRIMARY KEY,
    username TEXT    REFERENCES User (username) ON DELETE CASCADE,
    place_id INTEGER REFERENCES Place (id) ON DELETE CASCADE
);


COMMIT TRANSACTION;
PRAGMA foreign_keys = on;
