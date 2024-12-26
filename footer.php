
<footer class="footer">
    <div class="container-fluid">
        <div class="social-icons">
            <a href="https://twitter.com" target="_blank" class="social-link">
                <i class="bi bi-twitter"></i>
            </a>
            <a href="https://facebook.com" target="_blank" class="social-link">
                <i class="bi bi-facebook"></i>
            </a>
            <a href="https://linkedin.com" target="_blank" class="social-link">
                <i class="bi bi-linkedin"></i>
            </a>
        </div>
        <p class="footer-text">© <?php echo date('Y'); ?> TIES Pharmacy App. All Rights Reserved. </p>
        <p class="footer-text">
                Terms of Service | Privacy Policy
        </p>
    </div>
  
</footer>
<script>
// Animasi fade-in untuk footer
document.addEventListener('DOMContentLoaded', () => {
    const footer = document.querySelector('.footer');
    footer.style.opacity = 0;
    footer.style.transition = 'opacity 1s ease-in-out';

    // Efek fade-in
    setTimeout(() => {
        footer.style.opacity = 1;
    }, 500);
});
</script>


<style>
html, body {
    height: 100%; /* Memastikan halaman menggunakan 100% tinggi layar */
    margin: 0;
    display: flex;
    flex-direction: column;
}

/* Memastikan main mengambil ruang yang tersisa antara navbar dan footer */
main {
    flex-grow: 1;
    display: flex;
    flex-direction: column;
}

/* CSS footer */
.footer {
    background-color: #F06292; 
    color: #ffffff; 
    padding: 10px 0;
    text-align: center;
    width: 100%;
    position: relative;
    bottom: 0;
    margin-top: auto; /* Memastikan footer selalu di bawah halaman */
}

.social-icons {
    margin-bottom: 10px;
}

.social-link {
    color: #ffffff;
    font-size: 1.5rem;
    margin: 0 10px;
    transition: color 0.3s ease, transform 0.3s ease;
}

.social-link:hover {
    color: #17a2b8; 
    transform: scale(1.2); /* Slight zoom effect */
}

.footer-text {
    font-size: 0.9rem;
    margin-top: 10px;
    color: #ffffff;
}

.footer-text a {
    color: #17a2b8; 
    text-decoration: none;
}
</style>
