app = {
    init: function() {
        this.smoothScroll();
        this.darkTheme();
    },

    smoothScroll : function() {
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });    
    },

    darkTheme : function() {
        const themeToggle = document.querySelector('.fa-moon');

        const currentTheme = localStorage.getItem('theme');
        if (currentTheme === 'dark') {
            document.body.classList.add('dark-theme');
            themeToggle.classList.replace('fa-moon', 'fa-sun');
        }

        themeToggle.addEventListener('click', function() {
            document.body.classList.toggle('dark-theme');
            if (document.body.classList.contains('dark-theme')) {
                themeToggle.classList.replace('fa-moon', 'fa-sun');
                localStorage.setItem('theme', 'dark');
            } else {
                themeToggle.classList.replace('fa-sun', 'fa-moon');
                localStorage.setItem('theme', 'light');
            }
        });
    }
};

/* initialisation de l'app lorsque la page est chargée */
document.addEventListener('DOMContentLoaded', function() {
    app.init();
});

