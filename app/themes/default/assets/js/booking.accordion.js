$(document).ready(function() {
    
  $(".AccordionNextBtn").on("click", function() {
      

      
            var contentId = $(this).closest('.accordion-content').attr('id');
            var isValid = true;
          
           $('#'+contentId+' :required').each(function() {
               if ($(this).val() === '' && !$(this).prop('checked')) {
                        isValid = false;
             }
           });
           
           if (!isValid) {
             alert('Please fill out all required fields.');
           } else {

                     var num = contentId.substring(8);
                     var newNum = parseInt(num) + 1;
                     var newId = "content-" + newNum;
                      
                     $('#'+contentId).toggle('hide');
                     $('#'+newId).toggle('show');
           }
           
           event.preventDefault();
           
            $("form").submit(function(e){
               // alert('submit intercepted');
                e.preventDefault(e);
            });
   });
   
   
   $(".AccordionPervBtn").on("click", function() {
       
      //alert('feras naim');
      
      $("#checkme").val("");
     // $("#agreechb").val("");
       
         var contentId = $(this).closest('.accordion-content').attr('id');
         var num = contentId.substring(8);
         var newNum = parseInt(num) - 1;
         var newId = "content-" + newNum;
         
         $('#'+newId).toggle('hide');
         $('#'+contentId).toggle('show');
         
          $("form").submit(function(e){
            //    alert('submit intercepted');
                e.preventDefault(e);
            });
        
       // event.preventDefault();

   });
     
});