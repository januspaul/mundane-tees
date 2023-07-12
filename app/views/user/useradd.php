<?php include '../app/views/includes/header.php' ?>
<div class="container d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="text-center p-3 shadow-lg rounded border border-1">
        <h1>Add User</h1>
        <form id="adduser-form" class="row g-3">
            <div class="d-flex justify-content-center">
                <div class="col-md-5 mb-3">
                    <label for="username" class="form-label">Username:</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="col-md-5 mb-3">
                    <label for="password" class="form-label">Password:</label>
                    <input type="password" class="form-control" id="password" name="password" min="8" required>
                </div>
            </div>
            <div class="d-flex justify-content-center">
                <div class="col-md-5 mb-3">
                    <label for="role" class="form-label">Role:</label>
                    <select class="form-control" id="role" name="role" required>
                        <?php
                        $roles = array("admin", "editor", "viewer");
                        foreach ($roles as $role) {
                            echo "<option value=\"$role\">$role</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div id="error-message" class="alert alert-danger mt-3" role="alert" style="display: none;"></div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary btn-lg text-center">
                    <i class="fa-solid fa-square-plus fa-xl"></i>
                </button>
            </div>
        </form>
    </div>
</div>
<script src="js/useradd.js"></script>