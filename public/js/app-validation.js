$(document).ready(function(){
  var validator = $('form[class=zend-form]').validate({
                    ignore: ':hidden:not(select)',
                    errorClass: "invalid",
			rules: {
                                username:'required',
                                password:'required',
                                /*Application*/
                                applicationDate:'required',
                                applicationAcknowledgementDate:'required',
                                entityType:'required',
                                entity:'required',
				companyName: {
					required: {
                                                depends: function(element) {
                                                                if ($('select[id=entityType] option:selected').val() == 'company'){
                                                                    return true;
                                                                    }else{
                                                                    return false;
                                                                    }
                                                            } 
                                        }                                        
				},                                
//				companyRegistrationNumber: {
//					required: {
//                                                depends: function(element) {
//                                                                if ($('select[id=entityType] option:selected').val() == 'company'){
//                                                                    return true;
//                                                                    }else{
//                                                                    return false;
//                                                                    }
//                                                            } 
//                                        }                                        
//				}, 
/*Contact Details*/
				telephoneNumber: {
					required: {
                                                depends: function(element) {
                                                                if (($('input[id=mobileNumber]').val() === '') && 
                                                                        ($('input[id=faxNumber]').val() === '') && 
                                                                        ($('input[id=emailAddress]').val() === '')){
                                                                    return true;
                                                                    }else{
                                                                    return false;
                                                                    }
                                                            } 
                                        }                                        
				},
				mobileNumber: {
					required: {
                                                depends: function(element) {
                                                                if (($('input[id=telephoneNumber]').val() === '') && 
                                                                        ($('input[id=faxNumber]').val() === '') && 
                                                                        ($('input[id=emailAddress]').val() === '')){
                                                                    return true;
                                                                    }else{
                                                                    return false;
                                                                    }
                                                            } 
                                        }                                        
				},
				faxNumber: {
					required: {
                                                depends: function(element) {
                                                                if (($('input[id=telephoneNumber]').val() === '') && 
                                                                        ($('input[id=mobileNumber]').val() === '') && 
                                                                        ($('input[id=emailAddress]').val() === '')){
                                                                    return true;
                                                                    }else{
                                                                    return false;
                                                                    }
                                                            } 
                                        }                                        
				},
				emailAddress: {
					required: {
                                                depends: function(element) {
                                                                if (($('input[id=telephoneNumber]').val() === '') && 
                                                                        ($('input[id=mobileNumber]').val() === '') && 
                                                                        ($('input[id=faxNumber]').val() === '')){
                                                                    return true;
                                                                    }else{
                                                                    return false;
                                                                    }
                                                            } 
                                        }                                        
				},
				addressLineOne: {
					required: {
                                                depends: function(element) {
                                                                if ($('input[id=postalAddress]').val() === ''){
                                                                    return true;
                                                                    }else{
                                                                    return false;
                                                                    }
                                                            } 
                                        }                                        
				},
				postalAddress: {
					required: {
                                                depends: function(element) {
                                                                if ($('input[id=addressLineOne]').val() === ''){
                                                                    return true;
                                                                    }else{
                                                                    return false;
                                                                    }
                                                            } 
                                        }                                        
				},                                
                                /*End Contact Details*/
				contactFirstName: {
					required: {
                                                depends: function(element) {
                                                                if ($('select[id=entityType] option:selected').val() == 'company'){
                                                                    return true;
                                                                    }else{
                                                                    return false;
                                                                    }
                                                            } 
                                        }                                        
				},                                
				contactMiddleName: {
					required: {
                                                depends: function(element) {
                                                                if ($('select[id=entityType] option:selected').val() == 'company'){
                                                                    return true;
                                                                    }else{
                                                                    return false;
                                                                    }
                                                            } 
                                        }                                        
				},
				contactLastName: {
					required: {
                                                depends: function(element) {
                                                                if ($('select[id=entityType] option:selected').val() == 'company'){
                                                                    return true;
                                                                    }else{
                                                                    return false;
                                                                    }
                                                            } 
                                        }                                        
				},
				contactPosition: {
					required: {
                                                depends: function(element) {
                                                                if ($('select[id=entityType] option:selected').val() == 'company'){
                                                                    return true;
                                                                    }else{
                                                                    return false;
                                                                    }
                                                            } 
                                        }                                        
				},
				firstName: {
					required: {
                                                depends: function(element) {
                                                                if ($('select[id=entityType] option:selected').val() == 'person'){
                                                                    return true;
                                                                    }else{
                                                                    return false;
                                                                    }
                                                            } 
                                        }                                        
				},                                  
				middleName: {
					required: {
                                                depends: function(element) {
                                                                if ($('select[id=entityType] option:selected').val() == 'person'){
                                                                    return true;
                                                                    }else{
                                                                    return false;
                                                                    }
                                                            } 
                                        }                                        
				}, 
				lastName: {
					required: {
                                                depends: function(element) {
                                                                if ($('select[id=entityType] option:selected').val() == 'person'){
                                                                    return true;
                                                                    }else{
                                                                    return false;
                                                                    }
                                                            } 
                                        }                                        
				}, 
				identityNumber: {
					required: {
                                                depends: function(element) {
                                                                if ($('select[id=entityType] option:selected').val() == 'person'){
                                                                    return true;
                                                                    }else{
                                                                    return false;
                                                                    }
                                                            } 
                                        }                                        
				},                                                                 

                                /**
                                 * Project Resolution
                                 */
                                
				resolutionDiscussionDate: "required",
				resolutionCorespondenceDate: "required",
                                resolutionDiscussionStatus:'required',
                                    /**
                                     * When status is approved
                                     */
                                    projectName: {
                                            required: {
                                                    depends: function(element) {
                                                                    if ($('select[id=resolutionDiscussionStatus] option:selected').val() == 'APPROVED'){
                                                                        return true;
                                                                        }else{
                                                                        return false;
                                                                        }
                                                                } 
                                            }                                        
                                    },
                                    startDate: {
                                            required: {
                                                    depends: function(element) {
                                                                    if ($('select[id=resolutionDiscussionStatus] option:selected').val() == 'APPROVED'){
                                                                        return true;
                                                                        }else{
                                                                        return false;
                                                                        }
                                                                } 
                                            }                                        
                                    }, 
                                    endDate: {
                                            required: {
                                                    depends: function(element) {
                                                                    if ($('select[id=resolutionDiscussionStatus] option:selected').val() == 'APPROVED'){
                                                                        return true;
                                                                        }else{
                                                                        return false;
                                                                        }
                                                                } 
                                            }                                        
                                    },
                                    entityType: {
                                            required: {
                                                    depends: function(element) {
                                                                    if ($('select[id=resolutionDiscussionStatus] option:selected').val() == 'APPROVED'){
                                                                        return true;
                                                                        }else{
                                                                        return false;
                                                                        }
                                                                } 
                                            }                                        
                                    },                                    
                                signedDate:"required",
                                discussionStatus:"required",
                                'phase[]':"required",
                                'instalmentAmount[]':"required",
                                'instalmentDate[]':"required",
                                totalNumberOfMaleEmployees:"required"
			},
			messages: {
				discussionDate: "Enter discussion date.",
                                username: 'Please provide your username',
                                password: 'Please provide your password',
                                signedDate: 'Signed date is required.',
                                entityType:'Please select an entity',
                                entity:''
			}
		});

});