<?php
include 'config.php';

if (!isset($_GET['id']) || empty($_GET['id'])) {
    echo "<script>alert('ID produk tidak valid!'); window.location.href='index.php';</script>";
    exit();
}

$id_produk = $_GET['id'];

$stmt = $conn->prepare("SELECT * FROM produk WHERE id_produk = ?");
$stmt->bind_param("i", $id_produk);
$stmt->execute();
$result = $stmt->get_result();
$produk = $result->fetch_assoc();

if (!$produk) {
    echo "<script>alert('Produk tidak ditemukan!'); window.location.href='index.php';</script>";
    exit();
}

$kategori_result = $conn->query("SELECT * FROM kategori");
$status_result = $conn->query("SELECT * FROM status");

if (isset($_POST['submit'])) {
    $nama_produk = $_POST['nama_produk'];
    $harga = $_POST['harga'];
    $kategori_id = $_POST['kategori_id'];
    $status_id = $_POST['status_id'];

    $stmt = $conn->prepare("UPDATE produk SET nama_produk = ?, harga = ?, kategori_id = ?, status_id = ? WHERE id_produk = ?");
    $stmt->bind_param("siiii", $nama_produk, $harga, $kategori_id, $status_id, $id_produk);

    if ($stmt->execute()) {
        echo "<script>alert('Produk berhasil diperbarui!'); window.location.href='index.php';</script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Ubah Produk</title>
    <link rel="stylesheet" href="style.css">
    <style>
        form {
            max-width: 350px;
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
            <h2>Ubah Produk</h2>
        </section>

        <form action="" method="POST">
            <div>
                <label for="nama_produk">Nama Produk</label>
                <input type="text" id="nama_produk" name="nama_produk" value="<?= htmlspecialchars($produk['nama_produk']); ?>" required>

                <label for="harga">Harga</label>
                <input type="number" id="harga" name="harga" value="<?= $produk['harga']; ?>" required>

                <label for="kategori">Kategori</label>
                <select id="kategori" name="kategori_id" required>
                    <option value="">Pilih</option>
                    <?php while ($row = $kategori_result->fetch_assoc()) { ?>
                        <option value="<?= $row['id_kategori']; ?>" <?= ($row['id_kategori'] == $produk['kategori_id']) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($row['nama_kategori']); ?>
                        </option>
                    <?php } ?>
                </select>

                <label for="status">Status</label>
                <select id="status" name="status_id" required>
                    <option value="">Pilih</option>
                    <?php while ($row = $status_result->fetch_assoc()) { ?>
                        <option value="<?= $row['id_status']; ?>" <?= ($row['id_status'] == $produk['status_id']) ? 'selected' : ''; ?>>
                            <?= htmlspecialchars($row['nama_status']); ?>
                        </option>
                    <?php } ?>
                </select>

                <button type="submit" name="submit">Ubah Produk</button>
            </div>
        </form>
    </div>
</body>

</html>