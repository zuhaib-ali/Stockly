@include('layouts.header')

<!-- navbar and sidebar -->
@include('layouts.template')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="justify-content: end; padding:10px;">
            <li class="breadcrumb-item"><a href="{{ route('admin') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('admin.investors') }}">Investors</a></li>
            <li class="breadcrumb-item" aria-current="page">Add Investor</li>
        </ol>
    </nav>

    <div class="container add-investor-container">
        <div class="card">
            <!-- Card header -->
            <div class="card-header bg-primary text-white">
                <h3 style="text-transform:capitalize; ">Accountant: {{Session::get('user')->name}}</h3>
            </div>

            <!-- card body -->
            <div class="card-body">
                <!-- Form -->
                <form action="{{ route('admin.update-investor') }}" method="POST" class="form" enctype='multipart/form-data'>
                    @csrf 
                    
                    <div class="form-row d-flex flex-wrap justify-content-between">

                        <div class="col-12" style="padding:10px;">
                            <div class="row">
                                <div class="col-6">
                                    <fieldset id="invester-filedset">
                                        <legend>Invester</legend>
                                        <div class="form-row">
                                            <div class="d-flex flex-wrap justify-content-between">
                                                <div class="form-group">
                                                    <input type="text" name="first_name" placeholder='First Name' value="{{ $investor->first_name }}" class='form-control' required>
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" name='last_name' value="{{ $investor->last_name }}" placeholder='Last Name' class='form-control' required>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <input type="text" name='phone' value="{{ $investor->phone }}" placeholder='Phone' class='form-control' >
                                            </div>

                                            <div class="form-group">
                                                <input type="text" name='email' value="{{ $investor->email }}" placeholder='E-Mail' class='form-control' >
                                            </div>                            

                                            <div class="form-group">
                                                <input type="text" value="{{ $investor->cnic }}" placeholder='CNIC' class='form-control' readonly>
                                            </div>
                                        </div>

                                        <!-- Address -->
                                        <div class="form-group">
                                            <textarea name='address' cols="30" rows="3" placeholder="Address..." class='form-control'>{{ $investor->address }}</textarea>
                                        </div>
                                    </fieldset>                        
                                </div>


                                <div class="col-6 nominee-container">
                                    <fieldset id='nominee-filed'>
                                        <legend>Nominee</legend>
                                        <div class="form-row">
                                            <div class="form-group">
                                                <input type="text" name='nominee_name' value="{{ $investor->nominee_name }}" placeholder='Nominee Name' class='form-control'  >
                                            </div>

                                            <div class="form-group">
                                                <input type="text" value="{{ $investor->nominee_cnic }}" placeholder='Nominee CNIC' class='form-control' readonly>
                                            </div>
                                        </div>

                                        <br>

                                        <h5>Relationship with nominee:</h5>
                                        <div class="form-row d-flex flex-wrap justify-content-between">
                                            <div class="form-group">
                                                Father <input type="radio" name="nominee" value="father" @if($investor->nominee_relationship == 'father') checked @endif>
                                            </div>                            

                                            <div class="form-group">
                                                Mother <input type="radio" name="nominee" value="mother" @if($investor->nominee_relationship == 'mother') checked @endif>
                                            </div>                            

                                            <div class="form-group">
                                                Brother <input type="radio" name="nominee" value="brother" @if($investor->nominee_relationship == 'brother') checked @endif>
                                            </div>                            

                                            <div class="form-group">
                                                Uncle <input type="radio" name="nominee" value="uncle" @if($investor->nominee_relationship == 'uncle') checked @endif>
                                            </div>                
                                            
                                            <div class="form-group">
                                                Other <input type="radio" name="nominee" value="other" @if($investor->nominee_relationship == 'other') checked @endif>
                                            </div>                
                                        </div>
                                    </fieldset>

                                    <!-- Referrel code. -->
                                    <div class="form-group">
                                        <label for="">Referral ID:</label>
                                        <input list="referral_codes" name='referral_code' value="{{ $investor->referral_code }}" class='form-control' autocomplete="off">
                                        <datalist id="referral_codes">
                                            @foreach($investors as $i)
                                                <option value="{{ $i->id }}">{{ $i->username }}</option>
                                            @endforeach
                                        </datalist>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    <input type="hidden" value="{{ $investor->id }}" name="id">

                    <div class="form-group d-flex justify-content-center">
                        <input type="submit" value="UPDATE" class='btn btn-success' style="width:200px;">
                    </div>

                </form>

            </div>
        </div>

        
    </div>

@include('layouts.footer')