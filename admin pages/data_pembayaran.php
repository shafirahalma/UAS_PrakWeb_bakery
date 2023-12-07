<section id="main-content">
    <section class = "wrapper">

        <div class="row">
            <main>
                    <?php if(isset($_GET['remove'])){?>
						<div class="alert alert-danger">
							<p>Hapus Data Berhasil !</p>
						</div>
                    <?php }?>

                    <?php if(isset($_GET['insert'])){?>
						<div class="alert alert-success">
							<p>Insert Data Berhasil !</p>
						</div>
                    <?php }?>

                    <?php if(isset($_GET['editdata'])){?>
						<div class="alert alert-primary">
							<p>Edit Data Berhasil !</p>
						</div>
                    <?php }?>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Data Pembayaran</h1>
                        <ol class="breadcrumb mb-4">
                        </ol>

                        <div class="container">

                        <a href="home.php?page=data_pembayaran" style="margin-right :0.5pc;" 
							class="btn btn-success btn-md pull-right">
							<i class="fa fa-refresh"></i> Refresh Data</a>
						<div class="clearfix"></div>
						<br/>

                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Tabel Data Pembayaran
                            </div>
                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Username Member</th>
                                            <th>Kode Order</th>
                                            <th>Id_bank</th>
                                            <th>Rekening</th>
                                            <th>Nama Rekening</th>
                                            <th>Tanggal Transfer</th>
                                            <th>Bukti</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>ID</th>
                                            <th>Username Member</th>
                                            <th>Kode Order</th>
                                            <th>Id_bank</th>
                                            <th>Rekening</th>
                                            <th>Nama Rekening</th>
                                            <th>Tanggal Transfer</th>
                                            <th>Bukti</th>
                                        </tr>
                                    </tfoot>
                                    <tbody>
                                        <?php
                                        include "config/config.php";

                                        $query = "SELECT * FROM pembayaran";

                                        $tampil = $conn->query($query);
                                        while ($c=$tampil->fetch_array()) {?>
                                            <tr>
                                                <td><?php echo $c ['id'];?></td>
                                                <td><?php echo $c ['username'];?></td>
                                                <td><?php echo $c ['kode_order'];?></td>
                                                <td><?php echo $c ['id_bank'];?></td>
                                                <td><?php echo $c ['rekening'];?></td>
                                                <td><?php echo $c ['nama_rekening'];?></td>
                                                <td><?php echo $c ['tgl_transfer'];?></td>
                                                <td style="text-align: center;"><img src="bukti/<?php echo $c['bukti']; ?>" style="width: 120px; height: 100px"></td>
                                            </tr>
                                        <?php
                                        }?>
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
