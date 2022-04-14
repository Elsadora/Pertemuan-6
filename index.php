<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Index Page Dinamis 1</title>

    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous" /> -->
    <link rel="stylesheet" href="Bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet"href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.8.1/font/bootstrap-icons.css"/>

</head>
<body>
  <div class="container">
    <h1 style="text-align: center">ELSADORA'S RECOMENDATION MEAL FOR DIET</h1>

    <button type="button" class="btn btn-primary float-end"><i class="fas fa-plus-circle"></i> Create</button>

    <div class="row">
        <div class="col-sm input-group mb-3">
            <input type="text" class="form control" id="search" placeholder="Search Menu ..." aria-describedby="button-addon2">
            <button class="btn btn-primary" type="button" id="button-addon2">
              <i class="fas fa-search"></i>
            </button>
        </div>
        <div class="col-sm input-group mb-3">
          <select class="form-select" id="filter" aria-label="Default select example">
              <option class="text-muted" selected>Filter Menu Rating</option>
              <option value="4.5-5">4.5-5</option>
              <option value="3-4">3-4</option>
              <option value="less than 2.5">less than 2.5</option>
          </select>
        </div>
        <div class="col-sm input-group mb-3">
          <select class="form-select" id="sorting" aria-label="Default select example">
              <option value="ASC">Sort by Menu Ascending</option>
              <option value="DESC">Sort by Menu Descending</option>
              </select>
        </div>
    </div>
    <div class="row" id="content">
      <?php
      require_once 'db.php';
      $query = mysqli_query($db, "SELECT * FROM food_recomendation");
      while ($row = mysqli_fetch_object($query)) :
      ?>
        <div class="col-sm filter">
          <div class="card" style="width: 15rem">
            <img src="<?= $row->gambar; ?>" class="card-img-top" alt="..." />
            <div class="card-body">
              <h5 class="card-title"><?= $row->namaMenu;?></h5>
              <div class="d-flex justify-content-between align-items-center">
                <div class="d-flex justify-content-start">
                  <p class="card-text m-1"><?= $row->deskripsi;?></p>
                  <p style="color: orange" class="m-1">
                    <i class="bi bi-star-fill"><?= $row->rating;?></i></p>
                </div>
                <div class="d-flex justify-content-end">
                  <div class="card-btn pe-4">
                  <a href="#"><i class="bi bi-pencil-fill"></i></a>
                  <a href="#" class="text-danger"
                      ><i class="bi bi-trash3-fill"></i
                  ></a>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>  
      <?php endwhile; ?>
    </div>
  </div>
  <script src="Bootstrap/js/bootstrap.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" charset="utf-8"></script>
  <script type="text/javascript">
    $(document).ready(function() {
      $('#search').on('keyup', function() {
        $.ajax({
          type: 'POST',
          url: 'search.php',
          data: {
              search: $(this).val()
          },
          cache: false,
          success: function(data) {
            $('#content').html(data);
          }
        });
      });

      $('#filter').on('change', function() {
        $.ajax({
          type: 'POST',
          url: 'filter.php',
          data: {
              filter: $(this).val()
          },
          cache: false,
          success: function(data) {
            $('#content').html(data);
          }
        });
      });

      $('#sorting').on('change', function() {
        $.ajax({
          type: 'POST',
          url: 'sorting.php',
          data: {
            sorting: $(this).val()
          },
          cache: false,
          success: function(data) {
            $('#content').html(data);
          }
        });
      });
    });
  </script>

</body>
</html>
