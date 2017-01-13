/*
Theme Name: 
Theme URI: http://
Author: 
Author URI: http://
Description: Javascript
*/


/* =Layout Script
---------------------------------------------------------- */

$(document).ready(function(){
	var asides		= $(".left-panel");
	var _bool		= '';
	$(".c_customdropdown li").click(function(e) {
		var $target = $( e.currentTarget );
		$target.closest( '.btn-group' )
		 .find( '[data-bind="label"]' ).text($target.text()).val($target.attr('attr_id'))
			.end()
		 .children( '.dropdown-toggle' ).dropdown( 'toggle' );
		return false;

	});
	

	$.validator.addMethod("regex", function(value, element, regexpr) {          
	    return regexpr.test(value);
	}, "Provide a valid input for experience.");

    //for signup
    $(".signup").click(function(){
        var _self   = $(this);
        
        var html    = "<form name='frmsignup' method='post' action='/signup'>"+
                        "<div class='row-fluid clearfix text-left'>"+
                            "<div class='form-group clearfix'>"+
                                "<div class='col-md-12'>"+
                                    "<div class='alert alert-signup hide' role='alert'></div>"+
                                "</div>"+
                            "</div>"+
                            "<div class='form-group clearfix'>"+
                                "<div class='col-md-6'>"+
                                    "<label class='control-label'>Firstname*</label>"+
                                    "<input class='form-control' type='text' name='firstname' value='' autocomplete='off' required='required' />"+
                                "</div>"+
                                "<div class='col-md-6'>"+
                                    "<label class='control-label'>Lastname*</label>"+
                                    "<input class='form-control' type='text' name='lastname' value='' autocomplete='off' required='required' />"+
                                "</div>"+
                            "</div>"+
                            "<div class='form-group clearfix'>"+
                                "<div class='col-md-12'>"+
                                    "<label class='control-label'>Email*</label>"+
                                    "<input class='form-control' type='text' name='email' value='' autocomplete='off' required='required' />"+
                                "</div>"+
                            "</div>"+
                            "<div class='form-group clearfix'>"+
                                "<div class='col-md-4'>"+
                                    "<label class='control-label'>Phone No*</label>"+
                                    "<input class='form-control' type='text' name='phoneno' value='' autocomplete='off' required='required' />"+
                                "</div>"+
                                "<div class='col-md-4'>"+
                                    "<label class='control-label'>City</label>"+
                                    "<input class='form-control' type='text' name='city' value='' autocomplete='off'/>"+
                                "</div>"+
                                "<div class='col-md-4'>"+
                                    "<label class='control-label'>Postal Code</label>"+
                                    "<input class='form-control' type='text' name='postalcode' value='' autocomplete='off'/>"+
                                "</div>"+
                            "</div>"+
                            "<div class='form-group clearfix'>"+
                                "<div class='col-md-6'>"+
                                    "<label class='control-label'>Username*</label>"+
                                    "<input class='form-control' type='text' name='username' value='' autocomplete='off' required='required' />"+
                                "</div>"+
                                "<div class='col-md-6'>"+
                                    "<label class='control-label'>User Type*</label>"+
                                    "<div class='field'>"+
                                        "<div class='select'>"+
                                            "<select class='form-control' name='usertype' required='required'>"+
                                                "<option value=''>Select User Type</option>"+
                                                "<option value='basic'>Basic User</option>"+
                                                "<option value='company'>Company</option>"+
                                            "</select>"+
                                        "</div>"+
                                    "</div>"+
                                "</div>"+
                            "</div>"+
                            "<div class='form-group clearfix pr'>"+
                                "<div class='col-md-6'>"+
                                    "<label class='control-label'>Password*</label>"+
                                    "<input class='form-control' type='password' name='password' value='' autocomplete='off' required='required' />"+
                                "</div>"+
                                "<div class='col-md-6'>"+
                                    "<label class='control-label'>Re-Type Password*</label>"+
                                    "<input class='form-control' type='password' name='password_confirmation' value='' autocomplete='off' required='required' />"+
                                "</div>"+
                            "</div>"+
                            "<div class='form-group clearfix'>"+
                                "<div class='col-md-12 clearfix'>"+
                                    "<button type='submit' class='btn btn-primary btn-md col-md-12 col-sm-12 col-xs-12'><span class='fa fa-user-plus'></span>&nbsp;Register</button>"+
                                    "<div class='signupPreview'></div>"+
                                    "<input type='hidden' value='"+$("meta[name='csrf-token']").attr('content')+"' name='_token'>"+
                                "</div>"+
                            "</div>"+
                        "</div>"+
                      "</form>";

        jAlert({
                'class'     : 'modal-md',
                'title'     : 'Sign Up',
                'msg'       : html,
                'footer'    : false
        });
        passwordStrength();
        $("form[name='frmsignup']").validate({
            rules: {
                firstname: {
                    required: true,
                    regex: /^[a-zA-Z\s]+$/
                },
                lastname: {
                    required: true,
                    regex: /^[a-zA-Z\s]+$/
                },
                email: {
                    required: true,
                    email: true,
                    regex: /^[-a-z0-9_}{\'?]+(\.[-a-z0-9_}{\'?+]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i
                },
                phoneno: {
                    required: {
                        depends:function(){
                            $(this).val($.trim($(this).val()));
                            return true;
                        }
                    },
                    regex: /^[0-9]+$/
                },
                city: {
                    required: false,
                    regex: /^[a-zA-Z\s]+$/
                },
                postalcode: {
                    required: false,
                    regex: /^\d{4,5}$/
                },
                username: {
                    required: true
                }, 
                usertype: {
                    required: true
                },
                password: {
                  required: true,
                  regex: /^(?=.*[a-zA-Z])((?=.*?\d)|(?=.*?[!@#$%^&*(),._+]))[A-Za-z\d!@#$%^&*(),._+]{8,20}$/i
                }
            },
            messages: {
                firstname: {
                    required: "Please enter your firstname",
                    regex: "Please enter a valid firstname"
                },
                lastname: {
                    required: "Please enter your lastname",
                    regex: "Please enter a valid lastname"
                },
                email: {
                  required :"Please enter an email address",
                  email:"Please enter a valid email address",
                  regex:"Please enter a valid email address"
                },
                phoneno: {
                    required: "Please enter your phone number",
                    regex: "Please enter a valid phone number"
                },
                city: {
                    regex: "Please enter a valid city"
                },
                postalcode: {
                    regex: "Please enter a valid postal code"
                },
                username:{
                    required: "Please enter your username"
                },
                usertype:{
                    required: "Please select your desire usertype"
                },
                password: {
                  required: "Please enter your password",
                  regex :"Please provide a valid password"
                }
            }  
        })

        $("form[name='frmsignup']").ajaxForm({
            target:'#signupPreview',
            dataType:'json',
            beforeSubmit:function(){
              $("button[type='submit']", $("form[name='frmsignup']")).attr('disabled','disabled').html('Processing Request Please wait...');
              $(".alert-signup").removeClass('alert-danger').addClass('hide').html('');
            },
            success: function(responseText, statusText, xhr, $form){
                $("button[type='submit']", $("form[name='frmsignup']")).removeAttr('disabled').html('<span class="fa fa-gift"></span>&nbsp;Register');
                $("form[name='frmsignup']").resetForm();
                $(".c_alert").modal('hide');
                window.location.reload();
            },
            error: function(response){
                $("button[type='submit']", $("form[name='frmsignup']")).removeAttr('disabled').html('<span class="fa fa-gift"></span>&nbsp;Register');
                var html   =  "<ul class='pd'>";
                $.each(response.responseJSON.message,function(key, value){
                    html += "<li><strong>"+key.toUpperCase()+"</strong>: "+value+"</li>";
                })
                html    += "</ul>";

                $(".alert-signup").addClass('alert-danger').removeClass('hide').html(html);
            }
        });
    })
    //endhere

	
	$(".c_menu_toggle").click(function(){
		if(_bool=='' ||  _bool==true)
		{
			_bool	= false;
			if(asides.is(":visible")==false)
			{
				asides.css('margin-left','-610px');
				asides.show();
			}
			
			if(asides.css('margin-left')=="-610px")
			{
				asides.animate({
					'margin-left':0
				},'slow', function() {
					_bool = true;
					$(".content-panel").attr('style','margin-left:210px');
				});
				
				
			}else
			{
				asides.animate({
					'margin-left':-610
				},'slow', function() {
					_bool = true;
					$(".content-panel").attr('style','margin-left:0');
				});
				
			}
		}
	});
	
	$(".navbar-nav li").click(function(){
        var _self  = $(this);
        var _getID = _self.text().toLowerCase().replace(/\s+/,'');
        $("body, html").animate({
          scrollTop: $("#"+_getID).offset().top - 40
        }, 500, 'swing')
    })
    $(".btn-donate").click(function(){
    	var _self   = $(this);
    	$("body, html").animate({
          scrollTop: $("#donate").offset().top - 40
        }, 500, 'swing')
    });


    $("form[name='frmdonate']").validate({
    	rules: {
    		charity: "required",
    		firstname: {
    			required: true,
    			regex: /^[a-zA-Z\s]+$/
    		},
    		lastname: {
    			required: true,
    			regex: /^[a-zA-Z\s]+$/
    		},
    		email: {
    			required: true,
    			email: true,
    			regex: /^[-a-z0-9_}{\'?]+(\.[-a-z0-9_}{\'?+]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i
    		},
    		phoneno: {
    			required: {
	                depends:function(){
	                    $(this).val($.trim($(this).val()));
	                    return true;
	                }
	            },
    			regex: /^[0-9]+$/
    		},
    		city: {
    			required: true,
    			regex: /^[a-zA-Z\s]+$/
    		},
    		postalcode: {
    			required: true,
    			regex: /^\d{4,5}$/
    		},
    		country: {
    			required: true,
    			regex: /^[a-zA-Z\s]+$/
    		},
    		amount: {
    			required: true,
    			regex: /^[0-9]+(\.[0-9][0-9])?$/
    		},
    		currency: "required",
    		agreement: "required"
    	},
    	messages: {
    		charity: "Please choose your charity.",
    		firstname: {
    			required: "Please enter your firstname",
    			regex: "Please enter a valid firstname"
    		},
    		lastname: {
    			required: "Please enter your lastname",
    			regex: "Please enter a valid lastname"
    		},
    		email: {
	          required :"Please enter an email address",
	          email:"Please enter a valid email address",
	          regex:"Please enter a valid email address"
	        },
	        phoneno: {
    			required: "Please enter your phone number",
    			regex: "Please enter a valid phone number"
    		},
    		city: {
    			required: "Please enter your city",
    			regex: "Please enter a valid city"
    		},
    		postalcode: {
    			required: "Please enter your postal code",
    			regex: "Please enter a valid postal code"
    		},
    		country: {
    			required: "Please enter your country",
    			regex: "Please enter a valid country"
    		},
    		amount: {
    			required: "Please enter the amount you want to donate",
    			regex: "Please enter a valid amount"	
    		},
    		currency: "Please choose your currency.",
    		agreement: "Please read and accept the terms and condition"
    		
    	},
    	errorPlacement: function(error, element) {
    		if (element.attr("name") == "agreement") {
		       error.appendTo("#agrError");
		    } else {
		      error.insertAfter(element);
		    }
		}
    })
	
		
	$("form[name='frmdonate']").ajaxForm({
	    target:'#donatePreview',
	    dataType:'json',
	    beforeSubmit:function(){
	      $("button[type='submit']", $("form[name='frmdonate']")).attr('disabled','disabled').html('Submitting your donation please wait...');
	      $(".alert-donate").removeClass('alert-danger').addClass('hide').html('');
	    },
	    success: function(responseText, statusText, xhr, $form){
	        $("button[type='submit']", $("form[name='frmdonate']")).removeAttr('disabled').html('<span class="fa fa-gift"></span>&nbsp;Donate now');
	        window.location.href = xhr.responseJSON.approvalUrl;
            
	    },
		error: function(response){
			$("button[type='submit']", $("form[name='frmdonate']")).removeAttr('disabled').html('<span class="fa fa-gift"></span>&nbsp;Donate now');
        	var html   =  "<ul class='pd'>";
        	$.each(response.responseJSON.message,function(key, value){
        		html += "<li>"+key.toUpperCase()+": "+value+"</li>";
        	})
        	html    += "</ul>";

        	$(".alert-donate").addClass('alert-danger').removeClass('hide').html(html);
	    }
	});


    
	$("form[name='frmcompany']").validate({
        rules: {
           name: {
                required: true,
                regex: /^[a-zA-Z\s]+$/
            },
            email: {
                required: true,
                email: true,
                regex: /^[-a-z0-9_}{\'?]+(\.[-a-z0-9_}{\'?+]+)*@([a-z0-9_][-a-z0-9_]*(\.[-a-z0-9_]+)*\.(aero|arpa|biz|com|coop|edu|gov|info|int|mil|museum|name|net|org|pro|travel|mobi|[a-z][a-z])|([0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}))(:[0-9]{1,5})?$/i
            },
            description: {
                required: true,
                regex: /^[a-zA-Z().+_,;\s\d\n]{30,300}$/
            },
            address: {
                required: true
            },
            city: {
                required: true
            },
            postalcode: {
                required: true,
                regex: /^\d{4,5}$/
            },
            country:{
                required: true,
                regex: /^[a-zA-Z.,\s]+$/
            },
            industry: {
                required: true
            },
            contact_person: {
                required: true,
                regex: /^[a-zA-Z\s]+$/
            },
            contactno: {
                required: true,
                regex: /^([+]|\d)[-\d]{4,20}$/
            }
        },
        messages:{
            name: {
                required: "Please enter your company name",
                regex: "Please enter a valid company name"
            },
            email: {
                required: "Please enter your company email",
                email:"Please enter a valid email address",
                regex:"Please enter a valid email address"
            },
            description: {
                required: "Please enter you company description",
                regex: "Company description must contain atleast minimum of 30 and maximum of 300 characters"
            },
            address: {
                required: "Please enter your company address",
            },
            city: {
                required: "Please enter your city",
            },
            postalcode: {
                required: "Please enter your postal code",
                regex: "Please enter a valid postal code"
            },
            country :{
                required: "Please enter your country",
                regex: "Please enter a valid country"
            },
            industry: {
                required: "Please choose your industry"
            },
            contact_person: {
                required: "Please enter your contact person",
                regex: "Please enter a valid contact person"
            },
            contactno: {
                required: "Please enter your contact person number",
                regex: "Please enter a valid contact person number"
            }

        }
    })
    $("form[name='frmcompany']").ajaxForm({
        target:'#companyPreview',
        dataType:'json',
        beforeSubmit:function(){
          $("button[type='submit']", $("form[name='frmcompany']")).attr('disabled','disabled').html('Saving please wait...');
          $(".alert-company").removeClass('alert-danger').removeClass('alert-success').addClass('hide').html('');
        },
        success: function(responseText, statusText, xhr, $form){
            $("button[type='submit']", $("form[name='frmcompany']")).removeAttr('disabled').html('<span class="fa fa-save"></span>&nbsp;Save');
            var html   =  "<ul class='list-inline'>";
            $.each(xhr.responseJSON.message,function(key, value){
                html += "<li>"+key.toUpperCase()+": "+value+"</li>";
            })
            html    += "</ul>";

            $(".alert-company").addClass('alert-success').removeClass('hide').html(html);
            
        },
        error: function(response){
            $("button[type='submit']", $("form[name='frmcompany']")).removeAttr('disabled').html('<span class="fa fa-save"></span>&nbsp;Save');
            var html   =  "<ul class='list-inline'>";
            $.each(response.responseJSON.message,function(key, value){
                html += "<li>"+key.toUpperCase()+": "+value+"</li>";
            })
            html    += "</ul>";

            $(".alert-company").addClass('alert-danger').removeClass('hide').html(html);
        }
    })

});
function jAlert(params)
{
    var c_alert         = $(".c_alert");
    $(".modal-dialog", c_alert).addClass(params.class);
    $(".modal-title", c_alert).html(params.title);
    $(".modal-body", c_alert).html(params.msg);
   
    $(".modal-footer",c_alert).removeClass('hide');
    if(!params.footer)
    {
        $(".modal-footer",c_alert).addClass('hide');
    }
    c_alert.modal({backdrop: 'static', keyboard: false});

}

function passwordStrength()
{
    $("input[name='password']").unbind('keyup').keyup(function(){
        var _self             = $(this);
        var _parent           = _self.parent();
        var regex             = /^[!@#$%^&*(),._+]$/i;
        var passwordStrength  = 0;
        if(_self.val().length > 0)
        {
          for(var i=0; i<_self.val().length;i++)
          {
            if(regex.test(_self.val().substring(i,i + 1)))
            {
                passwordStrength++;
            }
          }
        }else
        {
           passwordStrength = 0;
        }

        regex = '';
        regex = new Array();
        regex.push("[A-Z]"); //Uppercase Alphabet.
        regex.push("[0-9]"); //Digit.
        //Validate for each Regular Expression.
        for (var i = 0; i < regex.length; i++) {
            if (new RegExp(regex[i]).test(_self.val())) {
                passwordStrength++;
            }
        }

        if(_self.val().length > 8 && passwordStrength > 2)
        {
           passwordStrength++;
        }

        var strength  = "";
        switch (true) {
            case (parseInt(passwordStrength) >= 0 && parseInt(passwordStrength) < 3):
              strength = "Weak";
              break;
            case (parseInt(passwordStrength) >= 3 && parseInt(passwordStrength) < 5):
              strength = "Good";
              break;
            case (parseInt(passwordStrength) >= 5 && parseInt(passwordStrength) < 7):
              strength = "Strong";
              break;
            case (parseInt(passwordStrength) >= 7):
              strength = "Very Strong";
              break;
        }
        if(_self.val().length>0)
        {
          if($(".validate-password", _parent).length)
          {
            $(".validate-password", _parent).removeAttr('class').attr('class','validate-password small bold').text(strength);
          }else
          {
            _self.after("<label class='validate-password pull-right small bold'>"+strength+"</label>");
          }
        }else{
          $(".validate-password", _parent).remove();
        }
        return true;
    });
}

function validateEmail(email) 
{
    var re = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i;
    return re.test(email);
}

function getFileUpload()
{
    var _parent        = $(".upload");
    var uploadName     = $("input[type='file']", _parent).val();
    $("label", _parent).text(uploadName);
    
}



