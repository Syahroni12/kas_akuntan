<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
?>
<?php include 'partials/navbar_hrd.php'; ?>

<div class="row">
    <!-- Card Pegawai -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-primary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                            Supplier</div>
                        <?php
                        include('inc/koneksi.php');
                        $query = "SELECT * FROM jabatan";
                        $queryy = "SELECT * FROM pengurus";
                        
                        $result = mysqli_query($koneksi, $query);
                        $resultt = mysqli_query($koneksi, $queryy);
                        $count = mysqli_num_rows($result);
                        $countt = mysqli_num_rows($resultt);

                        ?>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$count;?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-users fa-2x text-gray-300"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Baru -->
    <div class="col-xl-3 col-md-6 mb-4">
        <div class="card border-left-secondary shadow h-100 py-2">
            <div class="card-body">
                <div class="row no-gutters align-items-center">
                    <div class="col mr-2">
                        <div class="text-xs font-weight-bold text-secondary text-uppercase mb-1">
                            Akun</div>
                        <div class="h5 mb-0 font-weight-bold text-gray-800"><?=$countt;?></div>
                    </div>
                    <div class="col-auto">
                        <i class="fas fa-icon-baru fa-2x text-gray-300"></i>
                        <!-- Ganti "fa-icon-baru" dengan kelas ikon yang sesuai -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>