<?php include '../app/views/includes/header.php'; ?>
<div class="container d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="text-center shadow-lg p-3 rounded border border-1">
        <h1>Edit User</h1>
        <form id="edituser-form" class="row g-3">
            <div class="d-flex justify-content-center">
                <div class="col-md-5 mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" value="<?php echo htmlspecialchars($user['Username']); ?>" required>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="col-md-5 mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" placeholder="password" min="8" required>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="col-md-5 mb-3">
                    <label for="role" class="form-label">Role:</label>
                    <select class="form-control" id="role" name="role" required>
                        <?php
                        $roles = array("admin", "editor", "viewer");
                        foreach ($roles as $role) {
                            $selected = ($user['Role'] === $role) ? 'selected' : '';
                            echo "<option value=\"$role\" $selected>$role</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <input type="hidden" name="userid" id="userid" value="<?php echo htmlspecialchars($userid); ?>">
            <div id="error-message" class="alert alert-danger mt-3" role="alert" style="display: none;"></div>
            <?php if (empty($user)) : ?>
                <p>User not found</p>
            <?php endif; ?>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk fa-xl"></i>
                </button>
            </div>
        </form>
    </div>
</div>
<script src="js/useredit.js"></script>