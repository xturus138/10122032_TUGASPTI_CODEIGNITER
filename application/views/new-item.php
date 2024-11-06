<!DOCTYPE html>
<html>

<head>
    <?php include 'inc/head.php'; ?>
    <script type="text/javascript" src="js/jquery-3.7.1.min.js"></script>
</head>

<body class="skin-blue">
    <?php include 'inc/header.php'; ?>
    <div class="wrapper row-offcanvas row-offcanvas-left">
        <?php include 'sidebar-nav.php'; ?>
    </div>
    <aside class="right-side">
        <section class="content-header">
            <h1>Kelola Produk</h1>
            <ol class="breadcrumb">
                <li><a href="<?php echo site_url('dashboard'); ?>"><i class="fa fa-dashboard"></i> Dashboard</a></li>
                <li class="active">Produk</li>
            </ol>
        </section>
        <br>
        <div class="col-md-2">
            <!-- Small modal -->
            <div class="form-group">
                <button class="btn btn-default" data-toggle="modal" data-target=".bs-example-modal-sm">
                    <span class="glyphicon glyphicon-plus"></span> Tambah Model Baru
                </button>
            </div>
        </div>
        <div class="col-md-7"></div>
        <div class="col-md-3">
            <!-- search form -->
            <form action="" method="POST">
                <div class="input-group">
                    <input type="text" id="input-kode" name="q" class="form-control"
                        placeholder="Masukkan kode model..." required />
                    <span class="input-group-btn">
                        <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i
                                class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>
            <!-- /.search form -->
        </div>
        <br>
        <!-- Modal Add Item -->
        <div class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-sm">
                <div class="modal-content">
                    <div class="box box-warning">
                        <div class="box-header">
                            <h3 class="box-title">New Item</h3>
                        </div><!-- /.box-header -->
                        <div class="box-body">
                            <form id="form-insert-item" role="form">
                                <div class="form-group">
                                    <label>Kode Model</label>
                                    <input type="text" name="kd_model" class="form-control" maxlength="4"
                                        placeholder="Kode model maksimal 4 digit ..." required />
                                </div>
                                <div class="form-group">
                                    <label>Nama Model</label>
                                    <input type="text" name="nama_model" class="form-control"
                                        placeholder="Masukkan nama model ..." required />
                                </div>
                                <div class="form-group">
                                    <label>Keterangan</label>
                                    <textarea name="deskripsi" class="form-control" rows="3"
                                        placeholder="Masukkan deskripsi produk ..."></textarea>
                                </div>
                                <div class="box-footer">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                    <button type="reset" class="btn btn-warning">Reset</button>
                                </div>
                            </form>
                        </div><!-- /.box-body -->
                    </div><!-- /.box -->
                </div>
            </div>
        </div>
        <!-- Ajax Tambah Item / TABEL -->
        <div id="ajax_add_item"></div><!-- /.Ajax Tambah Item -->
    </aside>
    <?php include 'inc/jq.php'; ?>
</body>

<script type="text/javascript">
    $(document).ready(function () {
        // menampilkan semua list agenda saat pertama kali halaman utama diload
        $("#ajax_add_item").load("<?php echo site_url('newitem/lihat_item_paging'); ?>");

        // melakukan proses tambah item ketika tombol ditekan
        $('#form-insert-item').submit(function (e) {
            e.preventDefault();
            $.ajax({
                type: 'POST',
                url: "<?php echo site_url('newitem/proses_tambah_item'); ?>",
                data: $(this).serialize(),
                success: function (data) {
                    $('#ajax_add_item').load("<?php echo site_url('newitem/lihat_item_paging'); ?>");
                    $('.bs-example-modal-sm').modal('hide');
                    $("#form-insert-item")[0].reset();
                    alert('success');
                },
                error: function (data) {
                    alert("error");
                }
            });
        });

        // melakukan proses pencarian ketika mengetikkan nama agenda
        $('#input-kode').keyup(function () {
            var kd_model = $('#input-kode').val();
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('newitem/proses_cari_item'); ?>",
                data: { kd_model: kd_model },
                success: function (html) {
                    $('#ajax_add_item').html(html);
                }
            });
        });
    });
</script>

</html>