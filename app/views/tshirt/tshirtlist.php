<?php include '../app/views/includes/header.php'; ?>
<div class="container p-3">
    <h1 class="text-center">Tshirt List</h1>
    <div class="table-responsive shadow-lg rounded border border-2">
        <table class="table table-hover">
            <thead class="thead-dark text-center">
                <tr>
                    <th>Tshirt ID</th>
                    <th>Size</th>
                    <th>Sleeve</th>
                    <th>Style</th>
                    <th>Neck Shape</th>
                    <th>Sex</th>
                    <th>Name</th>
                    <th>Image</th>
                    <th>User ID</th>
                    <th>Tags</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody class="text-center align-middle">
                <?php foreach ($tshirtlist as $tshirt) : ?>
                    <tr>
                        <td><?php echo $tshirt['TshirtID']; ?></td>
                        <td><?php echo $tshirt['Size']; ?></td>
                        <td><?php echo $tshirt['Sleeve']; ?></td>
                        <td><?php echo $tshirt['Style']; ?></td>
                        <td><?php echo $tshirt['NeckShape']; ?></td>
                        <td><?php echo $tshirt['Sex']; ?></td>
                        <td><?php echo $tshirt['Name']; ?></td>
                        <td>
                            <?php if (!empty($tshirt['Image'])) : ?>
                                <img src="<?php echo $tshirt['Image']; ?>" alt="<?php echo $tshirt['Image']; ?>" height="100" width="100">
                            <?php else : ?>
                                <img src="assets/placeholder.jpg" alt="Placeholder Image" height="100" width="100">
                            <?php endif; ?>
                        </td>
                        <td><?php echo $tshirt['UserID']; ?></td>
                        <td><?php echo $tshirt['TagNames']?></td>
                        <td>
                            <a href="edittshirt.php?tshirtid=<?php echo $tshirt['TshirtID']; ?>" class="btn btn-warning btn-lg"><i class="fa-solid fa-pen fa-xl"></i></a>
                            <?php if ($_SESSION['role'] === 'admin') : ?>
                                <button class="btn btn-danger delete-tshirt btn-lg" data-tshirtid="<?php echo $tshirt['TshirtID']; ?>">
                                <i class="fa-solid fa-trash-can fa-xl"></i>
                            </button>
                            <?php endif?>
                        </td>
                    </tr>
                <?php endforeach; ?>
                <?php if (empty($tshirtlist)) : ?>
                    <tr>
                        <td colspan="10">No tshirt found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    <div class="d-flex justify-content-center">
        <a href="addtshirt.php" class="btn btn-primary mt-3 mb-3 btn-lg"><i class="fa-solid fa-square-plus fa-xl"></i></a>
    </div>
    <nav aria-label="Tshirt navigation" class="d-flex justify-content-center">
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
<script src="js/tshirtdelete.js"></script>