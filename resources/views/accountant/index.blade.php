@include('layouts.header')

<!-- navbar and sidebar -->
@include('layouts.template')
    <br>
    <div class="container accountant-container index-container">
        <!-- Accountants -->
        <div class="card bg-primary">
            <a href="{{ route('accountant.investors') }}">
                <div class="card-body">
                    <h3>Investors</h3>
                </div>
            </a>
        </div>

        <!-- Add Transaction -->
        <div class="card bg-danger">
            <a href="{{ route('accountant.transaction') }}">
                <div class="card-body">
                    <h3>Add Transaction</h3>
                </div>
            </a>
        </div>
    </div>

@include('layouts.footer')