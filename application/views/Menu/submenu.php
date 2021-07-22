<!-- Begin Page Content -->
<div class="container-fluid">
    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title; ?></h1>
    <a href="" class="btn btn-primary mb-3" data-toggle="modal" data-target="#newSubMenuModal">Add New Sub Menu</a>
    <div class="row">
        <div class="col-lg">
            <?= $this->session->flashdata('message'); ?>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Title</th>
                        <th scope="col">Menu</th>
                        <th scope="col">Url</th>
                        <th scope="col">Icon</th>
                        <th scope="col">Active</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $a = 1; ?>
                    <?php foreach ($subMenu as $sm) : ?>
                        <tr>
                            <th scope="row"><?= $a; ?></th>
                            <td><?= $sm['title']; ?></td>
                            <td><?= $sm['menu']; ?></td>
                            <td><?= $sm['url']; ?></td>
                            <td><?= $sm['icon']; ?></td>
                            <td><?= $sm['is_active']; ?></td>
                            <td>
                                <a href="<?= base_url('Menu/updateSubMenu/'); ?><?= $sm['id']; ?>" data-toggle="modal" data-target="#ubahSubMenu<?= $sm['id']; ?>" class="badge badge-success">Edit</a>
                                <a href="<?= base_url('Menu/hapusSubMenu/'); ?><?= $sm['id']; ?>" onclick="return confirm('Yakin Menghapus sub menu <?= $sm['title']; ?>?');" class="badge badge-danger">Delete</a>
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
<div class="modal fade" id="newSubMenuModal" tabindex="-1" role="dialog" aria-labelledby="newSubMenuModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSubMenuModalLabel">Add New Sub Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('menu/submenu'); ?>" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <input type="text" class="form-control" id="title" name="title" placeholder="Sub Menu title">
                        <small class="form-text text-danger">
                            <?= form_error('title'); ?>
                        </small>
                    </div>
                    <div class="form-group">
                        <select name="menu_id" id="menu_id" class="form-control">
                            <option value="">Select Menu</option>
                            <?php foreach ($menu as $m) : ?>
                                <option value="<?= $m['id']; ?>"><?= $m['menu']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="url" name="url" placeholder="Sub Menu url">
                        <small class="form-text text-danger">
                            <?= form_error('url'); ?>
                        </small>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control" id="icon" name="icon" placeholder="Sub Menu icon">
                        <small class="form-text text-danger">
                            <?= form_error('icon'); ?>
                        </small>
                    </div>
                    <div class="form-group">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                            <label class="form-check-label" for="is_active">
                                Active ?
                            </label>
                        </div>
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
foreach ($subMenu as $sm) : $a++; ?>
    <div class="modal fade" id="ubahSubMenu<?= $sm['id']; ?>" tabindex="-1" role="dialog" aria-labelledby="ubahSubMenu" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateSubMenuModalLabel">Update Sub Menu</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action="<?= base_url('menu/updateSubMenu/'); ?>" method="post">
                    <div class="modal-body">
                        <div class="form-group">
                            <input type="hidden" class="form-control" name="id" placeholder="id_submenu" value="<?= $sm['id']; ?>">
                            <input type="text" class="form-control" id="title" name="title" placeholder="Sub Menu title" value="<?= $sm['title']; ?>">
                            <small class="form-text text-danger">
                                <?= form_error('title'); ?>
                            </small>
                        </div>
                        <div class="form-group">
                            <select name="menu_id" id="menu_id" class="form-control">
                                <option value="">Select Menu</option>
                                <?php foreach ($menu as $m) : ?>
                                    <?php if ($sm == $subMenu['menu_id']) : ?>
                                        <option value="<?= $sm['menu_id']; ?>" selected><?= $sm['menu_id']; ?></option>
                                    <?php else : ?>
                                        <option value="<?= $sm['menu_id']; ?>"><?= $sm['menu_id']; ?></option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="url" name="url" placeholder="Sub Menu url" value="<?= $sm['url']; ?>">
                            <small class="form-text text-danger">
                                <?= form_error('url'); ?>
                            </small>
                        </div>
                        <div class="form-group">
                            <input type="text" class="form-control" id="icon" name="icon" placeholder="Sub Menu icon" value="<?= $sm['icon']; ?>">
                            <small class="form-text text-danger">
                                <?= form_error('icon'); ?>
                            </small>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="1" name="is_active" id="is_active" checked>
                                <label class="form-check-label" for="is_active">
                                    Active ?
                                </label>
                            </div>
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