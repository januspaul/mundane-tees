<?php include '../app/views/includes/header.php'; ?>
<div class="container p-3">
    <h1 class="text-center">Tag List</h1>
    <div class="table-responsive shadow-lg rounded border border-1">
        <table class="table table-hover">
            <thead class="thead-dark text-center">
                <tr>
                    <th>Tag ID</th>
                    <th>Tag Name</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="text-center align-middle">
                <?php foreach ($taglist as $tag) : ?>
                    <tr>
                        <td><?php echo $tag['TagID']; ?></td>
                        <td><?php echo $tag['TagName']; ?></td>
                        <td>
                            <a href="edittag.php?tagid=<?php echo $tag['TagID']; ?>" class="btn btn-warning btn-lg" role="button">
                                <i class="fa-solid fa-pen fa-xl"></i>
                            </a>
                            <?php  if ($_SESSION['role'] === 'admin') :?>
                                <button class="btn btn-danger btn-lg delete-tag" data-tagid="<?php echo $tag['TagID']; ?>">
                                <i class="fa-solid fa-trash-can fa-xl"></i>
                            </button>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($taglist)) : ?>
                    <tr>
                        <td colspan="3">No tags found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        <a href="addtag.php" class="btn btn-primary mt-3 mb-3 btn-lg"> <i class="fa-solid fa-square-plus fa-xl"></i>
        </a>
    </div>
</div>
<script src="js/tagdelete.js"></script>