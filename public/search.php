<?php require_once('../private/initialize.php'); 

$query = $_GET['query'] ?? '';


$provider_set = search_providers(h(u($query)));

?>

<?php include(SHARED_PATH . '/header.php'); ?>


<section class="ftco-section bg-light">
  <div class="container">
    <div class="row">
      <div class="col-md-12 ftco-animate">
        <div class="tab-content p-4" id="v-pills-tabContent">
          <div class="tab-pane fade show active" id="v-pills-1" role="tabpanel" aria-labelledby="v-pills-nextgen-tab">
            <form action="<?php echo url_for('/search.php') ?>" method="get">
              <div class="row">
                <div class="col">
                  <div class="form-group">
                    <div class="form-field">
                      <input type="text" name="query" class="form-control" value="<?php h(u($query)) ?>" placeholder="Click the Search button to view Service Providers">
                    </div>
                  </div>
                </div>
                <div class="col col-lg-2">
                  <div class="form-group">
                    <div class="form-field">
                      <input type="Submit" name="search" value="Search" class="form-control btn btn-primary">
                    </div>
                  </div>
                </div>
              </div>
              <!-- <div class="row">
                <div class="col-md">
                  <div class="form-group">
                    <div class="form-field">
                      <div class="select-wrap">
                        <form action="#" method="get">
                          <select name="Category" class="form-control">
                            <option value="AllCategories" default>All Categories</option>
                            <option value="Plumber">Plumber</option>
                            <option value="Carpenter">Carpenter</option>
                            <option value="Painter">Painter</option>
                            <option value="Electrician">Electrician</option>
                            <option value="Roofer">Roofer</option>
                          </select>
                      </div>
                    </div>
                  </div>
                </div>
                <div class="col-md">
                  <div class="form-group">
                    <div class="form-field">
                      <div class="select-wrap">
                        <select name="Location" id="" class="form-control">
                          <option value="AllCities" default>All Cities</option>
                          <option value="Surrey">Surrey</option>
                          <option value="Langley">Langley</option>
                          <option value="Vancouver">Vancouver</option>
                          <option value="White Rock">White Rock</option>
                          <option value="Richmond">Richmond</option>
                        </select>
                      </div>
                    </div>
                  </div>
                </div>
              </div> -->
            </form>
          </div>
        </div>
         <?php
          if (!(empty($provider_set))) {
        ?> 
            <div class="col-md-12 ftco-animate">
              <?php
                while ($provider = mysqli_fetch_assoc($provider_set)) { 
                  $id = $provider['id'];

              ?>
                  <div class="job-post-item bg-white p-4 d-block d-md-flex align-items-center">
                    <div class="mb-4 mb-md-0 mr-5">
                      <div class="job-post-item-header d-flex align-items-center">
                        <h2 class=mr-3 text-black h3><?php echo $provider['business_name'] ?></h2>
                        <div class="badge-wrap">
                          <span class="bg-primary text-white badge py-2 px-3">$<?php echo $provider['price_per_hour'] ?></span>
                        </div>
                      </div>
                      <div class="job-post-item-body d-block d-md-flex">
                        <div class="mr-3"><span class="icon-layers"></span> <a href="#"><?php echo $provider['profession'] ?></a>
                        </div>
                        <div class="mr-3"><span class="icon-male"></span> <a href="#"><?php echo $provider['available'] ?></a>
                        </div>
                        <div><span class="icon-my_location"></span> <span><?php echo $provider['city'];?></span>
                        </div>
                      </div>
                    </div>
                    <div class="ml-auto  ">
                      <a class="btn btn-secondary" href="<?php echo url_for('/booking/provider_info.php?id=' . h(u($id))); ?>">View more info </a>
                    </div>
            </div><?php
                }
                  ?>
      </div>
  <?php
        } else {
          echo "There are no Results";
        }
  ?>
    </div>
  </div>
</section>
<?php include(SHARED_PATH . '/footer.php'); ?>
