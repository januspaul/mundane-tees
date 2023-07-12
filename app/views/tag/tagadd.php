<?php include '../app/views/includes/header.php' ?>
<div class="container p-5 d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="shadow-lg rounded p-3 border border-1">
        <h1 class="text-center">Add Tag</h1>
        <form id="addtag-form" class="row g-3">
            <div class="d-flex justify-content-center">
                <div class="col-md-5 mb-3">
                    <label for="tagname" class="form-label">Tag Name:</label>
                    <input type="text" class="form-control" id="tagname" name="tagname" required>
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
<script src="js/tagadd.js"></script>