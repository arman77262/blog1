<?php require_once 'header.php'?>
              <div class="row state-overview">
                  <div class="col-lg-3 col-sm-6">
                      <section class="card">
                          <div class="symbol terques">
                              <i class="fa fa-user"></i>
                          </div>
                          <div class="value">
                              <h1>
                                  <?php
                                    $query = "SELECT * FROM tbl_user";
                                    $select = $db->select($query);
                                    if ($select){
                                        $count = mysqli_num_rows($select);
                                        echo $count;
                                    }else{
                                        echo "0";
                                    }
                                  ?>
                              </h1>
                              <p>Total Users</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="card">
                          <div class="symbol red">
                              <i class="fa fa-tags"></i>
                          </div>
                          <div class="value">
                              <h1>
                                  <?php
                                  $query = "SELECT * FROM tbl_category";
                                  $select = $db->select($query);
                                  if ($select){
                                      $count = mysqli_num_rows($select);
                                      echo $count;
                                  }else{
                                      echo "0";
                                  }
                                  ?>
                              </h1>
                              <p>Total Category</p>
                          </div>
                      </section>
                  </div>
                  <div class="col-lg-3 col-sm-6">
                      <section class="card">
                          <div class="symbol yellow">
                              <i class="fa fa-shopping-cart"></i>
                          </div>
                          <div class="value">
                              <h1>
                                  <?php
                                  $query = "SELECT * FROM tbl_post";
                                  $select = $db->select($query);
                                  if ($select){
                                      $count = mysqli_num_rows($select);
                                      echo $count;
                                  }else{
                                      echo "0";
                                  }
                                  ?>
                              </h1>
                              <p>Total Products</p>
                          </div>
                      </section>
                  </div>
              </div>
              <!--state overview end-->


<?php require_once 'footer.php'?>