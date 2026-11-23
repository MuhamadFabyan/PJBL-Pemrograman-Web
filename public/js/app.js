
document.addEventListener('DOMContentLoaded', function () {

    // SIDEBAR TOGGLE
    const sidebar = document.getElementById('sidebar');
    const toggle = document.getElementById('sidebarToggle');

    toggle?.addEventListener('click', function () {
        if (window.innerWidth <= 768) {
            sidebar.classList.toggle('show');
        } else {
            sidebar.classList.toggle('collapsed');
        }
    });

    // ACTIVE NAVIGATION
    const currentPath = window.location.pathname;

    document.querySelectorAll('.nav-menu .nav-link').forEach(link => {
        const linkPath = new URL(link.href).pathname;

        if (linkPath === currentPath) {
            link.classList.add('active');
        }
    });

    // CURRENT DATE
    const dateElement = document.getElementById('currentDate');

    if (dateElement) {
        dateElement.textContent = new Intl.DateTimeFormat('id-ID', {
            day: 'numeric',
            month: 'long',
            year: 'numeric'
        }).format(new Date());
    }

    // CLOSE SIDEBAR AFTER NAVIGATION ON MOBILE
    document.querySelectorAll('.nav-menu .nav-link').forEach(link => {
        link.addEventListener('click', function () {
            if (window.innerWidth <= 768) {
                sidebar.classList.remove('show');
            }
        });
    });

});
