<?php
    if (isset($_POST['search'])):
        require_once 'db.php';
        $search = $_POST['search'];

        $query = mysqli_query($conn, "SELECT * FROM food_recomendation WHERE namaMenu LIKE '%" . $search . "%'");
        while ($row = mysqli_fetch_object($query)):
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
<?php
        endwhile;
    endif;
?>
