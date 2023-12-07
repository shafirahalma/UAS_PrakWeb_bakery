<?php
include "config/config.php";

$update = false;
$id = '';
$nama_resep = '';
$cara_buat = '';
$bahan = '';

// Insert
if (isset($_POST['insert'])) {
	$id_resep = $_POST['id_resep'];
	$nama_resep = $_POST['id_kue'];
	$bahan = $_POST['bahan'];
	$cara_buat = $_POST['cara_buat'];
	$gambar = $_FILES['gambar']['name'];

	if ($gambar != "") {
		$ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
		$x = explode('.', $gambar);
		$ekstensi = strtolower(end($x));
		$file_tmp = $_FILES['gambar']['tmp_name'];
		$angka_acak = rand(1, 999);
		$nama_gambar_baru = $angka_acak . '-' . $gambar;
		if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
			move_uploaded_file($file_tmp, 'gambar_resep/' . $nama_gambar_baru);
			$query = "INSERT INTO resep (id, id_kue, bahan, cara_buat, gambar) VALUES ('$id_resep', '$nama_resep', '$bahan', '$cara_buat', '$nama_gambar_baru')";

			$result = mysqli_query($conn, $query);

			if (!$result) {
				die("Query gagal dijalankan: " . mysqli_errno($conn) . " - " . mysqli_error($conn));
			} else {
				echo "<script>alert('Data berhasil ditambah.');window.location='home.php?page=data_resep&&insert=data-insert';</script>";
			}
		} else {
			echo "<script>alert('Ekstensi gambar yang boleh hanya jpg, png, dan jpeg.');window.location='home.php?page=data_produk';</script>";
		}
	} else {
		echo "Error";
	}
}

// Delete
if (isset($_GET['delete'])) {
	$id = $_GET['delete'];

	$query = "DELETE FROM resep WHERE id = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("s", $id);

	if ($stmt->execute()) {
		echo "<script>alert('Berhasil menghapus data.');window.location='home.php?page=data_resep&&remove=hapus-data';</script>";
	} else {
		echo "<script>alert('ERROR');</script>" . mysqli_error($conn);
	}

	$stmt->close();
}

// Edit
if (isset($_GET['edit'])) {
	$id = $_GET['edit'];
	$update = true;

	$query = "SELECT * FROM resep WHERE id = ?";
	$stmt = $conn->prepare($query);
	$stmt->bind_param("s", $id);
	$stmt->execute();
	$result = $stmt->get_result();
	$row = $result->fetch_assoc();

	$nama_resep = $row['id_kue'];
	$bahan = $row['bahan'];
	$cara_buat = $row['cara_buat'];
	$gambar = $row['gambar'];
}

// Update
if (isset($_POST['update'])) {
	$id_resep = $_POST['id_resep'];
	$nama_resep = $_POST['id_kue'];
	$bahan = $_POST['bahan'];
	$cara_buat = $_POST['cara_buat'];
	$gambar = $_FILES['gambar']['name'];

	if ($gambar != "") {
		$ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg');
		$x = explode('.', $gambar);
		$ekstensi = strtolower(end($x));
		$file_tmp = $_FILES['gambar']['tmp_name'];
		$angka_acak = rand(1, 999);
		$nama_gambar_baru = $angka_acak . '-' . $gambar;

		if (in_array($ekstensi, $ekstensi_diperbolehkan) === true) {
			move_uploaded_file($file_tmp, 'gambar_resep/' . $nama_gambar_baru);

			$query  = "UPDATE resep SET id_kue = ?, bahan = ?, cara_buat = ?, gambar = ? WHERE id = ?";
			$stmt = $conn->prepare($query);
			$stmt->bind_param("sssss", $nama_resep, $bahan, $cara_buat, $nama_gambar_baru, $id_resep);

			if ($stmt->execute()) {
				echo "<script>alert('Data berhasil diubah.');window.location='home.php?page=data_resep&&editdata=edit-data';</script>";
			} else {
				echo "<script>alert('Query gagal dijalankan: " . mysqli_errno($conn) . " - " . mysqli_error($conn) . "');</script>";
			}

			$stmt->close();
		} else {
			echo "<script>alert('Ekstensi gambar yang boleh hanya jpg atau png.');window.location='tambah_produk.php';</script>";
		}
	} else {
		$query  = "UPDATE resep SET id_kue = ?, bahan = ?, cara_buat = ? WHERE id = ?";
		$stmt = $conn->prepare($query);
		$stmt->bind_param("ssss", $nama_resep, $bahan, $cara_buat, $id_resep);

		if ($stmt->execute()) {
			echo "<script>alert('Data berhasil diubah.');window.location='home.php?page=data_resep&&editdata=edit-data';</script>";
		} else {
			echo "<script>alert('Query gagal dijalankan: " . mysqli_errno($conn) . " - " . mysqli_error($conn) . "');</script>";
		}

		$stmt->close();
	}
}
