$(document).ready(function(){
    
bsspObj.loadNewApplicationCount();
bsspObj.loadNewCommiteeResoultionsCount();
bsspObj.loadNewProjectsCount();
 

 setInterval(function () {bsspObj.loadNewApplicationCount();}, 5000);
 setInterval(function () {bsspObj.loadNewCommiteeResoultionsCount();}, 5000);
 setInterval(function () { bsspObj.loadNewProjectsCount();}, 5000);
 
	$("#tabs-wrap").tytabs({
							prefixtabs:"tab",
							prefixcontent:"content",
							classcontent:"tabscontent",
							tabinit:"1",
							catchget:"tab2",
							fadespeed:"normal"
							});                                                      
         if($('.datepicker').size() > 0){
        $('.datepicker').daterangepicker({
                                                        singleDatePicker: true,
                                                        format: 'DD/MM/YYYY'
                                                        });              
         }                                              
                                                     
  var implementationValue = $("select#includeImplementationReport option:selected").val();

        if('Y' === implementationValue){
            $('#immplementationStatus').fadeIn('slow',function(){});                
        }
        if('N' === implementationValue){                
            $('#immplementationStatus').fadeOut('slow',function(){});                
        } 


  
$('.panel-body').not('#access-denied').slimscroll({
  height: '512px'
});                                                        
//        $('.datepicker').datepicker({
//            format: 'dd/mm/yyyy',
////            startDate: '3d',
//            autoclose: true
//        });
//        $('.selectpicker').selectpicker();
  // Calls the selectBoxIt method on your HTML select box

  $("select.selectric").selectric();
  
  $("select#includeImplementationReport").selectric({
      onChange:function(){
          var value = $(this).val();

            if('Y' === value){
                $('#immplementationStatus').fadeIn('slow',function(){});                
            }
            if('N' === value){                
                $('#immplementationStatus').fadeOut('slow',function(){});                
            } 
      }
  });    
  $("select#entityType").selectric({
      onChange:function(){
          var value = $(this).val();

            if('person' === value){
                $('#company-section').fadeOut('slow',function(){
                    $('#individual-section').fadeIn('slow');
                });                
            }
            
            if('company' === value){                
                $('#individual-section').fadeOut('slow',function(){
                    $('#company-section').fadeIn('slow');
                });                
            } 
      }
  });


    if('APPROVED' === $('select[id=resolutionDiscussionStatus] option:selected').val()){
            $('#resolutionRemarks').val('Priority Area');
            $('#project-info').show();

    };
  
  $("select#resolutionDiscussionStatus").selectric({
      onChange:function(){
          var value = $(this).val();

            if('APPROVED' === value){
                    $('#resolutionRemarks').val('Priority Area');
                    $('#project-info').fadeIn('slow' , function(){
                        
                    });
                    
            }
            if('REJECTED' === value){
                $('#resolutionRemarks').val('Not Priority Area');
                $('#project-info').fadeOut('slow',function(){
                    
                });                
            }
            if('PENDING-INFO' === value){
                $('#resolutionRemarks').val('Additional Information required');
                $('#project-info').fadeOut('slow',function(){
                    
                });                
            }             
      }
  });
  
//Dynamic contents

/**
 * Consultant creation
 */
/**
 * Adding Project consultant 
 */

  $("#add-consultant").on('click' , function(){
            $.ajax({
            url: '/services/new-legal-entity/',
            type: 'GET',
            cache:false,
            data: {'projectNumber':0},
            beforeSend: function (request){
                $('#budget-loading-status').slideDown().html('<div class="loading"><span class="text-info"><i class="fa fa-spinner fa-spin"></i> Loading...</span></div>');               
            },

            success: function(data,status,xhr) {

                    $('#modal-project-consultant-body .frm-contents').html(data);
                    $('.datepicker').daterangepicker({
                                                                            singleDatePicker: true,
                                                                            format: 'DD/MM/YYYY'});

                $('#modal-project-consultant').modal('view',{
                    easing : 'linear',
                    position : 'bottom',
                    animation : 'top left',
                    speed : 1000,
                    overlayClose : false
                });
                $("select.selectric").selectric();
                $("select#entityType").selectric({
                    onChange:function(){
                        var value = $(this).val();

                          if('person' === value){
                              $('#company-section').fadeOut('slow',function(){
                                  $('#individual-section').fadeIn('slow');
                              });                
                          }
                          if('company' === value){                
                              $('#individual-section').fadeOut('slow',function(){
                                  $('#company-section').fadeIn('slow');
                              });                
                          } 
                    }
                });                 
            },
            complete:function(){
               
                $('.loading-status').html('');                
            },
            error: function(data,status,xhr) {
            alert("fail: " + xhr.toString() );
            //console.log(data );
            }
            });
      });
    /**
     * Creating a new consultant
     */
    $frmProjectConsultant = $("#project-consultant");
    
    $frmProjectConsultant.on('submit' , function(e){
      e.preventDefault();
            $.ajax({
            url: '/services/create-legal-entity/',
            type: 'POST',
            cache:false,
            data: $frmProjectConsultant.serialize(),
            dataType: 'JSON', 
            beforeSend: function (request){
                $select = $('select[id=consultantId]');
                $('#consultant-loading-status').slideDown().html('<div class="loading"><span class="text-info"><i class="fa fa-spinner fa-spin"></i> Loading...</span></div>');               
            },

            success: function(data,status,xhr) {
                      $select.prepend('<option id="' + data.entity.id + '" value="' + data.entity.id + '">' + data.entity.legalEntityName + '</option>');
                      $select.val(data.entity.id);                
                      $select.selectric('refresh');
             
            },
            complete:function(){ 
                $('#modal-project-consultant').modal('close');
                $('#consultant-notice').html('<p class="messages info status-approved">Consultant has been created successfully.</p>');
                $('#consultant-loading-status').html('');
               bsspUtil.authideNotices();
            },
            error: function(data,status,xhr) {
            alert("fail: " + xhr.toString() );
            //console.log(data );
            }
            });
      });    
        //trigger modal close
        $('.modal-close').on('click' , function(){
            $('#modal-project-consultant').modal('close');
        });
        
/**
 * Bbudget creation
 */
/**
 * Adding Project extension 
 */

  $("#add-project-budget").on('click' , function(){
            $.ajax({
            url: '/services/new-project-budget/',
            type: 'GET',
            cache:false,
            data: {'projectNumber':$('#projectNumber').val()},
            beforeSend: function (request){
                $('#budget-loading-status').slideDown().html('<div class="loading"><span class="text-info"><i class="fa fa-spinner fa-spin"></i> Loading...</span></div>');               
            },

            success: function(data,status,xhr) {

                    $('#modal-project-budget-body .frm-contents').html(data);
                    $('.datepicker').daterangepicker({
                                                                            singleDatePicker: true,
                                                                            format: 'DD/MM/YYYY'});
                        
                $('#modal-project-budget').modal('view',{
                    easing : 'linear',
                    position : 'bottom',
                    animation : 'top left',
                    speed : 1000,
                    overlayClose : false
                });              
            },
            complete:function(){ 
                $('.loading-status').html('');                
            },
            error: function(data,status,xhr) {
            alert("fail: " + xhr.toString() );
            //console.log(data );
            }
            });
      });        
    /**
     * Creating a new budget
     */
    $frmProjectBudget = $("#project-budget");
    $frmProjectBudget.on('submit' , function(e){
      e.preventDefault();
            $.ajax({
            url: '/services/create-project-budget/',
            type: 'POST',
            cache:false,
            data: $frmProjectBudget.serialize(),
            beforeSend: function (request){
                $('.loading-status').slideDown().html('<div class="loading"><span class="text-info"><i class="fa fa-spinner fa-spin"></i> Loading...</span></div>');               
            },

            success: function(data,status,xhr) {
                alert(data);
                if(10 > $('.instalment').size()){
                    $('#modal-project-budget-body .frm-contents').html(data);                  

                        
                $('#modal-project-budget').modal('view',{
                    easing : 'linear',
                    position : 'bottom',
                    animation : 'top left',
                    speed : 1000,
                    overlayClose : false
                });
                

                        
                }else{
                    $.Zebra_Dialog('<strong>Maximum payment rows</strong>, you have reached a maximum permissible number of payment instalments. Only ten(10) numbers instalments are allowed.', {
                        'type':     'information',
                        'title':    'Payment row'
                    });                     
                }               
            },
            complete:function(){ 
                $('.loading-status').html('');
               
            },
            error: function(data,status,xhr) {
            alert("fail: " + xhr.toString() );
            //console.log(data );
            }
            });
      });    
        //trigger modal close
        $('#cancel-budget').on('click' , function(){
            $('#modal-project-budget').modal('close');
        });       
/**
 * Setup City and Towns calls
 */

//budgetApproved
  $("select#regionCode").selectric({
      onChange:function(){
          var value = $(this).val();
            $.ajax({
            url: '/services/get-towns/',
            type: 'GET',
            cache:false,
            dataType:'JSON',
            data: {'code':value},
            beforeSend: function (request){
                $select = $('select[id=cityCode]');
                $select.html('<option> Loading cities/towns...</option>');
                $select.selectric('refresh');
            },

            success: function(data,status,xhr) {
                if(data.towns.length > 0){
                    
                    $select.html('');
                    //iterate over the data and append a select option
                    $.each(data.towns, function(key, val){
                      $select.append('<option id="' + val.value + '" value="' + val.value + '">' + val.label + '</option>');
                      $select;
                    });                    
                    
                }else{
                    $select.html('<option id="-1">None available at the moment !</option>');
                }
                $select.selectric('refresh');
            },
            complete:function(){ 
                $('#loader').remove();
            },
            error: function(data,status,xhr) {
                $select.html('<option id="-1">none available</option>');
            //alert("fail: " + xhr.toString() );
            //console.log(data );
            }
            }); 
      }
  });
  
/**
 * Setup City and Towns calls
 */
  $("select#cityCode").selectric({
      onChange:function(){
          var value = $(this).val();
            $.ajax({
            url: '/services/get-constituences/',
            type: 'GET',
            cache:false,
            dataType:'JSON',
            data: {'code':value},
            beforeSend: function (request){
                $select = $('select[id=constituencyCode]');
                $select.html('<option> Loading constituences...</option>');
                $select.selectric('refresh');
            },

            success: function(data,status,xhr) {
                if(data.constituences.length > 0){
                    
                    $select.html('');
                    //iterate over the data and append a select option
                    $.each(data.constituences, function(key, val){
                      $select.append('<option id="' + val.value + '" value="' + val.value + '">' + val.label + '</option>');
                      $select;
                    });                    
                    
                }else{
                    $select.html('<option id="-1">None available at the moment !</option>');
                }
                $select.selectric('refresh');
            },
            complete:function(){ 
                $('#loader').remove();
            },
            error: function(data,status,xhr) {
                $select.html('<option id="-1">none available</option>');
            //alert("fail: " + xhr.toString() );
            //console.log(data );
            }
            }); 
      }
  });   
  
});

var bsspObj = {
    updateConstituences:function(region){
            $.ajax({
            url: '/services/get-constituences/',
            type: 'GET',
            cache:false,
            dataType:'JSON',
            data: {'code':region},
            beforeSend: function (request){
                $select = $('select[id=constituencyCode]');
                $select.html('<option> Loading constituences...</option>');
                $select.selectric('refresh');
            },

            success: function(data,status,xhr) {
                if(data.constituences.length > 0){
                    
                    $select.html('');
                    //iterate over the data and append a select option
                    $.each(data.constituences, function(key, val){
                      $select.append('<option id="' + val.value + '" value="' + val.value + '">' + val.label + '</option>');
                      $select;
                    });                    
                    
                }else{
                    $select.html('<option id="-1">None available at the moment !</option>');
                }
                $select.selectric('refresh');
            },
            complete:function(){ 
                $('#loader').remove();
            },
            error: function(data,status,xhr) {
                $select.html('<option id="-1">none available</option>');
            //alert("fail: " + xhr.toString() );
            //console.log(data );
            }
            }); 
        
    },
    loadPriorityAreas:function(sector , rowNumber){
        
            $select = $('select[id=priority' + rowNumber + ']');
            
            if('' === sector){
//                $select.html('<option> Please select request sector first...</option>');
                return;
            }
            
            $.ajax({
            url: '/services/fetch-sector-priority-areas/',
            type: 'GET',
            cache:false,
            dataType:'JSON',
            data: {'code':sector},
            beforeSend: function (request){
                
                $select.html('<option> Loading priority areas...</option>');
//                $select.selectric('refresh');
            },

            success: function(data,status,xhr) {
                if(data.priorities.length > 0){
                    
                    $select.html('');
                    //iterate over the data and append a select option
                    $.each(data.priorities, function(key, val){
                      $select.append('<option id="' + val.value + '" value="' + val.value + '">' + val.label + '</option>');
                      $select;
                    });                    
                    
                }else{
                    $select.html('<option id="-1">None available at the moment !</option>');
                }
                $select.selectric('refresh');
            },
            complete:function(){ 
                $('#loader').remove();
            },
            error: function(data,status,xhr) {
                $select.html('<option id="-1">none available</option>');
            //console.log(data );
            }
            }); 
        
    },    
    loadRegions:function(){},
    loadTownsAndCities:function(regionCode){
            var value = regionCode;
            $.ajax({
            url: '/services/get-towns/',
            type: 'GET',
            cache:false,
            dataType:'JSON',
            data: {'code':value},
            beforeSend: function (request){
                $select = $('select[id=cityCode]');
                $select.html('<option> Loading cities/towns...</option>');
                $select.selectric('refresh');
            },

            success: function(data,status,xhr) {
                if(data.towns.length > 0){
                    
                    $select.html('');
                    //iterate over the data and append a select option
                    $.each(data.towns, function(key, val){
                      $select.append('<option id="' + val.value + '" value="' + val.value + '">' + val.label + '</option>');
                      $select;
                    });                    
                    
                }else{
                    $select.html('<option id="-1">None available at the moment !</option>');
                }
                $select.selectric('refresh');
            },
            complete:function(){ 
                $('#loader').remove();
            },
            error: function(data,status,xhr) {
                $select.html('<option id="-1">none available</option>');
            }
            });        
    },
    loadConstituences:function(cityTownCode){
            var value = cityTownCode;
            $.ajax({
            url: '/services/get-constituences/',
            type: 'GET',
            cache:false,
            dataType:'JSON',
            data: {'code':value},
            beforeSend: function (request){
                $select = $('select[id=constituencyCode]');
                $select.html('<option> Loading constituences...</option>');
                $select.selectric('refresh');
            },

            success: function(data,status,xhr) {
                if(data.constituences.length > 0){
                    
                    $select.html('');
                    //iterate over the data and append a select option
                    $.each(data.constituences, function(key, val){
                      $select.append('<option id="' + val.value + '" value="' + val.value + '">' + val.label + '</option>');
                      $select;
                    });                    
                    
                }else{
                    $select.html('<option id="-1">None available at the moment !</option>');
                }
                $select.selectric('refresh');
            },
            complete:function(){ 
                $('#loader').remove();
            },
            error: function(data,status,xhr) {
                $select.html('<option id="-1">none available</option>');
            }
            });        
    },
    lounchCommitteeResolutionDialog: function(){
        $.Zebra_Dialog('<strong>Zebra_Dialog</strong>, a small, compact and highly' +
            'configurable dialog box plugin for jQuery', {
            'type':     'question',
            'title':    'Custom buttons',
            'buttons':  [
                            {caption: 'Yes', callback: function() { return true;}},
                            {caption: 'Cancel', callback: function() { return false;}}
                        ]
        });        
    },
    loadNewApplicationCount:function(){
        
            $countSpan = $('<span class="badge"></span>');
            var numberOfCountSpan = $( ".navbar-nav > li > a[href*=promoters] span[class=badge]").size();
            
            $.ajax({
            url: '/services/fetch-new-applications-count/',
            type: 'GET',
            cache:false,
            dataType:'JSON',
            beforeSend: function (request){},

            success: function(data,status,xhr) {
                
                if(parseInt(data.rows.count) > 0){
                    
                        if(parseInt(numberOfCountSpan) == 0){
                           $countSpan.html(parseInt(data.rows.count));
                           $( ".navbar-nav > li > a[href*=promoters]" ).append($countSpan);                            
                        }else{
                           $( ".navbar-nav > li > a[href*=promoters] span[class=badge]").html(parseInt(data.rows.count));
                        }                      
                                       
                }else{}
            },
            complete:function(){},
            error: function(data,status,xhr) {
            console.log(data );
            }
            }); 
        
    },
    loadNewCommiteeResoultionsCount:function(){
        
            $countSpan = $('<span class="badge"></span>');
            var numberOfCountSpan = $( ".navbar-nav > li > a[href*=commiteeresolutions] span[class=badge]").size();

            $.ajax({
            url: '/services/fetch-new-committee-resolution-count/',
            type: 'GET',
            cache:false,
            dataType:'JSON',
            data: {},
            beforeSend: function (request){},

            success: function(data,status,xhr) {

                if(parseInt(data.rows.count) > 0){
                        if(parseInt(numberOfCountSpan) == 0){
                           $countSpan.html(parseInt(data.rows.count));
                           $( ".navbar-nav > li > a[href*=commiteeresolutions]" ).append($countSpan);                            
                        }else{
                           $( ".navbar-nav > li > a[href*=commiteeresolutions] span[class=badge]").html(parseInt(data.rows.count));
                        }                   
                }else{}
            },
            complete:function(){},
            error: function(data,status,xhr) {
            //console.log(data );
            }
            }); 
        
    },
    loadNewProjectsCount:function(){
        
            $countSpan = $('<span class="badge"></span>');
            var numberOfCountSpan = $( ".navbar-nav > li > a[href*=projects] span[class=badge]").size();
            $.ajax({
            url: '/services/fetch-new-projects-count/',
            type: 'GET',
            cache:false,
            dataType:'JSON',
            data: {},
            beforeSend: function (request){},

            success: function(data,status,xhr) {

                if(parseInt(data.rows.count) > 0){
                        if(parseInt(numberOfCountSpan) == 0){
                           $countSpan.html(parseInt(data.rows.count));
                           $( ".navbar-nav > li > a[href*=projects]" ).append($countSpan);                            
                        }else{
                           $( ".navbar-nav > li > a[href*=projects] span[class=badge]").html(parseInt(data.rows.count));
                        }                        
                 
                }else{}
            },
            complete:function(){},
            error: function(data,status,xhr) {
            //console.log(data );
            }
            }); 
        
    }   
};