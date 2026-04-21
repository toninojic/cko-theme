(function () {
  const body = document.body;
  const menuToggle = document.querySelector('.menu-toggle');
  const mobileDrawer = document.querySelector('.mobile-drawer');
  const overlay = document.querySelector('.nav-overlay');

  if (!menuToggle || !mobileDrawer || !overlay) return;

  const closeMenu = () => {
    menuToggle.classList.remove('is-active');
    menuToggle.setAttribute('aria-expanded', 'false');
    mobileDrawer.classList.remove('is-open');
    mobileDrawer.setAttribute('aria-hidden', 'true');
    overlay.classList.remove('is-open');
    body.classList.remove('menu-open');
  };

  const openMenu = () => {
    menuToggle.classList.add('is-active');
    menuToggle.setAttribute('aria-expanded', 'true');
    mobileDrawer.classList.add('is-open');
    mobileDrawer.setAttribute('aria-hidden', 'false');
    overlay.classList.add('is-open');
    body.classList.add('menu-open');
  };

  menuToggle.addEventListener('click', function () {
    if (mobileDrawer.classList.contains('is-open')) {
      closeMenu();
    } else {
      openMenu();
    }
  });

  overlay.addEventListener('click', closeMenu);

  mobileDrawer.querySelectorAll('a').forEach((link) => {
    link.addEventListener('click', closeMenu);
  });

  document.addEventListener('keydown', function (event) {
    if (event.key === 'Escape') {
      closeMenu();
    }
  });

  const revealElements = document.querySelectorAll('.reveal');
  if (!revealElements.length) return;

  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          observer.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.15 }
  );

  revealElements.forEach((el) => observer.observe(el));
})();
