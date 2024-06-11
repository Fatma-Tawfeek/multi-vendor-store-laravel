$(function ($) {
    $(".item-quantity").on("change", function () {
        let quantity = $(this).val();
        $.ajax({
            url: "/cart/" + $(this).data("id"),
            type: "put",
            data: {
                _token: csrf_token,
                quantity: quantity,
            },
        });
    });

    $(".remove-item").on("click", function () {
        let id = $(this).data("id");
        $.ajax({
            url: "/cart/" + id,
            type: "delete",
            data: {
                _token: csrf_token,
            },
            success: (response) => {
                $(`#${id}`).remove();
            },
        });
    });
})(jQuery);
