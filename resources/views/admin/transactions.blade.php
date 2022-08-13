@include('layouts.header')

<!-- navbar and sidebar -->
@include('layouts.template')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="justify-content: end; padding:10px;">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Transactions</li>
        </ol>
    </nav>

    <div class="container">
        <div class="title-heading">
            <h3>Transactions</h3>    
        </div>
        <hr>
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Name</th>
              <th>Product</th>
              <th>Deposited</th>
              <th>Total</th>
              <th>Purchased At</th>
              <th style="width:180px;">Action</th>
            </tr>
          </thead>
          <tbody>
            @if($transactions->count() != null)
              <?php $no = 1;?>
              @foreach($transactions as $transaction)
                <tr class="@if($transaction->seen == false) unseen @else  @endif">
                  <td>{{ $no++ }}</td>
                    <td>{{ $transaction->investor_name }}</td>
                    <td>
                      @foreach(json_decode($transaction->product) as $prodcut)
                        {{ $products->find($prodcut)->name }}<br>
                      @endforeach
                    </td>
                    <td>{{ $transaction->deposited_amount }}</td>
                    <td>{{ $transaction->total }}</td>
                    <td>{{ $transaction->created_at->format('d M, y') }}</td>
                    <td>
                      <a class="btn btn-sm btn-primary" href="{{ url('/seen') }}/{{$transaction->id}}"><i class='fas fa-eye'></i></a>
                      <a class="btn btn-sm btn-danger admin_transaction_delete_trigger" data="{{ $transaction->id }}"><i class='fas fa-trash'></i></a>
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

{{--
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
      --}}

    <!-- Delete product modal -->
    <div class="modal fade" id="admin_delete_transaction_modal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form action="{{ route('admin.delete-transaction') }}" method="POST" class="form">
            @csrf
            <div class="modal-body">
              <p id="admin_trasanction_delete_confirm_message"></p>
              <input type="hidden" name="id" id="admin_trasanction_delete_id" value="">
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