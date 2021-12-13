

    <!-- Bootstrap -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Fontawesome -->
    <script src="{{ asset('fontawesome/js/all.min.js') }}"></script>
    <!-- JQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- Toastr -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <!-- Select2 -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        // Get unseen transactions
        $(document).ready(function(){
            let unseen_investors_name = '';
            $.ajax({
                url: "{{ route('getUnseenTransactions') }}",
                type: "GET",
                success:function(data){
                    $('#total-unseen-transactions').text(data.length);
                    if(data.length != 0){
                        data.forEach(function(d){
                            unseen_investors_name += '<a href={{ url("/seen") }}/'+d.investor+'><li>'+d.investor_name+' ('+d.total+')'+'</li></a>';
                        });
                    }else{
                        unseen_investors_name += '<li style="font-styel:italic;">No any new transaction found.</li>';
                    }

                    $('#unseen-transactions-list').html(unseen_investors_name);
                }
            });
        });

        // On hover show unseen transactions
        $('#total-unseen-transactions').hover(function(){
            $('#unseen-transactions-list').prop('hidden', false);
        });

        $('#unseen-transactions-list').hover(function(){
            $(this).prop('hidden', false);
        }, function(){
            $(this).prop('hidden', true);
        });



        document.addEventListener("DOMContentLoaded", function(event) {
        const showNavbar = (toggleId, navId, bodyId, headerId) =>{
        const toggle = document.getElementById(toggleId),
        nav = document.getElementById(navId),
        bodypd = document.getElementById(bodyId),
        headerpd = document.getElementById(headerId)

        // Validate that all variables exist
        if(toggle && nav && bodypd && headerpd){
            toggle.addEventListener('click', ()=>{
                // show navbar
                nav.classList.toggle('show-navbar')
                // change icon
                toggle.classList.toggle('bx-x')
                // add padding to body
                bodypd.classList.toggle('body-pd')
                // add padding to header
                headerpd.classList.toggle('body-pd')
            })
            }
        }

        showNavbar('header-toggle','nav-bar','body-pd','header')

        /*===== LINK ACTIVE =====*/
        const linkColor = document.querySelectorAll('.nav_link')

        function colorLink(){
        if(linkColor){
        linkColor.forEach(l=> l.classList.remove('active'))
        this.classList.add('active')
        }
        }
        linkColor.forEach(l=> l.addEventListener('click', colorLink))

        // Your code to run since DOM is loaded and ready
        });
    </script>

    <script>

$('.investors-select2').select2();

        // Delete accountant modal
        $(document).on("click", ".delete_accountant_modal_trigger", function(){
            let accountant_id = $(this).attr("data");
            $.ajax({
                url: "{{ url('admin/get-accountant-by-id') }}"+"/"+accountant_id,
                type: "get",
                success:function(data){
                    $("#confirm_delete_accountant_message").text("Are you sure want to delete "+data.name);
                    $("#accountant_id_in_delete_modal").val(accountant_id);
                    $("#confirm_delete_accountant_modal").modal("show");
                }
            });
        });


        // Get categoreis on company select
        $(document).on('change', '#product_companies', function(){
            let company_id = $(this).val();
            let categories = '<option value="" hidden disabled selected>-- Select Category --</option>';
            $.ajax({
                url: "{{url('admin/get-categories-by-company-id-in-product')}}"+'/'+company_id,
                type: 'GET',
                success:function(data){
                    if(data.length != null){
                        for(i=0; i<data.length; i++){
                            categories += '<option value='+data[i].id+'> '+data[i].name+' </option>';
                        }
                        $('#proudct_categories').html(categories);
                        $('#proudct_categories').attr('disabled', false);
                    }else{
                        $('#proudct_categories').attr('disabled', true);
                    }
                }
            });
        });


        // Edit category modal
        $(document).on("click", ".edit_category_modal_trigger", function(){
            let category_id = $(this).attr("data");
            let companies = '<option value="" hidden disabled selected>-- Select Company --</option>';
            $.ajax({
                url: "{{ url('admin/get-category-by-id') }}"+"/"+category_id,
                type: "get",
                success:function(data){
                    $('#categories_edit_title').text('Edit - '+data.name);
                    $('#edit_id_category').val(data.id);
                    $('#edit_main_category').val(data.name);
                    $('#edit_category_company').html(companies);
                    $('#edit_category_modal').modal('show');
                }
            });
        });


        // Delete category modal
        $(document).on("click", ".delete_category_modal_trigger", function(){
            let category_id = $(this).attr("data");
            $.ajax({
                url: "{{ url('admin/get-category-by-id') }}"+"/"+category_id,
                type: "get",
                success:function(data){
                    $("#confirm_delete_category_message").text("Are you sure want to delete "+data.name);
                    $("#category_id_in_delete_modal").val(category_id);
                    $("#confirm_delete_category_modal").modal("show");
                }
            });
        });

        // Get sub category by category id
        $(document).on('change', '#edit_proudct_category', function(){
            let category_id = $(this).val();
            let sub_categories = "<option value='' hidden disabled selected>-- No Category Selected --</option>";
            $.ajax({
                url: "{{url('admin/get-sub-category-by-category-id')}}"+'/'+category_id,
                type: 'GET',
                success:function(data){
                    if(data.length != null){
                        for(i=0; i<data.length; i++){
                            sub_categories += "<option value="+data[i].id+"> "+data[i].name+" </option>";
                        }
                    }
                    $('#edit_product_sub_category').html(sub_categories);
                }
            });
        });


        // Edit sub category modal
        $(document).on("click", ".edit_sub_category_modal_trigger", function(){
            let sub_category_id = $(this).attr("data");
            let categories = "<option value='' hidden disabled selected>-- Select Category --</option>";
            $.ajax({
                url: "{{ url('admin/get-sub-category-by-id') }}"+"/"+sub_category_id,
                type: "get",
                success:function(data){         
                    if(data['categories'].length != null){

                        for(i=0; i<data['categories'].length; i++){
                            if(data['categories'][i].id == data['sub_category'].category_id){
                                categories += '<option value='+data['categories'][i].id+' selected>' + data['categories'][i].name + '</option>';    
                            }else{
                                categories += '<option value='+data['categories'][i].id+'>' + data['categories'][i].name + '</option>';    
                            }    
                        }
                    }
                    $('#sub_category_edit_category').html(categories);
                    $('#sub_category_edit_id').val(data['sub_category'].id);
                    $('#sub_category_edit_modal_title').text("Edit - "+data['sub_category'].name);
                    $('#sub_category_edit').val(data['sub_category'].name);
                    $('#edit-sub-category-modal').modal('show');
                }
            });
        });


        // Delete sub category modal
        $(document).on("click", ".delete_sub_category_modal_trigger", function(){
            let category_id = $(this).attr("data");
            $.ajax({
                url: "{{ url('admin/get-sub-category-by-id') }}"+"/"+category_id,
                type: "get",
                success:function(data){
                    $("#confirm_delete_sub_category_message").text("Are you sure want to delete "+data['sub_category'].name);
                    $("#sub_category_id_in_delete_modal").val(category_id);
                    $("#confirm_delete_sub_category_modal").modal("show");
                }
            });
        });
    


        // Edit company modal
        $(document).on("click", ".edit_company_modal_trigger", function(){
            let company_id = $(this).attr("data");
            $.ajax({
                url: "{{ url('admin/get-company-by-id') }}"+"/"+company_id,
                type: "get",
                success:function(data){
                    $("#edit_name_company").val(data.name);
                    $('#edit_email_company').val(data.email);
                    $('#edit_address_company').text(data.address);
                    $('#edit_phone_company').val(data.phone);
                    $('#edit_id_company').val(data.id);
                    $("#edit_company_modal").modal("show");
                }
            });
        });

        // Delete company modal
        $(document).on("click", ".delete_company_modal_trigger", function(){
            let company_id = $(this).attr("data");
            $.ajax({
                url: "{{ url('admin/get-company-by-id') }}"+"/"+company_id,
                type: "get",
                success:function(data){
                    $("#confirm_delete_company_message").text("Are you sure want to delete "+data.name);
                    $("#company_id_in_delete_modal").val(company_id);
                    $("#confirm_delete_company_modal").modal("show");
                }
            });
        });


        // Edit product modal
        $(document).on("click", ".edit_product_modal_trigger", function(){
            let product_id = $(this).attr("data");
            let companies = "<option value='' hidden disabled selected>-- No Company Selected --</option>";
            let categories = "<option value='' hidden disabled selected>-- No Category Selected --</option>";
            let category_id = null;

            $.ajax({
                url: "{{ url('admin/edit-get-product-by-id') }}"+"/"+product_id,
                type: "get",
                success:function(data){
                    // Company
                    if(data['companies'].length != null){
                        for(i=0; i<data['companies'].length; i++){
                            if(data['companies'][i].id == data['product'].company_id){
                                companies += "<option value="+data['companies'][i].id+" selected> "+data['companies'][i].name+" </option>";

                            }else{
                                companies += "<option value="+data['companies'][i].id+"> "+data['companies'][i].name+" </option>";
                            }
                        }
                    }

                    // Categories
                    if(data['categories'].length != null){
                        for(i=0; i<data['categories'].length; i++){
                            if(data['categories'][i].id == data['product'].category_id){
                                categories += "<option value="+data['categories'][i].id+" selected>"+data['categories'][i].name+"</option>";
                            }else{
                                categories += "<option value="+data['categories'][i].id+">"+data['categories'][i].name+"</option>";
                            }
                        }
                    }

                    $('#edit_id_product').val(data['product'].id);
                    $("#edit-proudct-modal").text('Edit - '+data['product'].name);
                    $("#edit_product_name").val(data['product'].name);
                    $("#edit_product_price").val(data['product'].price);
                    $("#edit_product_description").val(data['product'].description);
                    $("#edit_product_tax").val(data['product'].tax);
                    $("#edit_product_company").html(companies);
                    $("#edit_proudct_category").html(categories);
                    $('#edit_product_stock').val(data['product'].stock);
                    $("#edit_product_modal").modal("show");
                }
            });
        });

        // Select categories on company change to update proudct
        $(document).on('change', '#edit_product_company', function(){
            let company_id = $(this).val();
            let categories = "<option value='' hidden disabled selected>-- No Category Selected --</option>";
            $.ajax({
                url: "{{ url('admin/get-categories-by-company-id-in-edit-product-modal') }}"+'/'+company_id,
                type: 'GET',
                success:function(data){

                    if(data.length != null){
                        for(i=0; i<data.length; i++){
                            categories += "<option value="+data[i].id+">"+data[i].name+"</option>";
                        }
                    }
                    $("#edit_proudct_category").html(categories);
                }
            });
        });
        

        // Delete product modal
        $(document).on("click", ".delete_product_modal_trigger", function(){
            let category_id = $(this).attr("data");
            $.ajax({
                url: "{{ url('admin/get-product-by-id') }}"+"/"+category_id,
                type: "get",
                success:function(data){
                    $("#confirm_delete_product_message").text("Are you sure want to delete "+data.name);
                    $("#product_id_in_delete_modal").val(category_id);
                    $("#confirm_delete_product_modal").modal("show");
                }
            });
        });


        // Invester terms and conditions agreement in accountant
        $(document).on('click', '#invester_terms_and_conditions', function(){
            if($(this).prop('checked')){
                $('#submit_investor').prop('disabled', false);
                $(this).val(1);
            }else{
                $('#submit_investor').prop('disabled', true);
            }
        });

        // Show investor image on select profile.
        $(document).on('change', '#investor_profile_image', function(event){
            $('#investor_profile').prop('src', URL.createObjectURL(event.target.files[0]));
        });

        // Show cnic fornt.
        $(document).on('change', '#add_investor_cnic_front', function(event){
            $('#cnic_front').prop('src', URL.createObjectURL(event.target.files[0]));
        });

        // Show cnic back.
        $(document).on('change', '#add_investor_cnic_back', function(event){
            $('#cnic_back').prop('src', URL.createObjectURL(event.target.files[0]));
        });

        $(document).on('click', '.add_new_transaction', function(){
            let transaction_rows = '';
            let rows = '';
            let products = '<option value="" hidden disabled selected>-- Select Product --</option>';
            let products_list = '';
            let proudct = '';

            $.ajax({
                url: "{{ route('accountant.get-products-in-add-transaction') }}",
                type: 'GET',
                success:function(data){

                    if(data.length != 0){
                        data.forEach(function(product){
                            products += '<option value='+product.id+'>'+product.name+'</option>';
                        });
                    }

                    products_list +='<select name="product[]" class="form-control product products-select2">'+products+'</select>';
                    rows += '<tr id="">'+
                            '<td>'+products_list+'</td>'+
                            '<td><input type="text" name="price[]" value="" class="price form-control" multiple readonly></td>'+
                            '<td><input type="text" name="stock[]" value="" class="stock form-control" multiple readonly></td>'+
                            '<td><input type="text" name="quantity[]" value="" class="quantity form-control" multiple disabled></td>'+
                            '<td><input type="text" name="total[]" value="" class="total form-control" multiple readonly></td>'+
                            '<td style="text-align:center;"><button type="button" class="btn btn-sm btn-danger remove_product_transaction" style="margin-top:10px;">X</button></td>'+
                        '</tr>';
                        
                    $('#add_transaction_table_body').append(rows);
                    $('#trasaction-footer').prop('hidden', false);
                    $('.products-select2').select2();
                }
            });
        });
        
        // On product select in add transaction module.
        $(document).on('change', '.product', function(){
            let product_id = $(this).val();
            // Adding id to cosest tr.
            let row_id = $(this).closest('tr').attr('id', "product_row_"+product_id);            
            $.ajax({
                url:'{{ url("accountant/get-product-by-id-in-add-transaction") }}'+'/'+product_id,
                type: 'GET',
                success:function(data){
                    $("#"+row_id.prop('id')+" input.price").val(data.price);
                    $("#"+row_id.prop('id')+" input.stock").val(data.stock);
                    $("#"+row_id.prop('id')+" input.quantity").prop('disabled', false);
                }
            });
        });

        // On quantity change.
        $(document).on('keyup', '.quantity', function(){
            total_products_price = 0;
            let row_id = $(this).closest('tr').attr('id');
            let stock = $("#"+row_id+" input.stock").val();
            let quantity = $("#"+row_id+" input.quantity").val();

            // If ammount is greater than stock, alert.
            if(Number(stock) < Number(quantity)){
                alert("quantity is too long for stock.");
                $("#"+row_id+" input.quantity").val(null);
                return false;
            }

            // Total price = number of products * price of product
            $("#"+row_id+" input.total").val(quantity * $("#"+row_id+" input.price").val());

            // Sum all the total ammount of proudcts.
            $('.total').each(function(){
                total_products_price += parseInt($(this).val());   
            });
            $('#total_products_price').val(total_products_price);
        });

        // Remove transaction row
        $(document).on('click', '.remove_product_transaction', function(){
            $(this).closest('tr').remove();
            if($('tr').length-1 == 0){
                $('#trasaction-footer').prop('hidden', true);
            }
        });

        $(document).on('click', '.payment_type', function(){
            console.log($('#transaction_id').prop('hidden', false));
            if($(this).prop('checked')){
                $('#transaction_id').prop('hidden', false);
            }
        });
    </script>

    

    
    <!-- Accountatn Messagse -->
    @if(Session::has('accountant_success'))
        <script>
            toastr.success("{{ Session::get('accountant_success') }}");
        </script>
    @endif

    @if(Session::has('accountant_info'))
        <script>
            toastr.info("{{ Session::get('accountant_info') }}");
        </script>
    @endif

    @if(Session::has('accountant_error'))
        <script>
            toastr.error("{{ Session::get('accountant_error') }}");
        </script>
    @endif


    <!-- Category Messagse -->
    @if(Session::has('category_success'))
        <script>
            toastr.success("{{ Session::get('category_success') }}");
        </script>
    @endif

    @if(Session::has('category_info'))
        <script>
            toastr.info("{{ Session::get('category_info') }}");
        </script>
    @endif

    @if(Session::has('category_error'))
        <script>
            toastr.error("{{ Session::get('category_error') }}");
        </script>
    @endif



    <!-- Sub Category Messagse -->
    @if(Session::has('sub_category_success'))
        <script>
            toastr.success("{{ Session::get('sub_category_success') }}");
        </script>
    @endif

    @if(Session::has('sub_category_info'))
        <script>
            toastr.info("{{ Session::get('sub_category_info') }}");
        </script>
    @endif

    @if(Session::has('sub_category_error'))
        <script>
            toastr.error("{{ Session::get('sub_category_error') }}");
        </script>
    @endif


    <!-- Transaction Messagse -->
    @if(Session::has('transaction_success'))
        <script>
            toastr.success("{{ Session::get('transaction_success') }}");
        </script>
    @endif

    @if(Session::has('transaction_info'))
        <script>
            toastr.info("{{ Session::get('transaction_info') }}");
        </script>
    @endif

    @if(Session::has('transaction_error'))
        <script>
            toastr.error("{{ Session::get('transaction_error') }}");
        </script>
    @endif

    <!-- Company Messagse -->
    @if(Session::has('company_success'))
        <script>
            toastr.success("{{ Session::get('company_success') }}");
        </script>
    @endif

    @if(Session::has('company_info'))
        <script>
            toastr.info("{{ Session::get('company_info') }}");
        </script>
    @endif

    @if(Session::has('comapny_error'))
        <script>
            toastr.error("{{ Session::get('comapny_error') }}");
        </script>
    @endif


    <!-- Product Messagse -->
    @if(Session::has('product_success'))
        <script>
            toastr.success("{{ Session::get('product_success') }}");
        </script>
    @endif

    @if(Session::has('product_info'))
        <script>
            toastr.info("{{ Session::get('product_info') }}");
        </script>
    @endif

    @if(Session::has('product_error'))
        <script>
            toastr.error("{{ Session::get('product_error') }}");
        </script>
    @endif


    <!-- Investor Message -->
    @if(Session::has('investor_success'))
        <script>
            toastr.success("{{ Session::get('investor_success') }}");
        </script>
    @endif

    @if(Session::has('investor_info'))
        <script>
            toastr.info("{{ Session::get('investor_info') }}");
        </script>
    @endif

    @if(Session::has('investor_error'))
        <script>
            toastr.error("{{ Session::get('investor_error') }}");
        </script>
    @endif

    @if($errors->any())
        @foreach($errors->all() as $error)
            <script>
                toastr.error("{{ $error }}");
            </script>
        @endforeach
    @endif
</body>
</html>