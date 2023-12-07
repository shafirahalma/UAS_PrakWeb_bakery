<section id="main-content">
    <section class="wrapper">

        <div class="row">
            <main>
                <?php if (isset($_GET['remove'])) { ?>
                    <div class="alert alert-danger" isset>
                        <p>Hapus Data Berhasil !</p>
                    </div>
                <?php } ?>

                <?php if (isset($_GET['insert'])) { ?>
                    <div class="alert alert-success">
                        <p>Insert Data Berhasil !</p>
                    </div>
                <?php } ?>

                <?php if (isset($_GET['editdata'])) { ?>
                    <div class="alert alert-primary">
                        <p>Edit Data Berhasil !</p>
                    </div>
                <?php } ?>
                <div class="container-fluid px-4">
                    <h1 class="mt-4">Data Resep</h1>
                    <ol class="breadcrumb mb-4">
                    </ol>

                    <div class="container">

                        <a href="home.php?page=data_resep" style="margin-right :0.5pc;" class="btn btn-success btn-md pull-right">
                            <i class="fa fa-refresh"></i> Refresh Data</a>
                        <div class="clearfix"></div>
                        <br />

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Form
                            </div>
                            <div class="card-body">
                                <form method="POST" action="aksi_resep.php" enctype="multipart/form-data">
                                    <?php
                                    include "config/config.php";
                                    // mencari kode barang dengan nilai paling besar
                                    $query = mysqli_query($conn, "SELECT max(id) as maxKode FROM resep");
                                    $data = mysqli_fetch_array($query);
                                    $kodeBarang = $data['maxKode'];


                                    $noUrut = (int) substr($kodeBarang, 3, 3);

                                    // bilangan yang diambil ini ditambah 1 untuk menentukan nomor urut berikutnya
                                    $noUrut++;


                                    $char = "RSP";
                                    $kodeBarang = $char . sprintf("%03s", $noUrut);
                                    ?>
                                    <?php include 'aksi_resep.php'; ?>
                                    <?php
                                    if ($update == true) :
                                    ?>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Id resep</label>
                                            <input type="text" name="id_resep" class="form-control" id="exampleInputid" aria-describedby="id" value="<?php echo $id ?>" readonly>
                                        </div>

                                    <?php else : ?>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Id resep</label>
                                            <input type="text" name="id_resep" class="form-control" id="exampleInputid" aria-describedby="id" value="<?php echo $kodeBarang ?>" readonly>
                                        </div>
                                    <?php endif; ?>
                                    <div class="mb-3">
                                        <label for="exampleInputEmail1" class="form-label">Id Kue</label>
                                        <select class="form-select" aria-label=".form-select-lg example" name="id_kue">
                                            <option selected>Pilih Kue</option>
                                            <?php
                                            include "config/config.php";
                                            $query = "SELECT * FROM produk";
                                            $select = $conn->query($query);
                                            while ($row = $select->fetch_array()) { ?>
                                                <option value="<?php echo $row['id_kue']; ?>"><?php echo $row['id_kue']; ?> -> <?php echo $row['nama']; ?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputNama" class="form-label">Bahan Bahan</label>
                                        <textarea name="bahan" rows="10" class="form-control" id="exampleInputnama_bank"><?php echo $bahan; ?></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label for="exampleInputNama" class="form-label">Cara Membuat</label>
                                        <textarea name="cara_buat" rows="10" class="form-control" id="exampleInputnama_bank"><?php echo $cara_buat; ?></textarea>
                                    </div>

                                    <?php if ($update == true) : ?>
                                        <div class="mb-3">
                                            <img src="gambar_resep/<?php echo $gambar ?>" style="width: 120px;float: left;margin-bottom: 5px;">
                                            <input type="file" name="gambar" class="form-control" id="exampleInputnama_bank">
                                            <i>Nb: Gambar tidak dapat di ubah</i>
                                        </div>
                                    <?php else : ?>
                                        <div class="mb-3">
                                            <label for="exampleInputNama" class="form-label">Gambar Resep</label>
                                            <input type="file" name="gambar" class="form-control" id="exampleInputnama_bank">
                                        </div>
                                    <?php endif; ?>

                                    <?php
                                    if ($update == true) :
                                    ?>
                                        <button type="submit" name="update" class="btn btn-primary">Update</button>
                                    <?php else : ?>
                                        <button type="submit" name="insert" class="btn btn-primary" onclick="javascript:return confirm('Anda yakin insert data?');">Submit</button>
                                    <?php endif; ?>
                                </form>
                            </div>
                        </div>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabel Data Resep
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nama</th>
                                            <th>Bahan</th>
                                            <th>Cara Buat</th>
                                            <th>Gambar</th>
                                            <th>Kelola</th>
                                            <th>Download</th> <!-- Tambah kolom untuk tombol download -->
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Id</th>
                                            <th>Nama</th>
                                            <th>Bahan</th>
                                            <th>Cara Buat</th>
                                            <th>Gambar</th>
                                            <th>Kelola</th>
                                            <th>Download</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        include "aksi_resep.php";
                                        include "config/config.php";

                                        $query = "SELECT * FROM resep JOIN produk ON resep.id_kue = produk.id_kue";

                                        $tampil = $conn->query($query);
                                        while ($c = $tampil->fetch_array()) { ?>
                                            <tr>
                                                <td><?php echo $c['id']; ?></td>
                                                <td><?php echo $c['id_kue']; ?></td>
                                                <td><?php echo $c['bahan']; ?></td>
                                                <td><?php echo $c['cara_buat']; ?></td>
                                                <td style="text-align: center;"><img src="gambar_kue/<?php echo $c['gambar']; ?>" style="width: 120px; height: 100px"></td>
                                                <td>
                                                    <a href="home.php?page=data_resep&&edit=<?php echo $c['id']; ?>">
                                                        <button type="submit" class="btn btn-primary btn-sm" name="edit">Edit</button>
                                                    </a>

                                                    <a href="aksi_resep.php?delete=<?php echo $c['id']; ?>">
                                                        <button type="submit" name="delete" class="btn btn-danger btn-sm" onclick="javascript:return confirm('Anda yakin hapus data bank?');">Delete</button>
                                                    </a>
                                                </td>

                                                <td>
                                                    <!-- Tambah link download -->
                                                    <a href="download_resep.php?id=<?php echo $c['id']; ?>">
                                                        <button type="submit" class="btn btn-success btn-sm" name="download">Download</button>
                                                    </a>
                                                </td>

                                            </tr>
                                        <?php
                                        } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </main>
            <!--End Table-->
        </div>
    </section>
</section>