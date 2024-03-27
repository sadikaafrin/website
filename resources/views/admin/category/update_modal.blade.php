



    <div class="modal fade" id="updatedModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
        <form action="" id="updateCategoryForm" method="post" enctype="multipart/form-data"  >
            @csrf
            <input type="hidden" id="up_id">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="updateModalLabel">Update a Category</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div id="errMsgContainer" class="mb-3"></div>
                        <div class="form-group my-3">
                            <label for="name">Category Name</label>
                            <input type="text" name="up_name" id="up_name" class="form-control" >
                        </div>
                        <div class="form-group my-3">
                            <label for="description">Category Description</label>
                            <textarea type="text"  name="up_description" id="up_description" class="form-control" ></textarea>
                        </div>
                        <div class="form-group my-3">
                            <label for="image">Category Image</label>
                            <input type="file"   name="up_image" id="up_image" class="form-control">
                        </div>
                        <div class="form-floating my-3">
                            <div class="img" style="margin: auto; text-align: center; vertical-align: middle; border: 1px solid #ddd; border-radius: 4px; padding: 4px; height: 250px; overflow: hidden;">
                                <img id="current_image" class="img-fluid" style="height: 240px; width: auto;" src="" alt="Category Image">
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary update_category" >Update Category</button>
                    </div>
                </div>
            </div>
        </form>
    </div>









