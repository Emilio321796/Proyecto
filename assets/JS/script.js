document.addEventListener('DOMContentLoaded', function() {
    var navbar = document.querySelector('.navbar');
    var lastScrollTop = 0;

    window.addEventListener('scroll', function() {
        var scrollTop = window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > lastScrollTop && scrollTop > navbar.offsetHeight) {
            
            navbar.classList.add('navbar-hidden');
        } else if (scrollTop < lastScrollTop) {
            
            navbar.classList.remove('navbar-hidden');
        }
        lastScrollTop = scrollTop;
    });
});

let lastScrollTop = 0;
const footer = document.querySelector('.footer');

window.addEventListener('scroll', function() {
  let scrollTop = window.pageYOffset || document.documentElement.scrollTop;

  if (scrollTop > lastScrollTop) {
    // Scrolling down
    footer.classList.add('footer--hidden');
  } else {
    // Scrolling up
    footer.classList.remove('footer--hidden');
  }

  lastScrollTop = scrollTop;
});