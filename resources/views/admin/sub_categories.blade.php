@include('layouts.header')

<!-- navbar and sidebar -->
@include('layouts.template')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="justify-content: end; padding:10px;">
            <li class="breadcrumb-item"><a href="{{ route('index') }}">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Category</li>
        </ol>
    </nav>

    <div class="container">

        <div class="title-heading">
            <h3>Sub Categories</h3>    

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_sub_category_modal">Add Sub Category</button>
            <!-- Add category modal -->            
            <div class="modal fade" id="add_sub_category_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <form action="{{ route('add-sub-category') }}" method="POST" class="form">
                @csrf
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <!-- Category -->
                        <div class="form-group">
                            <select name="category" class="form-control" @if($categories->count() == null) disabled @endif>
                                <option value="" hidden disabled selected>-- Category --</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id}}">{{ $category->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        
                        <!-- Sub category -->
                        <div class="form-group">
                          <input type="text" name="name" placeholder="Sub Category" class="form-control">
                        </div>

                    </div>

                    <div class="modal-footer">
                      <button type="submit" class="btn btn-primary">Add</button>
                    </div>

                  </div>
                </div>
              </form>
            </div>
        </div>

        <hr>

        <table class="table">
        <thead>
            <tr>
              <th>#</th>
              <th>Category</th>
              <th>Sub Category</th>
              <th style="width:180px;">Actions</th>
            </tr>
          </thead>
          <tbody>
            @if($sub_categories->count() != null)
              <?php $no = 1;?>
              @foreach($sub_categories as $sub_category)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $sub_category->category }}</td>
                  <td>{{ $sub_category->name }}</td>
                  <td>
                    <a class="btn btn-sm btn-success edit_sub_category_modal_trigger" data="{{ $sub_category->id }}"><i>Edit</i></a>
                    <a class="btn btn-sm btn-danger delete_sub_category_modal_trigger" data="{{ $sub_category->id }}"><i>Delete</i></a>
                  </td>
                </tr>
              @endforeach
              
            @else
              <tr>
                <td colspan="4" style="background-color:ghostwhite;"> No Data Found! </td>
              </tr>
            @endif
          </tbody>  
        </table>
    </div>

    <!-- Edit category modal -->
    <div class="modal" tabindex="-1" id="edit-sub-category-modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{ route('update-sub-category') }}" method="POST" class="form">
            @csrf

            <div class="modal-header">
              <h5 class="modal-title" id='sub_category_edit_modal_title'></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
              <!-- Category -->
              <div class="form-group">
                <label for="">Category</label>
                <select name="category" id="sub_category_edit_category" class="form-control">

                </select>
              </div>

              <!-- Sub category -->
              <div class="form-group">
                <label for="">Sub Category</label>
                <input type="text" name="name" value="" id="sub_category_edit" class="form-control" required>
              </div>

              <!-- category id -->
              <input type="hidden" id="sub_category_edit_id" name="id">
            </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>


    <!-- Delete category modal -->
    <div class="modal fade" id="confirm_delete_sub_category_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{ route('delete-sub-category') }}" method="POST" class="form">
            @csrf
            <div class="modal-body">
              <p id="confirm_delete_sub_category_message"></p>
              <input type="hidden" name="id" id="sub_category_id_in_delete_modal" value="">
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
              <input type="submit" class="btn btn-danger" value="Delete">
            </div>
          </form>
        </div>
      </div>
    </div>
@include('layouts.footer')