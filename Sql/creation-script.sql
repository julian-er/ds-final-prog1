CREATE TABLE users (
    id INT(10) unsigned NOT NULL AUTO_INCREMENT,
    user VARCHAR(45) NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(200) NOT NULL,
    lastName VARCHAR(200) NOT NULL,
    PRIMARY KEY (id),
    UNIQUE KEY user (user)
) ENGINE = InnoDB;

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