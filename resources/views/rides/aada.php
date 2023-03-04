 <div class="container">
        <div class="row" id="main-ride-book">
          <div class="tabs-skips" id="flex-div">  
            <ul class="nav nav-tabs d-class" id="myTab" role="tablist"> 
             <li class="nav-item" role="presentation1">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
              type="button" role="tab" aria-controls="home-tab-pane" aria-selected="false"></button>
            </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
              type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">+</button>
          </li>
        </ul>
    
        <div class="tab-content mt-5" id="myTabContent">
          <div class="row">
            <div class="col-sm-2">
              <div class="form-check">
                <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
                <label class="form-check-label" for="flexCheckDefault">
                  Skip vehicle
                </label>
              </div>
            </div>
          </div>

          <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
            tabindex="0">
            <div class="row mt-5">
              <div class="col-md-5">
                <div class="vehicle-picture" id="file-box" style="cursor: pointer;">
                  <div class="vehicle-picture-add">
                    <!-- <a href=""><input type="file" placeholder=" Add photo" class="img-url"></a> -->
                    <!-- Click here to select a file -->
                    <img src="">
                    <input type="file" id="file-input" style="display: none">
                  </div>
                </div>
              </div>
              <div class="col-sm-2">
                <strong>{{ $list->model }}</strong>
                <p>Elite I20</p><br>
                 <p>{{$list->year}}<br>
                  <p>{{$list->color}}</p></p>
              </div>
            </div>
          </div>

          <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
            <div class="row" id="">
              <div class="col-sm-2"></div>
              <div class="col-sm-4 ">
                <div class="vehicle-picture" id="file-box" style="cursor: pointer;">
                  <div class="vehicle-picture-add">
                    <!-- <a href=""><input type="file" placeholder=" Add photo" class="img-url"></a> -->
                    Click here to select a file
                    <input type="file" id="file-input" style="display: none">
                  </div>
                </div>
              </div>
              <div class="col-sm-4">
                <div class="vehicle-details">
                  <div class="row align-items-center">
                    <div class="col-sm-2 text-lg-end">
                      <div class="vehicle-label model">Model</div>
                    </div>
                     <div class="col-md-10 position-relative location">
              <input type="text" class="form-control" placeholder="e.g. Ford Focus" name="name" id='name1' autocomplete="off">
              <div id="product_list"></div>
            </div>
                  </div>
                </div>
                <div class="row mt-5 align-items-center" id="max-width">
                  <div class="col-sm-2 text-lg-end">
                    <div class="vehicle-label model">Type</div>
                  </div>
                  <div class="col-sm-4">
                    <select class="form-select" aria-label="Default select example">
                      <option selected>------</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>
                  </div>
                  <div class="col-sm-2 text-center">
                    <div class="vehicle-label model">Color</div>
                  </div>
                  <div class="col-sm-4">
                    <select class="form-select" aria-label="Default select example">
                      <option selected>----</option>
                      <option value="1">One</option>
                      <option value="2">Two</option>
                      <option value="3">Three</option>
                    </select>
                  </div>
                </div>
                <div class="row mt-5 align-items-center" id="max-width1">
                  <div class="col-sm-2 text-lg-end">
                    <div class="vehicle-label model">Year</div>
                  </div>
                  <div class="col-sm-4" type="button" class="btn btn-secondary" data-bs-toggle="tooltip"
                    data-bs-placement="top" data-bs-custom-class="custom-tooltip"
                    data-bs-title="This top tooltip is themed via CSS variables.">
                    <input type="number" name="year" step="1" min="1908" max="2024" id="id_year" placeholder="1991"
                      data-gtm-form-interact-field-id="0" aria-invalid="false" class="form-control">
                  </div>
                  <div class="col-sm-2 text-center">
                    <div class="vehicle-label model">Licence Plate</div>
                  </div>
                  <div class="col-sm-4">
                    <input type="text" name="year" step="1" min="1908" max="2024" id="id_year" placeholder="POP 123"
                      data-gtm-form-interact-field-id="0" aria-invalid="false" class="form-control">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>