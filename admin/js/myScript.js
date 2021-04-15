
/*
*
* variables
*
* */

// global vars
var navLinks = $('.nav-item');
var contactLink = $('#contact');
var categoryLink = $('#cat');
var productLink = $('#product');
var usersLink = $('#user');
var orderLink = $('#order');

// index/category vars
var recBtn = $('#add-cat');
var recForm = $('.form');
var table = $('.table-responsive');
var bfor = $('.bfor');
var after = $('.after');
var catInput = $('#category');
var save = $('#save');
var editSave = $('#editSave');
var msg = $('#msg');


/*
*
* functions
*
* */

//a function to get current page
//returns true if supplied url matches current url
function urls(page) {

    var url = window.location.pathname;
    var srch = new RegExp(page, 'g');
    var curUrl = url.match(srch);

    return curUrl == page;
}


//adds styling to the active page
function activePage(page) {

    page.find('a').css({"color": "#007BFF", "border-right": "3px solid #007BFF"});

}

//a function to toggle b/w table n form
function table_tog(){
    table.toggle(function () {
        bfor.toggle();
        after.toggle();
    });
    recForm.toggle();
}

//check for empty inputs
function emptyInputs(input) {
    if (Array.isArray(input)){
        for(var i = 0; i < input.length; i++){
            if(input[i].val().length < 1){
                return true;
            }
        }
    } else {
        if(input.val().length < 1){
            return true;
        }
    }
}


//checks when animate.css animation ends
function animationEnd() {

    document.getElementById('category').addEventListener('animationend', function(){
        catInput.removeClass('animate__shakeX');
    });

}

//displays err/success msg
function displayError(report, colour){
    msg.slideDown();
    msg.addClass("alert-" + colour);
    msg.html(report);
    setTimeout(function(){
        msg.slideUp();
        msg.removeClass("alert-" + colour);
    }, 4000)
}

//function to get our tables
function getTable(table) {

    $.post('assets/serverside/ajax-handler.php', { table: table }, function (data) {

        $("#table").html(data);

    });

}

//status activating/deactivating function
function status(statTable, statBtn) {

    $(document).on('click', statBtn, function (e) {

        e.preventDefault();
        var status = $(this).attr('status');
        var id = $(this).attr('statId');

        $.ajax({
            url: 'assets/serverside/ajax-handler.php',
            method: 'POST',
            data: {statId: id, status: status, statusTable: statTable},
            success: function (data) {
                if (data == 'ok'){
                    getTable(statTable);
                } else{
                    displayError(data, 'warning');
                }
            },
            error: function (resp) {
                console.log('something went wrong');
                alert("Sorry, an error occurred: "+resp.status + " " + resp.statusText);
            }
        })

    });


}



//a function to delete from tables
function del(delTable, delBtn) {

    $(document).on('click', delBtn, function (e) {

        e.preventDefault();
        var id = $(this).attr('delId');
        var name = $(this).attr('delName');
        var table = delTable;

        bootbox.confirm("Are you sure you want to delete: " + name.toUpperCase(), function (response) {

            if(response){

                $.ajax({
                    url: 'assets/serverside/ajax-handler.php',
                    method: 'POST',
                    data: { delId: id, delTable: table },
                    success: function (data) {
                        if (data == 'ok'){
                            displayError("Successfully deleted", 'info');
                            getTable(delTable);
                        } else{
                            displayError(data, 'warning');
                        }
                    },
                    error: function (resp) {
                        console.log('something went wrong');
                        alert("Sorry, an error occurred: "+resp.status+" "+resp.statusText);
                    }
                });

            }

        })
    });


}

//ajax form handler(login/register)
function myAjax_auth(element, sentform, msg, page) {
    $(element).click(function (e) {

        e.preventDefault();

        var frm = $(sentform);
        $.ajax({
            url:'assets/serverside/ajax-handler.php',
            method: 'POST',
            data: frm.serialize(),
            success: function(data) {

                if (data == 'ok'){
                    displayError(msg, 'success');
                    setTimeout(function (){
                        location.assign(page);
                }, 2000);
                }else{
                    displayError(data, 'danger');
                }

            },
            error: function (resp) {
                console.log('something went wrong');
                alert("Sorry, an error occurred: "+resp.status+" "+resp.statusText);
            }

        })
    })
}


//ajax form handler(save)
function myAjax_save(element, sentform, msg) {
    $(element).click(function (e) {

        e.preventDefault();

        var frm = $(sentform);
        $.ajax({
            url:'assets/serverside/ajax-handler.php',
            method: 'POST',
            data: frm.serialize(),
            success: function(data) {

                if (data == 'ok'){
                    displayError(msg, 'success');
                    setTimeout(() => {
                        window.top.location = window.top.location;
                }, 2000);
                }else{
                    displayError(data, 'danger');
                }

            },
            error: function (resp) {
                console.log('something went wrong');
                alert("Sorry, an error occurred: "+resp.status+" "+resp.statusText);
            }

        })
    })
}


//ajax form handler(edit)
function myAjax_edit(editBtn, addr) {

    $(document).on('click', editBtn, function (e) {

        e.preventDefault();

        var id = $(this).attr('editId');

        $.get(addr+'?editId='+id, function (data, status) {

            if (status == 'success'){

                $('.card').html(data);

            } else {
                alert(status);
            }

        });


    });

}



/*
*
* doc dot ready
* this is d document dot ready function
* all codes except function and variable declaration goes here
*
* */
$(document).ready(function () {

    /*
    *
    * Global codes
    *
    * */

    //adds animation to nav link icons
    navLinks.hover(function () {

        $(this).find('.hover-anime').addClass('animate__jello');

    }, function () {

        $(this).find('.hover-anime').removeClass('animate__jello');

    });


    //tooltip
    $('[data-toggle="tooltip"]').tooltip();

    //to get our current page
    if (urls('index')){

        //to get our categories table
        getTable('categories');
        //to add active class to current link
        activePage(categoryLink);

    } else if(urls('contact')) {


        //to get our contact table
        getTable('contact_us');
        //to add active class to current link
        activePage(contactLink);

    } else if(urls('product')) {


        //to get our product table
        getTable('product');
        //to add active class to current link
        activePage(productLink);

    } else if(urls('users')) {


        //to get our user table
        getTable('users');
        //to add active class to current link
        activePage(usersLink);

    } else if(urls('order')) {


        //to get our order table
        // getTable('users');
        //to add active class to current link
        activePage(orderLink);

    } else {

        // get our categories table if nothing else checks out
        getTable('categories');
        //to add active class to current link
        activePage(categoryLink);

    }

    //this button toggles btw table and category form
    recBtn.click(function () {
        table_tog();
        catInput.val('');
        save.show();
        $('#editSave').hide();
    });


    /*
    *
    * index/category codes
    *
    * */



    //Activating and deactivating a category
    status('categories', '#catStat');

    //Deleting a category
    del('categories', '#catDel');



    //Editing a category
    myAjax_edit('#catEdit', 'edit_category.php');



    //Adding or inserting new category
    myAjax_save('#catSave', '#frmCategory', 'New category added');




    /*
    *
    * contact_us codes
    *
    * */

    //Delete a contact
    del('contact_us', '#contDel');



    /*
    *
    * product codes
    *
    * */

    //Delete a product
    del('product', '#productDel');

    //Activating and deactivating a product
    status('product', '#prodStat');

    //Add products
    myAjax_save('#prodSave', '#frmProduct', 'New product added');

    //edit product
    myAjax_edit('#productEdit', 'edit_product.php');

    //change product image
    myAjax_edit('#imgBtn', 'change_image.php');



    /*
    *
    * users codes
    *
    * */

    //Delete a user
    del('users', '#usDel');

});

/*
*
*  i'mma be honest with u, dis whole thing wasn't easy altho we've still got some small gaps to fill
*  but for now we're done with the admin page
*
* */

/*
*
*talk abt filling gaps we're back
*
* */

    //register admin user
    myAjax_auth('#btnRegister', '#frmRegister', 'New user created', 'login.php');

    //login user
    myAjax_auth('#btnLogin', '#frmLogin', 'Login successful', 'index.php');