@include('layouts.header')

<!-- navbar and sidebar -->
@include('layouts.template')
    <br>
    <div class='d-flex justify-content-end'>
        <form action="{{ route('update-fillers') }}" method="POST" class="form">
            @csrf
            <div class="d-flex">
                <input type="text" name="filler" value="@if($settings->count() != null){{ $settings->find(1)->filler }}@endif" class='form-control' placeholder="%Filler" style="width:200px; margin-right:10px;">
                <input type="text" name="non_filler" value="@if($settings->count() != null){{ $settings->find(1)->non_filler }}@endif" id="non_filler" class='form-control' placeholder="%Non-filler"  style="width:200px;">        
            </div>
            <input type="submit" value="Update" class='btn btn-info'>
        </form>
    </div>

    <hr>

    <div class="container index-container">
        <!-- Accountants -->
        <div class="card index-card bg-info">
            <div class="card-body">
                <h3>Accountants</h3>
                <p>{{ $accountants->count() }}</p>
                <a href="{{ route('admin.accountants') }}">View more</a>
            </div>
        </div>

        <!-- Companies -->
        <div class="card index-card bg-info">
            <div class="card-body">
                <h3>Companies</h3>
                <p>{{ $companies->count() }}</p>
                <a href="{{ route('admin.companies') }}">View more</a>
            </div>
        </div>

        <div class="card index-card bg-danger">
            <div class="card-body">
                <h3>Categories</h3>
                <p>{{ $categories->count() }}</p>
                <a href="{{ route('admin.categories') }}">View more</a>
            </div>
        </div>

        <!-- Products -->
        <div class="card index-card bg-primary">
            <div class="card-body">
                <h3>Products</h3>
                <p>{{ $products->count() }}</p>
                <a href="{{ route('admin.products') }}">View more</a>
            </div>
        </div>
    </div>

@include('layouts.footer')