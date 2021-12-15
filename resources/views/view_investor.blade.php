@include('layouts.header')
@include('layouts.template')

<nav aria-label="breadcrumb">
    <ol class="breadcrumb" style="justify-content: end; padding:10px;">
        <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.investors') }}">Investors</a></li>
        <li class="breadcrumb-item" aria-current="page">Show {{ $investor->username }}</li>
    </ol>
</nav>

<div class="container">
    <div class="row">
        <div class="col-3" style="border-right:1px solid light;">
            @if($investor->image == null)
                <img src="https://th.bing.com/th/id/R.3ef68e5abe6857b3e88f81279a2fcdc6?rik=ObMqJBPXvQgYSA&riu=http%3a%2f%2flofrev.net%2fwp-content%2fphotos%2f2017%2f05%2fuser_logo.png&ehk=QQQcM2g1kFCPxnKjzxIx0trgxkbN%2fQNmZIIKm6H08S0%3d&risl=&pid=ImgRaw&r=0" alt="" class="profile_image" style="width:200px; height:200px;">
            @else
                <img src="{{ asset('investors_images/') }}/{{$investor->id}}/{{$investor->image}}" alt="" class="profile_image" style="width:200px; height:200px;">
            @endif
            <br>
            <br>
            <dl class="data_list">
                <dt>Name</dt>
                <dd>{{ $investor->username }}</dd>

                <dt>E-Mail</dt>
                <dd>{{ $investor->email }}</dd>

                <dt>Phone</dt>
                <dd>{{ $investor->phone }}</dd>

                <dt>CNIC</dt>
                <dd>{{ $investor->cnic }}</dd>

                <dt>Address</dt>
                <dd>{{ $investor->address }}</dd>

                <dt>Position</dt>
                <dd>{{ $investor->leve_name }}</dd>

                <dt>Points</dt>
                <dd>{{ $investor->points }}</dd>
            </dl>
        </div>

        <div class="col-9">
            <div>
                @if($referral != null)
                <div>
                    <h3>Referral</h3>
                
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>E-Mail</th>
                                <th>Phone</th>
                                <th>CNIC</th>
                                <th>ADDRESS</th>
                                <th>POSITION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>{{ $referral->username}}</td>
                                <td>{{ $referral->email}}</td>
                                <td>{{ $referral->phone}}</td>
                                <td>{{ $referral->cnic}}</td>
                                <td>{{ $referral->address}}</td>
                                <td>{{ $referral->level_name}}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                @endif


                @if($transactions->count() != null)
                <div>
                    <h3>Transactions</h3>
                
                    <table class="table table-responsive">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Product</th>
                                <th>PKR</th>
                                <th>Qty</th>
                                <th>Delivered</th>
                                <th>Pay Type</th>
                                <th>Deposited</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $no = 1; ?>
                            <?php $index = 0;?>
                            @foreach($transactions as $transaction)
                                <tr>
                                    <td>{{ $no++ }}</td>
                                    <!-- Product -->
                                    <td>
                                        @foreach($products->whereIn("id", json_decode($transaction->product)) as $product)
                                            {{ $product->name }}<br>
                                        @endforeach    
                                    </td>
                                    
                                    <!-- Price -->
                                    <td>
                                        @foreach($products->whereIn("id", json_decode($transaction->product)) as $product)
                                            {{ $product->price }}<br>
                                        @endforeach    
                                    </td>

                                    <!-- Quantity -->
                                    <td>
                                        @foreach($products->whereIn("id", json_decode($transaction->product)) as $product)
                                            {{ json_decode($transaction->quantity)[$index] }}<br>
                                        @endforeach    
                                    </td>

                                    <!-- Delivered -->
                                    <td>
                                        @foreach($products->whereIn("id", json_decode($transaction->product)) as $product)
                                            {{ json_decode($transaction->delivered)[$index] }}<br>
                                        @endforeach    
                                    </td>
                                    
                                    <td>{{ $transaction->payment_type }}</td>
                                    <td>{{ $transaction->deposited_amount}}</td>
                                    <td>{{ $transaction->total}}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
            </div>


            <div class="mt-5">
                <h4>Nomnee</h4>
                <dl class="data_list">
                    <dt>Name</dt>
                    <dd>{{ $investor->nominee_name }}</dd>
                    <dt>Relationship</dt>
                    <dd>{{ $investor->nominee_relationship }}</dd>
                    <dt>CNIC</dt>
                    <dd>{{ $investor->nominee_cnic }}</dd>
                </dl>
            </div>

            <div class="mt-5 d-flex justify-content-around">
                <div>
                    <img src="{{ asset('investors_images') }}/{{ $investor->id }}/{{ $investor->cnic_front }}" alt="CNIC FRONT" width="400px" height="250px">
                </div>

                <div>
                <img src="{{ asset('investors_images') }}/{{ $investor->id }}/{{ $investor->cnic_back }}" alt="CNIC BACK" width="400px" height="250px">
                </div>
            </div>
        </div>
    </div>
</div>

@include('layouts.footer')