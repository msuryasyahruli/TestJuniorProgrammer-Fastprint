CREATE TABLE produk (
    id_produk INT AUTO_INCREMENT PRIMARY KEY,
    nama_produk VARCHAR(255) NOT NULL,
    harga INT NOT NULL,
    kategori_id INT NOT NULL,
    status_id INT NOT NULL,
    FOREIGN KEY (kategori_id) REFERENCES kategori(id_kategori),
    FOREIGN KEY (status_id) REFERENCES status(id_status)
);

CREATE TABLE kategori (
    id_kategori INT AUTO_INCREMENT PRIMARY KEY,
    nama_kategori VARCHAR(100) NOT NULL
);

CREATE TABLE status (
    id_status INT AUTO_INCREMENT PRIMARY KEY,
    nama_status VARCHAR(100) NOT NULL
);
