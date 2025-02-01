<?php
include 'config.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM produk WHERE id_produk = $id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Produk berhasil dihapus!'); window.location='index.php';</script>";
    } else {
        echo "Error: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tes Programmer</title>
    <link rel="stylesheet" href="style.css">
    <style>
        button {
            width: 64px;
            height: 32px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
            border: 1px solid #ddd;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
    <script>
        function confirmDelete(id) {
            if (confirm("Apakah Anda yakin ingin menghapus produk ini?")) {
                window.location.href = "index.php?id=" + id;
            }
        }
    </script>
</head>

<body>
    <div class="container">
        <section class="header">
            <h2>Daftar Produk</h2>
            <a href="tambah.php"><button>Tambah</button></a>
        </section>

        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Produk</th>
                    <th>Harga</th>
                    <th>Kategori</th>
                    <th>Status</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $sql = "SELECT produk.id_produk, produk.nama_produk, produk.harga, 
                            kategori.nama_kategori, status.nama_status 
                        FROM produk
                        JOIN kategori ON produk.kategori_id = kategori.id_kategori
                        JOIN status ON produk.status_id = status.id_status";
                $result = $conn->query($sql);
                $no = 1;
                while ($row = $result->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $row['nama_produk']; ?></td>
                        <td><?= 'Rp ', number_format($row['harga'], 0, ',', '.'); ?></td>
                        <td><?= $row['nama_kategori']; ?></td>
                        <td><?= $row['nama_status']; ?></td>
                        <td>
                            <a href="ubah.php?id=<?= $row['id_produk']; ?>"><button>Ubah</button></a>
                            <button onclick="confirmDelete(<?= $row['id_produk']; ?>)">Hapus</button>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</body>

</html>