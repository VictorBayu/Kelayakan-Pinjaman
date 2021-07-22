<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newRoleModal">Add New Role</a>
    <div class="row">
        <div class="col-lg-6">
            <?= form_error('role', '<div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Role</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $a = 1; ?>
                    <?php foreach ($role as $r) : ?>
                        <tr>
                            <th scope="row"><?= $a; ?></th>
                            <td><?= $r['role']; ?></td>
                            <td>
                                <a href="<?= base_url('admin/roleAccess/') . $r['id']; ?>" class=" badge badge-warning">Access</a>
                                <a href="<?= base_url('Admin/ubahdataRole/') . $r['id']; ?>" class="badge badge-success" data-toggle="modal" data-target="#updateRole<?= $r['id']; ?>">Edit</a>
                                <a href="<?= base_url('Admin/hapus/') . $r['id']; ?>" onclick="return confirm('Yakin menghapus role <?= $r['role']; ?> ?');" class="badge badge-danger">Delete</a>
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
<div class="modal fade" id="newRoleModal" tabindex="-1" role="dialog" aria-labelledby="newRoleModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newRoleModalLabel">Add New Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/role'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="role" name="role" placeholder="Role name">
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
foreach ($role as $r) : $a++; ?>
    <div class="modal fade" id="updateRole<?= $r['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="updateRole" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateRoleModalLabel">Update Role</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('admin/ubahdataRole/'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="id" placeholder="id_name" value="<?= $r['id']; ?>">
                            <input type="text" class="form-control" id="role" name="role" placeholder="Role name" value="<?= $r['role']; ?>">
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