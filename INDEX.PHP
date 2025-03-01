<?php
include 'db.php';

$sql = "SELECT * FROM yatim"; // Ganti 'yatim' dengan nama tabel Anda
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="fontawesome/css/font-awesome.min.css">
    <title>YAYASAN_CRUD</title>
</head>
<body>
<nav class="navbar bg-body-tertiary">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">CRUD -  BS5</a>
  </div>
</nav>

<div class="container">
    <h1 class="mt-4">Data Yayasan</h1>
    <figure>
        <blockquote class="blockquote">
            <p>Berisi data yang telah disimpan di database.</p>
        </blockquote>
        <figcaption class="blockquote-footer">
            CRUD <cite title="Source Title">Create Read Update Delete</cite>
        </figcaption>
    </figure>
    <a href="create.php" class="btn btn-primary mb-3">
        Tambah Data <i class="fa fa-plus"></i>
    </a>
    <div class="table-responsive">
        <table class="table align-middle table-bordered table-hover">
            <thead>
                <tr>
                    <th><center>ID Yatim</center></th>
                    <th>Nama</th>
                    <th>Tanggal Lahir</th>
                    <th>Jenis Kelamin</th>
                    <th>Alamat</th>
                    <th>Status</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><center><?php echo $row['id']; ?></center></td>
                    <td><?php echo $row['nama']; ?></td>
                    <td><?php echo $row['tanggal_lahir']; ?></td>
                    <td><?php echo $row['jenis_kelamin']; ?></td>
                    <td><?php echo $row['alamat']; ?></td>
                    <td><?php echo $row['status']; ?></td>
                    <td>
                        <a href="update.php?id=<?php echo $row['id']; ?>" class="btn btn-success btn-sm">Ubah <i class="fa fa-pencil"></i></a>
                        <a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm">Hapus <i class="fa fa-trash"></i></a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
</div>
</body>
</html>

<?php $conn->close(); ?>