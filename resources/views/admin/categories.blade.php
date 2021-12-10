@include('layouts.header')

<!-- navbar and sidebar -->
@include('layouts.template')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="justify-content: end; padding:10px;">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Category</li>
        </ol>
    </nav>

    <div class="container">

        <div class="title-heading">
            <h3>Categories</h3>    

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_category_modal">Add category</button>
            <!-- Add category modal -->            
            <div class="modal fade" id="add_category_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <form action="{{ route('admin.add-category') }}" method="POST" class="form">
                @csrf
                <div class="modal-dialog">
                  <div class="modal-content">

                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Add Category</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                      <!-- Category Name -->
                      <div class="form-group">
                        <input type="text" name="name" placeholder="Category" class="form-control">
                      </div>

                      <!-- Company -->
                      <div class="form-group">
                        <select name="company" id="" class="form-control" @if($companies->count() == null) disabled @endif>
                            <option value="" hidden dsiabled selected>-- Select Company --</option>
                            @foreach($companies as $company)
                              <option value="{{ $company->id }}">{{ $company->name }}</option>
                            @endforeach
                        </select>
                        
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
              <th style="width:180px;">Actions</th>
            </tr>
          </thead>
          <tbody>
            @if($categories->count() != null)
              <?php $no = 1;?>
              @foreach($categories as $category)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $category->name }}</td>
                  <td>
                    <a class="btn btn-sm btn-success edit_category_modal_trigger" data="{{ $category->id }}"><i>Edit</i></a>
                    <a class="btn btn-sm btn-danger delete_category_modal_trigger" data="{{ $category->id }}"><i>Delete</i></a>
                  </td>
                </tr>
              @endforeach
              
            @else
              <tr>
                <td colspan="6" style="background-color:ghostwhite;"> No Data Found! </td>
              </tr>
            @endif
          </tbody>  
        </table>
    </div>

    <!-- Edit category modal -->
    <div class="modal" tabindex="-1" id="edit_category_modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{ route('admin.update-category') }}" method="POST" class="form">
            @csrf

            <div class="modal-header">
              <h5 class="modal-title" id='categories_edit_title'></h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
              
              <!-- Category -->
              <div class="form-group">
                <label for="main">Category</label>
                <input type="text" name="name" value="" id="edit_main_category" class="form-control">
              </div>

              <!-- category id -->
              <input type="hidden" id="edit_id_category" name="id">

            </div>

            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>

          </form>
        </div>
      </div>
    </div>


    <!-- Delete category modal -->
    <div class="modal fade" id="confirm_delete_category_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{ route('admin.delete-category') }}" method="POST" class="form">
            @csrf
            <div class="modal-body">
              <p id="confirm_delete_category_message"></p>
              <input type="hidden" name="id" id="category_id_in_delete_modal" value="">
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