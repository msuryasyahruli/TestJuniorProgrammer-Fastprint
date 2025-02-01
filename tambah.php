<?php
include 'config.php';

if (isset($_POST['submit'])) {
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $kategori_id = $_POST['kategori_id'];
    $status_id = $_POST['status_id'];

    $stmt = $conn->prepare("INSERT INTO produk (nama_produk, harga, kategori_id, status_id) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("siii", $nama_produk, $harga, $kategori_id, $status_id);

    if ($stmt->execute()) {
        echo "<script>alert('Produk berhasil ditambahkan!'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

$kategori_result = $conn->query("SELECT * FROM kategori");

$status_result = $conn->query("SELECT * FROM status");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tambah Produk</title>
    <link rel="stylesheet" href="style.css">
    <style>
        form {
            width: 350px;
            margin: auto;
        }

        label {
            display: inline-block;
        }

        input,
        select {
            width: 100%;
            padding: 8px 0;
            margin: 8px 0;
            border: 1px solid #ccc;
            border-radius: 4px;
        }

        button {
            width: 100%;
            height: 32px;
            margin-top: 24px;
        }
    </style>
</head>

<body>
    <div class="container">
        <section class="header">
            <h2>Tambah Produk</h2>
        </section>

        <form action="" method="POST">
            <div>
                <label for="nama_produk">Nama Produk</label>
                <input type="text" id="nama_produk" name="nama_produk" required>

                <label for="harga">Harga</label>
                <input type="number" id="harga" name="harga" required>

                <label for="kategori">Kategori</label>
                <select id="kategori" name="kategori_id" required>
                    <option value="">Pilih</option>
                    <?php while ($row = $kategori_result->fetch_assoc()) { ?>
                        <option value="<?= $row['id_kategori'] ?>"><?= $row['nama_kategori'] ?></option>
                    <?php } ?>
                </select>

                <label for="status">Status</label>
                <select id="status" name="status_id" required>
                    <option value="">Pilih</option>
                    <?php while ($row = $status_result->fetch_assoc()) { ?>
                        <option value="<?= $row['id_status'] ?>"><?= $row['nama_status'] ?></option>
                    <?php } ?>
                </select>

                <button type="submit" name="submit">Tambah Produk</button>
            </div>
        </form>
    </div>
</body>

</html>