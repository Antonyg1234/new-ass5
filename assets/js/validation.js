
$(document).ready(function(){
    $('#myForm').validate({
        rules:{
            category:{
                required:true,
                lettersonly:true
            }
        }

    });

   // $.validator.addMethod("accept", function(value, element) {
  //      return this.optional(element) || /^[a-zA-Z ]*$/.test(value);
   // }, "Letters only please");

    $('#myForm_product').validate({
        rules: {

            product: {
                required: true,
                lettersonly: true
            },

            price: {
                required: true,
                number: true
            },
            uploadedimage: {
                required: true,
                extension: "jpg,png",

            },
            category_select: {
                required: true
            }
        },
            messages: {
                uploadedimage: {
                    required: "You must insert an image",
                    extension: "Only .jpg and .png images allowed"
                },
                category_select: {
                    required: "Please select an option"

                }
            }

    });

   /* jQuery.validator.addMethod('selectcheck', function (value) {
        return (value != '0');
    }, "year required");*/

    $('#myForm_productedit').validate({
        rules: {

            product: {
                required: true,
                lettersonly: true
            },

            price: {
                required: true,
                number: true
            },
            uploadFile: {
                required: true,
                extension: "jpg,png",
                filesize: 10

            },
            category_select: {
                required: true
            }
        },

            messages: {
                uploadFile: {
                    required: "You must insert an image",
                    extension: "Only .jpg and .png images allowed"

                },
                category_select: {
                    required: "Please select an option"

                }
            }


    });

});



//accept: "/^[a-zA-Z ]*$/"

function deleteFunction(id) {
    if(confirm("Confirm delete")) document.location = 'http://localhost/assignment_4/category_delete.php?id='+id;
}

function deleteProductFunction(id) {
    if(confirm("Confirm delete")) document.location = 'http://localhost/assignment_4/product_delete.php?id='+id;
}
