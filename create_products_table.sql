CREATE TABLE products (
    id VARCHAR(50) PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    price DECIMAL(10,2) NOT NULL,
    currency VARCHAR(10) NOT NULL,
    quantity INT NOT NULL,
    category_name VARCHAR(255),
    barcode VARCHAR(50),
    description TEXT,
    images TEXT
);
