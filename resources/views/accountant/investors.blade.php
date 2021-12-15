@include('layouts.header')

<!-- navbar and sidebar -->
@include('layouts.template')

    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="justify-content: end; padding:10px;">
            <li class="breadcrumb-item"><a href="{{ route('accountant') }}">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">investors</li>
        </ol>
    </nav>

    <div class="container">
        <div class="title-heading">
            <h4>investors</h4>    
            <a href="{{ route('accountant.add-investor-view') }}" class='btn btn-primary'>Add investor</a>
        </div>
        <hr>
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Investor</th>
              <th>E-Mail</th>
              <th>Level</th>
              <th>Points</th>
              <th style="width:180px;">Action</th>
            </tr>
          </thead>
          <tbody>
            @if($investors->count() != null)
              <?php $no = 1;?>
              @foreach($investors as $investor)
                <tr>
                  <td>{{ $no++ }}</td>
                  <td>{{ $investor->username }}</td>
                  <td>{{ $investor->email }}</td>
                  <td>{{ $investor->level }}</td>
                  <td>{{ $investor->points }}</td>
                  <td>
                    <a class="btn btn-sm btn-primary" href="{{ route('accountant.view_investor', ['id' => $investor->id]) }}">View</a>
                    <a class="btn btn-sm btn-danger delete_investor_modal_trigger" data="{{ $investor->id }}">Delete</a>
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

    <!-- Delete investor modal -->
    <div class="modal fade" id="delete_investor_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{ route('delete-investor') }}" method="POST" class="form">
            @csrf
            <div class="modal-body">
              <p id="delete_investor_title"></p>
              <input type="hidden" name="id" id="delete_investor_id" value="">
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