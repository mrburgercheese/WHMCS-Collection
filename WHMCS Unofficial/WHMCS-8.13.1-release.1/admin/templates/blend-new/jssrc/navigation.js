const desktop = window.matchMedia('(min-width: 1200px)')
const animationSpeed = 250;
$(document).ready(() => {
    const navbar = document.querySelector('.navigation')
    const navigation = document.querySelector('.navbar-new')
    const navToggle = document.querySelector('.navigation .nav-toggle')
    const quicksearch = document.querySelector('[data-quicksearch]')
    const searchInput = document.querySelector('#intelliSearchForm input.quicksearch')
    const overlay = document.querySelector('#overlay')

    const closeMenu = () => {
        navToggle.classList.remove('active');
        navigation.classList.remove('active');
        navigation.classList.add('active-out');

        setTimeout(() => {
            navigation.classList.remove('active-out')
            overlay.classList.remove('active');
        }, animationSpeed)

        document.body.classList.remove('mobile-active');
    }

    document.addEventListener('click', e => {

        const isDropdownButton = e.target.closest("[data-dropdown-btn]")

        if (!isDropdownButton && e.target.closest("[data-dropdown]") != null) return

        let currentDropdown

        if (isDropdownButton) {

            e.preventDefault()
            if (desktop.matches) {

                currentDropdown = e.target.closest("[data-dropdown]")
                currentDropdown.classList.toggle("active")
                const submenus = currentDropdown.querySelectorAll('.has-dropdown');

                submenus.forEach((submenu) => {
                    const link_href = submenu.querySelector('a[data-dropdown-btn]')
                        .getAttribute('href');

                    submenu.addEventListener('click', () => {
                        window.location.href = link_href;
                    });

                    submenu.addEventListener('mouseenter', () => {
                        submenu.classList.add('active');
                    });

                    submenu.addEventListener('mouseleave', () => {
                        setTimeout(() => {
                            if (!submenu.matches(':hover')) {
                                submenu.classList.remove('active');
                            }
                        }, 35)
                    });
                });

            } else {
                const dropdown = e.target.closest("[data-dropdown]").querySelector("[data-dropdown-menu]");
                let prevMenu = dropdown.parentElement.parentElement;

                currentDropdown = e.target.closest("[data-dropdown]").querySelector("[data-dropdown-menu]").cloneNode(true);

                if (e.target.closest(".nav-icons"))
                    prevMenu = document.querySelector('.navbar-new > ul')

                const backButtonText = e.target.closest('[data-dropdown-btn]').dataset.title;
                const backButton = document.createElement('li');

                backButton.innerHTML = `<a class="menu-back-button"><i class="ph ph-caret-left"></i> ${backButtonText}</a>`;
                backButton.addEventListener("click", () => {
                    currentDropdown.classList.add('menu-secondary-hidden');

                    setTimeout(() => {
                        prevMenu.classList.remove('menu-primary-hidden');
                    })

                    setTimeout(() => {
                        navigation.removeChild(navigation.lastElementChild);
                    }, 500)
                })


                if (currentDropdown) {
                    currentDropdown.classList.add('menu-secondary-hidden');
                    currentDropdown.prepend(backButton);

                    prevMenu.classList.add('menu-primary-hidden');

                    navigation.appendChild(currentDropdown);
                    setTimeout(() => {
                        currentDropdown.classList.remove('menu-secondary-hidden');
                    })

                }
            }


        } else {
            const activeDropdown = navigation.querySelector('[data-dropdown].active')
            if (desktop.matches && activeDropdown)
                activeDropdown.classList.remove("active")
        }

        const checkSubMenu = (dropdown) => {
            let foundSubMenu
            dropdown.querySelectorAll('[data-dropdown-menu] [data-dropdown]').forEach(el => {
                if (el === currentDropdown) foundSubMenu = el
            })
            return foundSubMenu
        }

        document.querySelectorAll("[data-dropdown].active").forEach(dropdown => {
            if (dropdown === currentDropdown || currentDropdown === checkSubMenu(dropdown)) return

            dropdown.classList.remove("active")
        })

    })


    searchInput.addEventListener('focus', () => {
        closeMenu()

        navbar.classList.add('search-active')
        quicksearch.classList.add('active')
    })

    searchInput.addEventListener('blur', () => {
        navbar.classList.remove('search-active')
        quicksearch.classList.remove('active')
    })

    navToggle.addEventListener('click', e => {


        navToggle.classList.toggle('active');

        if (navigation.classList.contains('active')) {
            closeMenu()
        } else {
            navigation.classList.add('active');
        }

        overlay.classList.toggle('active');
        document.body.classList.toggle('mobile-active');

        overlay.addEventListener('click', () => {
            closeMenu()
        })
    })

    const reset = () => {
        if (desktop.matches && navigation.lastElementChild.hasAttribute("data-dropdown-menu")) {
            navigation.removeChild(navigation.lastElementChild);
            navigation.querySelector('ul').className = '';
        } else if (desktop.matches) {
            navToggle.classList.remove('active');
            navigation.classList.remove('active');
            overlay.classList.remove('active');
            document.querySelector('.navigation .menu-right').prepend(quicksearch)
        } else {
            document.querySelectorAll("[data-dropdown].active").forEach(dropdown => {
                dropdown.classList.remove("active")
            })

            document.querySelector('.mobile-nav .quick-search-item').append(quicksearch)
        }
    }

    reset();

    window.addEventListener('resize', () => {
        reset();
    })
})