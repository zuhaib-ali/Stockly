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
            <h3>Accountants</h3>    

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_category_modal">Add accountant</button>
            <!-- Add category modal -->            
            <div class="modal fade" id="add_category_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <form action="{{ route('admin.add-accountant') }}" method="POST" class="form">
                @csrf
                <div class="modal-dialog">
                  <div class="modal-content">

                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Add Accountant</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">

                        <!-- Name -->
                        <div class="form-group">
                            <input type="text" name="name" class='form-control' placeholder='Accountant Name'>
                        </div>

                        <!-- E-Mail -->
                        <div class="form-group">
                            <input type="email" name="email" class='form-control' placeholder='E-mail'>
                        </div>

                        <!-- Phone -->
                        <div class="form-group">
                            <input type="tel" name="phone" class='form-control' placeholder='Phone' maxlength='12' required>
                        </div>

                        <!-- Address -->
                        <div class="form-group">
                            <textarea name="address" id="" cols="30" rows="3" placeholder="Address" class='form-control'></textarea>
                        </div>

                        <!-- Password -->
                        <div class="form-group">
                            <input type="password" name="password" class='form-control' placeholder='Password'>
                        </div>

                        <!-- Role -->
                        <input type="hidden" name="role" value="accountant">
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
              <th>Name</th>
              <th>E-Mail</th>
              <th>Phone</th>
              <th>Address</th>
              <th style="width:180px;">Actions</th>
            </tr>
          </thead>
          <tbody>
            @if($accountants->count() != null)
              <?php $no = 1;?>
              @foreach($accountants as $accountant)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $accountant->name }}</td>
                  <td>{{ $accountant->email }}</td>
                  <td>{{ $accountant->phone }}</td>
                  <td>{{ $accountant->address }}</td>
                  <td>
                    <a class="btn btn-sm btn-success edit_accountant_modal_trigger" data="{{ $accountant->id }}"><i>Edit</i></a>
                    <a class="btn btn-sm btn-danger delete_accountant_modal_trigger" data="{{ $accountant->id }}"><i>Delete</i></a>
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
    {{-- <div class="modal" tabindex="-1" id="edit_category_modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{ route('update-category') }}" method="POST" class="form">
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
        --}}
        
    <!-- Delete category modal -->
    <div class="modal fade" id="confirm_delete_accountant_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{ route('admin.delete-accountant') }}" method="POST" class="form">
            @csrf
            <div class="modal-body">
              <p id="confirm_delete_accountant_message"></p>
              <input type="hidden" name="id" id="accountant_id_in_delete_modal" value="">
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