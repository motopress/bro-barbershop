(function ($) {

    'use strict';

    $('.mpa-cart').on('click', '.item-toggle', function (e) {
        $(this).closest('.mpa-cart-item').toggleClass('opened');
    });

    let mainSidebar = $('#main-sidebar');
    let mainSidebarOpen = $('.main-sidebar-toggle-button, .main-sidebar-toggle');

    mainSidebarOpen.on('click', function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        mainSidebar.toggleClass('opened');
        $('body').toggleClass('sidebar-opened');
    })

    $(document).on('click', '#main-sidebar .close-sidebar', function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        $('#main-sidebar').toggleClass('opened');
        $('body').toggleClass('sidebar-opened');
    });

    let menuToggle = $('#menuToggle');
    let menuHolder = $('#masthead .main-navigation-container');
    let siteHeader = $('#masthead');

    menuToggle.on('click', function (e) {
        e.preventDefault();
        menuToggle.toggleClass('active');
        menuHolder.toggleClass('opened');
        siteHeader.toggleClass('dropdown-opened');
    });

    $(document).on('click', function (event) {
        if (!$('body').hasClass('sidebar-opened')) {
            return;
        }

        const sidebar = $('#main-sidebar');

        if ($(event.target).is(sidebar) || sidebar.has(event.target).length > 0) {
            return;
        }

        sidebar.removeClass('opened');
        $('body').removeClass('sidebar-opened');
    });

    let menu = $('.widget_nav_menu, .widget_pages, #site-navigation .menu'),
        menuLinksWithChildren = menu.find('.menu-item-has-children > a, .page_item_has_children > a'),
        toggleButton = $('<button/>', {
            'aria-pressed': 'false',
            'class': 'submenu-toggle',
            'html': '<svg width="8" height="6" viewBox="0 0 8 6" xmlns="http://www.w3.org/2000/svg">\n\n' +
                '<path id="Polygon 4" d="M4 6L0.535899 -3.01142e-07L7.4641 -9.06825e-07L4 6Z"/>\n' +
                '</svg>'
        });

    menuLinksWithChildren.after(toggleButton);

    menu.on('click', '.submenu-toggle', function (e) {
        e.preventDefault();
        e.stopImmediatePropagation();
        $(this).next('.sub-menu, .children').toggleClass('opened');
        $(this).toggleClass('toggled');
    });

    function setupSubMenuPosition() {
        const submenus = $('.main-navigation').find('.sub-menu');

        submenus.each(function (index, submenu) {
            submenu.classList.remove('toleft');
            var parent = submenu.parentNode,
                parentCoords = parent.getBoundingClientRect();

            if ((parentCoords.left + parent.offsetWidth + 280 - window.innerWidth) > 0) {
                submenu.classList.add('toleft');
            }
        });
    }

    setupSubMenuPosition();

    $(window).on('resize', function () {
        setupSubMenuPosition();
    });

    let creativeButtons = $('.is-style-creative > .wp-block-button__link');

    creativeButtons.each(function (index, button) {
        let bgColor = $(button).css('background-color');

        $(button).css('background-image', `linear-gradient( ${bgColor}, ${bgColor} )`);
        $(button).css('background-color', 'transparent');
    })
})(jQuery);
