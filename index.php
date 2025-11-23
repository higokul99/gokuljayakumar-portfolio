<?php
require_once 'functions.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars(get_setting('site_title')); ?></title>
    <link rel="icon" type="image/png" href="gokul-jayakumar.jpg">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Header -->
    <header id="header">
        <div class="container header-content">
            <div class="logo">
                <h1><?php echo htmlspecialchars(get_setting('header_logo_part1')); ?><span>  <?php echo htmlspecialchars(get_setting('header_logo_part2')); ?></span></h1>
            </div>
            <div class="menu-toggle">&#9776;</div>
            <nav>
                <ul>
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#experience">Experience</a></li>
                    <li><a href="#education">Education</a></li>
                    <li><a href="#achievements">Achievements</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- Hero Section -->
    <section id="home" class="hero">
        <div class="container hero-content">
            <div class="hero-text">
                <h1><?php echo htmlspecialchars(get_setting('hero_title_prefix')); ?> <span><?php echo htmlspecialchars(get_setting('hero_title_name')); ?></span></h1>
                <p><?php echo htmlspecialchars(get_setting('hero_description')); ?></p>
                <div class="hero-buttons">
                    <a href="#contact" class="btn btn-primary">Contact Me</a>
                    <a href="<?php echo htmlspecialchars(get_setting('resume_link')); ?>" class="btn btn-secondary" target="_blank">My Resume</a>
                </div>
            </div>
            <div class="hero-image">
                <img src="gokul-jayakumar.jpg" alt="Gokul Jayakumar">
            </div>
        </div>
    </section>

    <!-- About Section -->
    <section id="about">
        <div class="container">
            <div class="section-header">
                <h2><?php echo htmlspecialchars(get_setting('about_title')); ?></h2>
                <p><?php echo htmlspecialchars(get_setting('about_subtitle')); ?></p>
            </div>
            <div class="about-content">
                <div class="about-text">
                    <h3><?php echo htmlspecialchars(get_setting('about_detailed_title')); ?></h3>
                    <p><?php echo get_setting('about_detailed_text'); // Allow HTML here as per setup ?></p>
                    
                    <ul class="info-list">
                        <li>
                            <strong>Email</strong>
                            <span><?php echo htmlspecialchars(get_setting('contact_email')); ?></span>
                        </li>
                        <li>
                            <strong>Phone</strong>
                            <span><?php echo htmlspecialchars(get_setting('contact_phone')); ?></span>
                        </li>
                        <li>
                            <strong>LinkedIn</strong>
                            <span><a href="<?php echo htmlspecialchars(get_setting('contact_linkedin')); ?>" target="_blank">linkedin.com/in/gokul-jayakumar</a></span>
                        </li>
                        <li>
                            <strong>github</strong>
                            <span><a href="<?php echo htmlspecialchars(get_setting('contact_github')); ?>" target="_blank">github.com/higokul99</a></span>
                        </li>
                    </ul>
                    
                    <h3>Technical Skills</h3>
                    <div class="skills">
                        <?php
                        $skills = get_all_skills();
                        while($skill = $skills->fetch_assoc()):
                        ?>
                            <span class="skill-tag"><?php echo htmlspecialchars($skill['name']); ?></span>
                        <?php endwhile; ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Experience Section -->
    <section id="experience" class="experience">
        <div class="container">
            <div class="section-header">
                <h2>Work Experience</h2>
                <p>My professional journey and key responsibilities</p>
            </div>
            <div class="timeline">
                <?php
                $experiences = get_all_experiences();
                while($exp = $experiences->fetch_assoc()):
                ?>
                <div class="timeline-item">
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <div class="timeline-date"><?php echo htmlspecialchars($exp['date_range']); ?></div>
                        <h3 class="timeline-title"><?php echo htmlspecialchars($exp['title']); ?></h3>
                        <h4 class="timeline-subtitle"><?php echo htmlspecialchars($exp['company']); ?></h4>
                        <div class="timeline-description">
                            <?php echo $exp['description']; // Allow HTML ?>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <!-- Education Section -->
    <section id="education">
        <div class="container">
            <div class="section-header">
                <h2>Education</h2>
                <p>My academic background and qualifications</p>
            </div>
            <div class="education-container">
                <?php
                $education = get_all_education();
                while($edu = $education->fetch_assoc()):
                ?>
                <div class="education-item">
                    <div class="education-date"><?php echo htmlspecialchars($edu['date_range']); ?></div>
                    <h3 class="education-title"><?php echo htmlspecialchars($edu['degree']); ?></h3>
                    <h4 class="education-subtitle"><?php echo htmlspecialchars($edu['school']); ?></h4>
                    <div class="education-score"><?php echo htmlspecialchars($edu['score']); ?></div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <!-- Achievements Section -->
    <section id="achievements" class="achievements">
        <div class="container">
            <div class="section-header">
                <h2>Achievements</h2>
                <p>Recognitions and accomplishments throughout my career</p>
            </div>
            <div class="achievements-container">
                <?php
                $achievements = get_all_achievements();
                while($ach = $achievements->fetch_assoc()):
                ?>
                <div class="achievement-card">
                    <h3 class="achievement-title"><?php echo htmlspecialchars($ach['title']); ?></h3>
                    <p class="achievement-description"><?php echo htmlspecialchars($ach['description']); ?></p>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <!-- Certifications Section -->
    <section id="certifications">
        <div class="container">
            <div class="section-header">
                <h2>Certifications</h2>
                <p>Professional certifications and continuous learning achievements</p>
            </div>
            <div class="certifications-container">
                <?php
                $certifications = get_all_certifications();
                while($cert = $certifications->fetch_assoc()):
                ?>
                <div class="certification-card">
                    <img src="<?php echo htmlspecialchars($cert['image_url']); ?>" alt="<?php echo htmlspecialchars($cert['title']); ?>" class="certification-logo">
                    <h3 class="certification-title"><?php echo htmlspecialchars($cert['title']); ?></h3>
                    <p class="certification-issuer"><?php echo htmlspecialchars($cert['issuer']); ?></p>
                    <p><?php echo htmlspecialchars($cert['description']); ?></p>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact">
        <div class="container">
            <div class="section-header">
                <h2>Contact Me</h2>
                <p>Get in touch for opportunities, collaborations, or just to say hello</p>
            </div>
            <div class="contact-container">
                <div class="contact-grid">
                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M22 16.92V19.92C22.0011 20.1985 21.9441 20.4742 21.8325 20.7293C21.7209 20.9845 21.5573 21.2136 21.3521 21.4019C21.1468 21.5901 20.9046 21.7335 20.6407 21.8227C20.3769 21.9119 20.0974 21.9451 19.82 21.92C16.7428 21.5856 13.787 20.5341 11.19 18.85C8.77382 17.3147 6.72533 15.2662 5.19 12.85C3.49998 10.2412 2.44824 7.27099 2.12 4.18C2.09501 3.90347 2.12788 3.62476 2.21649 3.36162C2.3051 3.09849 2.44745 2.85669 2.63455 2.65162C2.82165 2.44655 3.04974 2.28271 3.30372 2.17052C3.55771 2.05833 3.83227 2.00026 4.11 2H7.11C7.59531 1.99522 8.06711 2.16708 8.43849 2.48353C8.80988 2.79999 9.05434 3.23945 9.13 3.72C9.27446 4.68007 9.52184 5.62273 9.87 6.53C9.9901 6.88792 10.0175 7.27691 9.94924 7.65088C9.88101 8.02485 9.71005 8.37242 9.46 8.65L8.09 10.02C9.51356 12.555 11.445 14.4865 13.98 15.91L15.35 14.54C15.6276 14.2899 15.9751 14.119 16.3491 14.0508C16.7231 13.9825 17.1121 14.0099 17.47 14.13C18.3773 14.4782 19.3199 14.7255 20.28 14.87C20.7658 14.9466 21.2094 15.1945 21.5265 15.5705C21.8437 15.9466 22.0122 16.4222 22 16.92Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="contact-text">
                            <h3>Phone</h3>
                            <a href="tel:<?php echo htmlspecialchars(get_setting('contact_phone')); ?>"><?php echo htmlspecialchars(get_setting('contact_phone')); ?></a>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M4 4H20C21.1 4 22 4.9 22 6V18C22 19.1 21.1 20 20 20H4C2.9 20 2 19.1 2 18V6C2 4.9 2.9 4 4 4Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <polyline points="22,6 12,13 2,6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                        <div class="contact-text">
                            <h3>Email</h3>
                            <a href="mailto:<?php echo htmlspecialchars(get_setting('contact_email')); ?>"><?php echo htmlspecialchars(get_setting('contact_email')); ?></a>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893A11.821 11.821 0 0020.465 3.516z" fill="currentColor"/>
                            </svg>
                        </div>
                        <div class="contact-text">
                            <h3>WhatsApp</h3>
                            <a href="<?php echo htmlspecialchars(get_setting('contact_whatsapp')); ?>" target="_blank"><?php echo htmlspecialchars(get_setting('contact_phone')); ?></a>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M20.447 20.452h-3.554v-5.569c0-1.328-.027-3.037-1.852-3.037-1.853 0-2.136 1.445-2.136 2.939v5.667H9.351V9h3.414v1.561h.046c.477-.9 1.637-1.85 3.37-1.85 3.601 0 4.267 2.37 4.267 5.455v6.286zM5.337 7.433c-1.144 0-2.063-.926-2.063-2.065 0-1.138.92-2.063 2.063-2.063 1.14 0 2.064.925 2.064 2.063 0 1.139-.925 2.065-2.064 2.065zm1.782 13.019H3.555V9h3.564v11.452zM22.225 0H1.771C.792 0 0 .774 0 1.729v20.542C0 23.227.792 24 1.771 24h20.451C23.2 24 24 23.227 24 22.271V1.729C24 .774 23.2 0 22.222 0h.003z" fill="currentColor"/>
                            </svg>
                        </div>
                        <div class="contact-text">
                            <h3>LinkedIn</h3>
                            <a href="<?php echo htmlspecialchars(get_setting('contact_linkedin')); ?>" target="_blank">linkedin.com/in/gokul-jayakumar</a>
                        </div>
                    </div>

                    <div class="contact-item">
                        <div class="contact-icon">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12 0c-6.626 0-12 5.373-12 12 0 5.302 3.438 9.8 8.207 11.387.599.111.793-.261.793-.577v-2.234c-3.338.726-4.033-1.416-4.033-1.416-.546-1.387-1.333-1.756-1.333-1.756-1.089-.745.083-.729.083-.729 1.205.084 1.839 1.237 1.839 1.237 1.07 1.834 2.807 1.304 3.492.997.107-.775.418-1.305.762-1.604-2.665-.305-5.467-1.334-5.467-5.931 0-1.311.469-2.381 1.236-3.221-.124-.303-.535-1.524.117-3.176 0 0 1.008-.322 3.301 1.23.957-.266 1.983-.399 3.003-.404 1.02.005 2.047.138 3.006.404 2.291-1.552 3.297-1.23 3.297-1.23.653 1.653.242 2.874.118 3.176.77.84 1.235 1.911 1.235 3.221 0 4.609-2.807 5.624-5.479 5.921.43.372.823 1.102.823 2.222v3.293c0 .319.192.694.801.576 4.765-1.589 8.199-6.086 8.199-11.386 0-6.627-5.373-12-12-12z" fill="currentColor"/>
                            </svg>
                        </div>
                        <div class="contact-text">
                            <h3>GitHub</h3>
                            <a href="<?php echo htmlspecialchars(get_setting('contact_github')); ?>" target="_blank">github.com/higokul99</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3><?php echo htmlspecialchars(get_setting('header_logo_part1')) . ' ' . htmlspecialchars(get_setting('header_logo_part2')); ?></h3>
                    <p><?php echo htmlspecialchars(get_setting('footer_text')); ?></p>
                    <div class="social-links">
                        <a href="<?php echo htmlspecialchars(get_setting('contact_linkedin')); ?>" class="social-icon" target="_blank">in</a>
                        <a href="<?php echo htmlspecialchars(get_setting('contact_github')); ?>" class="social-icon" target="_blank">GH</a>
                    </div>
                </div>
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul class="footer-links">
                        <li><a href="#home">Home</a></li>
                        <li><a href="#about">About Me</a></li>
                        <li><a href="#experience">Experience</a></li>
                        <li><a href="#education">Education</a></li>
                        <li><a href="#achievements">Achievements</a></li>
                        <li><a href="#certifications">Certifications</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-column">
                    <h3>Skills</h3>
                    <ul class="footer-links">
                        <?php
                        // Fetch first 5 skills for footer
                        $sql = "SELECT * FROM skills ORDER BY order_index ASC LIMIT 5";
                        $footer_skills = $conn->query($sql);
                        while($f_skill = $footer_skills->fetch_assoc()):
                        ?>
                        <li><a href="#"><?php echo htmlspecialchars($f_skill['name']); ?></a></li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            </div>
            <div class="footer-bottom">
                <p><?php echo htmlspecialchars(get_setting('footer_copyright')); ?></p>
            </div>
        </div>
    </footer>

    <!-- Back to Top Button -->
    <a href="#" class="back-to-top">↑</a>

    <!-- JavaScript for functionality -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Mobile Menu Toggle
            const menuToggle = document.querySelector('.menu-toggle');
            const navMenu = document.querySelector('nav ul');
            
            menuToggle.addEventListener('click', function() {
                navMenu.classList.toggle('active');
            });
            
            // Smooth Scrolling for Navigation Links
            const navLinks = document.querySelectorAll('header nav ul li a, .hero-buttons a, .footer-links a');
            
            navLinks.forEach(link => {
                link.addEventListener('click', function(e) {
                    if(this.getAttribute('href').startsWith('#')) {
                        e.preventDefault();
                        
                        const targetId = this.getAttribute('href');
                        const targetSection = document.querySelector(targetId);
                        
                        if(targetSection) {
                            window.scrollTo({
                                top: targetSection.offsetTop - 80,
                                behavior: 'smooth'
                            });
                            
                            // Close mobile menu after clicking a link
                            navMenu.classList.remove('active');
                        }
                    }
                });
            });
            
            // Back to Top Button
            const backToTopBtn = document.querySelector('.back-to-top');
            
            window.addEventListener('scroll', function() {
                if(window.pageYOffset > 300) {
                    backToTopBtn.classList.add('show');
                } else {
                    backToTopBtn.classList.remove('show');
                }
            });
            
            backToTopBtn.addEventListener('click', function(e) {
                e.preventDefault();
                window.scrollTo({
                    top: 0,
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html>
