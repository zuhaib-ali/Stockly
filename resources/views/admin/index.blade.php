@include('layouts.header')

<!-- navbar and sidebar -->
@include('layouts.template')
    <nav aria-label="breadcrumb">
        <div class='d-flex justify-content-between'>
            <form action="{{ route('update-fillers') }}" method="POST" class="form">
                @csrf
                <input type="text" name="filler" value="@if($settings->count() != null){{ $settings->find(1)->filler }}@endif"  placeholder="%Filler" style="width:200px; margin-right:10px;">
                <input type="text" name="non_filler" value="@if($settings->count() != null){{ $settings->find(1)->non_filler }}@endif" id="non_filler"  placeholder="%Non-filler"  style="width:200px;">        
                <input type="submit" value="Update" class='bg-info'>
            </form>
            <ol class="breadcrumb" style="justify-content: end; padding:10px;">
                <li class="breadcrumb-item" aria-current="page">Home</li>
            </ol>
        </div>
        
    </nav>
    <br>
    

    <hr>

    <div class="container index-container">
        <!-- Accountants -->
        <div class="card index-card bg-primary">
            <a href="{{ route('admin.accountants') }}">
                <div class="card-body">
                    <h3>Accountants</h3>
                    <p>{{ $accountants->count() }}</p>
                </div>
            
            </a>
        </div>

        <!-- Companies -->
        <div class="card index-card bg-warning">
            <a href="{{ route('admin.companies') }}">
                <div class="card-body">
                    <h3>Companies</h3>
                    <p>{{ $companies->count() }}</p>
                </div>
            </a>
        </div>

        <div class="card index-card bg-success">
            <a href="{{ route('admin.categories') }}">
                <div class="card-body">
                    <h3>Categories</h3>
                    <p>{{ $categories->count() }}</p>
                </div>
            </a>
        </div>

        <!-- investors -->
        <div class="card index-card bg-danger">
            <a href="{{ route('admin.investors') }}">
                <div class="card-body">
                    <h3>Investors</h3>
                    <p>{{ $investors->count() }}</p>
                </div>
            </a>
        </div>

        <!-- Products -->
        <div class="card index-card bg-danger">
            <a href="{{ route('admin.products') }}">
                <div class="card-body">
                    <h3>Products</h3>
                    <p>{{ $products->count() }}</p>
                </div>
            </a>
        </div>

        <!-- Transactions -->
        <div class="card index-card bg-success">
            <a href="{{ route('admin.transactions') }}">
                <div class="card-body">
                    <h3>Transactions</h3>
                    <p>{{ $transactions->count() }}</p>
                </div>
            </a>
        </div>
    </div>

@include('layouts.footer')