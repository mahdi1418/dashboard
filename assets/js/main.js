$(document).ready(function () {
    $('#register').submit(function (e) {
        e.preventDefault();
        $name = $('#name').val();
        $name2 = $('#name2').val();
        $pass = $('#pass').val();
        $email = $('#email').val();
        $pass2 = $('#pass2').val();
        $.ajax({
            url: 'handle.php',
            type: 'POST',
            dataType: "json",
            data: {
                name: $name,
                name2: $name2,
                email: $email,
                pass: $pass,
                pass2: $pass2
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
        $.ajax({
            url: 'handle.php',
            type: 'POST',
            dataType: "json",
            data: {
                email: $email,
                password: $password
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
        $.ajax({
            url: 'handle.php',
            type: 'POST',
            dataType: "json",
            data: {
                add_title_product: $title,
                add_desc_product: $desc,
                add_price_product: $price
            },
            success: function (response) {
                $('#result').html(response);
                $('#proModal').hide();
                $('#add_product')[0].reset();
                var newProductHTML = `
                    <div class="repo-item col-md-12 d-flex justify-content-between">
                         <div>
                             <a href="#" class="repo-title">${response.title}</a><br>
                             <span class="dot dot-php"></span>${response.desc}
                         </div>
                         <div>
                             <h5 class="m-0 mb-1 text-danger">${response.price} $</h5>
                             <h6 class="m-0"></h6>
                         </div>
                     </div>
                `;
                $('#productList').append(newProductHTML);

            },
            error: function () {
            }
        });
    });
    $('.fa-ellipsis-v').click(function () {
        $(this).siblings('div').fadeToggle(300);
    });
    $('#delete').click(function () {
        if (confirm('Are you sure you want to delete this product?')) {
            console.log('محصول حذف شد');
        } else {
            console.log('عملیات حذف لغو شد');
        }
    });
    $('#pro_serach').keyup(function (e) {
        $word = $(this).val();

        if ($word.length > 1) {
            $.ajax({
                url: 'handle.php',
                type: 'POST',
                data: {
                    word: $word,
                    type: 'pro'
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
});
