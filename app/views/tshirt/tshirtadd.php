<?php include '../app/views/includes/header.php' ?>
<div class="container p-5 d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="col-md-10 shadow-lg p-3 rounded border border-1">
        <div>
            <h1 class="text-center">Add Tshirt</h1>
        </div>
        <form id="addtshirt-form" class="p-3 justify-content-center">
            <div class="row">
                <div class="mb-3 col-md-6">
                    <label for="name">Name:</label>
                    <input type="text" class="form-control" id="name" name="name" required>
                </div>
                <div class="mb-3 col-md-6">
                    <label for="image">Image:</label>
                    <input type="file" class="form-control" id="image" name="image">
                </div>
            </div>
            <div class="row">
                <div class="mb-3 col-md-4">
                    <label for="size">Size:</label>
                    <select class="form-control" id="size" name="size" required>
                        <?php
                        $sizes = $presetSizes;
                        foreach ($sizes as $size) {
                            echo "<option value=\"$size\">$size</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="sleeve">Sleeve:</label>
                    <select class="form-control" id="sleeve" name="sleeve" required>
                        <?php
                        $sleeves = $presetSleeves;
                        foreach ($sleeves as $sleeve) {
                            echo "<option value=\"$sleeve\">$sleeve</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3 col-md-4">
                    <label for="style">Style:</label>
                    <select class="form-control" id="style" name="style" required>
                        <?php
                        $styles = $presetStyles;
                        foreach ($styles as $style) {
                            echo "<option value=\"$style\">$style</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row d-flex justify-content-center">
                <div class="mb-3 col-md-5">
                    <label for="neckshape">Neck Shape:</label>
                    <select class="form-control" id="neckshape" name="neckshape" required>
                        <?php
                        $neckShapes = $presetNeckShapes;
                        foreach ($neckShapes as $neckShape) {
                            echo "<option value=\"$neckShape\">$neckShape</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3 col-md-5">
                    <label for="sex">Sex:</label>
                    <select class="form-control" name="sex" id="sex" required>
                        <?php
                        $sexes = $presetSexes;
                        foreach ($sexes as $sex) {
                            echo "<option value=\"$sex\">$sex</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tags">Tags:</label><br>
                    <?php
                    // Display each tag as a checkbox
                    foreach ($tags as $tag) {
                        echo '<input type="checkbox" class="form-check-input m-2" id="' . $tag['TagID'] . '" name="tags[]" value="' . $tag['TagID'] . '">';
                        echo '  <label class="form-check-label" for="' . $tag['TagID'] . '">' . $tag['TagName'] . '</label>';
                    }
                    ?>
                </div>
            </div>
            <div id="error-message" class="alert alert-danger mt-3 text-center" role="alert" style="display: none;"></div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary rounded rounded-1 btn-lg" id="addToastBtn">
                    <i class="fa-solid fa-square-plus fa-xl"></i>
                </button>
            </div>
        </form>
    </div>
</div>

<script src="js/tshirtadd.js"></script>