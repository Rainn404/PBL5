// Mobile Navigation Toggle
document.addEventListener('DOMContentLoaded', function() {
    const navToggle = document.getElementById('navToggle');
    const navMenu = document.getElementById('navMenu');
    
    if (navToggle) {
        navToggle.addEventListener('click', function() {
            navMenu.classList.toggle('active');
            navToggle.classList.toggle('active');
        });
    }
    
    // Close mobile menu when clicking on a link
    const navLinks = document.querySelectorAll('.nav-link');
    navLinks.forEach(link => {
        link.addEventListener('click', () => {
            navMenu.classList.remove('active');
            navToggle.classList.remove('active');
        });
    });
    
    // Smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                window.scrollTo({
                    top: targetElement.offsetTop - 70,
                    behavior: 'smooth'
                });
            }
        });
    });
    
    // Add scroll effect to navbar
    window.addEventListener('scroll', function() {
        const navbar = document.querySelector('.navbar');
        if (window.scrollY > 100) {
            navbar.style.backgroundColor = 'rgba(255, 255, 255, 0.95)';
            navbar.style.backdropFilter = 'blur(10px)';
        } else {
            navbar.style.backgroundColor = 'var(--white)';
            navbar.style.backdropFilter = 'none';
        }
    });

    // Anggota Filter Functionality
    const divisiFilter = document.getElementById('divisi-filter');
    const semesterFilter = document.getElementById('semester-filter');
    const searchInput = document.getElementById('search-anggota');
    const anggotaCards = document.querySelectorAll('.anggota-card');

    function filterAnggota() {
        const divisiValue = divisiFilter.value;
        const semesterValue = semesterFilter.value;
        const searchValue = searchInput.value.toLowerCase();

        anggotaCards.forEach(card => {
            const cardDivisi = card.getAttribute('data-divisi');
            const cardSemester = card.getAttribute('data-semester');
            const cardName = card.querySelector('h3').textContent.toLowerCase();

            const divisiMatch = divisiValue === 'all' || cardDivisi === divisiValue;
            const semesterMatch = semesterValue === 'all' || cardSemester === semesterValue;
            const searchMatch = cardName.includes(searchValue);

            if (divisiMatch && semesterMatch && searchMatch) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    if (divisiFilter) divisiFilter.addEventListener('change', filterAnggota);
    if (semesterFilter) semesterFilter.addEventListener('change', filterAnggota);
    if (searchInput) searchInput.addEventListener('input', filterAnggota);

    // Pagination functionality
    const pageButtons = document.querySelectorAll('.page-btn');
    pageButtons.forEach(button => {
        button.addEventListener('click', function() {
            if (!this.classList.contains('active')) {
                document.querySelector('.page-btn.active').classList.remove('active');
                this.classList.add('active');
                // Here you would typically load new page content via AJAX
            }
        });
    });
});