(function () {

    'use strict';

    /**
     * Debounce.
     *
     * @param {Function} func
     * @param {number} wait
     * @param {boolean} immediate
     */
    function debounce(func, wait, immediate) {

        var timeout;
        wait = (typeof wait !== 'undefined') ? wait : 20;
        immediate = (typeof immediate !== 'undefined') ? immediate : true;

        return function () {

            var context = this, args = arguments;
            var later = function () {
                timeout = null;

                if (!immediate) {
                    func.apply(context, args);
                }
            };

            var callNow = immediate && !timeout;

            clearTimeout(timeout);
            timeout = setTimeout(later, wait);

            if (callNow) {
                func.apply(context, args);
            }
        };
    }

    /**
     * Prepends an element to a container.
     *
     * @param {Element} container
     * @param {Element} element
     */
    function prependElement(container, element) {

        if (container.firstChild) {
            return container.insertBefore(element, container.firstChild);
        } else {
            return container.appendChild(element);
        }
    }

    /**
     * Shows an element by adding a hidden className.
     *
     * @param {Element} element
     */
    function showButton(element) {
        // classList.remove is not supported in IE11.
        element.className = element.className.replace('is-empty', '');
    }

    /**
     * Hides an element by removing the hidden className.
     *
     * @param {Element} element
     */
    function hideButton(element) {
        // classList.add is not supported in IE11.
        if (!element.classList.contains('is-empty')) {
            element.className += ' is-empty';
        }
    }

    /**
     * Returns the currently available space in the menu container.
     *
     * @returns {number} Available space
     */
    function getAvailableSpace(button, container) {
        return container.offsetWidth - button.offsetWidth - 40;
    }

    /**
     * Returns whether the current menu is overflowing or not.
     *
     * @returns {boolean} Is overflowing
     */
    function isOverflowingNavivation(list, button, container) {
        return list.offsetWidth > getAvailableSpace(button, container);
    }

    /**
     * Set menu container variable.
     */
    var navContainer = document.querySelector('.main-navigation');

    /**
     * Let’s bail if we our menu doesn't exist.
     */

    if (!navContainer) {
        return;
    }
    var breaks = [];
    var shouldUpdateMenu = document.querySelector('#masthead').classList.contains('hide-overflow')

    /**
     * Refreshes the list item from the menu depending on the menu size.
     */
    function updateNavigationMenu(container) {

        /**
         * Let’s bail if our menu is empty.
         */
        if (!shouldUpdateMenu || !container.parentNode.querySelector('.menu[id]')) {
            return;
        }
        // Adds the necessary UI to operate the menu.
        var visibleList = container.parentNode.querySelector('.menu[id]');
        var menuHolder = container.querySelector('.primary-menu-wrapper');
        var hiddenList = visibleList.parentNode.nextElementSibling.querySelector('.hidden-links');
        var toggleButton = visibleList.parentNode.nextElementSibling.querySelector('.primary-menu-more-toggle');

        if (window.innerWidth <= 991) {

            if (breaks.length > 0) {
                visibleList.insertAdjacentHTML('beforeend', hiddenList.innerHTML);
                hiddenList.innerHTML = '';
                breaks.length = 0;
                hideButton(toggleButton);
            }

            return;
        }

        if (isOverflowingNavivation(visibleList, toggleButton, menuHolder)) {
            // Record the width of the list.
            breaks.push(visibleList.offsetWidth);
            // Move last item to the hidden list.
            prependElement(hiddenList, !visibleList.lastChild || null === visibleList.lastChild ? visibleList.previousElementSibling : visibleList.lastChild);
            // Show the toggle button.
            showButton(toggleButton);

        } else {

            // There is space for another item in the nav.
            if (getAvailableSpace(toggleButton, menuHolder) > breaks[breaks.length - 1]) {
                // Move the item to the visible list.
                visibleList.appendChild(hiddenList.firstChild);
                breaks.pop();
            }

            // Hide the dropdown btn if hidden list is empty.
            if (breaks.length < 1) {
                hideButton(toggleButton);
            }
        }

        // Recur if the visible list is still overflowing the nav.
        if (isOverflowingNavivation(visibleList, toggleButton, menuHolder)) {
            updateNavigationMenu(container);
        }
    }

    const submenus = navContainer.querySelectorAll('.sub-menu');

    function updateSubMenuPosition(submenus) {
        submenus.forEach(function (submenu) {
            submenu.classList.remove('toleft');
            var parent = submenu.parentNode,
                parentCoords = parent.getBoundingClientRect();

            if ((parentCoords.left + parent.offsetWidth + 250 - window.innerWidth) > 0) {
                submenu.classList.add('toleft');
            }
        });
    }

    /**
     * Run our priority+ function as soon as the document is `ready`.
     */
    document.addEventListener('DOMContentLoaded', function () {

        updateSubMenuPosition(submenus);
        updateNavigationMenu(navContainer);

        // Also, run our priority+ function on selective refresh in the customizer.
        var hasSelectiveRefresh = (
            'undefined' !== typeof wp &&
            wp.customize &&
            wp.customize.selectiveRefresh &&
            wp.customize.navMenusPreview.NavMenuInstancePartial
        );

        if (hasSelectiveRefresh) {
            // Re-run our priority+ function on Nav Menu partial refreshes.
            wp.customize.selectiveRefresh.bind('partial-content-rendered', function (placement) {
                const submenus = navContainer.querySelectorAll('.sub-menu');
                updateNavigationMenu(placement.container[0].parentNode);
                updateSubMenuPosition(submenus);
            });
        }
    });

    /**
     * Run our priority+ function on load.
     */
    window.addEventListener('load', function () {
        updateSubMenuPosition(submenus);
        updateNavigationMenu(navContainer);
    });

    /**
     * Run our priority+ function every time the window resizes.
     */
    var isResizing = false;
    window.addEventListener('resize',
        debounce(function () {
            if (isResizing) {
                return;
            }

            isResizing = true;
            setTimeout(function () {
                updateNavigationMenu(navContainer);
                updateSubMenuPosition(submenus);
                isResizing = false;
            }, 100);
        })
    );

    /**
     * Run our priority+ function.
     */
    updateSubMenuPosition(submenus);
    updateNavigationMenu(navContainer);

})();
