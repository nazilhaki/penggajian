<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include __DIR__ . "/../../config/config.php"; // Sesuaikan path dengan struktur folder Anda

if ($_SESSION['level'] == 'admin') {
?>
<!-- begin breadcrumb -->
<ol class="breadcrumb pull-right">
    <li><a href="javascript:;">Home</a></li>
    <li><a href="javascript:;">Transaksi</a></li>
    <li class="active">Gaji</li>
</ol>
<!-- end breadcrumb -->
<!-- begin page-header -->
<h1 class="page-header">Data Gaji</h1>

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-inverse" data-sortable-id="form-validation-1">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Input Gaji</h4>
            </div>
            <div class="panel-body panel-form">
                <form class="form-horizontal form-bordered" data-parsley-validate="true" name="data_pengguna" action="./model/input_penggajian.php" method="POST">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4">Bulan/Tahun </label>
                        <div class="col-md-6 col-sm-6">
                            <div class="row">
                                <div class="col-md-6">
                                    <select class="form-control" name="bulan" id="bulan">
                                        <?php
                                        $arr = array("Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
                                        foreach ($arr as $key) {
                                            echo "<option value='$key'>$key</option>"; // Perbaikan penulisan option
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <select name="tahun" class="form-control" id="tahun">
                                        <?php
                                        for ($i = 2015; $i < 2026; $i++) {
                                            echo '<option value="' . $i . '">' . $i . '</option>';
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4">NIP</label>
                        <div class="col-md-6 col-sm-6">
                            <select name="nip" id="nip" data-live-search="true" data-style="btn-white" class="form-control selectpicker" onchange="getEmployeeData()">
                                <option value="1">---- Pilih NIP ----</option>
                                <?php
                                $sql = "SELECT * FROM t_pegawai ORDER BY nama_pegawai ASC";
                                $result = mysqli_query($connection, $sql);
                                if ($result && mysqli_num_rows($result) > 0) {
                                    while ($data = mysqli_fetch_assoc($result)) {
                                        echo '<option value="' . $data['nip'] . '">' . $data['nip'] . ' [' . $data['nama_pegawai'] . ']</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4">Nama Pegawai</label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="text" name="nama_pegawai" id="nama_pegawai" data-parsley-required="true" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4">Jabatan</label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="text" name="nama_jabatan" id="nama_jabatan" data-parsley-required="true" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4">Gaji Pokok</label>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-inline">
                                Rp.
                                <input class="form-control" type="text" name="gaji_pokok" id="gaji_pokok" data-parsley-required="true" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4">Tunjangan Jabatan</label>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-inline">
                                Rp.
                                <input class="form-control" type="text" name="tunjangan_jabatan" id="tunjangan_jabatan" data-parsley-required="true" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4">Bonus</label>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-inline">
                                Rp. <input class="form-control" type="number" name="bonus" id="bonus" value="0" data-parsley-required="true" />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4">Potongan</label>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-inline">
                                Rp.
                                <input class="form-control" type="text" name="potongan" id="potongan" value="0" data-parsley-required="true" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4">Gaji Bersih</label>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-inline">
                                Rp.
                                <input class="form-control" type="text" name="gaji_bersih" id="gaji_bersih" value="0" data-parsley-required="true" readonly />
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4"></label>
                        <div class="col-md-6 col-sm-6">
                            <button type="submit" class="btn btn-primary btn-sm">Submit</button> <button type="reset" class="btn btn-danger btn-sm">Reset</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>

    </div>
    <div class="col-md-6">
        <div class="panel panel-inverse" data-sortable-id="form-validation-1">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">Keterangan</h4>
            </div>
            <div class="panel-body panel-form">
                <form class="form-horizontal form-bordered" data-parsley-validate="true" name="data_pengguna" action="./model/input_penggajian.php" method="POST">
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4"> Hadir </label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="text" data-parsley-type="number" name="hadir" id="hadir" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4"> Sakit </label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="text" data-parsley-type="number" name="sakit" id="sakit" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4"> Ijin </label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="text" data-parsley-type="number" name="ijin" id="ijin" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4"> Tanpa Keterangan </label>
                        <div class="col-md-6 col-sm-6">
                            <input class="form-control" type="text" data-parsley-type="number" name="tanpa_keterangan" id="tanpa_keterangan" readonly />
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-4 col-sm-4"> Potongan Absen </label>
                        <div class="col-md-6 col-sm-6">
                            <div class="form-inline">
                                Rp.
                                <input class="form-control" type="text" data-parsley-type="number" name="potonganx" id="potonganx" readonly />
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>

<div class="row">
    <!-- begin col-12 -->
    <div class="col-md-12">
        <!-- begin panel -->
        <div class="panel panel-inverse">
            <div class="panel-heading">
                <div class="panel-heading-btn">
                    <a href="javascript:;" class="btn btn-xs btn-icon btn-circle btn-warning" data-click="panel-collapse"><i class="fa fa-minus"></i></a>
                </div>
                <h4 class="panel-title">List Data Gaji</h4>
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <table id="data-table" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Tanggal</th>
                                <th>Periode Gaji</th>
                                <th>NIP</th>
                                <th>Nama</th>
                                <th>Gaji Bersih</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $sql = "SELECT * FROM view_gaji";
                            $result = mysqli_query($connection, $sql);
                            if ($result && mysqli_num_rows($result) > 0) {
                                $i = 0;
                                while ($data = mysqli_fetch_assoc($result)) {
                                    $i++;
                            ?>
                                    <tr>
                                        <td><?php echo $i; ?></td>
                                        <td><?php echo date("d-F-Y", strtotime($data['tanggal_penggajian'])); ?></td>
                                        <td><?php echo $data['bulan'] . ' / ' . $data['tahun']; ?></td>
                                        <td><?php echo $data['nip']; ?></td>
                                        <td><?php echo $data['nama_pegawai']; ?></td>
                                        <td align="right"><?php echo 'Rp. ' . number_format($data['gaji_bersih']); ?></td>
                                        <td>
                                            <a href='index.php?p=edit_penggajian&&no_penggajian=<?php echo $data['no_penggajian']; ?>' class="btn btn-default btn-icon btn-sm" title='Edit'><i class="fa fa-expand"></i></a>
                                            <a onclick="konfirmasi('<?php echo $data['nip']; ?>','../index.php?p=data_gaji','../model/hapus_penggajian.php?');" class="btn btn-danger btn-icon btn-sm" title='Hapus'><i class="fa fa-times"></i></a>
                                            <a href='index.php?p=cetak&&no_penggajian=<?php echo $data['no_penggajian']; ?>' class="btn btn-primary btn-icon btn-sm" title='Detail'><i class='glyphicon glyphicon-folder-open'></i></a>
                                        </td>
                                    </tr>
                                <?php
                                }
                            } else {
                                echo '<tr><td colspan="7">Data tidak ditemukan.</td></tr>';
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- end panel -->
    </div>
    <!-- end col-12 -->
</div>

<!-- Di bagian akhir dari halaman HTML atau PHP Anda -->
<script>
function getEmployeeData() {
    var nip = document.getElementById('nip').value;
    var xhr = new XMLHttpRequest();
    xhr.open('GET', './model/get_employee_data.php?nip=' + nip, true);
    xhr.onload = function () {
        if (xhr.status === 200) {
            var data = JSON.parse(xhr.responseText);
            document.getElementById('nama_pegawai').value = data.nama_pegawai;
            document.getElementById('nama_jabatan').value = data.nama_jabatan;
            document.getElementById('gaji_pokok').value = data.gaji_pokok;
            document.getElementById('tunjangan_jabatan').value = data.tunjangan_jabatan;
            // Anda bisa tambahkan handling untuk field lainnya di sini
        } else {
            alert('Request failed. Status: ' + xhr.status);
        }
    };
    xhr.send();
}
</script>

<?php
} else {
?>
<script type="text/javascript">
    window.location.href = "../../halaman_error.php";
</script>
<?php
}
?>
