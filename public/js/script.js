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

    // Close menu when clicking outside (on overlay)
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

    // Close modal when clicking outside of the content
    if (modal) {
        modal.addEventListener('click', function(e) {
            if (e.target === modal) {
                modal.style.display = 'none';
                document.body.style.overflow = '';
            }
        });
    }

    // Handle form submission (for your bot integration)
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault(); // Prevent default form submission

            const name = document.getElementById('contactName').value;
            const phone = document.getElementById('contactPhone').value;
            const productName = modalProductName.textContent.replace('Mahsulot: ', ''); // Get product name from modal

            // You will implement your bot integration here
            console.log(`Mijoz nomi: ${name}, Telefon raqami: ${phone}, Qiziqqan mahsulot: ${productName}`);

            // Example: Send data to your bot API
            // fetch('YOUR_BOT_API_ENDPOINT', {
            //     method: 'POST',
            //     headers: {
            //         'Content-Type': 'application/json',
            //         'Authorization': 'Bearer YOUR_BOT_TOKEN' // If you have a token
            //     },
            //     body: JSON.stringify({
            //         username: name,
            //         phone: phone,
            //         product_name: productName,
            //         // Add any other data you need, like product ID
            //         product_id: document.querySelector('.quick-contact-button').dataset.productId // Example of getting product ID
            //     })
            // })
            // .then(response => response.json())
            // .then(data => {
            //     console.log('Bot response:', data);
            //     // Show success message or close modal
            //     alert('So\'rovingiz yuborildi!'); // Replace with a custom message box
            //     modal.style.display = 'none';
            //     document.body.style.overflow = '';
            // })
            // .catch(error => {
            //     console.error('Error sending to bot:', error);
            //     alert('Xatolik yuz berdi. Iltimos, qayta urinib ko\'ring.'); // Replace with a custom message box
            // });

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
});

