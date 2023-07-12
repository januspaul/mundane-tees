<?php include '../app/views/includes/header.php'; ?>
<div class="container p-5 d-flex justify-content-center align-items-center" style="min-height: 60vh;">
    <div class="col-md-10 shadow-lg p-3 rounded border order-1">
        <div>
            <h1 class="text-center">Edit Tshirt</h1>
        </div>
        <form id="edittshirt-form" class="p-3">
            <div class="row">
                <div class="col-md-12 d-flex justify-content-center pb-3 rounded">
                    <img src="<?php echo $tshirt['Image'] ?>" alt="" class="rounded h-100 w-100">
                </div>
                <div class="form-group col-md-6">
                    <label for="name" class="form-label">Name:</label>
                    <input type="text" class="form-control" name="name" id="name" value="<?php echo htmlspecialchars($tshirt['Name'], ENT_QUOTES, 'UTF-8'); ?>">
                </div>
                <div class="form-group col-md-6">
                    <label for="image" class="form-label">Image:</label>
                    <input type="file" class="form-control" name="image" id="image">
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="size" class="form-label">Size:</label>
                    <select class="form-control" name="size" id="size">
                        <?php
                        $sizes = $presetSizes;
                        foreach ($sizes as $size) {
                            $selected = ($tshirt['Size'] === $size) ? 'selected' : '';
                            echo "<option value=\"$size\" $selected>$size</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="sleeve" class="form-label">Sleeve:</label>
                    <select class="form-control" name="sleeve" id="sleeve">
                        <?php
                        $sleeves = $presetSleeves;
                        foreach ($sleeves as $sleeve) {
                            $selected = ($tshirt['Sleeve'] === $sleeve) ? 'selected' : '';
                            echo "<option value=\"$sleeve\" $selected>$sleeve</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="style" class="form-label">Style:</label>
                    <select class="form-control" name="style" id="style">
                        <?php
                        $styles = $presetStyles;
                        foreach ($styles as $style) {
                            $selected = ($tshirt['Style'] === $style) ? 'selected' : '';
                            echo "<option value=\"$style\" $selected>$style</option>";
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-md-6">
                    <label for="neckshape" class="form-label">Neck Shape:</label>
                    <select class="form-control" name="neckshape" id="neckshape">
                        <?php
                        $neckShapes = $presetNeckShapes;
                        foreach ($neckShapes as $neckShape) {
                            $selected = ($tshirt['NeckShape'] === $neckShape) ? 'selected' : '';
                            echo "<option value=\"$neckShape\" $selected>$neckShape</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="form-group col-md-6">
                    <label for="sex" class="form-label">Sex:</label>
                    <select class="form-control" name="sex" id="sex">
                        <?php
                        $sexes = $presetSexes;
                        foreach ($sexes as $sex) {
                            $selected = ($tshirt['Sex'] === $sex) ? 'selected' : '';
                            echo "<option value=\"$sex\" $selected>$sex</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="tags">Tags:</label><br>
                    <?php
                    foreach ($tags as $tag) {
                        $checked = in_array($tag['TagName'], explode(', ', $tshirt['TagNames'])) ? 'checked' : '';
                        echo '<input type="checkbox" class="form-check-input m-2" id="' . $tag['TagID'] . '" name="tags[]" value="' . $tag['TagID'] . '" ' . $checked . '>';
                        echo '  <label class="form-check-label" for="' . $tag['TagID'] . '">' . $tag['TagName'] . '</label>';
                    }
                    ?>
                </div>
                <div class="form-group" style="display: none;">
                    <label for="tshirtid">Tshirt ID:</label>
                    <input type="text" class="form-control" name="tshirtid" id="tshirtid" value="<?php echo htmlspecialchars($tshirt['TshirtID'], ENT_QUOTES, 'UTF-8'); ?>" hidden>
                </div>
                <div class="form-group" style="display: none;">
                    <label for="itemcode">Item Code:</label>
                    <input type="text" class="form-control" name="itemcode" id="itemcode" value="<?php echo htmlspecialchars($tshirt['ItemCode'], ENT_QUOTES, 'UTF-8'); ?>" hidden>
                </div>
                <div class="form-group" style="display: none;">
                    <label for="image">User ID:</label>
                    <input type="text" class="form-control" name="userid" id="userid" value="<?php echo htmlspecialchars($tshirt['UserID'], ENT_QUOTES, 'UTF-8'); ?>" hidden>
                </div>
                <div class="form-group" style="display: none;">
                    <label for="datecreated">Date Created:</label>
                    <input type="text" class="form-control" name="datecreated" id="datecreated" value="<?php echo htmlspecialchars($tshirt['DateCreated'], ENT_QUOTES, 'UTF-8'); ?>" hidden>
                </div>
            </div>
            <div id="error-message" class="alert alert-danger mt-3 text-center" role="alert" style="display: none;"></div>
            <div class="d-flex justify-content-center">
                <button type="submit" class="btn btn-primary rounded rounded-1 btn-lg mt-3"><i class="fa-solid fa-floppy-disk fa-xl"></i></button>
            </div>
        </form>
    </div>
</div>
<script src="js/tshirtedit.js"></script>