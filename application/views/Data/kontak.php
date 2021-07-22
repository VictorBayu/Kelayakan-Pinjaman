<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800"><?= $title; ?></h1>
    <div class="row">
        <div class="col-md-5">
            <?= $this->session->flashdata('message'); ?>
            <form action="<?= base_url('data/kontak'); ?>" method="post">
                <div class="input-group mb-1">
                    <input type="text" class="form-control" placeholder="Search Keyword" name="keyword" autocomplete="off" autofocus>
                    <div class="input-group-append">
                        <input class="btn btn-primary" type="submit" name="submit">
                    </div>
                </div>
            </form> 
        </div>
    </div>
    <div class="row">
        <div class="col-lg-10">
            <h5>Result : <?= $total_rows; ?></h5>
            <!-- <a href="<?= base_url('user/export_Excel'); ?>" class="btn btn-outline-success mb-1">Export</a> -->
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Nama Nasabah</th>
                        <th scope="col">Kontak Nasabah</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($kontak)) : ?>
                        <tr>
                            <td colspan="10">
                                <div class="alert alert-danger" role="alert"> Data not Found!
                                </div>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php foreach ($kontak as $k) : ?>
                        <tr>
                            <th scope="row"><?= ++$start; ?></th>
                            <td><?= $k['nama_nasabah']; ?></td>
                            <td><?= $k['no_nasabah']; ?></td>
                            <td>
                                <a href="<?= base_url('data/updateNasabah/'); ?><?= $k['id_kontak']; ?>" class="badge badge-success" data-toggle="modal" data-target="#ubahNasabah<?= $k['id_kontak']; ?>">Edit</a>
                                <a href="<?= base_url('data/hapusNasabah/'); ?><?= $k['id_kontak']; ?>" onclick="return confirm('Yakin Menghapus Nasabah <?= $k['nama_nasabah']; ?>?');" class="badge badge-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <?= $this->pagination->create_links(); ?>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->
<?php $a = 0;
foreach ($kontak as $k) : $a++; ?>
    <div class="modal fade" id="ubahNasabah<?= $k['id_kontak']; ?>" tabindex="-1" role="dialog" aria-labelledby="ubahNasabah" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateNasabahModalLabel">Update Nasabah</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('data/updateNasabah/'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="id_kontak" placeholder="id_kontak" value="<?= $k['id_kontak']; ?>">
                            <input type="text" class="form-control" id="nama_nasabah" name="nama_nasabah" placeholder="Nama Nasabah" value="<?= $k['nama_nasabah']; ?>">
                            <small class="form-text text-danger">
                                <?= form_error('nama_nasabah'); ?>
                            </small>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="no_nasabah" name="no_nasabah" placeholder="Kontak Nasabah" value="<?= $k['no_nasabah']; ?>">
                            <small class="form-text text-danger">
                                <?= form_error('no_nasabah'); ?>
                            </small>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php endforeach; ?>
<script>
    $("#newSubMenuModal").on('shown.bs.modal',
        function() {
            $('#title').trigger('focus');
        });

    function addsubMenu() {
        $('#newSubMenuModal').modal('show');
    }
</script>