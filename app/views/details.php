<?php include '../app/views/includes/header.php'; ?>

<div class="container p-1">
    <div>
        <h1 class="text-center">T-Shirt Details</h1>
        <h5 class="card-title display-2 text-center"><?php echo $tshirt['Name']; ?></h5>
    </div>    
    <div class="d-flex justify-content-center shadow-lg">
        <div class="card" style="width: 100vw;">
            <div class="row g-0">
                <div class="col-md-6 p-3">
                    <img src="<?php echo $tshirt['Image']; ?>" class="card-img-top h-100" alt="T-shirt Image" style="height: 100vh;">
                </div>
                <div class="col-md-6">
                    <div class="card-body">
                        <div class="row">
                            <h4 class="card-text display-6">Size: <?php echo $tshirt['Size']; ?></h4>
                            <h4 class="card-text display-6">Style: <?php echo $tshirt['Style']; ?></h4>
                            <h4 class="card-text display-6">Tshirt ID: <?php echo $tshirt['TshirtID']; ?></h4>
                            <h4 class="card-text display-6">Sleeve: <?php echo $tshirt['Sleeve']; ?></h4>
                            <h4 class="card-text display-6">Neck Shape: <?php echo $tshirt['NeckShape']; ?></h4>
                            <h4 class="card-text display-6">Sex: <?php echo $tshirt['Sex']; ?></h4>
                            <h4 class="card-text display-6 text-truncate">Item Code: <?php echo $tshirt['ItemCode']; ?></h4>
                            <h4 class="card-text display-6 text-truncate">Date Created: <?php echo $tshirt['DateCreated']; ?></h4>
                            <h4 class="card-text display-6">Created By: <?php echo $tshirt['UserID']; ?></h4>
                            <h4 class="card-text display-6">Tags: <?php echo $tshirt['TagNames']; ?></h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center p-2">
        <a href="#" class="btn btn-primary btn-lg" id="goBackBtn">Go back</a>
    </div>
</div>
<script src="js/header.js"></script>