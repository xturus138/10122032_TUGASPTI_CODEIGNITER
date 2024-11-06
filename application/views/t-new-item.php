<?php echo $this->pagination->create_links(); ?>
<div class="col-md-12">
    <div class="box box-warning">
        <div class="box-body no-padding">
            <table class="table">
                <thead>
                    <tr>
                        <th>No.</th>
                        <th>Kode Model</th>
                        <th>Nama Model</th>
                        <th>Keterangan</th>
                        <th colspan='2'>
                            <div align="center">Aksi</div>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($daftar_item as $item) { ?>
                        <tr>
                            <td><?php echo $i++; ?></td>
                            <td><?php echo $item->kd_model; ?></td>
                            <td><?php echo $item->nama_model; ?></td>
                            <td><?php echo $item->deskripsi; ?></td>
                            <td width="50">
                                <button data-kode="<?php echo $item->kd_model; ?>" class="btn btn-primary btn-xs btn-edit">
                                    <span class="glyphicon glyphicon-edit"></span>
                                </button>
                            </td>
                            <td width="50">
                                <a href="<?php echo site_url('newitem/delete_item/' . $item->kd_model); ?>"
                                    class="btn btn-danger btn-xs"
                                    onclick="return confirm('Apakah Anda yakin untuk menghapus produk ini?');">
                                    <span class="glyphicon glyphicon-trash"></span>
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
    <a class="btn btn-success" href="<?php echo site_url('report'); ?>" role="button">
        <i class="fa fa-file-excel-o"></i> Export to Excel
    </a>
</div>
<?php echo $this->pagination->create_links(); ?>