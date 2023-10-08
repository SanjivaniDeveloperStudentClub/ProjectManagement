// const dropdownContainer = document.querySelector('.custom-dropdown');
// const inputField = dropdownContainer.querySelector('.dropdown-input');
// const dropdownOptions = document.querySelectorAll('.dropdown-option');

// dropdownContainer.addEventListener('click', () => {
//     dropdownContainer.classList.toggle('active');
// });

// dropdownOptions.forEach((option) => {
//     option.addEventListener('click', () => {
//         const selectedOption = option.textContent;
//         inputField.value = selectedOption;
//         dropdownContainer.classList.remove('inactive');
//     });
// });

const dropdowns = document.querySelectorAll('.custom-dropdown');

        dropdowns.forEach((dropdown) => {
            const inputField = dropdown.querySelector('.dropdown-input');
            const dropdownOptions = dropdown.querySelectorAll('.dropdown-option');

            dropdown.addEventListener('click', () => {
                dropdown.classList.toggle('active');
            });

            document.addEventListener('click', (event) => {
                if (!dropdown.contains(event.target)) {
                    dropdown.classList.remove('active');
                }
            });

            dropdownOptions.forEach((option) => {
                    option.addEventListener('click', () => {
                        const selectedOption = option.textContent;
                        inputField.value = selectedOption;
                        dropdownContainer.classList.remove('inactive');
                    });
                });
        });