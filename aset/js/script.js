$(function () {
    let navMain = $('.navbar-collapse')
    navMain.on('click', '.nav-item:not([data-toggle])', null, function () {
        navMain.collapse('hide')
    })
})

$(document).ready(function () {
    $('.navbar-toggler').on('click', function () {
        $('.navbar-toggler').toggleClass('open')
    })

    $('.nav-item').on('click', function () {
        $('.navbar-toggler').toggleClass('open')
    })

    $(document).ready(function () {
        $('.navbar-toggler').click(function () {
            $('.sidebar').toggleClass('sidebar-open')
        })
    })
})