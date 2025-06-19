$(document).ready(function() {

    

    /***************************************/
    /* Datepicker */
    /***************************************/
    // Start date
    function dateFormat(date) {
        $(date).datepicker({
            dateFormat: "mm/dd/yy",
            prevText: '<i class="fa fa-caret-left"></i>',
            nextText: '<i class="fa fa-caret-right"></i>',
        });
    }

    // Destroy date
    function destroyDate(date) {
        $(date).datepicker("destroy");
    }

    // Initialize date range
    dateFormat("#date_from");
    /***************************************/
    /* end datepicker */
    /***************************************/

    // Validation
    $("#j-pro").justFormsPro({
        rules: {
            name: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            phone: {
                required: true
            },
            adults: {
                required: true,
                integer: true,
                minvalue: 0
            },
            children: {
                required: true,
                integer: true,
                minvalue: 0
            },
            date_from: {
                required: true
            },
            date_to: {
                required: true
            },
            message: {
                required: true
            }
        },
        messages: {
            name: {
                required: "Add your name"
            },
            email: {
                required: "Add your email",
                email: "Incorrect email format"
            },
            phone: {
                required: "Add your phone"
            },
            adults: {
                required: "Field is required",
                integer: "Only integer allowed",
                minvalue: "Value not less than 0"
            },
            children: {
                required: "Field is required",
                integer: "Only integer allowed",
                minvalue: "Value not less than 0"
            },
            date_from: {
                required: "Select check-in date"
            },
            date_to: {
                required: "Select check-out date"
            },
            message: {
                required: "Enter your message"
            }
        },
        afterSubmitHandler: function() {
            // Destroy date range
            destroyDate("#date_from");
            destroyDate("#date_to");


            return true;
        }
    });
});