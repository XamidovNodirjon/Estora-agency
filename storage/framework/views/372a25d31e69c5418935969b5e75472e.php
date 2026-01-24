<!DOCTYPE html>
<html lang="<?php echo e(app()->getLocale()); ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Estora Real Estate Agency</title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/filter_product.css')); ?>">
    <link rel="stylesheet" href="/css/dashboard.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- <link rel="stylesheet" href="/css/style.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.min.css">

<style>
    /* General Styles */
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: 'Montserrat', sans-serif;
    }

    body {
        background-color: #f5f6f5;
        color: #333;
        line-height: 1.6;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Header Styles */
    .header {
        background-color: #fff;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        position: fixed;
        width: 100%;
        top: 0;
        z-index: 1000;
        padding: 15px 0;
    }

    .header .container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .logo img {
        height: 40px;
    }

    .logo span {
        font-size: 1.2rem;
        font-weight: 600;
        color: #1a3c34;
    }

    .main-nav {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .contact-info a {
        color: #1a3c34;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s;
    }

    .contact-info a:hover {
        color: #007bff;
    }

    .language-selector select {
        padding: 8px;
        border: 1px solid #ddd;
        border-radius: 5px;
        background-color: #fff;
        cursor: pointer;
    }

    .menu-toggle {
        display: none;
        flex-direction: column;
        gap: 5px;
        cursor: pointer;
    }

    .menu-toggle .bar {
        width: 25px;
        height: 3px;
        background-color: #1a3c34;
        transition: all 0.3s;
    }

    /* Mobile Menu */
    .mobile-menu-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.7);
        display: none;
        z-index: 1001;
    }

    .mobile-menu-overlay.active {
        display: flex;
        justify-content: flex-end;
    }

    .mobile-menu {
        background: #fff;
        width: 250px;
        height: 100%;
        padding: 20px;
        position: relative;
    }

    .close-menu {
        position: absolute;
        top: 20px;
        right: 20px;
        background: none;
        border: none;
        font-size: 1.5rem;
        cursor: pointer;
    }

    .mobile-menu ul {
        list-style: none;
        padding-top: 40px;
    }

    .mobile-menu ul li {
        margin: 15px 0;
    }

    .mobile-menu ul li a {
        color: #1a3c34;
        text-decoration: none;
        font-size: 1.1rem;
        font-weight: 500;
    }

    .search-form-card {
        background: #fff;
        margin: 100px auto 30px;
        padding: 20px;
        border-radius: 10px;
        overflow: hidden;
    }

    .search-form-card h2 {
        font-size: 1.8rem;
        margin-bottom: 20px;
        color: #1a3c34;
    }

    .search-form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        font-size: 0.9rem;
        margin-bottom: 5px;
        color: #555;
    }

    .form-group select,
    .form-group input {
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 0.9rem;
        background: #f9f9f9;
    }

    .form-group input:focus,
    .form-group select:focus {
        outline: none;
        border-color: #007bff;
    }

    .filter-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
    }

    .more-filters-btn,
    .map-view-btn,
    .show-ads-btn {
        padding: 10px 20px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 0.9rem;
        display: flex;
        align-items: center;
        gap: 5px;
        transition: background-color 0.3s;
    }

    .more-filters-btn {
        background: #f1f1f1;
        color: #333;
    }

    .map-view-btn {
        background: #007bff;
        color: #fff;
    }

    /* Changed color for show-ads-btn */
    .show-ads-btn {
        background: #F7931E; /* Changed from #1a3c34 */
        color: #fff;
    }

    .more-filters-btn:hover,
    .map-view-btn:hover,
    .show-ads-btn:hover {
        opacity: 0.9;
    }

    /* Ads Listing */
    .ads-listing-section {
        margin-bottom: 50px;
    }

    .ads-listing-section h2 {
        font-size: 1.8rem;
        margin-bottom: 20px;
        color: #1a3c34;
    }

    .ad-card {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        transition: transform 0.3s;
    }

    .ad-card:hover {
        transform: translateY(-5px);
    }

    .image-gallery-card-container {
        position: relative;
        width: 100%;
        height: 200px;
        overflow: hidden;
    }

    .prev-button-card {
        left: 5px;
    }

    .next-button-card {
        right: 5px;
    }

    .ad-info {
        padding: 15px;
    }

    .ad-info h3 {
        font-size: 1.2rem;
        margin-bottom: 10px;
        color: #1a3c34;
    }

    .ad-price {
        font-size: 1.1rem;
        font-weight: 600;
        color: #007bff;
        margin-bottom: 10px;
    }

    .ad-location {
        font-size: 0.9rem;
        color: #555;
        margin-bottom: 10px;
    }

    .ad-details {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
        font-size: 0.85rem;
        color: #666;
        margin-bottom: 10px;
    }

    .ad-details span {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .ad-category {
        font-size: 0.85rem;
        color: #888;
        margin-bottom: 10px;
    }

    .product-id {
        font-size: 0.85rem;
        color: #888;
    }

    .view-ad-button,
    .quick-contact-button {
        flex: 1;
        padding: 10px;
        border: none;
        border-radius: 5px;
        text-align: center;
        font-size: 0.9rem;
        cursor: pointer;
        text-decoration: none;
        transition: background-color 0.3s;
    }

    .view-ad-button {
        background: #007bff;
        color: #fff;
    }

    /* Changed color for quick-contact-button */
    .quick-contact-button {
        background: #F7931E; /* Changed from #1a3c34 */
        color: #fff;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 5px;
    }

    .view-ad-button:hover,
    .quick-contact-button:hover {
        opacity: 0.9;
    }

    /* Pagination */
    .pagination-links {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 30px;
    }

    .pagination-info {
        font-size: 0.9rem;
        color: #666;
    }

    .pagination-links nav {
        display: flex;
        gap: 10px;
    }

    .page-link {
        padding: 8px 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        text-decoration: none;
        color: #333;
        font-size: 0.9rem;
        transition: all 0.3s;
    }

    .page-link.active,
    .page-link:hover {
        background: #007bff;
        color: #fff;
        border-color: #007bff;
    }

    .page-link.disabled {
        color: #ccc;
        cursor: not-allowed;
    }

    .page-link.dots {
        border: none;
        background: none;
    }

    .footer {
        width: 100%;
        background-color: #293038;
        color: #fff;
        padding-top: 30px;
        padding-bottom: 20px;
    }

    .footer-background {

        padding-top: 0;
        position: relative;
        min-height: auto;
    }

    .footer-background::before {
        display: none;
    }

    .footer-content {
        display: flex;
        justify-content: space-between;
        align-items: flex-start;
        padding-bottom: 20px; /* Padding kamaytirildi */
        position: relative;
        z-index: 2;
        gap: 20px; /* Elementlar orasidagi bo'shliq */
        flex-wrap: wrap; /* Kichik ekranlarda o'ralash uchun */
    }

    .footer-logo {
        display: flex;
        flex-direction: column;
        align-items: flex-start;
        color: #fff;
        font-weight: 600;
        font-size: 1rem; /* Kichraytirildi */
    }

    .footer-logo img {
        height: 55px; /* Logotip balandligi kichraytirildi */
        margin-bottom: 5px;
    }

    .footer-logo span {
        font-size: 0.6em; /* Kichraytirildi */
        font-weight: 400;
        letter-spacing: 1px;
        opacity: 0.8;
    }

    .footer-links ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .footer-links ul li {
        margin-bottom: 8px; /* Bo'shliq kamaytirildi */
    }

    .footer-links ul li a {
        color: #fff;
        text-decoration: none;
        font-weight: 500;
        transition: color 0.3s ease;
        font-size: 0.9em; /* Kichraytirildi */
    }

    .footer-links ul li a:hover {
        color: #f7a01d; /* Hover effekti */
    }

    .footer-contact p {
        margin: 0 0 5px 0; /* Bo'shliq kamaytirildi */
        font-weight: 500;
        font-size: 0.9em; /* Kichraytirildi */
    }

    .footer-contact p:first-child {
        font-weight: 600;
        margin-bottom: 10px; /* Bo'shliq kamaytirildi */
        font-size: 1em; /* Kichraytirildi */
    }

    .footer-social {
        display: flex;
        gap: 12px; /* Bo'shliq kamaytirildi */
        font-size: 1.3em; /* Ikonka o'lchami kichraytirildi */
    }

    .footer-social a {
        color: #fff;
        transition: color 0.3s ease;
    }

    .footer-social a:hover {
        color: #f7a01d;
    }

    .footer-bottom {
        border-top: 1px solid rgba(255, 255, 255, 0.1);
        padding: 15px 0;
        text-align: center;
        font-size: 0.8em;
        color: rgba(255, 255, 255, 0.7);
        position: relative;
        margin-top: 15px;
        z-index: 2;
    }


    /* Modal */
    .modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
        justify-content: center;
        align-items: center;
        z-index: 1002;
    }

    .modal-content {
        background: #fff;
        padding: 20px;
        border-radius: 10px;
        width: 90%;
        max-width: 400px;
        position: relative;
    }

    .close-button {
        position: absolute;
        top: 10px;
        right: 15px;
        font-size: 1.5rem;
        cursor: pointer;
    }

    .modal-content h3 {
        font-size: 1.5rem;
        margin-bottom: 15px;
        color: #1a3c34;
    }

    .modal-product-name {
        font-size: 0.9rem;
        margin-bottom: 20px;
        color: #555;
    }

    .modal-content .form-group {
        margin-bottom: 15px;
    }

    .modal-content .form-group label {
        font-size: 0.9rem;
        color: #555;
    }

    .modal-content .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
        font-size: 0.9rem;
    }

    /* Changed color for submit-contact-button */
    .submit-contact-button {
        width: 100%;
        padding: 10px;
        background: #1a3c34;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        font-size: 0.9rem;
    }

    .submit-contact-button:hover {
        background: #007bff;
    }

    /* Responsive Design */
    @media (max-width: 768px) {
        .main-nav {
            gap: 10px;
        }

        .contact-info {
            display: none;
        }

        .menu-toggle {
            display: flex;
        }

        .search-form-grid {
            grid-template-columns: 1fr;
        }

        .filter-actions {
            flex-direction: column;
            gap: 10px;
        }

        .filter-buttons {
            display: flex;
            gap: 10px;
            width: 100%;
        }

        .map-view-btn,
        .show-ads-btn {
            flex: 1;
        }

        .pagination-links {
            flex-direction: column;
            gap: 15px;
        }
    }

    @media (max-width: 480px) {

        .view-ad-button,
        .quick-contact-button {
            width: 100%;
        }
    }

    .ads-grid {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }

    .ad-card {
        display: flex;
        align-items: center;
        border: 1px solid #ddd;
        border-radius: 8px;
        padding: 10px;
        background-color: #fff;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .image-gallery-card-container {
        position: relative;
        width: 300px;
        height: 200px;
        margin-right: 20px;
    }

    .ad-image {
        width: 100%;
        height: 100%;
        object-fit: cover;
        border-radius: 4px;
    }

    .nav-button-card {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        padding: 10px;
        cursor: pointer;
    }

    .prev-button-card {
        left: 5px;
    }

    .next-button-card {
        right: 5px;
    }

    .ad-info {
        flex-grow: 1;
    }

    .ad-actions {
        display: flex;
        gap: 10px;
        margin-top: 10px;
    }

    .telegram-contact {
        display: flex;
        align-items: center;
        gap: 5px;
        color: #0088cc;
        text-decoration: none;
    }

    .ads-grid {
        display: grid;
        grid-template-columns: 1fr;
        gap: 30px;
    }

    .ad-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 15px;
        flex-wrap: wrap;
    }

    .view-ad-button {
        flex-grow: 1;
        padding: 12px 20px;
        background-color: #28a745;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 16px;
        cursor: pointer;
        transition: background-color 0.3s ease;
        text-align: center;
        text-decoration: none;
    }

    .view-ad-button:hover {
        background-color: #218838;
    }

    .contact-buttons-container {
        display: flex;
        gap: 10px;
    }

    .phone-contact-button {
        background-color: #007bff;
    }

    .telegram-share-button {
        background-color: #0088cc;
    }

    .modal {
        display: none;
        position: fixed;
        z-index: 1000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.6);
        justify-content: center;
        align-items: center;
        backdrop-filter: blur(5px);
        -webkit-backdrop-filter: blur(5px);
        animation: fadeIn 0.3s ease-in-out;
    }

    .modal-content {
        background-color: #ffffff;
        padding: 30px;
        border-radius: 12px;
        max-width: 500px;
        width: 90%;
        position: relative;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        animation: slideIn 0.4s cubic-bezier(0.68, -0.55, 0.27, 1.55);
    }

    .modal-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .modal-header h3 {
        font-size: 24px;
        font-weight: 700;
        color: #333;
        margin: 0;
    }

    .modal-product-info {
        font-size: 14px;
        color: #666;
        margin-top: 5px;
    }

    .modal .close-button {
        position: absolute;
        top: 15px;
        right: 20px;
        font-size: 28px;
        color: #aaa;
        cursor: pointer;
        line-height: 1;
        transition: color 0.3s ease;
    }

    .modal .close-button:hover {
        color: #333;
    }

    .modal .form-group {
        margin-bottom: 20px;
    }

    .modal .form-group label {
        display: block;
        margin-bottom: 8px;
        font-weight: 600;
        color: #555;
    }

    .modal .form-group input {
        width: 100%;
        padding: 12px 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        font-size: 16px;
        transition: border-color 0.3s ease, box-shadow 0.3s ease;
    }

    .modal .form-group input:focus {
        outline: none;
        border-color: #28a745;
        box-shadow: 0 0 5px rgba(40, 167, 69, 0.2);
    }

    .submit-contact-button {
        width: 100%;
        padding: 15px;
        background-color: #28a745;
        color: #fff;
        border: none;
        border-radius: 8px;
        font-size: 18px;
        font-weight: 700;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .submit-contact-button:hover {
        background-color: #218838;
    }

    .success-content {
        text-align: center;
        padding: 40px;
    }

    .success-icon {
        margin: 0 auto 20px;
        width: 80px;
        height: 80px;
    }

    .checkmark-circle {
        display: block;
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background: #28a745;
        padding: 10px;
        box-sizing: border-box;
        transform: rotate(-90deg);
    }

    .checkmark-circle.animate {
        animation: rotate 1s ease-in-out;
    }

    .checkmark {
        width: 100%;
        height: 100%;
        display: block;
        transform: rotate(45deg);
    }

    .checkmark-circle-path {
        stroke: #fff;
        stroke-width: 4;
        stroke-dasharray: 157;
        stroke-dashoffset: 157;
        animation: stroke 1s linear forwards;
    }

    .checkmark-check {
        stroke: #fff;
        stroke-width: 4;
        stroke-dasharray: 48;
        stroke-dashoffset: 48;
        opacity: 0;
        animation: stroke-check 0.8s ease-in-out 0.8s forwards;
    }

    @keyframes stroke {
        to {
            stroke-dashoffset: 0;
        }
    }

    @keyframes stroke-check {
        from {
            stroke-dashoffset: 48;
            opacity: 0;
        }
        to {
            stroke-dashoffset: 0;
            opacity: 1;
        }
    }

    @keyframes rotate {
        from {
            transform: rotate(-90deg);
        }
        to {
            transform: rotate(270deg);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
        }
        to {
            opacity: 1;
        }
    }

    @keyframes slideIn {
        from {
            transform: translateY(-50px);
            opacity: 0;
        }
        to {
            transform: translateY(0);
            opacity: 1;
        }
    }

    .header .container {
        display: flex;
        /*justify-content: space-between;*/
        /*align-items: center;*/
        padding: 15px 20px;
        flex-wrap: wrap;
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .logo img {
        height: 45px;
    }

    .logo-text {
        font-size: 16px;
        color: #0a0a0a;
        font-weight: 500;
    }

    /* Telefon raqam */
    .phone-btn {
        background-color: #f59e0b;
        color: #fff;
        padding: 10px 20px;
        border-radius: 30px;
        text-decoration: none;
        font-weight: bold;
        white-space: nowrap;
        transition: 0.3s;
    }

    .phone-btn:hover {
        background-color: #d97706;
    }

    /* Language selector */
    .language-selector {
        position: relative;
        margin-left: 15px;
        z-index: 1000;
    }

    .select-language {
        padding: 8px 15px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 500;
        display: flex;
        align-items: center;
        gap: 5px;
        user-select: none;
    }

    .language-dropdown {
        position: absolute;
        top: 45px;
        right: 0;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.15);
        display: none;
        min-width: 150px;
        animation: fadeDrop 0.3s ease-out forwards;
        z-index: 1001;
    }

    .language-dropdown ul {
        list-style: none;
        padding: 10px;
        margin: 0;
    }

    .language-dropdown ul li a {
        display: block;
        text-decoration: none;
        color: #333;
        padding: 5px 0;
        font-weight: 500;
    }

    .language-dropdown ul li a:hover {
        color: #007bff;
    }

    /* Menu icon */
    .menu-icon {
        cursor: pointer;
        padding: 10px;
        border-radius: 6px;
        display: flex; /* Always visible */
        flex-direction: column;
        justify-content: center;
        align-items: center;
        gap: 4px;
        width: 30px;
        height: 30px;
    }

    .menu-icon span {
        width: 100%;
        height: 3px;
        background-color: #333;
        border-radius: 2px;
    }

    /* Dropdown modal */
    .dropdown-modal {
        position: absolute;
        top: 60px;
        right: 20px;
        background-color: #fff;
        border-radius: 8px;
        box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        padding: 15px 20px;
        display: none;
        animation: fadeDrop 0.3s ease-out forwards;
        z-index: 999;
        min-width: 180px;
    }

    .dropdown-modal ul {
        list-style: none;
        margin: 0;
        padding: 0;
    }

    .dropdown-modal ul li a {
        text-decoration: none;
        color: #333;
        font-weight: 500;
        display: block;
        margin: 8px 0;
        transition: 0.2s;
    }

    .dropdown-modal ul li a:hover {
        color: #007bff;
    }

    /* Animation */
    @keyframes fadeDrop {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    /* Responsive */
    @media (max-width: 768px) {
        .header .container {
            flex-direction: column;
            align-items: stretch;
            gap: 10px;
        }

        .main-nav {
            display: flex;
            justify-content: space-between;
            width: 100%;
            flex-wrap: wrap;
        }

        .logo {
            justify-content: center;
            width: 100%;
        }

        .phone-btn {
            width: 100%;
            text-align: center;
        }

        .language-selector,
        .menu-icon {
            margin: 0;
        }

        .language-selector {
            order: 2;
            width: 50%;
            justify-content: center;
            display: flex;
        }

        .menu-icon {
            order: 3;
            justify-content: flex-end;
            width: 50%;
            display: flex;
        }
    }

    .image-modal-content {
        max-width: 90%;
        width: 800px;
        padding: 0;
        background: #fff;
        position: relative;
        border-radius: 8px;
        overflow: hidden;
    }

    .image-modal-container {
        position: relative;
        width: 100%;
        height: 500px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .modal-image {
        max-width: 100%;
        max-height: 100%;
        object-fit: contain;
        transition: opacity 0.3s ease;
    }

    .nav-button-modal {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background: rgba(0, 0, 0, 0.5);
        color: #fff;
        border: none;
        padding: 10px;
        cursor: pointer;
        font-size: 24px;
        border-radius: 50%;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .prev-button-modal {
        left: 10px;
    }

    .next-button-modal {
        right: 10px;
    }

    .nav-button-modal:hover {
        background: rgba(0, 0, 0, 0.7);
    }
    /* Base Styles for all screen sizes */
    body {
        font-family: 'Montserrat', sans-serif;
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        background-color: #f7f9fc;
        color: #333;
    }

    .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 15px;
    }

    a {
        text-decoration: none;
        color: #007bff;
    }

    /* Header */
    .header {
        background-color: #fff;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        padding: 15px 0;
        position: sticky;
        top: 0;
        z-index: 1000;
    }

    .header .container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .logo {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .logo img {
        height: 40px;
    }

    .logo-text {
        font-weight: 700;
        font-size: 18px;
        color: #2c3e50;
    }

    .main-nav {
        display: flex;
        align-items: center;
        gap: 20px;
    }

    .contact-info .phone-btn {
        display: inline-block;
        background-color: #007bff;
        color: #fff;
        padding: 8px 16px;
        border-radius: 20px;
        font-weight: 600;
        transition: background-color 0.3s;
    }

    .contact-info .phone-btn:hover {
        background-color: #0056b3;
    }

    .language-selector {
        position: relative;
        cursor: pointer;
    }

    .select-language {
        background-color: #f0f0f0;
        padding: 8px 12px;
        border-radius: 20px;
        font-weight: 500;
        display: flex;
        align-items: center;
    }

    .language-dropdown {
        display: none;
        position: absolute;
        top: 100%;
        right: 0;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        z-index: 10;
        min-width: 120px;
        margin-top: 10px;
    }

    .language-dropdown ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .language-dropdown ul li a {
        display: block;
        padding: 10px 15px;
        color: #333;
        transition: background-color 0.2s;
    }

    .language-dropdown ul li a:hover {
        background-color: #f0f0f0;
    }

    .menu-icon {
        display: none; /* Hidden on desktop */
        cursor: pointer;
        font-size: 24px;
        color: #333;
    }

    .dropdown-modal {
        display: none;
        position: absolute;
        top: 60px;
        right: 15px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        min-width: 150px;
        z-index: 10;
    }

    .dropdown-modal ul {
        list-style: none;
        padding: 0;
        margin: 0;
    }

    .dropdown-modal ul li a {
        display: block;
        padding: 12px 15px;
        color: #333;
        transition: background-color 0.2s;
    }

    .dropdown-modal ul li a:hover {
        background-color: #f0f0f0;
    }

    /* Mobile Menu Overlay */
    .mobile-menu-overlay {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(0, 0, 0, 0.5);
        z-index: 2000;
        display: none;
        justify-content: flex-end;
        transition: opacity 0.3s ease;
        opacity: 0;
    }

    .mobile-menu-overlay.active {
        display: flex;
        opacity: 1;
    }

    .mobile-menu {
        background-color: #fff;
        width: 250px;
        max-width: 80%;
        height: 100%;
        padding: 20px;
        transform: translateX(100%);
        transition: transform 0.3s ease;
    }

    .mobile-menu-overlay.active .mobile-menu {
        transform: translateX(0);
    }

    .mobile-menu .close-menu {
        background: none;
        border: none;
        font-size: 30px;
        color: #333;
        position: absolute;
        top: 10px;
        right: 20px;
        cursor: pointer;
    }

    .mobile-menu ul {
        list-style: none;
        padding: 40px 0 0;
        margin: 0;
    }

    .mobile-menu ul li {
        margin-bottom: 20px;
    }

    .mobile-menu ul li a {
        font-size: 18px;
        color: #333;
        display: block;
        padding: 10px 0;
        border-bottom: 1px solid #eee;
    }

    .mobile-menu .mobile-login-btn {
        background-color: #007bff;
        color: #fff;
        padding: 10px 20px;
        border-radius: 25px;
        font-weight: 600;
        text-align: center;
        margin-top: 20px;
        display: inline-block;
    }


    /* Search Form Card */
    .search-form-card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 20px rgba(0, 0, 0, 0.05);
        padding: 30px;
        margin-top: 20px;
    }

    .search-form-card h2 {
        font-size: 24px;
        font-weight: 600;
        color: #2c3e50;
        margin-top: 0;
        margin-bottom: 20px;
    }

    .search-form-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
    }

    .form-group {
        display: flex;
        flex-direction: column;
    }

    .form-group label {
        font-weight: 500;
        color: #555;
        margin-bottom: 8px;
    }

    .form-group select,
    .form-group input {
        padding: 10px 12px;
        border: 1px solid #ccc;
        border-radius: 5px;
        font-size: 14px;
        width: 100%;
        box-sizing: border-box;
    }

    .form-group select:focus,
    .form-group input:focus {
        border-color: #007bff;
        outline: none;
    }

    .filter-actions {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-top: 20px;
        flex-wrap: wrap;
        gap: 15px;
    }

    .filter-actions .more-filters-btn {
        background-color: #f0f0f0;
        color: #555;
        border: none;
        padding: 12px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 500;
        transition: background-color 0.3s;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .filter-actions .more-filters-btn:hover {
        background-color: #e0e0e0;
    }

    .filter-buttons {
        display: flex;
        gap: 15px;
        flex-wrap: wrap;
    }

    .show-ads-btn {
        background-color: #28a745;
        color: #fff;
        border: none;
        padding: 12px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 600;
        transition: background-color 0.3s;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .show-ads-btn:hover {
        background-color: #218838;
    }

    .map-view-btn {
        background-color: #6c757d;
        color: #fff;
        border: none;
        padding: 12px 20px;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 600;
        transition: background-color 0.3s;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .map-view-btn:hover {
        background-color: #5a6268;
    }

    /* Ads Listing Section */
    .ads-listing-section {
        padding: 40px 0;
    }

    .ads-listing-section h2 {
        font-size: 28px;
        font-weight: 700;
        text-align: center;
        margin-bottom: 30px;
        color: #2c3e50;
    }

    .no-results {
        text-align: center;
        color: #777;
        font-size: 18px;
        margin-top: 50px;
    }

    .ads-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
        gap: 25px;
    }

    .ad-card {
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
        overflow: hidden;
        transition: transform 0.3s, box-shadow 0.3s;
        display: flex;
        flex-direction: column;
    }

    .ad-card:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 25px rgba(0, 0, 0, 0.1);
    }

    .image-gallery-card-container {
        position: relative;
        width: 100%;
        padding-top: 66.66%; /* 3:2 aspect ratio */
        overflow: hidden;
    }

    .ad-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: opacity 0.3s ease-in-out;
    }

    .nav-button-card {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0, 0, 0, 0.5);
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 35px;
        height: 35px;
        cursor: pointer;
        font-size: 18px;
        display: flex;
        justify-content: center;
        align-items: center;
        opacity: 0;
        transition: opacity 0.3s;
    }

    .ad-card:hover .nav-button-card {
        opacity: 1;
    }

    .prev-button-card {
        left: 10px;
    }

    .next-button-card {
        right: 10px;
    }

    .ad-info {
        padding: 20px;
        display: flex;
        flex-direction: column;
        flex-grow: 1;
    }

    .ad-info h3 {
        font-size: 20px;
        font-weight: 600;
        color: #2c3e50;
        margin-top: 0;
        margin-bottom: 10px;
    }

    .ad-price {
        font-size: 22px;
        font-weight: 700;
        color: #28a745;
        margin-bottom: 10px;
    }

    .ad-location {
        font-size: 14px;
        color: #777;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .ad-details {
        display: flex;
        flex-wrap: wrap;
        gap: 15px;
        font-size: 14px;
        color: #555;
        margin-bottom: 15px;
    }

    .ad-details span {
        display: flex;
        align-items: center;
        gap: 5px;
    }

    .ad-details i {
        color: #007bff;
    }

    .ad-category {
        font-size: 13px;
        color: #999;
        margin-bottom: 15px;
        flex-grow: 1;
    }

    .product-id {
        font-size: 12px;
        color: #aaa;
        margin-top: auto;
        margin-bottom: 10px;
    }

    .ad-actions {
        display: flex;
        justify-content: space-between;
        align-items: flex-end;
        gap: 15px;
    }

    .view-ad-button {
        background-color: #007bff;
        color: #fff;
        border: none;
        padding: 10px 15px;
        border-radius: 5px;
        cursor: pointer;
        font-weight: 500;
        transition: background-color 0.3s;
    }

    .view-ad-button:hover {
        background-color: #0056b3;
    }

    .contact-buttons-container {
        text-align: right;
    }

    .contact-buttons-container p {
        margin: 0 0 5px;
        font-size: 14px;
        color: #555;
        font-weight: 600;
    }

    .contact-buttons-container a {
        color: #fff;
        padding: 5px 10px;
        border-radius: 5px;
        display: inline-flex;
        align-items: center;
        gap: 5px;
        background-color: #0088cc;
        transition: background-color 0.3s;
    }

    .contact-buttons-container a:hover {
        background-color: #006b99;
    }

    /* Pagination */
    .pagination-links {
        display: flex;
        justify-content: center;
        align-items: center;
        flex-wrap: wrap;
        gap: 10px;
        margin-top: 30px;
    }

    .pagination-info {
        font-size: 14px;
        color: #777;
    }

    .pagination-links nav {
        display: flex;
        gap: 5px;
    }

    .page-link {
        display: block;
        padding: 8px 12px;
        background-color: #fff;
        border: 1px solid #ddd;
        border-radius: 5px;
        color: #007bff;
        transition: background-color 0.3s, color 0.3s;
        font-weight: 500;
    }

    .page-link:hover {
        background-color: #f0f0f0;
    }

    .page-link.active {
        background-color: #007bff;
        color: #fff;
        border-color: #007bff;
    }

    .page-link.disabled {
        color: #ccc;
        cursor: not-allowed;
        background-color: #fff;
    }

    .page-link.dots {
        border: none;
        background: none;
    }

    /* Modals */
    .modal {
        display: none;
        position: fixed;
        z-index: 2000;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
        background-color: rgba(0, 0, 0, 0.6);
        justify-content: center;
        align-items: center;
    }

    .modal-content {
        background-color: #fefefe;
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        width: 90%;
        max-width: 500px;
        position: relative;
        animation: fadeIn 0.3s;
    }

    .close-button {
        color: #aaa;
        float: right;
        font-size: 28px;
        font-weight: bold;
        position: absolute;
        top: 10px;
        right: 15px;
    }

    .close-button:hover,
    .close-button:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }

    .modal-header {
        text-align: center;
        margin-bottom: 20px;
    }

    .modal-header h3 {
        margin: 0;
        color: #2c3e50;
        font-size: 24px;
    }

    .modal-product-info {
        font-size: 14px;
        color: #777;
        margin-top: 5px;
    }

    .modal .form-group {
        margin-bottom: 20px;
    }

    .modal .form-group label {
        font-weight: 600;
    }

    .modal .form-group input {
        width: 100%;
        padding: 10px;
        border: 1px solid #ccc;
        border-radius: 5px;
        box-sizing: border-box;
    }

    .submit-contact-button {
        background-color: #28a745;
        color: #fff;
        border: none;
        padding: 12px 20px;
        border-radius: 5px;
        width: 100%;
        font-weight: 600;
        cursor: pointer;
        transition: background-color 0.3s;
    }

    .submit-contact-button:hover {
        background-color: #218838;
    }

    .submit-contact-button:disabled {
        background-color: #ccc;
        cursor: not-allowed;
    }

    .success-content {
        text-align: center;
    }

    .success-icon {
        margin-bottom: 20px;
    }

    .checkmark-circle {
        width: 80px;
        height: 80px;
        border-radius: 50%;
        background-color: #28a745;
        margin: 0 auto;
        position: relative;
        animation: scaleIn 0.5s cubic-bezier(0.68, -0.55, 0.27, 1.55) forwards;
    }

    .checkmark {
        width: 52px;
        height: 52px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    .checkmark-circle-path {
        stroke-dasharray: 157;
        stroke-dashoffset: 157;
        stroke-width: 4;
        stroke-miterlimit: 10;
        stroke: #fff;
        fill: none;
        animation: strokePath 1s cubic-bezier(0.65, 0, 0.45, 1) forwards 0.5s;
    }

    .checkmark-check {
        stroke-dasharray: 100;
        stroke-dashoffset: 100;
        stroke-width: 4;
        stroke-miterlimit: 10;
        stroke: #fff;
        fill: none;
        animation: strokeCheck 0.5s cubic-bezier(0.65, 0, 0.45, 1) forwards 1s;
    }

    .success-content h3 {
        color: #28a745;
    }

    /* Image Modal */
    .image-modal-content {
        max-width: 800px;
        background-color: transparent;
        box-shadow: none;
        padding: 0;
        position: relative;
    }

    .image-modal-container {
        position: relative;
    }

    .modal-image {
        display: block;
        max-width: 100%;
        max-height: 80vh;
        border-radius: 10px;
        transition: opacity 0.3s ease-in-out;
    }

    .nav-button-modal {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0, 0, 0, 0.5);
        color: #fff;
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        font-size: 24px;
        cursor: pointer;
        z-index: 10;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .nav-button-modal:hover {
        background-color: rgba(0, 0, 0, 0.7);
    }

    .prev-button-modal {
        left: 10px;
    }

    .next-button-modal {
        right: 10px;
    }

    /* Animations */
    .rotate-animation {
        animation: rotate 1.5s linear infinite;
    }

    @keyframes rotate {
        from {
            transform: rotate(0deg);
        }
        to {
            transform: rotate(360deg);
        }
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes strokePath {
        to {
            stroke-dashoffset: 0;
        }
    }

    @keyframes strokeCheck {
        to {
            stroke-dashoffset: 0;
        }
    }

    @keyframes scaleIn {
        from {
            transform: scale(0);
        }
        to {
            transform: scale(1);
        }
    }

    /* --- Mobile Responsiveness --- */
    @media (max-width: 768px) {
        .header .container {
            flex-wrap: wrap;
            padding-top: 10px;
            padding-bottom: 10px;
        }

        .main-nav {
            width: 100%;
            justify-content: space-between;
            margin-top: 10px;
        }

        .logo-text {
            font-size: 16px;
        }

        .contact-info .phone-btn {
            padding: 6px 12px;
            font-size: 14px;
        }

        .select-language {
            padding: 6px 10px;
            font-size: 14px;
        }

        .menu-icon {
            display: block; /* Show hamburger menu on mobile */
        }

        .dropdown-modal {
            display: none !important; /* Hide desktop dropdown on mobile */
        }

        /* Adjust search form for a single column layout */
        .search-form-grid {
            grid-template-columns: 1fr;
        }

        .search-form-card {
            padding: 20px;
        }

        .filter-actions {
            flex-direction: column;
            align-items: stretch;
        }

        .filter-buttons {
            flex-direction: column;
            gap: 10px;
            width: 100%;
        }

        .filter-actions .more-filters-btn,
        .show-ads-btn,
        .map-view-btn {
            width: 100%;
            justify-content: center;
        }

        /* Adjust ad grid for single column display */
        .ads-grid {
            grid-template-columns: 1fr;
        }

        .ad-card {
            padding: 10px;
        }

        .ad-info h3 {
            font-size: 18px;
        }

        .ad-price {
            font-size: 20px;
        }

        .ad-details {
            flex-direction: column;
            gap: 8px;
        }

        .ad-actions {
            flex-direction: column;
            align-items: center;
            width: 100%;
            text-align: center;
            gap: 10px;
        }

        .view-ad-button {
            width: 100%;
        }

        .contact-buttons-container {
            width: 100%;
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        .contact-buttons-container p {
            text-align: center;
        }

        .pagination-links {
            flex-direction: column;
            gap: 15px;
        }

        .pagination-links nav {
            flex-wrap: wrap;
            justify-content: center;
        }

        .page-link {
            padding: 10px 14px;
            font-size: 14px;
        }

        .modal-content {
            width: 95%;
            padding: 20px;
        }
    }
    .card {
        display: flex;
        align-items: stretch; /* Ikkala tomon bir xil balandlikda bo'lishi uchun */
        max-height: 250px;    /* Kartochkaning umumiy balandligini cheklaymiz */
        overflow: hidden;
        border-radius: 12px;
        }

        .card-image {
        flex: 0 0 30% !important;        /* Rasm umumiy kenglikning 30% qismini egallaydi */
        height: 100% !important;
        object-fit: cover;    /* Rasmni cho'zmasdan, konteynerga moslab kesadi */
        }

    /* Asosiy konteyner stillari */
.search-hero {
    position: relative;
    width: 100%;
    height: 400px;
    background-size: cover;
    background-position: center;
    color: white;
    display: flex;
    align-items: center;
    justify-content: center;
    text-align: center;
    overflow: hidden;
}

.search-hero-overlay {
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-color: rgba(0, 0, 0, 0.4);
    z-index: 1;
}

.search-hero-content {
    position: relative;
    z-index: 2;
}

.search-hero-content h1 {
    font-size: 2.5rem;
    font-weight: bold;
    margin-bottom: 0.5rem;
}

.search-hero-content p {
    font-size: 1.1rem;
    opacity: 0.9;
}

/* Filtr formasi stillari */
.search-form-container {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
    padding: 2rem;
    margin-top: -100px; /* Qisman fon ustiga chiqishi uchun */
    position: relative;
    z-index: 10;
}

.search-tabs {
    display: flex;
    justify-content: flex-start;
    border-bottom: 2px solid #e0e0e0;
    margin-bottom: 1.5rem;
}

.search-tabs .tab {
    padding: 10px 20px;
    font-weight: bold;
    text-decoration: none;
    color: #555;
    transition: all 0.3s ease;
    border-bottom: 2px solid transparent;
}

.search-tabs .tab.active {
    color: #007bff;
    border-bottom-color: #007bff;
}

.main-filter-form {
    padding-bottom: 1.5rem;
    border-bottom: 1px solid #e0e0e0;
}

.form-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1rem;
    align-items: end;
}

.form-group {
    display: flex;
    flex-direction: column;
}

.form-group label {
    font-weight: 500;
    color: #777;
    margin-bottom: 0.5rem;
}

.form-control {
    width: 100%;
    padding: 10px 15px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 1rem;
    transition: border-color 0.3s;
}

.form-control:focus {
    border-color: #007bff;
    outline: none;
}

.price-inputs {
    display: flex;
    gap: 0.5rem;
}

.price-inputs .small-input {
    flex: 1;
}

.search-btn {
    background-color: #007bff;
    color: #fff;
    border: none;
    border-radius: 8px;
    padding: 12px 20px;
    font-size: 1rem;
    cursor: pointer;
    transition: background-color 0.3s;
}

.search-btn:hover {
    background-color: #0056b3;
}

/* Qo'shimcha filtrlar stillari */
.more-filters-bar {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding-top: 1.5rem;
}

.more-filters-toggle,
.map-view-btn {
    background: none;
    border: none;
    color: #007bff;
    font-size: 1rem;
    font-weight: 500;
    cursor: pointer;
    display: flex;
    align-items: center;
    gap: 8px;
}

.more-filters-toggle:hover,
.map-view-btn:hover {
    text-decoration: underline;
}

/* Javobgarlik (Responsiveness) */
@media (max-width: 768px) {
    .form-grid {
        grid-template-columns: 1fr;
    }

    .search-btn {
        width: 100%;
    }
}
</style>

</head>
<body>
    <?php echo $__env->make('layouts.header', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?>

    <div class="search-hero" style="background-image: url('<?php echo e(asset('images/dashboard.png')); ?>');">
        <div class="search-hero-overlay"></div>
        <div class="search-hero-content">
            <h1>Jami natijalar: <?php echo e($filteredProducts->total()); ?></h1>
            <p>Qayerda yashashni emas, qanday yashashni birga tanlaymiz.</p>
        </div>
    </div>

    <div class="search-form-card">
        <h2><?php echo e(__('Qidiruv natijalari')); ?></h2>
        <form action="<?php echo e(route('products.filter')); ?>" method="GET" id="searchForm">
            <div class="search-form-grid">
                <div class="form-group">
                    <label for="ad_type"><?php echo e(__('E\'lon turi')); ?></label>
                    <select name="ad_type" id="ad_type">
                        <option value="All"><?php echo e(__('Hammasi')); ?></option>
                        <option value="sale" <?php echo e(request('ad_type') == 'sale' ? 'selected' : ''); ?>><?php echo e(__('Sotish')); ?></option>
                        <option value="rent" <?php echo e(request('ad_type') == 'rent' ? 'selected' : ''); ?>><?php echo e(__('Ijaraga')); ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="property_type"><?php echo e(__('Mulk turi')); ?></label>
                    <select name="property_type" id="property_type">
                        <option value="All"><?php echo e(__('Hammasi')); ?></option>
                        <option value="apartment" <?php echo e(request('property_type') == 'apartment' ? 'selected' : ''); ?>><?php echo e(__('Kvartira')); ?></option>
                        <option value="house" <?php echo e(request('property_type') == 'house' ? 'selected' : ''); ?>><?php echo e(__('Uy/Hovli')); ?></option>
                        <option value="land" <?php echo e(request('property_type') == 'land' ? 'selected' : ''); ?>><?php echo e(__('Yer')); ?></option>
                        <option value="commercial" <?php echo e(request('property_type') == 'commercial' ? 'selected' : ''); ?>><?php echo e(__('Tijorat binosi')); ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="rooms"><?php echo e(__('Xonalar soni')); ?></label>
                    <select name="rooms" id="rooms">
                        <option value="All"><?php echo e(__('Hammasi')); ?></option>
                        <?php for($i = 1; $i <= 5; $i++): ?>
                            <option value="<?php echo e($i); ?>" <?php echo e(request('rooms') == $i ? 'selected' : ''); ?>><?php echo e($i); ?> <?php echo e(__('xona')); ?></option>
                        <?php endfor; ?>
                        <option value="5+" <?php echo e(request('rooms') == '5+' ? 'selected' : ''); ?>>5+ <?php echo e(__('xona')); ?></option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="price_from"><?php echo e(__('Narx (dan)')); ?></label>
                    <input type="number" name="price_from" id="price_from" value="<?php echo e(request('price_from')); ?>" placeholder="<?php echo e(__('minimal narx')); ?>" min="0">
                </div>
                <div class="form-group">
                    <label for="price_to"><?php echo e(__('Narx (gacha)')); ?></label>
                    <input type="number" name="price_to" id="price_to" value="<?php echo e(request('price_to')); ?>" placeholder="<?php echo e(__('maksimal narx')); ?>" min="0">
                </div>
                <div class="form-group">
                    <label for="region"><?php echo e(__('Hudud')); ?></label>
                    <select name="region" id="region" onchange="fetchCities()">
                        <option value="All"><?php echo e(__('Hammasi')); ?></option>
                        <?php $__currentLoopData = $regions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $region): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($region->id); ?>" <?php echo e(request('region') == $region->id ? 'selected' : ''); ?>><?php echo e($region->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="city"><?php echo e(__('Shahar')); ?></label>
                    <select name="city" id="city">
                        <option value="All"><?php echo e(__('Hammasi')); ?></option>
                        <?php $__currentLoopData = $cities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $city): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <option value="<?php echo e($city->id); ?>" <?php echo e(request('city') == $city->id ? 'selected' : ''); ?>><?php echo e($city->name); ?></option>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </select>
                </div>
                <div class="more-filters-hidden" style="display: none;">
                    <div class="form-group">
                        <label for="floors"><?php echo e(__('Qavatlar soni')); ?></label>
                        <select name="floors" id="floors">
                            <option value="All"><?php echo e(__('Hammasi')); ?></option>
                            <?php for($i = 1; $i <= 5; $i++): ?>
                                <option value="<?php echo e($i); ?>" <?php echo e(request('floors') == $i ? 'selected' : ''); ?>><?php echo e($i); ?> <?php echo e(__('Qavat')); ?></option>
                            <?php endfor; ?>
                            <option value="6+" <?php echo e(request('floors') == '6+' ? 'selected' : ''); ?>>6+ <?php echo e(__('Qavat')); ?></option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="filter-actions">
                <button type="button" class="more-filters-btn" id="moreFiltersBtn">
                    <i class="bi bi-funnel-fill"></i> <?php echo e(__('Ko\'proq filterlar')); ?>

                </button>
                <div class="filter-buttons">
                    <button type="button" class="map-view-btn">
                        <i class="bi bi-geo-alt-fill"></i> <?php echo e(__('Xaritadan ko\'rish')); ?>

                    </button>
                    <button type="submit" class="show-ads-btn">
                        <i class="bi bi-search"></i> <?php echo e(__('Ko\'rish')); ?> <?php echo e($filteredProducts->total()); ?> <?php echo e(__('e\'lonlar')); ?>

                    </button>
                </div>
            </div>
        </form>
    </div>

    <script src="//unpkg.com/alpinejs" defer></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

    <section class="ads-listing-section py-6">
        <div class="container mx-auto px-4">
            <h2 class="text-xl font-semibold mb-4"><?php echo e(__('Topilgan e\'lonlar')); ?></h2>
            <?php if($filteredProducts->isEmpty()): ?>
                <p class="text-gray-500"><?php echo e(__('Hech qanday e\'lon topilmadi. Boshqa filterlarni sinab ko\'ring.')); ?></p>
            <?php else: ?>
                <div class="space-y-6">
                    <?php $__currentLoopData = $filteredProducts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="flex flex-col md:flex-row bg-white rounded-2xl shadow-md overflow-hidden hover:shadow-lg transition ad-card"
                             data-images='<?php echo e(json_encode($product->image_array ?? [])); ?>'>
                            <div class="relative md:w-1/3 w-full h-56 md:h-auto open-image-modal" x-data="{ currentIndex: 0 }">
                                <?php
                                    $images = [];
                                    if (!empty($product->images)) {
                                        if (is_array($product->images)) {
                                            $images = $product->images;
                                        } elseif (is_string($product->images)) {
                                            $decoded = json_decode($product->images, true);
                                            $images = is_array($decoded) ? $decoded : [];
                                        }
                                    }
                                ?>

                                <span class="top-2 left-2 bg-yellow-400 text-xs font-semibold px-2 py-1 rounded-md"><?php echo e(__('Yaxshi Taklif')); ?></span>
                                <div class="overflow-hidden w-full h-full relative">
                                   <?php $__currentLoopData = $product->productImages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <img src="<?php echo e(asset('storage/' . $image->path)); ?>" 
                                            x-show="currentIndex === <?php echo e($index); ?>" ...>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <?php if(count($images) > 1): ?>
                                    <button class="prev-button-card absolute top-1/2 left-3 -translate-y-1/2 bg-white/80 hover:bg-white p-2 rounded-full shadow"
                                            @click="currentIndex = (currentIndex === 0) ? <?php echo e(count($images) - 1); ?> : currentIndex - 1">‹</button>
                                    <button class="next-button-card absolute top-1/2 right-3 -translate-y-1/2 bg-white/80 hover:bg-white p-2 rounded-full shadow"
                                            @click="currentIndex = (currentIndex === <?php echo e(count($images) - 1); ?>) ? 0 : currentIndex + 1">›</button>
                                    <div class="absolute bottom-2 left-1/2 -translate-x-1/2 flex space-x-2">
                                        <?php $__currentLoopData = $images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="w-2 h-2 rounded-full" :class="currentIndex === <?php echo e($index); ?> ? 'bg-yellow-500' : 'bg-gray-300'"></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>

                            </div>

                            <div class="flex-1 p-4 flex flex-col justify-between">
                                <div>
                                    <div class="flex items-center justify-between mb-2">
                                        <span class="text-xs text-white bg-yellow-600 px-2 py-1 rounded-md">ID <?php echo e($product->id); ?></span>
                                        <span class="text-lg font-bold text-green-700"><?php echo e(number_format($product->price, 0, '.', ' ')); ?> USD</span>
                                    </div>
                                    <h3 class="text-base font-semibold text-gray-800"><?php echo e($product->category->name ?? __('Kategoriya yo‘q')); ?></h3>
                                    <p class="text-gray-600 text-sm mt-1 flex items-center gap-1"><i class="bi bi-geo-alt-fill"></i>
                                        <?php echo e($product->region->name ?? __('Hudud topilmadi')); ?>,
                                        <?php echo e($product->city->name ?? $product->district->name ?? __('Shahar topilmadi')); ?></p>
                                    <p class="text-gray-500 text-sm mt-1"><?php echo e(__('Mo‘ljal:')); ?> <?php echo e($product->landmark ?? __('Ko‘rsatilmagan')); ?></p>
                                    <p class="text-gray-500 text-sm mt-1">
                                        <?php echo e(__('Universitet:')); ?>

                                        <?php echo e($product->universities->first()?->university_name ?? __('Ko‘rsatilmagan')); ?>

                                    </p>
                                    <p class="text-gray-500 text-sm mt-1">
                                        <?php echo e(__('Metro:')); ?>

                                        <?php echo e($product->metros->first()?->metro_name ?? __('Ko‘rsatilmagan')); ?>

                                    </p>

                                </div>
                                <p class="text-gray-400 text-xs mt-3"><?php echo e(__('E\'lon joylangan sana:')); ?> <?php echo e($product->created_at->format('d.m.Y')); ?></p>
                            </div>
                            <div class="md:w-1/4 w-full border-t md:border-t-0 md:border-l border-gray-200 p-4 flex flex-col justify-between">
                                <div>
                                    <a href="tel:+998951606446">
                                        <button class="w-full bg-blue-600 text-white py-2 rounded-lg font-medium hover:bg-blue-700"><?php echo e(__('Telefon raqam')); ?></button>
                                    </a>
                                    <button class="w-full mt-2 bg-gray-200 text-gray-700 py-2 rounded-lg font-medium hover:bg-gray-300 open-contact-modal"
                                            data-product-name="<?php echo e($product->name); ?>" data-product-id="<?php echo e($product->id); ?>"><?php echo e(__('Biz bilan bog\'lanish')); ?></button>
                                </div>
                                <div class="grid grid-cols-2 gap-2 text-sm text-gray-700 mt-4">
                                    <?php if($product->floor > 0): ?>
                                        <span class="flex items-center gap-1 bg-gray-100 px-2 py-1 rounded-md">
                                            <img src="<?php echo e(asset('images/4465213.png')); ?>" alt="icon" class="w-4 h-4" onerror="this.src='https://placehold.co/20x20/CCCCCC/333333?text=Icon';">
                                            <?php echo e($product->floor); ?>/<?php echo e($product->building_floor); ?> etaj
                                        </span>
                                    <?php endif; ?>
                                    <?php if($product->rooms > 0): ?>
                                        <span class="flex items-center gap-1 bg-gray-100 px-2 py-1 rounded-md">
                                            <img src="<?php echo e(asset('images/2800060.png')); ?>" alt="icon" class="w-4 h-4" onerror="this.src='https://placehold.co/20x20/CCCCCC/333333?text=Icon';">
                                            <?php echo e($product->rooms); ?> xona
                                        </span>
                                    <?php endif; ?>
                                    <?php if($product->square > 0): ?>
                                        <span class="flex items-center gap-1 bg-gray-100 px-2 py-1 rounded-md">
                                            <img src="<?php echo e(asset('images/5024066.png')); ?>" alt="icon" class="w-4 h-4" onerror="this.src='https://placehold.co/20x20/CCCCCC/333333?text=Icon';">
                                            <?php echo e($product->square); ?> m²
                                        </span>
                                    <?php endif; ?>
                                </div>
                              
                                <?php if($product->features && $product->features->count()): ?>
                                    <div class="flex flex-wrap gap-2 mt-3">
                                        <?php $__currentLoopData = $product->features; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $feature): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <span class="text-xs bg-green-100 text-green-700 px-2 py-1 rounded-md"><?php echo e($feature->feature_name); ?></span>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                <?php endif; ?>
                                <div class="flex gap-2 mt-3">
                                    <?php if($product->exchange): ?><span class="text-xs border border-yellow-500 text-yellow-600 px-2 py-1 rounded-md">Ayirboshlash</span><?php endif; ?>
                                    <?php if($product->pay_in_installments): ?><span class="text-xs border border-green-500 text-green-600 px-2 py-1 rounded-md">Bo'lib to'lash</span><?php endif; ?>
                                    <?php if($product->credit): ?><span class="text-xs border border-blue-500 text-blue-600 px-2 py-1 rounded-md">Ipoteka</span><?php endif; ?>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <div class="mt-6"><?php echo e($filteredProducts->links()); ?></div>
            <?php endif; ?>
        </div>

    </section>

    <div id="quickContactModal" class="modal">
        <div class="modal-content">
            <span class="close-button" id="closeContactModal">×</span>
            <div class="modal-header">
                <h3><?php echo e(__('Tezkor Murojaat')); ?></h3>
                <p class="modal-product-info"><?php echo e(__('E\'lon:')); ?> <span id="modalProductName"></span> (ID: <span id="modalProductId"></span>)</p>
            </div>
            <form id="contactForm">
                <div class="form-group">
                    <label for="contactName"><?php echo e(__('Ismingiz:')); ?></label>
                    <input type="text" id="contactName" name="name" placeholder="<?php echo e(__('Ismingizni kiriting')); ?>" required>
                </div>
                <div class="form-group">
                    <label for="contactPhone"><?php echo e(__('Telefon raqamingiz:')); ?></label>
                    <input type="tel" id="contactPhone" name="phone" placeholder="+998 (XX) XXX-XX-XX" required>
                </div>
                <button type="submit" class="submit-contact-button"><?php echo e(__('Yuborish')); ?></button>
            </form>
        </div>
    </div>

    <div id="successModal" class="modal">
        <div class="modal-content success-content">
            <span class="close-button" id="closeSuccessModal">×</span>
            <div class="success-icon">
                <div class="checkmark-circle">
                    <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                        <circle class="checkmark-circle-path" cx="26" cy="26" r="25" fill="none"/>
                        <path class="checkmark-check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8"/>
                    </svg>
                </div>
            </div>
            <h3><?php echo e(__('Murojaatingiz qabul qilindi!')); ?></h3>
            <p><?php echo e(__('Tez orada siz bilan bog\'lanamiz.')); ?></p>
        </div>
    </div>

    <div id="imageModal" class="modal">
        <div class="modal-content image-modal-content">
            <span class="close-button" id="closeImageModal">×</span>
            <div class="image-modal-container">
                <img src="" alt="Property Image" class="modal-image" id="modalImage">
                <button class="nav-button-modal prev-button-modal"><i class="bi bi-chevron-left"></i></button>
                <button class="nav-button-modal next-button-modal"><i class="bi bi-chevron-right"></i></button>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(() => $('#contactPhone').inputmask({
            mask: "+998 (99) 999-99-99",
            clearIncomplete: true,
            showMaskOnHover: false,
            onBeforePaste: pastedValue => pastedValue.replace(/^\+998/, '')
        }));

        const fetchCities = () => {
            const regionId = document.getElementById('region').value;
            const citySelect = document.getElementById('city');
            citySelect.innerHTML = '<option value="All"><?php echo e(__('Loading...')); ?></option>';
            citySelect.disabled = true;

            if (regionId && regionId !== 'All') {
                fetch(`/get-cities/${regionId}`, {
                    method: 'GET',
                    headers: { 'Accept': 'application/json', 'X-Requested-With': 'XMLHttpRequest' }
                })
                    .then(response => {
                        if (!response.ok) throw new Error(`HTTP error! Status: ${response.status}`);
                        return response.json();
                    })
                    .then(data => {
                        citySelect.innerHTML = '<option value="All"><?php echo e(__('Hammasi')); ?></option>';
                        if (data.length) {
                            data.forEach(city => {
                                const option = new Option(city.name, city.id);
                                option.selected = '<?php echo e(request('city')); ?>' == city.id;
                                citySelect.add(option);
                            });
                            citySelect.disabled = false;
                        } else {
                            citySelect.innerHTML = '<option value="All"><?php echo e(__('No cities found')); ?></option>';
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching cities:', error);
                        citySelect.innerHTML = '<option value="All"><?php echo e(__('Error loading cities')); ?></option>';
                    });
            } else {
                citySelect.innerHTML = '<option value="All"><?php echo e(__('Hammasi')); ?></option>';
                citySelect.disabled = true;
            }
        };

        document.addEventListener('DOMContentLoaded', () => {
            const modals = { contact: '#quickContactModal', success: '#successModal', image: '#imageModal' };
            const buttons = {
                openContact: document.querySelectorAll('.open-contact-modal'),
                openImage: document.querySelectorAll('.open-image-modal'),
                close: document.querySelector('#closeContactModal'),
                closeSuccess: document.querySelector('#closeSuccessModal'),
                closeImage: document.querySelector('#closeImageModal'),
                prevImage: document.querySelector('.prev-button-modal'),
                nextImage: document.querySelector('.next-button-modal')
            };
            const form = document.getElementById('contactForm');
            const elements = {
                productName: document.getElementById('modalProductName'),
                productId: document.getElementById('modalProductId'),
                modalImage: document.getElementById('modalImage'),
                submitBtn: form.querySelector('.submit-contact-button')
            };

            let currentImages = [], currentIndex = 0;
            const TELEGRAM_BOT_TOKEN = '8324622390:AAHTibxtx1NfrBz-P6NREXKZEboIqx8VxQI';
            const TELEGRAM_CHAT_ID = '-1002718251790';

            buttons.openContact.forEach(btn => btn.addEventListener('click', () => {
                elements.productName.textContent = btn.dataset.productName || 'Noma’lum e’lon';
                elements.productId.textContent = btn.dataset.productId || 'Noma’lum ID';
                document.querySelector(modals.contact).style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }));

            buttons.openImage.forEach(btn => btn.addEventListener('click', e => {
                if (e.target.tagName === 'BUTTON') return;
                const card = btn.closest('.ad-card');
                currentImages = JSON.parse(card.dataset.images || '[]') || [];
                currentIndex = 0;
                elements.modalImage.src = currentImages.length ? "<?php echo e(asset('storage/')); ?>" + currentImages[currentIndex] : "https://placehold.co/400x300/CCCCCC/333333?text=Rasm+Yo‘q";
                elements.modalImage.onerror = () => elements.modalImage.src = "https://placehold.co/400x300/CCCCCC/333333?text=Rasm+Yo‘q";
                document.querySelector(modals.image).style.display = 'flex';
                document.body.style.overflow = 'hidden';
            }));

            [buttons.close, buttons.closeSuccess, buttons.closeImage].forEach(closeBtn => closeBtn.addEventListener('click', () => {
                closeBtn.closest('.modal').style.display = 'none';
                document.body.style.overflow = 'auto';
            }));

            window.addEventListener('click', e => Object.values(modals).forEach(modal => {
                if (e.target === document.querySelector(modal)) {
                    document.querySelector(modal).style.display = 'none';
                    document.body.style.overflow = 'auto';
                }
            }));

            buttons.prevImage.addEventListener('click', () => {
                if (currentImages.length) {
                    currentIndex = (currentIndex - 1 + currentImages.length) % currentImages.length;
                    elements.modalImage.style.opacity = '0';
                    setTimeout(() => {
                        elements.modalImage.src = "<?php echo e(asset('storage/')); ?>" + currentImages[currentIndex];
                        elements.modalImage.style.opacity = '1';
                    }, 300);
                    elements.modalImage.onerror = () => elements.modalImage.src = "https://placehold.co/400x300/CCCCCC/333333?text=Rasm+Yo‘q";
                }
            });

            buttons.nextImage.addEventListener('click', () => {
                if (currentImages.length) {
                    currentIndex = (currentIndex + 1) % currentImages.length;
                    elements.modalImage.style.opacity = '0';
                    setTimeout(() => {
                        elements.modalImage.src = "<?php echo e(asset('storage/')); ?>" + currentImages[currentIndex];
                        elements.modalImage.style.opacity = '1';
                    }, 300);
                    elements.modalImage.onerror = () => elements.modalImage.src = "https://placehold.co/400x300/CCCCCC/333333?text=Rasm+Yo‘q";
                }
            });

            form.addEventListener('submit', e => {
                e.preventDefault();
                const name = document.getElementById('contactName').value;
                const phone = document.getElementById('contactPhone').value;
                if (phone.length < "+998 (99) 999-99-99".length) {
                    alert("Iltimos, telefon raqamini to'liq kiriting.");
                    return;
                }

                const message = `Yangi murojaat!\n\nIsmi: ${name}\nTelefon raqami: ${phone}\nQiziqish bildirgan e'lon: ${elements.productName.textContent}\nE'lon ID: ${elements.productId.textContent}`;
                elements.submitBtn.disabled = true;
                elements.submitBtn.innerHTML = '<i class="bi bi-arrow-clockwise rotate-animation"></i> <?php echo e(__('Yuborilmoqda...')); ?>';

                fetch(`https://api.telegram.org/bot${TELEGRAM_BOT_TOKEN}/sendMessage`, {
                    method: 'POST',
                    headers: { 'Content-Type': 'application/json' },
                    body: JSON.stringify({ chat_id: TELEGRAM_CHAT_ID, text: message })
                })
                    .then(response => response.json())
                    .then(() => {
                        document.querySelector(modals.contact).style.display = 'none';
                        document.querySelector(modals.success).style.display = 'flex';
                        document.querySelector(modals.success).querySelector('.checkmark-circle').classList.add('animate');
                        form.reset();
                    })
                    .catch(() => alert('Murojaat yuborishda xatolik yuz berdi. Iltimos, qayta urinib ko\'ring.'))
                    .finally(() => {
                        elements.submitBtn.disabled = false;
                        elements.submitBtn.innerHTML = '<?php echo e(__('Yuborish')); ?>';
                    });
            });

            document.querySelectorAll('.ad-card').forEach(card => {
                const images = card.querySelectorAll('.ad-image');
                const [prevBtn, nextBtn] = [card.querySelector('.prev-button-card'), card.querySelector('.next-button-card')];
                const allImages = JSON.parse(card.dataset.images || '[]') || [];
                let currentIndex = 0;

                const updateImage = index => {
                    if (allImages.length) {
                        currentIndex = (index + allImages.length) % allImages.length;
                        images.forEach((img, i) => {
                            img.style.opacity = i === currentIndex ? '1' : '0';
                            img.onerror = () => img.src = "https://placehold.co/400x300/CCCCCC/333333?text=Rasm+Yo‘q";
                        });
                    }
                };

                if (allImages.length) updateImage(0);
                [prevBtn, nextBtn].forEach((btn, i) => btn?.addEventListener('click', () => updateImage(currentIndex + (i ? 1 : -1))));
            });

            const moreFiltersBtn = document.getElementById('moreFiltersBtn');
    

            fetchCities();

            const toggleDropdown = (selector, menuClass) => {
                document.querySelector(selector)?.addEventListener('click', e => {
                    e.stopPropagation();
                    document.querySelector(menuClass)?.classList.toggle('hidden');
                });
            };

            toggleDropdown('.language-selector', '.language-menu');
            toggleDropdown('.currency-selector', '.currency-menu');

            document.querySelectorAll('.menu-icon, .dropdown-modal')?.forEach(el => el.addEventListener('click', e => e.stopPropagation()));
            document.addEventListener('click', () => {
                ['.language-menu', '.currency-menu', '.dropdown-modal'].forEach(cls => document.querySelector(cls)?.classList.add('hidden'));
            });
        });
    </script>
</body>
</html><?php /**PATH C:\Users\Asus\Desktop\Projects\UyTop\resources\views/filtered_products.blade.php ENDPATH**/ ?>