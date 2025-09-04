<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Clinique Santé - Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #1a75bc;
            --secondary: #0b5394;
            --accent: #32a852;
            --light-blue: #e8f4ff;
            --light-gray: #f8f9fa;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            color: #333;
        }
        
        .navbar {
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            color: var(--primary);
            font-weight: 700;
        }
        
        .nav-link {
            color: #555;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .nav-link:hover {
            color: var(--primary);
        }
        
        .btn-primary {
            background-color: var(--primary);
            border-color: var(--primary);
        }
        
        .btn-primary:hover {
            background-color: var(--secondary);
            border-color: var(--secondary);
        }
        
        .hero-section {
            background: linear-gradient(rgba(26, 117, 188, 0.8), rgba(11, 83, 148, 0.8)), url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100"><rect fill="%23f8f9fa" width="100" height="100"/><path d="M0,0 L100,100 M100,0 L0,100" stroke="%23e8f4ff" stroke-width="1"/></svg>');
            background-size: cover;
            color: white;
            padding: 100px 0;
        }
        
        .section-title {
            position: relative;
            margin-bottom: 40px;
            font-weight: 700;
            color: var(--primary);
        }
        
        .section-title:after {
            content: '';
            display: block;
            width: 60px;
            height: 3px;
            background: var(--accent);
            margin: 15px auto 0;
        }
        
        .card {
            border: none;
            border-radius: 10px;
            transition: transform 0.3s, box-shadow 0.3s;
            overflow: hidden;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .service-card {
            height: 100%;
            padding: 25px 15px;
            text-align: center;
        }
        
        .service-icon {
            font-size: 2.5rem;
            color: var(--primary);
            margin-bottom: 15px;
        }
        
        .doctor-card {
            text-align: center;
            padding: 20px;
        }
        
        .doctor-img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            margin: 0 auto 15px;
            border: 3px solid var(--light-blue);
        }
        
        .bg-light-custom {
            background-color: var(--light-blue);
        }
        
        .accordion-button:not(.collapsed) {
            background-color: var(--light-blue);
            color: var(--primary);
        }
        
        .contact-info i {
            color: var(--primary);
            width: 30px;
        }
        
        .blog-card {
            height: 100%;
        }
        
        .blog-card img {
            height: 200px;
            object-fit: cover;
        }
        
        footer {
            background-color: var(--secondary);
            color: white;
            padding: 40px 0 20px;
        }
        
        footer a {
            color: rgba(255,255,255,0.8);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        footer a:hover {
            color: white;
        }
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <i class="fas fa-hospital me-2"></i>Clinique Santé
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item"><a class="nav-link" href="#accueil">Accueil</a></li>
                    <li class="nav-item"><a class="nav-link" href="#apropos">À propos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#services">Services</a></li>
                    <li class="nav-item"><a class="nav-link" href="#medecins">Médecins</a></li>
                    <li class="nav-item"><a class="nav-link" href="#rendezvous">Rendez-vous</a></li>
                    <li class="nav-item"><a class="nav-link" href="#blog">Blog</a></li>
                    <li class="nav-item"><a class="nav-link" href="#contact">Contact</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section id="accueil" class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 fw-bold mb-4">Bienvenue à la Clinique Santé</h1>
            <p class="lead mb-5">Votre santé, notre priorité. Prenez rendez-vous en ligne dès aujourd'hui.</p>
            <a href="#rendezvous" class="btn btn-light btn-lg px-5 py-3 rounded-pill">
                <i class="fas fa-calendar-check me-2"></i>Prendre rendez-vous
            </a>
        </div>
    </section>

    <!-- À propos Section -->
    <section id="apropos" class="py-5">
        <div class="container">
            <h2 class="text-center section-title">À propos de nous</h2>
            <div class="row align-items-center">
                <div class="col-md-6 mb-4 mb-md-0">
                    <img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='500' height='300' viewBox='0 0 500 300'><rect fill='%231a75bc' width='500' height='300'/><circle fill='%23e8f4ff' cx='250' cy='150' r='80'/><rect fill='%23e8f4ff' x='230' y='70' width='40' height='160'/><rect fill='%23e8f4ff' x='150' y='130' width='200' height='40'/></svg>" class="img-fluid rounded shadow" alt="Clinique">
                </div>
                <div class="col-md-6">
                    <h3 class="mb-4">Notre mission</h3>
                    <p class="mb-4">Offrir des soins de qualité avec une approche humaine et bienveillante. Nous nous engageons à fournir des services médicaux exceptionnels dans un environnement chaleureux et accueillant.</p>
                    
                    <h3 class="mb-4">Notre équipe</h3>
                    <p>Des médecins expérimentés, des infirmiers qualifiés et un personnel accueillant sont à votre service pour prendre soin de votre santé à tout moment.</p>
                    
                    <div class="d-flex mt-4">
                        <div class="me-4">
                            <h4 class="text-primary">15+</h4>
                            <p>Médecins spécialistes</p>
                        </div>
                        <div class="me-4">
                            <h4 class="text-primary">24/7</h4>
                            <p>Services d'urgence</p>
                        </div>
                        <div>
                            <h4 class="text-primary">500+</h4>
                            <p>Patients satisfaits</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="services" class="py-5 bg-light-custom">
        <div class="container">
            <h2 class="text-center section-title">Nos Services</h2>
            <div class="row g-4">
                <div class="col-md-3">
                    <div class="card service-card">
                        <div class="service-icon">
                            <i class="fas fa-user-md"></i>
                        </div>
                        <h4>Consultations</h4>
                        <p>Consultations générales et spécialisées avec nos médecins experts.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card service-card">
                        <div class="service-icon">
                            <i class="fas fa-flask"></i>
                        </div>
                        <h4>Analyses médicales</h4>
                        <p>Laboratoire équipé pour tous types d'analyses et bilans santé.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card service-card">
                        <div class="service-icon">
                            <i class="fas fa-ambulance"></i>
                        </div>
                        <h4>Urgences 24/24</h4>
                        <p>Service d'urgence disponible 24h/24 et 7j/7 pour vos besoins critiques.</p>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="card service-card">
                        <div class="service-icon">
                            <i class="fas fa-procedures"></i>
                        </div>
                        <h4>Hospitalisation</h4>
                        <p>Chambres confortables et équipées pour un séjour agréable.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Médecins Section -->
    <section id="medecins" class="py-5">
        <div class="container">
            <h2 class="text-center section-title">Notre Équipe Médicale</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card doctor-card">
                        <img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='200' height='200' viewBox='0 0 200 200'><rect fill='%231a75bc' width='200' height='200'/><circle fill='%23e8f4ff' cx='100' cy='80' r='50'/><rect fill='%23e8f4ff' x='50' y='130' width='100' height='40'/></svg>" class="doctor-img" alt="Dr. Camara">
                        <h4 class="mt-2">Dr. Souare</h4>
                        <p class="text-primary">Médecin Généraliste</p>
                        <p>15 ans d'expérience en médecine générale et suivi des patients.</p>
                        <div class="mt-3">
                            <a href="#" class="btn btn-sm btn-outline-primary">Profil complet</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card doctor-card">
                        <img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='200' height='200' viewBox='0 0 200 200'><rect fill='%231a75bc' width='200' height='200'/><circle fill='%23e8f4ff' cx='100' cy='80' r='50'/><rect fill='%23e8f4ff' x='50' y='130' width='100' height='40'/></svg>" class="doctor-img" alt="Dr. Diallo">
                        <h4 class="mt-2">Dr. Diallo</h4>
                        <p class="text-primary">Cardiologue</p>
                        <p>Spécialiste des maladies cardiovasculaires et prévention.</p>
                        <div class="mt-3">
                            <a href="#" class="btn btn-sm btn-outline-primary">Profil complet</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card doctor-card">
                        <img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='200' height='200' viewBox='0 0 200 200'><rect fill='%231a75bc' width='200' height='200'/><circle fill='%23e8f4ff' cx='100' cy='80' r='50'/><rect fill='%23e8f4ff' x='50' y='130' width='100' height='40'/></svg>" class="doctor-img" alt="Dr. Bah">
                        <h4 class="mt-2">Dr. Bah</h4>
                        <p class="text-primary">Pédiatre</p>
                        <p>Expert en santé infantile et développement de l'enfant.</p>
                        <div class="mt-3">
                            <a href="#" class="btn btn-sm btn-outline-primary">Profil complet</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Rendez-vous Section -->
    <section id="rendezvous" class="py-5 bg-light-custom">
        <div class="container">
            <h2 class="text-center section-title">Prendre Rendez-vous</h2>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="card p-4">
                        <form class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label">Nom complet</label>
                                <input type="text" class="form-control" placeholder="Votre nom complet">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Téléphone</label>
                                <input type="tel" class="form-control" placeholder="Votre numéro de téléphone">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Email</label>
                                <input type="email" class="form-control" placeholder="Votre adresse email">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Choisir un médecin</label>
                                <select class="form-select">
                                    <option>Sélectionnez un médecin</option>
                                    <option>Dr. Souare - Médecin Généraliste</option>
                                    <option>Dr. Diallo - Cardiologue</option>
                                    <option>Dr. Bah - Pédiatre</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Date du rendez-vous</label>
                                <input type="date" class="form-control">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label">Heure du rendez-vous</label>
                                <input type="time" class="form-control">
                            </div>
                            <div class="col-12">
                                <label class="form-label">Message (optionnel)</label>
                                <textarea class="form-control" rows="3" placeholder="Précisez ici le motif de votre consultation"></textarea>
                            </div>
                            <div class="col-12 text-center mt-4">
                                <button class="btn btn-primary px-5 py-2">
                                    <i class="fas fa-paper-plane me-2"></i>Confirmer le rendez-vous
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Blog Section -->
    <section id="blog" class="py-5">
        <div class="container">
            <h2 class="text-center section-title">Articles & Conseils</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card blog-card">
                        <img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='400' height='200' viewBox='0 0 400 200'><rect fill='%231a75bc' width='400' height='200'/><circle fill='%23e8f4ff' cx='200' cy='100' r='50'/></svg>" class="card-img-top" alt="Prévenir l'hypertension">
                        <div class="card-body">
                            <h5 class="card-title">Prévenir l'hypertension</h5>
                            <p class="card-text">Découvrez nos conseils pour prévenir et gérer l'hypertension artérielle au quotidien.</p>
                            <a href="#" class="btn btn-sm btn-outline-primary">Lire plus</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card blog-card">
                        <img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='400' height='200' viewBox='0 0 400 200'><rect fill='%231a75bc' width='400' height='200'/><circle fill='%23e8f4ff' cx='200' cy='100' r='50'/></svg>" class="card-img-top" alt="Santé infantile">
                        <div class="card-body">
                            <h5 class="card-title">Santé infantile</h5>
                            <p class="card-text">Tout ce que les parents doivent savoir pour assurer la bonne santé de leurs enfants.</p>
                            <a href="#" class="btn btn-sm btn-outline-primary">Lire plus</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card blog-card">
                        <img src="data:image/svg+xml;utf8,<svg xmlns='http://www.w3.org/2000/svg' width='400' height='200' viewBox='0 0 400 200'><rect fill='%231a75bc' width='400' height='200'/><circle fill='%23e8f4ff' cx='200' cy='100' r='50'/></svg>" class="card-img-top" alt="Bien manger">
                        <div class="card-body">
                            <h5 class="card-title">Bien manger pour mieux vivre</h5>
                            <p class="card-text">Comment une alimentation équilibrée contribue à une meilleure santé globale.</p>
                            <a href="#" class="btn btn-sm btn-outline-primary">Lire plus</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Section -->
    <section id="contact" class="py-5 bg-light-custom">
        <div class="container">
            <h2 class="text-center section-title">Contactez-nous</h2>
            <div class="row">
                <div class="col-md-6 mb-4 mb-md-0">
                    <div class="card p-4 h-100">
                        <form>
                            <div class="mb-3">
                                <label class="form-label">Votre nom</label>
                                <input type="text" class="form-control" placeholder="Votre nom complet">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Votre email</label>
                                <input type="email" class="form-control" placeholder="Votre adresse email">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Votre message</label>
                                <textarea class="form-control" rows="4" placeholder="Comment pouvons-nous vous aider?"></textarea>
                            </div>
                            <button class="btn btn-primary w-100 py-2">
                                <i class="fas fa-paper-plane me-2"></i>Envoyer le message
                            </button>
                        </form>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="contact-info h-100 d-flex flex-column justify-content-center">
                        <div class="d-flex mb-4">
                            <i class="fas fa-map-marker-alt mt-1 me-3"></i>
                            <div>
                                <h5>Adresse</h5>
                                <p>Conakry, Ratoma</p>
                            </div>
                        </div>
                        <div class="d-flex mb-4">
                            <i class="fas fa-phone mt-1 me-3"></i>
                            <div>
                                <h5>Téléphone</h5>
                                <p>+224 621 10 81 17</p>
                            </div>
                        </div>
                        <div class="d-flex mb-4">
                            <i class="fas fa-envelope mt-1 me-3"></i>
                            <div>
                                <h5>Email</h5>
                                <p>contact@cliniquesante.com</p>
                            </div>
                        </div>
                        <div class="d-flex">
                            <i class="fas fa-clock mt-1 me-3"></i>
                            <div>
                                <h5>Horaires d'ouverture</h5>
                                <p>Lundi - Samedi : 8h à 20h<br>Dimanche : Urgences seulement</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- FAQ Section -->
    <section id="faq" class="py-5">
        <div class="container">
            <h2 class="text-center section-title">Foire Aux Questions</h2>
            <div class="row justify-content-center">
                <div class="col-lg-10">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Quels sont vos horaires d'ouverture ?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show">
                                <div class="accordion-body">
                                    Notre clinique est ouverte du lundi au samedi de 8h à 20h. Le service d'urgence fonctionne 24h/24 et 7j/7.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Prenez-vous les assurances maladie ?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    Oui, nous travaillons avec plusieurs assureurs et mutuelles. N'hésitez pas à nous contacter pour savoir si votre assurance est partenaire.
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Comment annuler ou reporter un rendez-vous ?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse">
                                <div class="accordion-body">
                                    Vous pouvez annuler ou reporter votre rendez-vous en nous appelant au moins 24 heures à l'avance au +224 6XX XX XX XX.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4 mb-4 mb-md-0">
                    <h5>Clinique Santé</h5>
                    <p>Votre santé, notre priorité. Des soins de qualité avec une approche humaine.</p>
                    <div class="d-flex mt-3">
                        <a href="#" class="me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="me-3"><i class="fab fa-twitter"></i></a>
                        <a href="#" class="me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                </div>
                <div class="col-md-2 mb-4 mb-md-0">
                    <h5>Liens rapides</h5>
                    <ul class="list-unstyled">
                        <li><a href="#accueil">Accueil</a></li>
                        <li><a href="#services">Services</a></li>
                        <li><a href="#medecins">Médecins</a></li>
                        <li><a href="#rendezvous">Rendez-vous</a></li>
                    </ul>
                </div>
                <div class="col-md-3 mb-4 mb-md-0">
                    <h5>Services</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Consultations</a></li>
                        <li><a href="#">Analyses médicales</a></li>
                        <li><a href="#">Urgences</a></li>
                        <li><a href="#">Hospitalisation</a></li>
                    </ul>
                </div>
                <div class="col-md-3">
                    <h5>Contact</h5>
                    <ul class="list-unstyled">
                        <li><i class="fas fa-map-marker-alt me-2"></i> Conakry, Ratoma</li>
                        <li><i class="fas fa-phone me-2"></i> +224 621 10 81 17</li>
                        <li><i class="fas fa-envelope me-2"></i> contact@cliniquesante.com</li>
                    </ul>
                </div>
            </div>
            <hr class="mt-4 mb-4">
            <div class="text-center">
                <p>&copy; 2025 Clinique Santé. Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>