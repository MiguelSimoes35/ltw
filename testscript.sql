--
-- File generated with SQLiteStudio v3.2.1 on sex dez 20 06:07:32 2019
--
-- Text encoding used: System
--
PRAGMA foreign_keys = off;

-- Table: User
CREATE TABLE User (
    username TEXT PRIMARY KEY,
    password TEXT NOT NULL,
    name     TEXT NOT NULL,
    email    TEXT NOT NULL
);
INSERT INTO User (username, password, name, email) VALUES ('thegoat', '$2y$10$cgZL0f30Gl4sQ7zEXt90qOEzl/Yus5.9fq9yZin4tCwW4aKGiDWny', 'LeBron James', 'lj23@lalakers.com');
INSERT INTO User (username, password, name, email) VALUES ('toy', '$2y$10$zxYw8NsoBP9dKLXnDzzalO4QLfK6eGTFvAjXMTZZL5i5KrGzovNbe', 'Toy Ferrao Oficial', 'toyferraooficial@gmail.com');
INSERT INTO User (username, password, name, email) VALUES ('lapulga', '$2y$10$X8zb2TRGL3m.zM10PfAnmO4wU0OM.Km6I.XGw0MJDbTOVaCukwCj6', 'Leo Messi', 'leomessi@barcelonafc.com');
INSERT INTO User (username, password, name, email) VALUES ('presidente', '$2y$10$zpFzOVunf8r87xIpj.QScuyOYrwYyYjVdp2i0ld8Oz2hI6mdRgNJK', 'Pinto da Costa', 'jnpc@fcp.pt');

-- Table: Location
CREATE TABLE Location (
    id      INTEGER PRIMARY KEY,
    city    TEXT    NOT NULL,
    country TEXT    NOT NULL
);
INSERT INTO Location (id, city, country) VALUES (1, 'Porto', 'Portugal');
INSERT INTO Location (id, city, country) VALUES (2, 'Braga', 'Portugal');
INSERT INTO Location (id, city, country) VALUES (3, 'Lisboa', 'Portugal');
INSERT INTO Location (id, city, country) VALUES (4, 'Braganca', 'Portugal');
INSERT INTO Location (id, city, country) VALUES (5, 'Barcelos', 'Portugal');
INSERT INTO Location (id, city, country) VALUES (6, 'Cascais', 'Portugal');
INSERT INTO Location (id, city, country) VALUES (7, 'Vilamoura', 'Portugal');
INSERT INTO Location (id, city, country) VALUES (8, 'Barcelona', 'Spain');
INSERT INTO Location (id, city, country) VALUES (9, 'Madrid', 'Spain');
INSERT INTO Location (id, city, country) VALUES (10, 'Vigo', 'Spain');
INSERT INTO Location (id, city, country) VALUES (11, 'Washington', 'USA');
INSERT INTO Location (id, city, country) VALUES (12, 'Los Angeles', 'USA');

-- Table: Place
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
INSERT INTO Place (id, title, price_day, description, address, location_id, owner, capacity) VALUES (1, 'All Star Arena', 300.0, 'House with a Basketball Court', 'LeBron Road', 12, 'thegoat', 10);
INSERT INTO Place (id, title, price_day, description, address, location_id, owner, capacity) VALUES (2, 'Arraial Popular', 450.0, 'Festas com boa musica', 'Bairro da Aldeia', 6, 'toy', 30);
INSERT INTO Place (id, title, price_day, description, address, location_id, owner, capacity) VALUES (3, 'Place for Champions', 250.0, 'House for the great players', 'La Masia', 8, 'lapulga', 5);
INSERT INTO Place (id, title, price_day, description, address, location_id, owner, capacity) VALUES (4, 'Escape House', 180.0, 'The perfect House for that escape you need sometimes', 'Center Street', 10, 'lapulga', 2);
INSERT INTO Place (id, title, price_day, description, address, location_id, owner, capacity) VALUES (5, 'Estadio das Antas', 800000.0, 'Estadio para milhares de pessoas e ate fruta vendemos na entrada', 'Antas Street', 1, 'presidente', 40000);
INSERT INTO Place (id, title, price_day, description, address, location_id, owner, capacity) VALUES (6, 'Just for Holidays', 150.0, 'House to Rent just in holidays season', 'Avenida dos Aliados', 1, 'presidente', 2);

-- Table: Photo
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
INSERT INTO Photo (id, path, user, place) VALUES (1, '../resources/users/thegoat', 'thegoat', NULL);
INSERT INTO Photo (id, path, user, place) VALUES (2, '../resources/places/1/0.jpg', NULL, 1);
INSERT INTO Photo (id, path, user, place) VALUES (3, '../resources/users/toy', 'toy', NULL);
INSERT INTO Photo (id, path, user, place) VALUES (4, '../resources/places/2/0.jpg', NULL, 2);
INSERT INTO Photo (id, path, user, place) VALUES (5, '../resources/users/lapulga', 'lapulga', NULL);
INSERT INTO Photo (id, path, user, place) VALUES (6, '../resources/places/3/0.jpg', NULL, 3);
INSERT INTO Photo (id, path, user, place) VALUES (7, '../resources/places/4/0.jpg', NULL, 4);
INSERT INTO Photo (id, path, user, place) VALUES (8, '../resources/users/presidente', 'presidente', NULL);
INSERT INTO Photo (id, path, user, place) VALUES (9, '../resources/places/5/0.jpg', NULL, 5);
INSERT INTO Photo (id, path, user, place) VALUES (10, '../resources/places/6/0.jpg', NULL, 6);

-- Table: Reservation
CREATE TABLE Reservation (
    id          INTEGER  PRIMARY KEY,
    checkin     DATE     NOT NULL,
    checkout    DATE     NOT NULL,
    total_price INTEGER  NOT NULL,
    place_id    INTEGER  REFERENCES Place (id),
    tourist     TEXT    REFERENCES User (username) 
);
INSERT INTO Reservation (id, checkin, checkout, total_price, place_id, tourist) VALUES (1, '2020-01-24', '2020-01-26', 600, 1, 'toy');
INSERT INTO Reservation (id, checkin, checkout, total_price, place_id, tourist) VALUES (2, '2019-12-30', '2020-01-04', 1500, 1, 'lapulga');
INSERT INTO Reservation (id, checkin, checkout, total_price, place_id, tourist) VALUES (3, '2020-04-08', '2020-04-15', 1260, 4, 'presidente');
INSERT INTO Reservation (id, checkin, checkout, total_price, place_id, tourist) VALUES (4, '2020-07-22', '2020-08-01', 1800, 4, 'presidente');
INSERT INTO Reservation (id, checkin, checkout, total_price, place_id, tourist) VALUES (5, '2019-05-16', '2019-05-20', 1000, 3, 'thegoat');
INSERT INTO Reservation (id, checkin, checkout, total_price, place_id, tourist) VALUES (6, '2019-12-30', '2020-01-04', 1250, 3, 'thegoat');
INSERT INTO Reservation (id, checkin, checkout, total_price, place_id, tourist) VALUES (7, '2019-02-15', '2019-02-25', 1800, 4, 'presidente');

-- Table: Like
CREATE TABLE [Like] (
    like_id  INTEGER PRIMARY KEY,
    username TEXT    REFERENCES User (username) ON DELETE CASCADE,
    place_id INTEGER REFERENCES Place (id) ON DELETE CASCADE
);
INSERT INTO "Like" (like_id, username, place_id) VALUES (1, 'toy', 1);
INSERT INTO "Like" (like_id, username, place_id) VALUES (2, 'lapulga', 1);
INSERT INTO "Like" (like_id, username, place_id) VALUES (3, 'presidente', 5);
INSERT INTO "Like" (like_id, username, place_id) VALUES (4, 'presidente', 4);
INSERT INTO "Like" (like_id, username, place_id) VALUES (5, 'thegoat', 3);


-- Table: Review
CREATE TABLE Review (
    id          INTEGER PRIMARY KEY,
    rate        INTEGER CHECK (rate <= 5 AND 
                               rate >= 1) 
                        NOT NULL,
    comment     TEXT,
    reservation INTEGER REFERENCES Reservation (id) 
);
INSERT INTO Review (id, rate, comment, reservation) VALUES (1, 5, 'Your place is fire bro, I loved every second of it.', 5);
INSERT INTO Review (id, rate, comment, reservation) VALUES (2, 4, 'Ainda bem que a policia n�o me apanhou. Obrigado amigos', 7);

-- Table: Notification
CREATE TABLE Notification (
    id          INTEGER PRIMARY KEY,
    type        TEXT    NOT NULL,
    description TEXT    NOT NULL,
    seen        INTEGER NOT NULL,
    date        DATE    NOT NULL,
    user        TEXT    REFERENCES User (username) 
);
INSERT INTO Notification (id, type, description, seen, date, user) VALUES (1, 'New Place Added!', 'You just added a new place called All Star Arena', 'yes', '2019-12-20', 'thegoat');
INSERT INTO Notification (id, type, description, seen, date, user) VALUES (2, 'New Reservation!', 'toy made a new reservation for your place All Star Arena', 'yes', '2019-12-20', 'thegoat');
INSERT INTO Notification (id, type, description, seen, date, user) VALUES (3, 'New Place Added!', 'You just added a new place called Arraial Popular', 'no', '2019-12-20', 'toy');
INSERT INTO Notification (id, type, description, seen, date, user) VALUES (4, 'New Place Added!', 'You just added a new place called Barcelona for Champions', 'no', '2019-12-20', 'lapulga');
INSERT INTO Notification (id, type, description, seen, date, user) VALUES (5, 'New Place Added!', 'You just added a new place called Escape House', 'no', '2019-12-20', 'lapulga');
INSERT INTO Notification (id, type, description, seen, date, user) VALUES (6, 'New Reservation!', 'lapulga made a new reservation for your place All Star Arena', 'yes', '2019-12-20', 'thegoat');
INSERT INTO Notification (id, type, description, seen, date, user) VALUES (7, 'New Reservation!', 'presidente made a new reservation for your place Escape House', 'no', '2019-12-20', 'lapulga');
INSERT INTO Notification (id, type, description, seen, date, user) VALUES (8, 'New Reservation!', 'presidente made a new reservation for your place Escape House', 'no', '2019-12-20', 'lapulga');
INSERT INTO Notification (id, type, description, seen, date, user) VALUES (9, 'New Place Added!', 'You just added a new place called Estadio das Antas', 'yes', '2019-12-20', 'presidente');
INSERT INTO Notification (id, type, description, seen, date, user) VALUES (10, 'New Place Added!', 'You just added a new place called Goat Mansion', 'yes', '2019-12-20', 'thegoat');
INSERT INTO Notification (id, type, description, seen, date, user) VALUES (11, 'New Reservation!', 'thegoat made a new reservation for your place Place for Champions', 'yes', '2019-04-20', 'lapulga');
INSERT INTO Notification (id, type, description, seen, date, user) VALUES (12, 'New Reservation!', 'thegoat made a new reservation for your place Place for Champions', 'no', '2019-12-20', 'lapulga');
INSERT INTO Notification (id, type, description, seen, date, user) VALUES (13, 'New Review!', 'thegoat made a review of your place Place for Champions', 'no', '2019-12-20', 'lapulga');
INSERT INTO Notification (id, type, description, seen, date, user) VALUES (14, 'New Review!', 'presidente made a review of your place Escape House', 'no', '2019-12-20', 'lapulga');
INSERT INTO Notification (id, type, description, seen, date, user) VALUES (15, 'New Place Added!', 'You just added a new place called Just for Holidays', 'no', '2019-12-20', 'presidente');

PRAGMA foreign_keys = on;
