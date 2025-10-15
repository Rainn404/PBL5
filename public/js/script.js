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
// FAQ Accordion
document.addEventListener('DOMContentLoaded', function() {
    // FAQ functionality
    const faqItems = document.querySelectorAll('.faq-item');
    faqItems.forEach(item => {
        const question = item.querySelector('.faq-question');
        question.addEventListener('click', () => {
            item.classList.toggle('active');
        });
    });

    // Password toggle
    const togglePassword = document.getElementById('togglePassword');
    const passwordInput = document.getElementById('password');
    
    if (togglePassword && passwordInput) {
        togglePassword.addEventListener('click', function() {
            const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
            passwordInput.setAttribute('type', type);
            this.querySelector('i').classList.toggle('fa-eye');
            this.querySelector('i').classList.toggle('fa-eye-slash');
        });
    }

    // Prestasi filter functionality
    const tahunFilter = document.getElementById('tahun-filter');
    const tingkatFilter = document.getElementById('tingkat-filter');
    const kategoriFilter = document.getElementById('kategori-filter');
    const searchPrestasi = document.getElementById('search-prestasi');
    const prestasiCards = document.querySelectorAll('.prestasi-card-large');

    function filterPrestasi() {
        const tahunValue = tahunFilter?.value || 'all';
        const tingkatValue = tingkatFilter?.value || 'all';
        const kategoriValue = kategoriFilter?.value || 'all';
        const searchValue = searchPrestasi?.value.toLowerCase() || '';

        prestasiCards.forEach(card => {
            const cardTahun = card.getAttribute('data-tahun');
            const cardTingkat = card.getAttribute('data-tingkat');
            const cardKategori = card.getAttribute('data-kategori');
            const cardText = card.textContent.toLowerCase();

            const tahunMatch = tahunValue === 'all' || cardTahun === tahunValue;
            const tingkatMatch = tingkatValue === 'all' || cardTingkat === tingkatValue;
            const kategoriMatch = kategoriValue === 'all' || cardKategori === kategoriValue;
            const searchMatch = cardText.includes(searchValue);

            if (tahunMatch && tingkatMatch && kategoriMatch && searchMatch) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }
        });
    }

    if (tahunFilter) tahunFilter.addEventListener('change', filterPrestasi);
    if (tingkatFilter) tingkatFilter.addEventListener('change', filterPrestasi);
    if (kategoriFilter) kategoriFilter.addEventListener('change', filterPrestasi);
    if (searchPrestasi) searchPrestasi.addEventListener('input', filterPrestasi);

    // Form submission
    const pendaftaranForm = document.getElementById('pendaftaranForm');
    if (pendaftaranForm) {
        pendaftaranForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Here you would typically send the form data to the server
            alert('Formulir pendaftaran berhasil dikirim! Kami akan menghubungi Anda melalui email.');
            this.reset();
        });
    }

    const loginForm = document.getElementById('loginForm');
    if (loginForm) {
        loginForm.addEventListener('submit', function(e) {
            e.preventDefault();
            // Here you would typically send the login data to the server
            alert('Login berhasil! Mengarahkan ke dashboard...');
        });
    }

    // Load more prestasi
    const loadMoreBtn = document.getElementById('loadMorePrestasi');
    if (loadMoreBtn) {
        loadMoreBtn.addEventListener('click', function() {
            // Simulate loading more content
            this.textContent = 'Memuat...';
            this.disabled = true;
            
            setTimeout(() => {
                this.textContent = 'Muat Lebih Banyak';
                this.disabled = false;
                alert('Fitur ini akan menampilkan lebih banyak prestasi ketika diintegrasikan dengan database.');
            }, 1000);
        });
    }
});