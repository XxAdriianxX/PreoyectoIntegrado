
document.getElementById('theme-toggle').addEventListener('click', function() {
    const body = document.body;
    const themeIcon = document.getElementById('theme-icon');
    if (body.classList.contains('light-theme')) {
        body.classList.remove('light-theme');
        body.classList.add('dark-theme');
        themeIcon.classList.remove('fa-moon');
        themeIcon.classList.add('fa-sun');
    } else {
        body.classList.remove('dark-theme');
        body.classList.add('light-theme');
        themeIcon.classList.remove('fa-sun');
        themeIcon.classList.add('fa-moon');
    }
});
