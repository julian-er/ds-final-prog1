CREATE TABLE users (
    userID INT(10) NOT NULL AUTO_INCREMENT,
    user VARCHAR(45) NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(200) NOT NULL,
    lastName VARCHAR(200) NOT NULL,
    PRIMARY KEY (userID),
    UNIQUE KEY user (user)
) ENGINE = InnoDB;

CREATE TABLE pets ( 
    petID INT(10) NOT NULL AUTO_INCREMENT,
    userID INT(10) NOT NULL,
    breed VARCHAR(45) NOT NULL,
    petName VARCHAR(45) NOT NULL,
    PRIMARY KEY (petID),
    FOREIGN KEY (userID) REFERENCES users(userID)
)

-- Insert an user: name of the user: example - password: 1234 (encripted)
INSERT INTO
    users (user, password, name, lastName)
VALUES
    (
        'example',
        '$2y$10$MKEZOE1o/HEE2KAgDMBkq.j6kjw0tiu.FGMSKLdi9wU8MMDQIlpFO',
        'Test',
        'User'
    );

-- Insert a pet : userId and breed of dog
INSERT INTO 
    pets (userID, breed)
VALUES
    (
     1,
     'Pastor Alemán'   
    )

-- Select all dogs of userID
SELECT * FROM `pets` WHERE userID = 1