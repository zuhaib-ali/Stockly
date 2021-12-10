@include('layouts.header')

<!-- navbar and sidebar -->
@include('layouts.template')
    <br>
    <div>
        <form action="{{ route('update-fillers') }}" method="POST" class="form">
            @csrf
            <div class="d-flex justify-content-end ">
                <div class="form-group me-3" style='width:100px;'>
                    <label for="">Filler</label>
                    <input type="text" name="filler" value="@if($settings->count() != null){{ $settings->find(1)->filler }}@endif" class='form-control' placeholder="%Filler">
                </div>
                <div class="form-group"style='width:100px;'>
                    <label for="">Non-filler</label>
                    <input type="text" name="non_filler" value="@if($settings->count() != null){{ $settings->find(1)->non_filler }}@endif" id="non_filler" class='form-control' placeholder="%Non-filler">
                </div>
            </div>
            <div class="form-group d-flex justify-content-end">
                <input type="submit" value="Update" class='btn btn-sm btn-info'>
            </div>
        </form>
    </div>

    <hr>

    <div class="container index-container">
        <!-- Accountants -->
        <div class="card bg-info">
            <div class="card-body">
                <h3>Accountants</h3>
                <p>{{ $accountants->count() }}</p>
                <a href="{{ route('admin.accountants') }}">View more</a>
            </div>
        </div>

        <!-- Companies -->
        <div class="card bg-info">
            <div class="card-body">
                <h3>Companies</h3>
                <p>{{ $companies->count() }}</p>
                <a href="{{ route('admin.companies') }}">View more</a>
            </div>
        </div>

        <div class="card bg-danger">
            <div class="card-body">
                <h3>Categories</h3>
                <p>{{ $categories->count() }}</p>
                <a href="{{ route('admin.categories') }}">View more</a>
            </div>
        </div>

        <!-- Products -->
        <div class="card bg-primary">
            <div class="card-body">
                <h3>Products</h3>
                <p>{{ $products->count() }}</p>
                <a href="{{ route('admin.products') }}">View more</a>
            </div>
        </div>
    </div>

@include('layouts.footer')