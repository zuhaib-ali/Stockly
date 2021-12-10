@include('layouts.header')

<!-- navbar and sidebar -->
@include('layouts.template')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="justify-content: end; padding:10px;">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Company</li>
        </ol>
    </nav>

    <div class="container">
        <div class="title-heading">
            <h3>Companies</h3>    

            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add_company_modal">Add Company</button>
            <!-- Add comapny modal -->            
            <div class="modal fade" id="add_company_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <form action="{{ route('admin.add-company') }}" method="POST" class="form">
                @csrf
                <div class="modal-dialog">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Add Company</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                          <input type="text" name="name" placeholder="Name" class="form-control">
                        </div>

                        <div class="form-group">
                          <input type="email" name="email" placeholder="E-Mail" class="form-control">
                        </div>

                        <div class="form-group">
                          <textarea name="address" placeholder="Address" id="" cols="30" rows="3" class="form-control"></textarea>
                          
                        </div>

                        <div class="form-group">
                          <input type="number" name="phone" placeholder="Mobile" class="form-control">
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
              <th>Name</th>
              <th>E-Mail</th>
              <th>Address</th>
              <th>Phone</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @if($companies->count() != null)
              <?php $no = 1;?>
              @foreach($companies as $company)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $company->name }}</td>
                  <td>{{ $company->email }}</td>
                  <td>{{ $company->address }}</td>
                  <td>{{ $company->phone }}</td>
                  <td>
                    <a class="btn btn-sm btn-success edit_company_modal_trigger" data="{{ $company->id }}"><i>Edit</i></a>
                    <a class="btn btn-sm btn-danger delete_company_modal_trigger" data="{{ $company->id }}"><i>Delete</i></a>
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


    <!-- Edit company modal -->
    <div class="modal" tabindex="-1" id="edit_company_modal">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{ route('admin.update-company') }}" method="POST" class="form">
            @csrf

            <div class="modal-header">
              <h5 class="modal-title">Modal title</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
              <!-- Name -->
              <div class="form-group">
                <label for="">Name</label>
                <input type="text" name="name" value="" id="edit_name_company" class="form-control">
              </div>
              <!-- E-Mail -->
              <div class="form-group">
                <label for="">E-Mail</label>
                <input type="text" value="" id="edit_email_company" class="form-control" disabled>
              </div>
              <!-- Address -->
              <div class="form-group">
                <label for="">Address</label>
                <textarea name="address" cols="30" rows="3" id="edit_address_company" class="form-control"></textarea>
              </div>
              <!-- Phone -->
              <div class="form-group">
                <label for="">Phone</label>
                <input type="text" name="phone" value="" id="edit_phone_company" class="form-control">
              </div>
              <!-- category id -->
              <input type="hidden" id="edit_id_company" name="id">
            </div>
            <div class="modal-footer">
              <button type="submit" class="btn btn-primary">Update</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- Delete company modal -->
    <div class="modal fade" id="confirm_delete_company_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{ route('admin.delete-company') }}" method="POST" class="form">
            @csrf
            <div class="modal-body">
              <p id="confirm_delete_company_message"></p>
              <input type="hidden" name="id" id="company_id_in_delete_modal" value="">
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