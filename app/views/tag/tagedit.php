<?php include '../app/views/includes/header.php'; ?>
<div class="container d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="text-center p-3 shadow-lg rounded border border-1">
        <h1>Edit Tag</h1>
        <form id="edittag-form" class="row g-3">
            <div class="d-flex justify-content-center">
                <div class="col-md-5 mb-3">
                    <label for="tagname" class="form-label">Tag Name:</label>
                    <input type="text" class="form-control" id="tagname" name="tagname" value="<?php echo htmlspecialchars($tag['TagName']); ?>" required>
                </div>
            </div>
            <input type="hidden" name="tagid" id="tagid" value="<?php echo htmlspecialchars($tagid); ?>">
            <div id="error-message" class="alert alert-danger mt-3" role="alert" style="display: none;"></div>
            <?php if (empty($tag)) : ?>
                <p>Tag not found</p>
            <?php endif; ?>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary">
                    <i class="fa-solid fa-floppy-disk fa-xl"></i>
                </button>
            </div>
        </form>
    </div>
</div>
<script src="js/tagedit.js"></script>