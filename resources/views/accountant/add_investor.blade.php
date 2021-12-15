@include('layouts.header')

<!-- navbar and sidebar -->
@include('layouts.template')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="justify-content: end; padding:10px;">
            <li class="breadcrumb-item"><a href="{{ route('accountant') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ route('accountant.investors') }}">Investors</a></li>
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
                <form action="{{ route('accountant.submit-investor') }}" method="POST" class="form" enctype='multipart/form-data'>
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
                                                    <input type="text" name="first_name" placeholder='First Name' class='form-control' required>
                                                </div>

                                                <div class="form-group">
                                                    <input type="text" name='last_name' placeholder='Last Name' class='form-control' required>
                                                </div>
                                            </div>
                                            
                                            <div class="form-group">
                                                <input type="text" name='phone' placeholder='Phone' class='form-control' >
                                            </div>

                                            <div class="form-group">
                                                <input type="text" name='email' placeholder='E-Mail' class='form-control' >
                                            </div>                            

                                            <div class="form-group">
                                                <input type="text" name='cnic' placeholder='CNIC' class='form-control' >
                                            </div>

                                            <div class="form-group">
                                                <input type="password" name='password' placeholder='Password' class='form-control' >
                                            </div>

                                        </div>

                                        <!-- Address -->
                                        <div class="form-group">
                                            <textarea name='address' cols="30" rows="3" placeholder="Address..." class='form-control'  ></textarea>
                                        </div>
                                    </fieldset>                        
                                </div>


                                <div class="col-6 nominee-container">
                                    <fieldset id='nominee-filed'>
                                        <legend>Nominee</legend>
                                        <div class="form-row">
                                            <div class="form-group">
                                                <input type="text" name='nominee_name' placeholder='Nominee Name' class='form-control'  >
                                            </div>

                                            <div class="form-group">
                                                <input type="text" name='nominee_cnic' placeholder='Nominee CNIC' class='form-control' >
                                            </div>
                                        </div>

                                        <br>

                                        <h5>Relationship with nominee:</h5>
                                        <div class="form-row d-flex flex-wrap justify-content-between">
                                            <div class="form-group">
                                                Father <input type="radio" name="nominee" value="father">
                                            </div>                            

                                            <div class="form-group">
                                                Mother <input type="radio" name="nominee" value="mother">
                                            </div>                            

                                            <div class="form-group">
                                                Brother <input type="radio" name="nominee" value="brother">
                                            </div>                            

                                            <div class="form-group">
                                                Uncle <input type="radio" name="nominee" value="uncle">
                                            </div>                
                                            
                                            <div class="form-group">
                                                Other <input type="radio" name="nominee" value="other">
                                            </div>                
                                        </div>
                                    </fieldset>

                                    <!-- Referrel code. -->
                                    <div class="form-group">
                                        <label for="">Referral ID:</label>
                                        <input list="referral_codes" name='referral_code' class='form-control' autocomplete="off">
                                        <datalist id="referral_codes">
                                            @foreach($investors as $investor)
                                                <option value="{{ $investor->id }}">{{ $investor->username }}</option>
                                            @endforeach
                                        </datalist>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Images -->
                    <br>
                    <br>
                    <div style="display:flex; flex-wrap:wrap; justify-content:center;">
                        <div>
                            <img id="investor_profile" src="https://www.bing.com/th?id=OIP.w_TsEm0ozE9YAmCKfbmx8wHaJ9&w=96&h=100&c=8&rs=1&qlt=90&o=6&pid=3.1&rm=2" alt="" width="150px" height="150px" style='border-radius:50%'>    <br>
                            <input type="file" id='investor_profile_image' value='' name='investor_profile_image'>
                        </div>

                        <!-- CNIC front -->    
                        <div>
                            <img src="https://th.bing.com/th/id/OIP.kM2UJPjCkozMEXbHY8YTTwAAAA?pid=ImgDet&rs=1" alt="CNIC BACK" class="cnic_pic" id="cnic_front"><br>
                            <input type="file" name="cnic_front" id="add_investor_cnic_front" required>
                        </div>

                        <!-- CNIC back -->
                        <div>
                            <img src="https://th.bing.com/th/id/OIP.kM2UJPjCkozMEXbHY8YTTwAAAA?pid=ImgDet&rs=1" alt="CNIC FRONT" class="cnic_pic" id="cnic_back"><br>
                            <input type="file" name="cnic_back" id="add_investor_cnic_back" required>
                        </div>
                    </div>

                    <hr>

                    <!-- Terms and conditions -->
                    <div class="form-group" style='color:grey;'>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.</p>
                        <span class='me-2' style="font-weight:bold; font-family:serif; font-style:italic;">I AGREE TO TERMS AND CONDITIONS</span> 
                        <input type="checkbox" name="terms_and_conditions" value='' id="invester_terms_and_conditions">
                    </div>
                    
                    <!-- Accountant id -->
                    <input type="hidden" value="{{ Session::get('user')->id }}" name='accountant_id'>
                    <br>

                    <div class="form-group d-flex justify-content-center">
                        <input type="submit" value="Add" id="submit_investor" class='btn btn-success' style="width:200px;" disabled>
                    </div>

                </form>

            </div>
        </div>

        
    </div>

@include('layouts.footer')