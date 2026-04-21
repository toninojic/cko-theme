(function () {
  const body = document.body;
  const menuToggle = document.querySelector('.menu-toggle');
  const mobileDrawer = document.querySelector('.mobile-drawer');
  const overlay = document.querySelector('.nav-overlay');
  const closeBtn = document.querySelector('.mobile-drawer-close');

  const revealObserver = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('is-visible');
          revealObserver.unobserve(entry.target);
        }
      });
    },
    { threshold: 0.15 }
  );

  const observeReveals = (scope = document) => {
    scope.querySelectorAll('.reveal').forEach((el) => revealObserver.observe(el));
  };

  if (menuToggle && mobileDrawer && overlay) {
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
    if (closeBtn) closeBtn.addEventListener('click', closeMenu);

    mobileDrawer.querySelectorAll('a').forEach((link) => {
      link.addEventListener('click', closeMenu);
    });

    document.addEventListener('keydown', function (event) {
      if (event.key === 'Escape') closeMenu();
    });
  }

  const loadMoreButtons = document.querySelectorAll('.cko-load-more');
  loadMoreButtons.forEach((button) => {
    button.addEventListener('click', async () => {
      const targetId = button.getAttribute('data-target');
      const wrapper = document.getElementById(targetId);
      if (!wrapper || button.classList.contains('is-loading')) return;

      const page = Number(wrapper.dataset.currentPage || '1') + 1;
      const postsPerPage = Number(wrapper.dataset.postsPerPage || '6');

      button.classList.add('is-loading');
      button.textContent = 'Loading...';

      try {
        const formData = new URLSearchParams();
        formData.append('action', 'cko_load_more_posts');
        formData.append('nonce', window.ckoTheme?.nonce || '');
        formData.append('page', String(page));
        formData.append('posts_per_page', String(postsPerPage));

        const response = await fetch(window.ckoTheme?.ajaxUrl || '', {
          method: 'POST',
          headers: { 'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8' },
          body: formData.toString(),
        });

        const data = await response.json();
        if (!data?.success) {
          button.remove();
          return;
        }

        const grid = wrapper.querySelector('.cko-news-grid');
        if (grid) {
          const fragment = document.createRange().createContextualFragment(data.data.html);
          grid.appendChild(fragment);
          observeReveals(grid);
        }

        wrapper.dataset.currentPage = String(data.data.next_page - 1);
        button.classList.remove('is-loading');
        button.textContent = 'Load More';

        if (!data.data.has_more) button.remove();
      } catch (err) {
        button.classList.remove('is-loading');
        button.textContent = 'Load More';
      }
    });
  });

  observeReveals();
})();
