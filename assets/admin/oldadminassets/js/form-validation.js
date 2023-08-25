var FormValidation = function() {
    var site_url = "/ACTM/index.php/";
       
    $("#edit_customer").validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-inline', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
        rules: {
            name: {
                required: true
            },
            phone:{
                required:true,
		number: true,
            },
            email:{
                required:true,
		email: true,
            },
            address:{
                required:true,
            },
            
            
        },
        messages: {
            name: {
                required: "Username is required!",
            },
            phone:{
                required:"Phone Number is required!",
		number: "Not a Valid Number!"
        },
            email:{
                required:"Email ID is required!",
		email: "Please Enter A Valid Email ID"
        },
            address:{
                required:"Address is required!",
        },
    }

    });

    $("#add_customer").validate({
        errorElement: 'span', //default input error message container
        errorClass: 'help-inline', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
        rules: {
            name: {
                required: true
            },
            phone:{
                required:true,
		number: true,
            },
            email:{
                required:true,
		email: true,
            },
            address:{
                required:true,
            },
            
            
        },
        messages: {
            name: {
                required: "Username is required!",
            },
            phone:{
                required:"Phone Number is required!",
		number: "Not a Valid Number!"
        },
            email:{
                required:"Email ID is required!",
		email: "Please Enter A Valid Email ID"
        },
            address:{
                required:"Address is required!",
        },
    }

    });

    $("#edit_stock_details").validate({
        
        errorElement: 'span', //default input error message container
        errorClass: 'help-inline', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
          rules: {
                item_id: {
                    required: true
                },
                party_id: {
                    required: true
                },
                qut: {
                    required: true,
                    
                },
                ch_no: {
                    required: true,
                    
                },
                date: {
                    required: true,
                   
                },
               
                type: {
                    required: true

                }

            },
            messages: {
                item_id: {
                    required: 'Please Select an Item.'
                },
                party_id: {
                    required: 'Please Select a Party.'
                },
                qut: {
                    required: 'Please enter Quantity.'
                },
                ch_no: {
                    required: 'Please enter Challan No.'
                },
                date: {
                    required: 'Please enter date',
                    
                },
                
                type: {
                    required: 'Please enter Type .'
                }
            }

    });


       $("#production_details").validate({
        
        errorElement: 'span', //default input error message container
        errorClass: 'help-inline', // default input error message class
        focusInvalid: false, // do not focus the last invalid input
        ignore: "",
          rules: {
                item_id: {
                    required: true
                },
                machine_id: {
                    required: true
                },
                qty: {
                    required: true,
                    
                },
                date: {
                    required: true,
                    
                },
                
                type: {
                    required: true,
                    
                },
            },
            messages: {
                item_id: {
                    required: 'Please Select an Item.'
                },
                machine_id: {
                    required: 'Please Select a Machine.'
                },
                qty: {
                    required: 'Please enter Quantity.'
                },
                
                date: {
                    required: 'Please enter date',
                    
                },
                
               type: {
                    required: 'Please Select Type',
                    
                },
            }

    });

}();