<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    {{-- <form action="" id="addBrandForm" method="post" enctype="multipart/form-data"  >
        @csrf --}}
        <input type="hidden" id="up_id">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="addModalLabel">Add Brand</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            <input type="hidden" id="brand_id">
          <div class="form-group my-3">
            <label for="name">Brand Name</label>
            <input type="text" name="up_name" id="up_name" class="form-control">

          </div>
          <div class="form-group my-3">
            <label for="description">Brand Description</label>
            <textarea name="up_description" id="up_description" class="form-control"></textarea>

          </div>
          <div class="form-group my-3">
            <label for="image">Brand Image</label>
            <input type="file" name="up_image" id="up_image" class="form-control">
          </div>
          <div class="form-floating my-3">
            <div class="img" style="margin: auto; text-align: center; vertical-align: middle; border: 1px solid #ddd; border-radius: 4px; padding: 4px; height: 250px; overflow: hidden;">
                <img id="current_image" class="img-fluid" style="height: 240px; width: auto;" src="" alt="Brand Image">
            </div>
        </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="button" class="btn btn-primary  update_brand" id="btn_save">Update changes</button>
        </div>
      </div>
    </div>
    {{-- </form> --}}
  </div>
