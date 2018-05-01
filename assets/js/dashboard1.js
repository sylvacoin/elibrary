$(document).ready(function () {
    "use strict";


    

    $(document).on('submit', '#share', function () {
        $.ajax({
            url: baseurl + 'documents/share',
            data: $('#share').serialize(),
            type: 'post',
            success: function (d)
            {

                var data = JSON.parse(d);
                if (data.status == 'true')
                {
                    $.toast({
                        heading: 'Share successful',
                        text: 'Document was shared successfully',
                        position: 'top-right',
                        loaderBg: '#fff',
                        icon: 'success',
                        hideAfter: 3500,
                        stack: 6
                    });

                } else {
                    $.toast({
                        heading: 'Share not successful',
                        text: 'This document was already shared with these selected contacts',
                        position: 'top-right',
                        loaderBg: '#fff',
                        icon: 'error',
                        hideAfter: 3500,
                        stack: 6
                    });

                }

                $('#modal_ajax').modal('hide');
            }

        })
        return false;

    });

    //delete favorites
    $(document).on('click', '#fav button.remove, #removeFromFav', function () {
        var $button = $(this);
        $.ajax({
            url: baseurl + 'documents/ajax_fav_books/true',
            data: {'doc': $button.data('id')},
            type: 'POST',
            cache: false,
            success: function (d)
            {
                var result = JSON.parse(d);
                if (result.status == 'success')
                {
                    $.toast({
                        heading: 'Success',
                        text: result.msg,
                        position: 'top-right',
                        loaderBg: '#fff',
                        icon: 'success',
                        hideAfter: 3500,
                        stack: 6
                    });
                    $button.removeAttr('id');
                    $button.attr('id', 'addToFav');
                    $button.removeClass('btn-danger').addClass('btn-primary');
                } else {
                    $.toast({
                        heading: 'Error',
                        text: result.msg,
                        position: 'top-right',
                        loaderBg: '#fff',
                        icon: 'error',
                        hideAfter: 3500,
                        stack: 6
                    });

                }
            }
        });

        return false;
    });

    //add favorites
    $(document).on('click', '#addToFav', function () {
        var $button = $('#addToFav');
        $.ajax({
            url: baseurl + 'documents/ajax_fav_books',
            data: {'doc': $button.data('id')},
            type: 'POST',
            cache: false,
            success: function (d)
            {
                var result = JSON.parse(d);
                if (result.status == 'success')
                {
                    $.toast({
                        heading: 'Success Book Added',
                        text: result.msg,
                        position: 'top-right',
                        loaderBg: '#fff',
                        icon: 'success',
                        hideAfter: 3500,
                        stack: 6
                    });
                    $button.removeAttr('id');
                    $button.attr('id', 'removeFromFav');
                    $button.removeClass('btn-primary').addClass('btn-danger');
                } else {
                    $.toast({
                        heading: 'Error Book not added',
                        text: result.msg,
                        position: 'top-right',
                        loaderBg: '#fff',
                        icon: 'error',
                        hideAfter: 3500,
                        stack: 6
                    });

                }
            }
        });

        return false;
    });

    // counter
    $(".counter").counterUp({
        delay: 100,
        time: 1200
    });

    var sparklineLogin = function () {
        $('#sparklinedash').sparkline([0, 5, 6, 10, 9, 12, 4, 9], {
            type: 'bar',
            height: '30',
            barWidth: '4',
            resize: true,
            barSpacing: '5',
            barColor: '#7ace4c'
        });
        $('#sparklinedash2').sparkline([0, 5, 6, 10, 9, 12, 4, 9], {
            type: 'bar',
            height: '30',
            barWidth: '4',
            resize: true,
            barSpacing: '5',
            barColor: '#7460ee'
        });
        $('#sparklinedash3').sparkline([0, 5, 6, 10, 9, 12, 4, 9], {
            type: 'bar',
            height: '30',
            barWidth: '4',
            resize: true,
            barSpacing: '5',
            barColor: '#11a0f8'
        });
        $('#sparklinedash4').sparkline([0, 5, 6, 10, 9, 12, 4, 9], {
            type: 'bar',
            height: '30',
            barWidth: '4',
            resize: true,
            barSpacing: '5',
            barColor: '#f33155'
        });
    }
    var sparkResize;
    $(window).on("resize", function (e) {
        clearTimeout(sparkResize);
        sparkResize = setTimeout(sparklineLogin, 500);
    });
    sparklineLogin();
});
