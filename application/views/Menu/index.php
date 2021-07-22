<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <!-- <script>
        $(document).ready(function(){
            $("#newMenuModal").on('shown.bs.modal', function(){
                $(this).find('input[type="text"]').focus();
            });
        });
    </script> -->
    <button href="#newMenuModal" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newMenuModal">Add New Menu</button>
    <div class="row">
        <div class="col-lg-6">
            <?= form_error('menu', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $a = 1; ?>
                    <?php foreach ($menu as $m) : ?>
                        <tr>
                            <th scope="row"><?= $a; ?></th>
                            <td><?= $m['menu']; ?></td>
                            <td>
                                <a href="<?= base_url('Menu/ubahdataMenu/'); ?><?= $m['id']; ?>" class="badge badge-success" data-toggle="modal" data-target="#updateMenu<?= $m['id']; ?>">Edit</a>
                                <a href="<?= base_url('Menu/hapus/'); ?><?= $m['id']; ?>" onclick="return confirm('Yakin menghapus menu <?= $m['menu']; ?>?');" class="badge badge-danger">Delete</a>
                            </td>
                        </tr>
                        <?php $a++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
<!-- /.container-fluid -->
</div>
<!-- End of Main Content -->
<!-- modal -->
<!-- Button trigger modal -->

<!-- Modal -->
<div class="modal fade" id="newMenuModal" tabindex="-1" role="dialog" aria-labelledby="newMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newMenuModalLabel">Add New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name">
                        <script>
                            $('#newMenuModal').on('shown.bs.modal', function() {
                                $('#menu').trigger('focus')
                            })
                        </script>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </form>
        </div>
    </div>
</div>

<?php $a = 0;
foreach ($menu as $m) : $a++; ?>
    <div class="modal fade" id="updateMenu<?= $m['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateMenu" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateMenuModalLabel">Update Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('menu/ubahdataMenu/'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="id" placeholder="id_name" value="<?= $m['id']; ?>">
                            <input type="text" class="form-control" id="menu" name="menu" placeholder="Menu name" value="<?= $m['menu']; ?>">
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
    $("#newMenuModal").on('shown.bs.modal',
        function() {
            $('#menu').trigger('focus');
        });

    function addsubMenu() {
        $('#newMenuModal').modal('show');
    }
</script>