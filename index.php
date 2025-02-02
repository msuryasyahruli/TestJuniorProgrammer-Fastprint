<?php
include 'config.php';

$limit = 10;

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $limit;

$totalQuery = "SELECT COUNT(*) AS total FROM produk";
$totalResult = $conn->query($totalQuery);
$totalRow = $totalResult->fetch_assoc();
$totalData = $totalRow['total'];

$totalPages = ceil($totalData / $limit);

$start = $offset + 1;
$end = min(($offset + $limit), $totalData);

$sql = "SELECT produk.id_produk, produk.nama_produk, produk.harga, 
               kategori.nama_kategori, status.nama_status 
        FROM produk
        JOIN kategori ON produk.kategori_id = kategori.id_kategori
        JOIN status ON produk.status_id = status.id_status
        LIMIT $limit OFFSET $offset";

$result = $conn->query($sql);

$no = $offset + 1;

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM produk WHERE id_produk = $id";
    if ($conn->query($sql) === TRUE) {
        echo "<script>window.location='index.php';</script>";
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
    <link rel="stylesheet" type="text/css" href="style.css">
    <style>
        button {
            width: 64px;
            height: 32px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            min-width: 680px;
        }

        .table-container {
            width: 100%;
            overflow-x: auto;
        }

        th,
        td {
            padding: 8px;
            text-align: center;
            border: 1px solid #ddd;
            max-width: 300px;
        }

        th {
            background-color: #f2f2f2;
        }

        .action-style {
            display: block;
        }

        .pagination {
            margin-top: 20px;
            display: flex;
            justify-content: space-between;
        }

        .pagination a {
            display: inline-block;
            text-decoration: none;
            border-radius: 5px;
        }

        .pagination-btn {
            display: block;
            gap: 18px;
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
        <div class="table-container">
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
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                    ?>
                            <tr>
                                <td><?= $no++; ?></td>
                                <td><?= htmlspecialchars($row['nama_produk']); ?></td>
                                <td>Rp <?= number_format($row['harga'], 0, ',', '.'); ?></td>
                                <td><?= htmlspecialchars($row['nama_kategori']); ?></td>
                                <td><?= htmlspecialchars($row['nama_status']); ?></td>
                                <td>
                                    <a href="ubah.php?id=<?= $row['id_produk']; ?>"><button>Ubah</button></a>
                                    <button onclick="confirmDelete(<?= $row['id_produk']; ?>)">Hapus</button>
                                </td>
                            </tr>
                        <?php
                        }
                    } else { ?>
                        <tr>
                            <td colspan="6">Tidak ada data produk.</td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>

            <div class="pagination">
                <span><?= $start; ?> - <?= $end; ?> / <?= $totalData; ?></span>

                <div class="pagination-btn">
                    <?php if ($page > 1) : ?>
                        <a href="?page=<?= $page - 1; ?>" class="prev">« Prev</a>
                    <?php endif; ?>

                    <?php if ($page < $totalPages) : ?>
                        <a href="?page=<?= $page + 1; ?>" class="next">Next »</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>

</html>