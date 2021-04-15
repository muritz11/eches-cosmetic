
var msg = $('#msg');

//ajax form handler(login/register)
function myAjax_auth(element, sentform, msg, page) {
    $(element).click(function (e) {

        e.preventDefault();

        var frm = $(sentform);
        $.ajax({
            url:'admin/assets/serverside/ajax-handler.php',
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


//create, ~update~, del cart items
//updating was moved down
function crud_cart(type, id, msg) {

    //removed this qty: index from data
    $.ajax({
        url:'resources/php/manage_cart.php',
        method: 'POST',
        data: { pid: id, type: type },
        success: function(data) {

            if (data == 'ok'){
                displayError(msg, 'info');
                setTimeout(function () {
                    location.reload(true);
                }, 3000);
            }else{
                displayError(data, 'danger');
            }

        },
        error: function (resp) {
            console.log('something went wrong');
            alert("Sorry, an error occurred: "+resp.status+" "+resp.statusText);
        }

    })

}


//displays err/success msg
function displayError(report, colour){
    msg.slideDown();
    msg.addClass("alert-" + colour);
    msg.html(report);
    setTimeout(function(){
        msg.slideUp();
        msg.removeClass("alert-" + colour);
    }, 444000)
}

var page = {

    principio: 0,
    final: 4,
    list: $('.shop-item'),
    sliced_list: $('.shop-item').slice(0, 4),
    mutable_totalPage: Math.ceil($('.shop-item').length / $('.shop-item').slice(0, 4).length),


    run: function () {
        this.list.addClass('d-none');
        this.sliced_list.removeClass('d-none');
    },

    current: function () {
        this.page_numbering();
        this.run();
        // console.log(this.totalPage());
    },

    nextPg: function () {

        if (this.mutable_totalPage !== 1){

            this.principio += 4;
            this.final += 4;

            this.sliced_list = this.list.slice(this.principio, this.final);
            this.mutable_totalPage -= 1;
            this.run();
            console.log(this.mutable_totalPage);
            // console.log(this.sliced_list.length);
        }


    },

    prevPg: function () {



        if (this.mutable_totalPage < this.totalPage()){

            this.principio -= 4;
            this.final -= 4;

            this.sliced_list = this.list.slice(this.principio, this.final);
            this.mutable_totalPage += 1;
            this.run();
            console.log(this.mutable_totalPage);

        }
    },

    pageNumber: function (x, y) {

        this.list.slice(x, y);

    },

    totalPage: function () {

        return total = Math.ceil(this.list.length / this.sliced_list.length);

    },

    page_numbering: function () {

        for (x = 1; x <= this.totalPage(); x++){

            var page_number = $('<button class="btn rounded" onclick="page.pageNumber(0, 4)"></button>').text(x);
            $('.page-number').append(page_number);

        }

    }

};


var search = {

    srch_icon: $('#srch_icon'),
    srch_modal: $('.search-modal'),
    srch_box: $('#search'),

    open_search: function () {

        this.srch_modal.show();
        this.srch_modal.addClass('animate__animated animate__slideInUp');

    },

    close_search: function () {

        this.srch_modal.hide();

    },

    fetch: function (txt) {

        $.ajax({
            url:'resources/php/fetch.php',
            method: 'POST',
            data: { query: txt },
            success: function(data) {

                $('#result').html(data);

            },
            error: function (resp) {
                console.log('something went wrong');
                alert("Sorry, an error occurred: "+resp.status+" "+resp.statusText);
            }

        })

    }

};

$(document).ready(function () {


    /* ******log out alert**** */
    $('#logout').click(function (e) {
        if (!confirm("Are you sure you want to log out")) {
            e.preventDefault();
        }
    });


    /*    ********search....********       */

    //open search
    $('#srch_icon').click(function () {

        search.open_search();

    });

    //close search
    $('.closebtn').click(function () {

        search.close_search();

    });

    //search and get result
    $('#search').keyup(function () {

        var input = $('#search').val();

        if (input != ''){

            search.fetch(input);

        } else {
            $('#result').html('');
        }

    });



    /*   *****on load of product page display only 4 products***  */
    page.current();


    $('#next').click(function () {

        page.nextPg();

    });

    $('#prev').click(function () {

        page.prevPg();

    });

    /* *******adding a tool tip to nav slc icons*****    */
    $('[data-toggle="tooltip"]').tooltip();

    //on load (check out) click the first accordion
    // $('.panel')[0].show();


    /* *******some xtra hover anime for product card*****    */
    $('.card').mouseenter(function () {

        $(this).find('.card-body').addClass('px-4');

    });

    $('.card').mouseleave(function () {

        $(this).find('.card-body').removeClass('px-4');

    });


    //animation for nav icons
    $('.nav-slc').hover(function () {

        $(this).addClass('animate__swing');

    }, function () {

        $(this).removeClass('animate__swing');

    });



    //animation for social icons
    $('.foot-icon').hover(function () {

        $(this).addClass('animate__jello');

    }, function () {

        $(this).removeClass('animate__jello');

    });
    
    // ACCORDION
    $('.accordion').click(function () {

        $(this).toggleClass('active');

        $(this).next().slideToggle();

    });


    //register new user
    myAjax_auth('#btnRegister', '#userRegister', 'Form submitted', 'login.php');

    //login user
    myAjax_auth('#btnLogin', '#userLogin', 'Login successful', 'index.php');

    //all of above except this is for checkout
    myAjax_auth('#btnRegister_checkout', '#userRegister', 'Form submitted, please login', 'checkout.php');

    myAjax_auth('#btnLogin_checkout', '#userLogin', 'Login successful', 'checkout.php');



    //shit was misbehaving so i brought it down here
    //instead of using crud_cart()
    $('.upd').click(function (e) {


        e.preventDefault();
        // var index = $('#upd').attr('indexQty');
        var quant = $(this).prev().val();
        var id = $(this).attr('pid');
        console.log(quant);

        $.ajax({
            url:'resources/php/manage_cart.php',
            method: 'POST',
            data: { pid: id, type: 'update', qty: quant },
            success: function(data) {

                if (data == 'ok'){
                    displayError('Item updated', 'info');
                    setTimeout(function () {
                        location.reload(true);
                    }, 3000);
                }else{
                    displayError(data, 'danger');
                }

            },
            error: function (resp) {
                console.log('something went wrong');
                alert("Sorry, an error occurred: "+resp.status+" "+resp.statusText);
            }

        })

    });



});