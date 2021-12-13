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
                        <div class="d-flex justify-content-between">
                            <div class="form-check">

                                <div class="d-flex justify-content-between" style="width:300px;">
                                    <!-- JazzCash -->
                                    <div class="form-check">
                                        <input class="form-check-input payment_type" type="radio" name="payment_type" value="jazz_cash">
                                        <label class="form-check-label" for="flexRadioDefault1">JazzCash</label>
                                    </div>

                                    <!-- Meezan Bank -->
                                    <div class="form-check">
                                        <input class="form-check-input payment_type" type="radio" name="payment_type" value="meezan_bank">
                                        <label class="form-check-label" for="flexRadioDefault1">Meezan Bank</label>
                                    </div>
                                </div>

                                <!-- Transaction ID -->
                                <div class="form-group">
                                    <input type="text" placeholder="Transaction ID" class="form-control" id="transaction_id" name="transaction_id" aria-describedby="basic-addon1" style="width:300px;" hidden required>
                                </div>
                            </div>

                            <!-- Total price -->
                            <div class="form-group">
                                <label for="">Total</label>
                                <input type="text" class="form-control" name="total" value="0" id="total_products_price" aria-describedby="basic-addon1" style="width:300px;" readonly>
                            </div>

                        </div>
                        <br>
                        <br>
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