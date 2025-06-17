CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE accounts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    type ENUM('asset','liability','income','expense') NOT NULL
);

CREATE TABLE journal_entries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    account_id INT NOT NULL,
    debit DECIMAL(10,2) DEFAULT 0,
    credit DECIMAL(10,2) DEFAULT 0,
    description VARCHAR(255),
    entry_date DATE NOT NULL,
    FOREIGN KEY (account_id) REFERENCES accounts(id)
);
INSERT INTO users (username, password) VALUES ('admin', '$2b$12$1AUMjiyLrSVPiUCzffs7i.NII7tD0wGDYgUmRW0ZK7kA53KUq7qtW');
