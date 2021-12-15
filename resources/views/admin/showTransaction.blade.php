@include('layouts.header')

<!-- navbar and sidebar -->
@include('layouts.template')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="justify-content: end; padding:10px;">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.transactions') }}">Transactions</a></li>
            <li class="breadcrumb-item" aria-current="page">Show {{ $transaction->username }}</li>
        </ol>
    </nav>

    <div class="container">
        <div class="row">
            <div class="col-4" style="border-right: 1px solid lightgrey;">
                <center>
                    @if($transaction->image == null)
                        <img src="https://th.bing.com/th/id/R.3ef68e5abe6857b3e88f81279a2fcdc6?rik=ObMqJBPXvQgYSA&riu=http%3a%2f%2flofrev.net%2fwp-content%2fphotos%2f2017%2f05%2fuser_logo.png&ehk=QQQcM2g1kFCPxnKjzxIx0trgxkbN%2fQNmZIIKm6H08S0%3d&risl=&pid=ImgRaw&r=0" alt="" class="profile_image">
                    @else
                        <img src="{{ asset('investors_images') }}/{{ $transaction->investor }}/{{ $transaction->image }}" alt="hello" class='profile_image'>
                    @endif
                </center>
                <br>
                <br>
                <dl class="data_list">
                    <dt>Name</dt>
                    <dd>{{ $transaction->username }}</dd>

                    <dt>E-Mail</dt>
                    <dd>{{ $transaction->email }}</dd>

                    <dt>Phone</dt>
                    <dd>{{ $transaction->phone }}</dd>

                    <dt>Address</dt>
                    <dd>{{ $transaction->address }}</dd>

                    <dt>CNIC</dt>
                    <dd>{{ $transaction->username }}</dd>

                    <dt>Noomiee</dt>
                    <dd>{{ $transaction->nominee_name }} ({{ $transaction->nominee_relationship }})</dd>

                    <dt>Noomiee CNIC</dt>
                    <dd>{{ $transaction->nominee_cnic }}</dd>

                </dl>
            </div>

            <div class="col-8">
                <table class='table'>
                    <h3>Transaction</h3>
                    <thead>
                        <tr>
                            <th>PRODUCT</th>
                            <th>PRICE</th>
                            <th>QUANTITY</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $index = 0; ?>    
                        @foreach($products as $product)
                            <tr>
                                <td>{{ $product->name }}</td>
                                <td>{{ json_decode($transaction->quantity)[$index++] }}</td>
                                <td>{{ $product->price }}</td>
                            </tr>
                        @endforeach    
                    </tbody>
                    <tfoot>
                        <tr>
                            <th>Deposited Amount: {{ $transaction->deposited_amount }}</th>
                            <th>Total Price: {{ $transaction->total }}</th>
                        </tr>
                    </tfoot>
                </table>
                
            </div>
        </div>

        <br>
        <br>

        <div class="row">
            <div class="d-flex justify-content-around">
                <div>
                    <img src="{{ asset('investors_images') }}/{{ $transaction->investor }}/{{ $transaction->cnic_front }}" alt="CNIC FRONT" width="300px" height="300px">
                </div>

                <div>
                    <img src="{{ asset('investors_images') }}/{{ $transaction->investor }}/{{ $transaction->cnic_back }}" alt="CINIC BACK" width="300px" height="300px">
                </div>
            </div>
        </div>
        
    </div>

@include('layouts.footer')