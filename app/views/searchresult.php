<?php
include '../app/views/includes/header.php';
?>
<form id="search-form" class="d-flex">
  <input class="form-control me-2" type="search" id="search" name="search" placeholder="Search" aria-label="Search">
  <button class="btn btn-outline-success" type="submit">🔍</button>
</form>
<div id="error-message" class="alert alert-danger mt-3" role="alert" style="display: none;"></div>
<h1>Search Results</h1>
<div class="row" id="results-container">
</div>
<script src="js/search.js"></script>