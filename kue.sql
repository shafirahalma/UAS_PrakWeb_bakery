-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versi server:                 10.9.2-MariaDB-log - mariadb.org binary distribution
-- OS Server:                    Win64
-- HeidiSQL Versi:               11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Membuang struktur basisdata untuk kue
DROP DATABASE IF EXISTS `kue`;
CREATE DATABASE IF NOT EXISTS `kue` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `kue`;

-- membuang struktur untuk table kue.bank
DROP TABLE IF EXISTS `bank`;
CREATE TABLE IF NOT EXISTS `bank` (
  `id` int(10) NOT NULL,
  `nama_bank` varchar(50) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel kue.bank: ~3 rows (lebih kurang)
/*!40000 ALTER TABLE `bank` DISABLE KEYS */;
INSERT INTO `bank` (`id`, `nama_bank`, `alamat`, `telepon`) VALUES
	(1, 'Bank BRI', 'Jombang', '085730161527'),
	(2, 'Bank BNI', 'Surabaya', '085730161527'),
	(3, 'Mandiri', 'Malang', '085648183191'),
	(4, 'Bank BCA', 'Semarang', '085730161527');
/*!40000 ALTER TABLE `bank` ENABLE KEYS */;

-- membuang struktur untuk table kue.masukan
DROP TABLE IF EXISTS `masukan`;
CREATE TABLE IF NOT EXISTS `masukan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) NOT NULL,
  `telepon` varchar(15) NOT NULL,
  `komentar` text NOT NULL,
  `createdate` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  CONSTRAINT `masukan_ibfk_1` FOREIGN KEY (`username`) REFERENCES `member` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel kue.masukan: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `masukan` DISABLE KEYS */;
/*!40000 ALTER TABLE `masukan` ENABLE KEYS */;

-- membuang struktur untuk table kue.member
DROP TABLE IF EXISTS `member`;
CREATE TABLE IF NOT EXISTS `member` (
  `username` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `nama_lengkap` varchar(100) NOT NULL,
  `tgl_lahir` date DEFAULT NULL,
  `alamat` varchar(150) NOT NULL,
  `asal_kota` varchar(25) NOT NULL,
  `telepon` varchar(12) NOT NULL,
  `jk` enum('L','P') NOT NULL,
  `level` enum('Admin','Member') NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel kue.member: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `member` DISABLE KEYS */;
INSERT INTO `member` (`username`, `password`, `nama_lengkap`, `tgl_lahir`, `alamat`, `asal_kota`, `telepon`, `jk`, `level`) VALUES
	('admin', '21232f297a57a5a743894a0e4a801fc3', 'admin', '2013-04-02', 'Jombang', 'Jombang', '085730161527', 'L', 'Admin'),
	('member', 'aa08769cdcb26674c6706093503ff0a3', 'member', '2013-04-02', 'Surabaya', 'Jombang', '085730161527', 'P', 'Member');
/*!40000 ALTER TABLE `member` ENABLE KEYS */;

-- membuang struktur untuk table kue.pembayaran
DROP TABLE IF EXISTS `pembayaran`;
CREATE TABLE IF NOT EXISTS `pembayaran` (
  `id` varchar(15) NOT NULL,
  `username` varchar(100) NOT NULL,
  `kode_order` varchar(20) CHARACTER SET utf8mb3 NOT NULL,
  `id_bank` int(10) NOT NULL,
  `rekening` varchar(50) NOT NULL,
  `nama_rekening` varchar(50) NOT NULL,
  `tgl_transfer` datetime NOT NULL,
  `bukti` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `fk1` (`id_bank`),
  UNIQUE KEY `id_order` (`kode_order`) USING BTREE,
  CONSTRAINT `pembayaran_ibfk_1` FOREIGN KEY (`id_bank`) REFERENCES `bank` (`id`),
  CONSTRAINT `pembayaran_ibfk_2` FOREIGN KEY (`kode_order`) REFERENCES `pesanan` (`kode`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel kue.pembayaran: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `pembayaran` DISABLE KEYS */;
/*!40000 ALTER TABLE `pembayaran` ENABLE KEYS */;

-- membuang struktur untuk table kue.pesanan
DROP TABLE IF EXISTS `pesanan`;
CREATE TABLE IF NOT EXISTS `pesanan` (
  `kode` varchar(20) CHARACTER SET utf8mb3 NOT NULL,
  `username` varchar(100) NOT NULL,
  `tgl` date NOT NULL,
  `id_kue` int(11) NOT NULL,
  `jumlah` int(11) NOT NULL,
  `total_bayar` float NOT NULL,
  `keterangan` text NOT NULL,
  `status_pesanan` enum('sudah_dibayar','belum_dibayar') NOT NULL,
  PRIMARY KEY (`kode`),
  KEY `username` (`username`),
  KEY `id_kue` (`id_kue`) USING BTREE,
  CONSTRAINT `pesanan_ibfk_1` FOREIGN KEY (`username`) REFERENCES `member` (`username`),
  CONSTRAINT `pesanan_ibfk_2` FOREIGN KEY (`id_kue`) REFERENCES `produk` (`id_kue`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel kue.pesanan: ~0 rows (lebih kurang)
/*!40000 ALTER TABLE `pesanan` DISABLE KEYS */;
/*!40000 ALTER TABLE `pesanan` ENABLE KEYS */;

-- membuang struktur untuk table kue.produk
DROP TABLE IF EXISTS `produk`;
CREATE TABLE IF NOT EXISTS `produk` (
  `id_kue` int(11) NOT NULL AUTO_INCREMENT,
  `kategori` varchar(50) NOT NULL DEFAULT 'ada',
  `nama` varchar(100) DEFAULT NULL,
  `keterangan` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  `harga` float NOT NULL,
  `status` enum('ada','kosong') NOT NULL,
  PRIMARY KEY (`id_kue`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel kue.produk: ~4 rows (lebih kurang)
/*!40000 ALTER TABLE `produk` DISABLE KEYS */;
INSERT INTO `produk` (`id_kue`, `kategori`, `nama`, `keterangan`, `gambar`, `harga`, `status`) VALUES
	(28, 'Kue Ulang Tahun', 'Kue Coklat', 'Lezat dan Manis', 'KueCoklat.jpg', 100000, 'kosong'),
	(30, 'Kue Kering', 'Kue Nastar', 'Enak', 'nastar.jpg', 25000, 'kosong'),
	(31, 'Kue Basah', 'Kue Lumpur', 'Lezat', 'kuelumpur.jpg', 10000, 'kosong'),
	(32, 'Kue Ulang Tahun', 'Kue Ubi', 'Enak', 'KueUbi.jpg', 100000, 'ada'),
	(33, 'Kue Basah', 'Dadar Gulung', 'Lezat dan Manis', 'dadargulung.jpeg', 15000, 'ada');
/*!40000 ALTER TABLE `produk` ENABLE KEYS */;

-- membuang struktur untuk table kue.resep
DROP TABLE IF EXISTS `resep`;
CREATE TABLE IF NOT EXISTS `resep` (
  `id` varchar(11) NOT NULL,
  `id_kue` int(11) NOT NULL DEFAULT 0,
  `bahan` text NOT NULL,
  `cara_buat` text NOT NULL,
  `gambar` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_kue` (`id_kue`),
  CONSTRAINT `FK1` FOREIGN KEY (`id_kue`) REFERENCES `produk` (`id_kue`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel kue.resep: ~2 rows (lebih kurang)
/*!40000 ALTER TABLE `resep` DISABLE KEYS */;
INSERT INTO `resep` (`id`, `id_kue`, `bahan`, `cara_buat`, `gambar`) VALUES
	('RSP001', 28, 'Berikut adalah beberapa bahan yang umum digunakan untuk membuat kue ulang tahun coklat:\r\n\r\nTepung terigu: 2 Â¼ cangkir\r\nBubuk kakao: Â¾ cangkir\r\nGula pasir: 2 cangkir\r\nGaram: 1 Â½ sendok teh\r\nBaking powder: 1 Â½ sendok teh\r\nBaking soda: 1 Â½ sendok teh\r\nTelur: 3 butir\r\nSusu: 1 Â½ cangkir\r\nMinyak sayur: Â½ cangkir\r\nEkstrak vanila: 2 sendok teh\r\nAir panas: Â¾ cangkir', 'Berikut adalah langkah-langkah umum untuk membuat kue ulang tahun coklatt:\r\n\r\nPanaskan oven pada suhu 180Â°C (350Â°F) dan siapkan loyang bundar berukuran 9 inci dengan memberi alas kertas roti atau melumuri loyang dengan mentega dan tepung.\r\n\r\nDalam sebuah mangkuk besar, ayak tepung terigu, bubuk kakao, gula pasir, garam, baking powder, dan baking soda. Aduk rata.\r\n\r\nTambahkan telur, susu, minyak sayur, dan ekstrak vanila ke dalam mangkuk dengan adonan kering. Gunakan mixer dengan kecepatan sedang untuk mengocok bahan-bahan tersebut selama 2-3 menit, atau sampai adonan tercampur dengan baik.\r\n\r\nTuangkan air panas ke dalam adonan dan aduk dengan spatula atau sendok kayu hingga tercampur sempurna. Adonan akan menjadi cukup encer, jadi jangan khawatir.\r\n\r\nTuang adonan ke dalam loyang yang telah disiapkan dan ratakan permukaannya dengan spatula.\r\n\r\nPanggang dalam oven yang telah dipanaskan selama sekitar 30-35 menit, atau sampai tusukan gigi yang dimasukkan ke dalam tengah kue keluar bersih.\r\n\r\nSetelah matang, keluarkan kue dari oven dan biarkan dingin dalam loyang selama beberapa menit. Kemudian, pindahkan kue ke rak kawat dan biarkan sepenuhnya dingin.\r\n\r\nSelanjutnya, Anda dapat menggunakan buttercream atau frosting pilihan Anda untuk menghias kue. Oleskan buttercream secara merata di permukaan kue dengan spatula atau gunakan piping bag untuk membuat hiasan yang lebih rumit.\r\n\r\nTerakhir, tambahkan hiasan tambahan seperti cokelat parut, permen, atau dekorasi kue lainnya sesuai selera.', '531-KueCoklat.jpg'),
	('RSP002', 30, 'Berikut adalah beberapa bahan yang umum digunakan untuk membuat kue nastar:\r\n\r\nTepung terigu: 250 gram\r\nMentega: 200 gram (suhu ruang)\r\nGula bubuk: 50 gram\r\nTelur kuning: 4 butir\r\nVanili bubuk: Â½ sendok teh\r\nKeju cheddar parut: 100 gram (opsional, untuk isian)\r\nSelai nanas: secukupnya (untuk isian)\r\nTopping: kuning telur (untuk mengoles permukaan nastar sebelum dipanggang)\r\n', 'Berikut adalah langkah-langkah umum untuk membuat kue nastar:\r\n\r\nSiapkan bahan-bahan yang diperlukan dan panaskan oven pada suhu 180Â°C (350Â°F).\r\n\r\nDalam sebuah mangkuk besar, campurkan mentega (suhu ruang) dan gula bubuk. Kocok menggunakan mixer dengan kecepatan rendah hingga tercampur rata dan lembut.\r\n\r\nTambahkan telur kuning satu per satu sambil terus mengocok adonan hingga telur tercampur sempurna.\r\n\r\nMasukkan tepung terigu dan vanili bubuk ke dalam adonan. Aduk rata menggunakan spatula atau tangan hingga adonan menjadi kalis (tidak lengket) dan terbentuk adonan yang dapat dipulung.\r\n\r\nAmbil sebagian kecil adonan nastar dan pipihkan dengan tangan. Beri isian selai nanas di tengah adonan yang telah dipipihkan, kemudian rapatkan adonan di sekitar selai nanas dan bulatkan kembali hingga membentuk bola kecil. Ulangi proses ini sampai adonan habis.\r\n\r\nLetakkan nastar yang telah dibentuk di atas loyang yang dilapisi dengan kertas roti atau diolesi dengan mentega.\r\n\r\nKocok kuning telur, kemudian oleskan di permukaan nastar sebagai topping.\r\n\r\nPanggang nastar dalam oven yang telah dipanaskan selama sekitar 15-20 menit, atau sampai bagian bawahnya terlihat kecokelatan.\r\n\r\nSetelah matang, angkat nastar dari oven dan biarkan dingin dalam suhu ruang.\r\n\r\nNastar siap disajikan. Anda dapat menyimpannya dalam wadah kedap udara untuk menjaga kelembapan.', '161-nastar.jpg'),
	('RSP003', 31, 'Berikut adalah beberapa bahan yang umum digunakan untuk membuat kue lumpur (molten chocolate cake):\r\n\r\nDark chocolate (cokelat hitam): 200 gram\r\nMentega: 150 gram\r\nTelur: 4 butir\r\nGula pasir: 150 gram\r\nTepung terigu: 80 gram\r\nBubuk kakao: 30 gram\r\nGaram: 1/4 sendok teh\r\nVanilla ekstrak: 1 sendok teh (opsional)\r\nMinyak zaitun atau mentega (untuk melumuri loyang)', 'Berikut adalah langkah-langkah umum untuk membuat kue lumpur (molten chocolate cake):\r\n\r\nPanaskan oven pada suhu 180Â°C (350Â°F). Siapkan loyang muffin atau ramekin yang dilumuri dengan minyak zaitun atau mentega.\r\n\r\nLelehkan dark chocolate dan mentega dalam mangkuk tahan panas di atas panci dengan air mendidih (metode double boiler). Aduk hingga cokelat dan mentega sepenuhnya meleleh dan tercampur rata. Setelah itu, diamkan sebentar untuk mendinginkan.\r\n\r\nDalam mangkuk terpisah, kocok telur dan gula pasir dengan mixer hingga mengembang dan berwarna cerah.\r\n\r\nTuangkan campuran cokelat yang telah meleleh ke dalam adonan telur dan gula. Aduk rata dengan spatula atau whisk.\r\n\r\nTambahkan tepung terigu, bubuk kakao, garam, dan ekstrak vanila (jika menggunakan) ke dalam adonan cokelat. Aduk hingga semua bahan tercampur rata dan tidak ada gumpalan tepung.\r\n\r\nTuang adonan ke dalam loyang muffin atau ramekin yang telah disiapkan, mengisi sekitar 2/3 bagian loyang.\r\n\r\nPanggang dalam oven yang telah dipanaskan selama sekitar 10-12 menit. Waktu ini dapat bervariasi tergantung pada oven masing-masing dan tingkat kematangan yang diinginkan. Kue lumpur harus memiliki bagian luar yang mengeras, tetapi bagian tengahnya masih lembut dan bergerak saat digoyang.\r\n\r\nSetelah matang, keluarkan kue lumpur dari oven dan biarkan dingin selama beberapa menit. Anda dapat mengeluarkannya dari loyang dengan hati-hati menggunakan sendok atau membalikkan loyang dengan hati-hati.\r\n\r\nSajikan kue lumpur segera dengan taburan gula bubuk, es krim vanila, atau buah segar sebagai hiasan opsional. Potong kue lumpur dan nikmati bagian tengah yang leleh (molten) dan lezat.', '871-kuelumpur.jpg');
/*!40000 ALTER TABLE `resep` ENABLE KEYS */;

-- membuang struktur untuk table kue.supplier
DROP TABLE IF EXISTS `supplier`;
CREATE TABLE IF NOT EXISTS `supplier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nama_toko` varchar(50) NOT NULL,
  `nama_lengkap` varchar(50) NOT NULL,
  `alamat` varchar(50) NOT NULL,
  `telepon` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Membuang data untuk tabel kue.supplier: ~1 rows (lebih kurang)
/*!40000 ALTER TABLE `supplier` DISABLE KEYS */;
INSERT INTO `supplier` (`id`, `nama_toko`, `nama_lengkap`, `alamat`, `telepon`) VALUES
	(1, 'Toko Sumber Rejeki', 'Siti Zulaika', 'Jalan Sumbersari', '085730161527'),
	(2, 'Toko Madura', 'Asep', 'Merjosari', '085730161527');
/*!40000 ALTER TABLE `supplier` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
