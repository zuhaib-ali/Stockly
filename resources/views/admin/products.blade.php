@include('layouts.header')

<!-- navbar and sidebar -->
@include('layouts.template')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="justify-content: end; padding:10px;">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">product</li>
        </ol>
    </nav>

    <div class="container">
        <div class="title-heading">
            <h3>Products</h3>    

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_product_modal">Add Product</button>
            <!-- Add comapny modal -->            
            <div class="modal fade" id="add_product_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">

              <form action="{{ route('admin.add-product') }}" method="POST" class="form" enctype="multipart/form-data">
                @csrf
                <div class="modal-dialog">
                  <div class="modal-content">

                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Add Product</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>  

                    <div class="modal-body">
                        <!-- Proudct name -->
                        <div class="form-group">
                          <input type="text" name="name" placeholder="Name" class="form-control">
                        </div>

                        <!-- Price -->
                        <div class="form-group">
                          <input type="number" name="price" placeholder="Price in PKR" class="form-control">
                        </div>

                        <!-- Company -->
                        <div class="form-group">
                            <select name="company" id="product_companies" class="form-control">
                                <option value="" hidden disabled selected>-- Company --</option>
                                @if($companies->count() != null)
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->name }}</option>
                                    @endforeach
                                @else
                                    <option value="" hidden disabled selected>-- No Company Found! --</option>
                                @endif
                            </select>
                        </div>

                        <!-- Categories -->
                        <div class="form-group">
                            <select name="category" id="proudct_categories" class="form-control" disabled></select>
                        </div>

                        <!-- Description -->
                        <div class="form-group">
                          <textarea name="description" placeholder="Description" cols="30" rows="3" class="form-control"></textarea>
                        </div>

                        <!-- Tax -->
                        <div class="form-group">
                          <input type="number" name="tax" placeholder="Tax" class="form-control">
                        </div>

                        <!-- Stock -->
                        <div class="form-group">
                          <input type="number" name="stock" placeholder="Stock" class="form-control">
                        </div>

                        <div class="form-group">
                            <input type="file" name="images[]" class="form-control" multiple>
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
              <th>Image</th>
              <th>Name</th>
              <th>Price</th>
              <th>Stock</th>
              <th style="width:180px;">Action</th>
            </tr>
          </thead>
          <tbody>
            @if($products->count() != null)
              <?php $no = 1;?>
              @foreach($products as $product)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>
                    @if($proudct_images->find($product->id) != null)
                      <img src="{{ asset('product_images') }}/{{ $proudct_images->find($product->id)->image_name }}" alt="" class="product_image">
                    @else
                      <img src="https://th.bing.com/th/id/OIP.AwJzA--cIbMfXb3IsB9MvgHaHt?w=172&h=180&c=7&r=0&o=5&pid=1.7" alt="{{ $product->name }}" class="product_image">
                    @endif

                  </td>
                  <td>{{ $product->name }}</td>
                  <td>{{ $product->price }}</td>
                  <td>{{ $product->stock }}</td>
                  <td>
                    <a class="btn btn-sm btn-primary"><i>View</i></a>
                    <a class="btn btn-sm btn-success edit_product_modal_trigger" data="{{ $product->id }}"><i>Edit</i></a>
                    <a class="btn btn-sm btn-danger delete_product_modal_trigger" data="{{ $product->id }}"><i>Delete</i></a>
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


      <!-- Edit product modal -->
      <div class="modal" tabindex="-1" id="edit_product_modal">
        <div class="modal-dialog">
          <div class="modal-content">
            <form action="{{ route('admin.update-product') }}" method="POST" class="form">
              @csrf

              <div class="modal-header">
                <h5 class="modal-title" id="edit-proudct-modal">Modal title</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>

              <div class="modal-body">
                <!-- Name -->
                <div class="form-group">
                  <label for="">Name</label>
                  <input type="text" name="name" value="" id="edit_product_name" class="form-control" required>
                </div>

                <!-- Price -->
                <div class="form-group">
                  <label for="">Price</label>
                  <input type="price" value="" name="price" id="edit_product_price" class="form-control" required>
                </div>

                <!-- Description -->
                <div class="form-group">
                  <label for="">Description</label>
                  <textarea name="description" id="edit_product_description" cols="30" rows="3" class="form-control"></textarea>
                </div>

                <!-- Company -->
                <div class="form-group">
                  <label for="">Company</label>
                  <select name="company" id="edit_product_company" class="form-control" required></select>
                </div>

                <!-- Category -->
                <div class="form-group">
                  <label for="">Cateogry</label>
                  <select name="category" id="edit_proudct_category" class="form-control" required></select>
                </div>

                <!-- Tax -->
                <div class="form-group">
                  <label for="">Tax</label>
                  <input type="text" name="tax" id="edit_product_tax" class="form-control">
                </div>

                <!-- Stock -->
                <div class="form-group">
                  <input type="number" name="stock" id="edit_product_stock" placeholder="Stock" class="form-control">
                </div>

                <!-- product_id -->
                <input type="hidden" id="edit_id_product" name="id">
              </div>

              <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>


    <!-- Delete product modal -->
    <div class="modal fade" id="confirm_delete_product_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{ route('admin.delete-product') }}" method="POST" class="form">
            @csrf
            <div class="modal-body">
              <p id="confirm_delete_product_message"></p>
              <input type="hidden" name="id" id="product_id_in_delete_modal" value="">
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