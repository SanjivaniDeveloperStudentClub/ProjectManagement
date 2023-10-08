const tabs = document.querySelectorAll('.tab');
const tabContainer = document.querySelector('#tabs');

tabs.forEach((tab) => {
    tab.addEventListener('click', () => {
        tabs.forEach((t) => t.classList.remove('active'));
        tab.classList.add('active');
    });
});