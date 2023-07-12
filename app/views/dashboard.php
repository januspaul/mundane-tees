<?php include '../app/views/includes/header.php'; ?>
<div class="container p-3">
    <h1 class="text-center pb-3">Dashboard</h1>
    <!-- TO DO: fix shirts with multiple tags only display the tag in Search Query. -->
    <!-- example: shirts that have tags cute and sporty should show both tags. if you search for the sporty tag the cute tag will not appear.  -->
    <div class="mb-3">
        <div class="container-fluid pb-3">
            <div class="row">
                <div class="d-flex rounded">
                    <div class="col-sm-4">
                        <a href="/dashboard.php?search=sports&size=&style=&sleeve=&neckshape=&sex=">
                            <div class="image-container">
                                <img class="w-100 h-100" src="images/sportswear.jpg" alt="">
                                <div class="image-text">
                                    <p class="display-3">Sporty</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <a href="/dashboard.php?search=summer&size=&style=&sleeve=&neckshape=&sex=">
                            <div class="image-container">
                                <img class="w-100 h-100" src="images/summerwear.jpg" alt="">
                                <div class="image-text">
                                    <p class="display-3">Summer</p>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-sm-4">
                        <a href="/dashboard.php?search=winter&size=&style=&sleeve=&neckshape=&sex=">
                            <div class="image-container">
                                <img class="w-100 h-100" src="images/winterwear.jpg" alt="">
                                <div class="image-text">
                                    <p class="display-3">Winter</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <form class="d-flex flex-wrap justify-content-center" action="" method="GET">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="Search T-Shirts" name="search" value="<?php echo isset($_GET['search']) ? $_GET['search'] : ''; ?>">
                <button class="btn btn-primary" type="submit"><i class="fa-solid fa-magnifying-glass fa-xl"></i></button>
            </div>
            <p class="pt-2">Filter By:</p>
            <div class="input-group rounded col-md-12 pt-2">
                <select class="form-select mb-2" name="size">
                    <option value="">Size</option>
                    <?php
                    $sizes = $presetSizes;
                    foreach ($sizes as $size) {
                        if ($size !== '') {
                            echo "<option value=\"$size\">$size</option>";
                        }
                    }
                    ?>
                </select>
                <select class="form-select mb-2" name="style">
                    <option value="">Style</option>
                    <?php
                    $styles = $presetStyles;
                    foreach ($styles as $style) {
                        if ($style !== '') {
                            echo "<option value=\"$style\">$style</option>";
                        }
                    }
                    ?>
                </select>
                <select class="form-select mb-2" name="sleeve">
                    <option value="">Sleeve</option>
                    <?php
                    $sleeves = $presetSleeves;
                    foreach ($sleeves as $sleeve) {
                        if ($sleeve !== '') {
                            echo "<option value=\"$sleeve\">$sleeve</option>";
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="input-group rounded col-md-12 pt-2">
                <select class="form-select mb-2" name="neckshape">
                    <option value="">NeckShape</option>
                    <?php
                    $neckshapes = $presetNeckShapes;
                    foreach ($neckshapes as $neckshape) {
                        if ($neckshape !== '') {
                            echo "<option value=\"$neckshape\">$neckshape</option>";
                        }
                    }
                    ?>
                </select>
                <select class="form-select mb-2" name="sex">
                    <option value="">Sex</option>
                    <?php
                    $sexes = $presetSexes;
                    foreach ($sexes as $sex) {
                        if ($sex !== '') {
                            echo "<option value=\"$sex\">$sex</option>";
                        }
                    }
                    ?>
                </select>
            </div>
        </form>
    </div>

    <?php if (!empty($tshirtList)) : ?>
        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4" id="tshirt-container">
            <?php foreach ($tshirtList as $tshirt) : ?>
                <div class="col">
                    <div class="card card-dashboard h-100 shadow-lg">
                        <a href="tshirtdetails.php?id=<?php echo $tshirt['TshirtID'] ?>" style="text-decoration: none; object-fit:cover;" class="h-100"><img src="<?php echo $tshirt['Image']; ?>" class="card-img-top h-100" alt="T-shirt Image" style="object-fit:cover;"></a>
                        <div class="card-body align-center text-center">
                            <p class="card-title display-4 text-center fw-semibold"><?php echo $tshirt['Name']; ?></p>
                            <div class="row">
                                <div class="col-md-6">
                                    <p class="card-text">Size: <?php echo $tshirt['Size']; ?></p>
                                    <p class="card-text">Style: <?php echo $tshirt['Style']; ?></p>
                                </div>
                                <div class="col-md-6">
                                    <p class="card-text">Sex: <?php echo $tshirt['Sex']; ?></p>
                                    <p class="card-text">Sleeve: <?php echo $tshirt['Sleeve']; ?></p>
                                </div>
                            </div>
                            <hr>
                            <div class="tags d-flex justify-content-center pb-2">
                                <?php
                                $tagNames = !is_null($tshirt['TagNames']) ? explode(", ", $tshirt['TagNames']) : [];
                                foreach ($tagNames as $tagName) {
                                    echo '<a class="btn btn-sm badge bg-primary m-1 fst-italic" href="/dashboard.php?search=' . $tagName . '&size=&style=&sleeve=&neckshape=&sex=">' . $tagName . '</a>';
                                }
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <?php if ($totalTshirts > $perPage) : ?>
            <nav aria-label="T-Shirt Pagination" class="d-flex justify-content-center pt-2">
                <ul class="pagination">
                    <?php
                    $totalPages = ceil($totalTshirts / $perPage);
                    for ($i = 1; $i <= $totalPages; $i++) {
                        echo '<li class="page-item' . ($i === $currentPage ? ' active' : '') . '"><a class="page-link" href="?search=' . urlencode($_GET['search'] ?? '') . '&page=' . $i . '">' . $i . '</a></li>';
                    }
                    ?>
                </ul>
            </nav>
        <?php endif; ?>
    <?php else : ?>
        <div class="alert alert-info text-center" role="alert">
            No T-Shirts found.
        </div>
    <?php endif; ?>
</div>
<script src="js/dashboard.js"></script>