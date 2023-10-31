<!-- javascript for tabby integration -->

            <script type="text/javascript">

              //  alert('<?=root?>payment/tabby_api');
                
                 //
            function submit_tabby_req() {
                // get from input
                var validate = true;
                var firstname = $('.firstname_cls').val();
                var lastname = $('.lastname_cls').val();
                var phone = $('.phone_cls').val();
                var address = $('.address_cls').val();
                var email = $('.email_cls').val();
                
                if(firstname == ''){
                    validate = false;
                    $('.firstname_cls').focus();
                    return;
                }
                if(lastname == ''){
                    validate = false;
                    $('.lastname_cls').focus();
                    return;
                }
                if(email == ''){
                    validate = false;
                    $('.email_cls').focus();
                    return;
                }
                if(phone == ''){
                    validate = false;
                    $('.phone_cls').focus();
                    return;
                }
                if(address == ''){
                    validate = false;
                    $('.address_cls').focus();
                    return;
                }
                //
                var submitForm = $("#registerSubmit").serializeArray();
                len = submitForm.length,
                dataObj = {};
                for (i=0; i<len; i++) {
                    // acceesing data array    
                    dataObj[submitForm[i].name] = submitForm[i].value;

                    value_input = $("input[name='"+submitForm[i].name+"']").val();
                    //form data validate  
                    if(value_input==''){
                        
                        validate = false;
                        $("input[name='"+submitForm[i].name+"']").focus();
                        return;
                    }
                }
                // email validate
                if(email != ''){
                    var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;  
                    if(!emailReg.test(email)) {  
                        validate = false;
                        $('.email_cls').focus();
                        return;
                   }

                }
                 
                
                
                    
                // ajax call
                if(validate==true){

                    $("body").scrollTop(0);
                    $(".booking_loading").css("display", "block");
                    $(".booking_data").css("display", "none");

                    $.ajax({
                        url: '<?=root?>payment/tabby_api',
                        type: 'POST',
                        data: $("#registerSubmit").serialize(),
                        
                        success: function(data) {
                            $(".booking_loading").css("display", "none");
                            $(".booking_data").css("display", "block");
                            var parsData = JSON.parse(data);
                            // alert(parsData.web_url);
                            var is_email_virified = parsData.is_email_virified;   // available_products
                            if(is_email_virified){
                                if(parsData.web_url != ''){
                              var web_url = `<a href="`+parsData.web_url+`" class="nav-link  border p-2" style="background:#fff;">
                                        <i class="la la-check icon-element"></i>
                                        <img src="<?=root.theme_url?>assets/img/tabby-logo.png" alt="<?=$item->title ?>" style="width:100px; height: 41px;">
                                        <span class="d-block pt-2 font-size-13"><?= T::interesttext?> `+parsData.total_payment+`. `+parsData.currency+`.</span></a>`;
                                    } else{
                                         var web_url = '';
                                    }

                            } else{

                               var web_url = 'Installments is not available';
                            }

                            var amazone = `<a href="#" class="nav-link border p-2" style="background:#fff;"  >
                                        <i class="la la-check icon-element"></i>
                                        <img src="<?=root.theme_url?>assets/img/payment-img.png" alt="<?=$item->title ?>" class="img-fluid w-75">
                                        <span class="d-block pt-2 font-size-13"><?= T::installmenttext?> `+parsData.total_payment+`. `+parsData.currency+`.<?=T::nofees?>.</span></a>`;
                            
                            $("#tabbyModal").modal('show');
                            $(".tabby_btn").html(web_url);
                            $(".amazone_btn").html(amazone);
                        }
                    }); 
                    
                } 
                }
                 
                 function hide_modal(){
                    $("#tabbyModal").modal('hide');
                 }

                
             </script>
             <!-- modal for tabby-->
            <div class="modal fade " id="tabbyModal" tabindex="-1" aria-labelledby="tabby" aria-hidden="true"> 
              <div class="modal-dialog ">
                <div class="modal-content " >
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel"><?=T::tabbyhead?></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body pb-2">
                        <div class="check-mark-tab text-center pb-4 row">


                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item tabby_btn pt-4 col-lg-6 m-0 p-1">
                                <li class="nav-item amazone_btn pt-4 col-lg-6 m-0 p-1">
                            </ul>
                    
                       </div>
                     
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>
             <!-- modal end --> 