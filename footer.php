<?php
// Footer
?>
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
        <p class="footer-text">© <?php echo date('Y'); ?> TIES Pharmacy App. All Rights Reserved. 
            <a href="#">Terms of Service</a> | <a href="#">Privacy Policy</a>
        </p>
    </div>
</footer>


<style>
/* Footer Container */
.footer {
    background-color: #343a40; /* Dark background */
    color: #ffffff; /* White text */
    padding: 20px 0;
    text-align: center;
    position: relative;
    bottom: 0;
    width: 100%;
}

/* Social Icons */
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
    color: #17a2b8; /* Light blue color on hover */
    transform: scale(1.2); /* Slight zoom effect */
}

/* Footer Text */
.footer-text {
    font-size: 0.9rem;
    margin-top: 10px;
    color: #cccccc;
}

.footer-text a {
    color: #17a2b8; /* Light blue for links */
    text-decoration: none;
}

.footer-text a:hover {
    text-decoration: underline;
}
</style>

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
