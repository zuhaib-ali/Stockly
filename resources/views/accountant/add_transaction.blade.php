@include('layouts.header')

<!-- navbar and sidebar -->
@include('layouts.template')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="justify-content: end; padding:10px;">
            <li class="breadcrumb-item"><a href="{{ route('accountant') }}">Home</a></li>
            <li class="breadcrumb-item" aria-current="page">Add Transaction</li>
        </ol>
    </nav>

    <div class="container add-transaction-container" style="">
        <div class="card">
            <div class="card-header"><h3 style="text-transform:capitalize; ">Add Transaction</h3></div>
            <div class="card-body">
                <form action="{{ route('accountant.create-transaction') }}" method="POST">
                    @csrf
                    <table class='table table-responsive'>
                        <thead>
                            <tr>
                                <th width="250px">Product</th>
                                <th width="120px">Price</th>
                                <th width="100px">Stock</th>
                                <th width="200px">Quantity</th>
                                <th>Total</th>
                                <th style='text-align:right;'><a class='btn btn-primary add_new_transaction'>Add</a></th>
                            </tr>
                        </thead>
                            
                            <tbody id="add_transaction_table_body">
                            </tbody>

                            <!-- Investors -->
                            <select class='form-control investors-select2' name="investor" style="width:200px;">
                                <option value="" hidden disabled selected>-- Select Investor --</option>
                                @foreach($investors as $investor)
                                    <option value="{{ $investor->id }}">{{ $investor->username }}</option>
                                @endforeach
                            </select>
                    </table>

                    
                    <div id='trasaction-footer' hidden>

                        <!-- Payment -->
                        <div class="form-group  d-flex justify-content-around">
                            <div>Cash <input type="radio" name="payment_type" value="cash" checked></div>
                        </div>

                        <!-- Total price -->
                        <div class="form-group  d-flex justify-content-center">
                            <input type="text" class="form-control" name="total" id="total_products_price" placeholder="PKR: Total quantity" aria-describedby="basic-addon1" style="width:300px;" readonly>
                        </div>

                        <!-- Create trasanction button -->
                        <div class="form-group d-flex justify-content-center">
                            <input type="submit" value="Add Transaction" class='btn btn-success'>
                        </div>

                    </div>
                </form>
            </div>
        </div>
    </div>

@include('layouts.footer')