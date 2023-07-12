<?php include '../app/views/includes/header.php'; ?>
<div class="container p-3">
    <h1 class="text-center">User List</h1>
    <div class="table-responsive shadow-lg rounded border border-2">
        <table class="table table-hover">
            <thead class="thead-dark text-center">
                <tr>
                    <th>Username</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="text-center align-middle">
                <?php foreach ($userList as $user) : ?>
                    <tr>
                        <td><?php echo $user['Username']; ?></td>
                        <td><?php echo $user['Role']; ?></td>
                        <td>
                            <a href="edituser.php?userid=<?php echo $user['UserID']; ?>" class="btn btn-warning btn-lg" role="button">
                                <i class="fa-solid fa-pen fa-xl"></i>
                            </a>
                            <button class="btn btn-danger btn-lg delete-user" data-userid="<?php echo $user['UserID']; ?>">
                                <i class="fa-solid fa-trash-can fa-xl"></i>
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
    <?php if (empty($userList)) : ?>
        <p class="text-center">No users found</p>
    <?php endif; ?>
    <div class="d-flex justify-content-center">
        <a href="adduser.php" type="submit" class="btn btn-primary text-center mb-3 mt-3 btn-lg">
            <i class="fa-solid fa-square-plus fa-xl"></i>
        </a>
    </div>
    <nav aria-label="User navigation" class="d-flex justify-content-center">
        <ul class="pagination">
            <?php if ($currentPage > 1) : ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $currentPage - 1; ?>">Previous</a>
                </li>
            <?php endif; ?>

            <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <li class="page-item <?php echo $currentPage == $i ? 'active' : ''; ?>">
                    <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                </li>
            <?php endfor; ?>

            <?php if ($currentPage < $totalPages) : ?>
                <li class="page-item">
                    <a class="page-link" href="?page=<?php echo $currentPage + 1; ?>">Next</a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
</div>
<script src="js/userdelete.js"></script>