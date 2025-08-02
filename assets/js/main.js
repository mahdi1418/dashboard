$(document).ready(function () {
    $('#register').submit(function (e) {
        e.preventDefault();
        $name = $('#name').val();
        $name2 = $('#name2').val();
        $pass = $('#pass').val();
        $email = $('#email').val();
        $pass2 = $('#pass2').val();
        $('#register button[type=submit]').text('Please wait').removeClass('btn-primary').addClass('btn-warning');
        $('#button').prop('disabled', true);
        $.ajax({
            url: 'handle.php',
            type: 'POST',
            dataType: "json",
            data: {
                name: $name,
                name2: $name2,
                email: $email,
                pass: $pass,
                pass2: $pass2,
                type: 'register'
            },
            success: function (response) {
                $('#result').html(response);
                setTimeout(function () {
                    window.location.href = 'panel.php';
                }, 3000);
            },
            error: function () {
            }
        });
    });
    $('#login').submit(function (e) {
        e.preventDefault();
        $email = $('#email').val();
        $password = $('#pass').val();
        $('#login button[type=submit]').text('Please wait').removeClass('btn-primary').addClass('btn-warning');
        $('#button').prop('disabled', true);
        $.ajax({
            url: 'handle.php',
            type: 'POST',
            dataType: "json",
            data: {
                email: $email,
                password: $password,
                type: 'login'
            },
            success: function (response) {
                $('#result').html(response);
                setTimeout(function () {
                    window.location.href = 'panel.php';
                }, 3000);
            },
            error: function () {
            }
        });
    });

    $('#add_product').submit(function (e) {
        e.preventDefault();
        $title = $('#add_title_product').val();
        $desc = $('#add_desc_product').val();
        $price = $('#add_price_product').val();
        $category = $('#category').val();
        $.ajax({
            url: 'handle.php',
            type: 'POST',
            dataType: "json",
            data: {
                add_title_product: $title,
                add_desc_product: $desc,
                add_price_product: $price,
                category: $category,
                type: 'add_pro'
            },
            success: function (response) {
                $('#result').html(response);
                setTimeout(function () {
                    window.location.href = 'all-product.php';
                }, 1000);
            },
            error: function () {
            }
        });
    });
    $('.fa-ellipsis-v').click(function () {
        $(this).siblings('div').fadeToggle(300);
    });
    $('#pro_serach').keyup(function (e) {
        $word = $(this).val();

        if ($word.length > 1) {
            $.ajax({
                url: 'handle.php',
                type: 'POST',
                data: {
                    word: $word,
                    type: 'pro_search'
                },
                success: function (response) {
                    $('#res_search').html(response)
                },
                error: function () {
                }
            });
        } else {
            $('#res_search').html('');
        }
    });

    const swiper = new Swiper('.swiper', {
        slidesPerView: 1.3,
        spaceBetween: 0,
        loop: true,
        centeredSlides: true,
        autoplay: {
            delay: 250,
            disableOnInteraction: false,
        },
    });

    $('#add_user').submit(function (e) {
        e.preventDefault();
        $name = $('#newuserName').val();
        $name2 = $('#newuserlName').val();
        $email = $('#newuserEmail').val();
        $pass = $('#newuserPass').val();
        $pass2 = $('#newuserPass2').val();
        $('#add_user button[type=submit]').text('Please wait').removeClass('btn-primary').addClass('btn-warning');
        $('#button').prop('disabled', true);
        $.ajax({
            url: 'handle.php',
            type: 'POST',
            dataType: "json",
            data: {
                name: $name,
                name2: $name2,
                email: $email,
                pass: $pass,
                pass2: $pass2,
                type: 'new_user'
            },
            success: function (response) {
                $('#result').html(response);
                setTimeout(function () {
                    window.location.href = 'all-users.php';
                }, 3000);
            },
            error: function () {
            }
        });
    });
    $('#categoreis').submit(function (e) {
        e.preventDefault();
        $categoryName = $('#categoryName').val();
        $.ajax({
            url: 'handle.php',
            type: 'POST',
            dataType: "json",
            data: {
                categoryName: $categoryName,
                type: 'category'
            },
            success: function (response) {
                $('#result').html(response);

                $('#categoreis')[0].reset();
                $('#categoreis #categoryName').val('');
                var newProductHTML = `
                     <div class="category-card">${response.category}</div>
                `;
                $('#category_list').append(newProductHTML);
            },
            error: function () {
            }
        });
    });
    $('[id^="order"]').click(function () {
        let clickedId = $(this).attr('id').toLowerCase();
        $.ajax({
            url: 'handle.php',
            type: 'POST',
            dataType: 'json',
            data: { type: 'order' },
            success: function (response) {
                $('#result').html(response.status);
                $('form[class^="order"]').hide();
                $('.' + clickedId).css('display', 'flex');
                $('[id^="order"]').val(response.order_id);
            },
            error: function () { }
        });
    });
});
