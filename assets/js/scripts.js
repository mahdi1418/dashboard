window.addEventListener('DOMContentLoaded', event => {

    // Toggle the side navigation
    const sidebarToggle = document.body.querySelector('#sidebarToggle');
    if (sidebarToggle) {
        // Uncomment Below to persist sidebar toggle between refreshes
        // if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
        //     document.body.classList.toggle('sb-sidenav-toggled');
        // }
        sidebarToggle.addEventListener('click', event => {
            event.preventDefault();
            document.body.classList.toggle('sb-sidenav-toggled');
            localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
        });
    }

});
function openModal(id) {
    document.getElementById().style.display = 'flex';
}
window.onclick = function (event) {
    const pro_search = document.getElementById('pro_search');
    if (!pro_search.contains(event.target)) {
        const items = pro_search.querySelectorAll('li');
        items.forEach(li => {
            li.style.display = 'none';
        });
    }
}



