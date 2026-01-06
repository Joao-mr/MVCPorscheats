document.querySelectorAll('.menu-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        document.querySelectorAll('.admin-section')
            .forEach(sec => sec.classList.remove('visible'));

        document.querySelectorAll('.menu-btn')
            .forEach(b => b.classList.remove('active'));

        document.getElementById(btn.dataset.section)
            .classList.add('visible');

        btn.classList.add('active');
    });
});
