<?php include '../app/views/includes/header.php'; ?>
<div class="container">
    <h2>Delete T-Shirt</h2>

    <?php if (isset($error)) : ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . '?tshirtid=' . $tshirtid, ENT_QUOTES, 'UTF-8'); ?>">
        <div class="form-group">
            <label for="image">ID:</label>
            <input type="text" class="form-control" name="tshirtid" id="tshirtid" value="<?php echo htmlspecialchars($tshirtid, ENT_QUOTES, 'UTF-8'); ?>">
        </div>
        <?php if (isset($errors)) : ?>
            <div id="error-message" class="alert alert-danger mt-3" role="alert">
                <?php foreach ($errors as $error) {
                    echo "<p>$error</p>"; // Display individual error messages
                } ?>
            </div>
        <?php endif; ?>
        <button type="submit" class="btn btn-primary">Delete</button>
    </form>
</div>
<!-- <script src="js/tshirts.js"></script> -->