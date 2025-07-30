document.addEventListener('DOMContentLoaded', function() {
    const menuToggle = document.querySelector('.menu-toggle');
    const mobileMenuOverlay = document.querySelector('.mobile-menu-overlay');
    const closeMenu = document.querySelector('.close-menu');

    // Hamburger menu functionality
    if (menuToggle) {
        menuToggle.addEventListener('click', function() {
            mobileMenuOverlay.classList.add('active');
            document.body.style.overflow = 'hidden'; // Prevent scrolling when menu is open
        });
    }

    if (closeMenu) {
        closeMenu.addEventListener('click', function() {
            mobileMenuOverlay.classList.remove('active');
            document.body.style.overflow = ''; // Restore scrolling
        });
    }

    if (mobileMenuOverlay) {
        mobileMenuOverlay.addEventListener('click', function(e) {
            if (e.target === mobileMenuOverlay) {
                mobileMenuOverlay.classList.remove('active');
                document.body.style.overflow = '';
            }
        });
    }

    // Quick Contact Modal functionality
    const quickContactButtons = document.querySelectorAll('.quick-contact-button');
    const modal = document.getElementById('quickContactModal');
    const closeModalButton = document.querySelector('#quickContactModal .close-button');
    const modalProductName = document.querySelector('#quickContactModal .modal-product-name');
    const contactForm = document.getElementById('contactForm');
    const contactPhoneInput = document.getElementById('contactPhone');

    quickContactButtons.forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.dataset.productId;
            const productName = this.dataset.productName || "Mahsulot"; // Get product name if available
            const productPhone = this.dataset.productPhone || ""; // Get product phone if available

            modalProductName.textContent = `Mahsulot: ${productName}`;
            contactPhoneInput.value = productPhone; // Set phone number in the input
            modal.style.display = 'flex'; // Show the modal
            document.body.style.overflow = 'hidden'; // Prevent scrolling
        });
    });

    if (closeModalButton) {
        closeModalButton.addEventListener('click', function() {
            modal.style.display = 'none'; // Hide the modal
            document.body.style.overflow = ''; // Restore scrolling
        });
    }

    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.style.display = 'none';
                document.body.style.overflow = '';
            }
        });
    }

    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            const name = document.getElementById('contactName').value;
            const phone = document.getElementById('contactPhone').value;
            const productName = modalProductName.textContent.replace('Mahsulot: ', ''); // Get product name from modal

            // You will implement your bot integration here
            console.log(`Mijoz nomi: ${name}, Telefon raqami: ${phone}, Qiziqqan mahsulot: ${productName}`);

            alert('So\'rovingiz yuborildi!');
            modal.style.display = 'none';
            document.body.style.overflow = '';
            contactForm.reset();
        });
    }

    const mainImage = document.querySelector('.product-gallery .main-image');
    const thumbnails = document.querySelectorAll('.product-gallery .thumbnail');

    if (mainImage && thumbnails.length > 0) {
        thumbnails.forEach(thumbnail => {
            thumbnail.addEventListener('click', function() {
                mainImage.src = this.src;
            });
        });
    }

    const languageSwitcher = document.getElementById('language-switcher');
    if (languageSwitcher) {
        languageSwitcher.addEventListener('change', function() {
            const selectedLang = this.value;
            window.location.href = `/lang/${selectedLang}`;
        });
    }
});

