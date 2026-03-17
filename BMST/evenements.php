<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Événements - BMS Tennis</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        /* ===== VARIABLES & RESET ===== */
        :root {
            --primary: #1a4d80;
            --primary-light: #2a6eb0;
            --secondary: #ffd700;
            --secondary-light: #ffe44d;
            --accent: #ffaa00;
            --white: #ffffff;
            --light-bg: #f0f7ff;
            --dark: #0a1a2a;
            --gray: #4a5568;
            --gray-light: #e2e8f0;
            --transition: all 0.3s ease;
            --shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
            --shadow-hover: 0 20px 30px -10px rgba(0, 0, 0, 0.2);
            --border-radius: 16px;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        html {
            scroll-behavior: smooth;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--dark);
            background: linear-gradient(135deg, #f5fbff 0%, #ffffff 100%);
        }
        
        h1, h2, h3, h4 {
            font-weight: 700;
            line-height: 1.2;
            margin-bottom: 1rem;
        }
        
        a {
            text-decoration: none;
            color: inherit;
        }
        
        .container {
            width: 100%;
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 1.5rem;
        }
        
        .section-padding {
            padding: 5rem 0;
        }
        
        .btn {
            display: inline-block;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            border: none;
            font-size: 1rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, var(--primary-light), var(--primary));
            transform: translateY(-3px);
            box-shadow: 0 15px 25px -8px var(--primary);
        }
        
        /* ===== HEADER ===== */
        header {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            box-shadow: 0 2px 20px rgba(26, 77, 128, 0.1);
            position: fixed;
            width: 100%;
            top: 0;
            z-index: 1000;
            border-bottom: 3px solid var(--secondary);
        }
        
        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 0.8rem 2rem;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .logo-image {
            height: 70px;
            width: auto;
            transition: var(--transition);
            margin-left: 0; /* Supprimé le margin-left: 1rem */
        }
        
        .logo-image:hover {
            transform: scale(1.05);
            filter: drop-shadow(0 4px 8px var(--secondary));
        }
        
        .nav-menu {
            display: flex;
            gap: 1.8rem;
            list-style: none;
            align-items: center;
            margin-right: 0; /* Supprimé le margin-right: 1rem */
        }
        
        .nav-link {
            font-weight: 600;
            color: var(--dark);
            text-decoration: none;
            transition: var(--transition);
            position: relative;
            padding: 0.5rem 0;
            white-space: nowrap;
            font-size: 0.95rem;
        }
        
        .nav-link:hover {
            color: var(--primary);
        }
        
        .nav-link::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 0;
            height: 3px;
            background: linear-gradient(90deg, var(--secondary), var(--accent));
            transition: var(--transition);
            border-radius: 3px;
        }
        
        .nav-link:hover::after {
            width: 100%;
        }
        
        .admin-link {
            background: linear-gradient(135deg, var(--secondary), var(--accent));
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            color: var(--dark);
            font-weight: 600;
            white-space: nowrap;
            font-size: 0.95rem;
        }
        
        .admin-link:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 215, 0, 0.3);
        }
        
        .admin-link::after {
            display: none;
        }
        
        .mobile-toggle {
            display: none;
            font-size: 1.8rem;
            cursor: pointer;
            color: var(--primary);
            margin-right: 0; /* Supprimé le margin-right: 1rem */
        }
        
        /* ===== HERO SECTION ÉVÉNEMENTS ===== */
        .events-hero {
            background: linear-gradient(145deg, var(--dark), #0d2b44);
            color: white;
            padding: 12rem 0 6rem;
            margin-top: 70px;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .events-hero::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 80%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,215,0,0.1) 0%, transparent 70%);
            border-radius: 50%;
        }
        
        .events-hero .container {
            position: relative;
            z-index: 2;
            background: rgba(10, 26, 42, 0.7);
            backdrop-filter: blur(8px);
            padding: 3.5rem;
            border-radius: 30px;
            max-width: 900px;
            margin: 0 auto;
            border: 1px solid rgba(255, 215, 0, 0.3);
            box-shadow: 0 30px 50px rgba(0,0,0,0.5);
        }
        
        .events-hero h1 {
            font-size: 3.8rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #ffffff 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 2px 2px 10px rgba(0,0,0,0.5);
        }
        
        .events-hero p {
            font-size: 1.3rem;
            color: rgba(255,255,255,0.95);
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        
        /* ===== FILTRES ===== */
        .events-filters {
            display: flex;
            justify-content: center;
            gap: 1rem;
            margin: 3rem 0;
        }
        
        .filter-btn {
            padding: 0.8rem 2rem;
            border: 2px solid var(--primary);
            background: transparent;
            color: var(--primary);
            border-radius: 50px;
            font-weight: 600;
            cursor: pointer;
            transition: var(--transition);
            font-size: 1rem;
        }
        
        .filter-btn.active {
            background: var(--primary);
            color: white;
        }
        
        .filter-btn:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 20px -5px var(--primary);
        }
        
        /* ===== GRILLE D'ÉVÉNEMENTS ===== */
        .events-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
            gap: 2rem;
        }
        
        .event-card {
            background: white;
            border-radius: 30px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
            border: 2px solid transparent;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .event-card:hover {
            transform: translateY(-15px) scale(1.02);
            border-color: var(--secondary);
            box-shadow: var(--shadow-hover);
        }
        
        .event-image {
            height: 250px;
            overflow: hidden;
            position: relative;
        }
        
        .event-image::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 30%;
            background: linear-gradient(to top, rgba(0,0,0,0.4), transparent);
        }
        
        .event-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center 30%;
            transition: var(--transition);
        }
        
        .event-card:hover .event-image img {
            transform: scale(1.1);
        }
        
        .event-badge {
            position: absolute;
            top: 15px;
            right: 15px;
            padding: 0.5rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            z-index: 2;
            box-shadow: 0 4px 10px rgba(0,0,0,0.2);
        }
        
        .badge-passe {
            background: var(--gray);
            color: white;
        }
        
        .badge-futur {
            background: var(--secondary);
            color: var(--dark);
        }
        
        .event-content {
            padding: 2rem;
            background: white;
            flex: 1;
        }
        
        .event-date {
            display: inline-block;
            background: var(--light-bg);
            color: var(--primary);
            padding: 0.4rem 1.2rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
            margin-bottom: 1rem;
            border-left: 4px solid var(--secondary);
        }
        
        .event-title {
            color: var(--primary);
            font-size: 1.5rem;
            margin-bottom: 1rem;
        }
        
        .event-description {
            color: var(--gray);
            margin-bottom: 1.5rem;
            line-height: 1.6;
        }
        
        .event-meta {
            display: flex;
            gap: 1.5rem;
            margin: 1.5rem 0;
            color: var(--gray);
            font-size: 0.95rem;
            flex-wrap: wrap;
            padding: 1rem 0;
            border-top: 2px dashed var(--gray-light);
            border-bottom: 2px dashed var(--gray-light);
        }
        
        .event-meta i {
            color: var(--secondary);
            margin-right: 0.5rem;
            width: 20px;
        }
        
        .event-meta span {
            display: flex;
            align-items: center;
        }
        
        /* ===== MESSAGE SI AUCUN ÉVÉNEMENT ===== */
        .no-events {
            text-align: center;
            padding: 4rem;
            background: white;
            border-radius: 30px;
            box-shadow: var(--shadow);
            color: var(--gray);
            grid-column: 1 / -1;
        }
        
        .no-events i {
            font-size: 4rem;
            color: var(--secondary);
            margin-bottom: 1rem;
        }
        
        .no-events h3 {
            color: var(--primary);
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }
        
        /* ===== FOOTER ===== */
        footer {
            background: linear-gradient(145deg, var(--dark), #0b1f30);
            color: white;
            padding: 5rem 0 2rem;
            margin-top: 4rem;
            position: relative;
            overflow: hidden;
        }
        
        footer::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 80%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,215,0,0.1) 0%, transparent 70%);
            border-radius: 50%;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 3rem;
            margin-bottom: 3rem;
            position: relative;
            z-index: 2;
        }
        
        .footer-column h3 {
            color: white;
            font-size: 1.5rem;
            margin-bottom: 1.8rem;
            position: relative;
            padding-bottom: 0.8rem;
        }
        
        .footer-column h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 4px;
            background: var(--secondary);
            border-radius: 4px;
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 1rem;
        }
        
        .footer-links a {
            color: #ccc;
            text-decoration: none;
            transition: var(--transition);
        }
        
        .footer-links a:hover {
            color: var(--secondary);
            padding-left: 5px;
        }
        
        .contact-info {
            list-style: none;
        }
        
        .contact-info li {
            display: flex;
            align-items: flex-start;
            gap: 1rem;
            margin-bottom: 1.2rem;
            color: #ccc;
        }
        
        .contact-info i {
            color: var(--secondary);
            font-size: 1.2rem;
            margin-top: 0.2rem;
            width: 20px;
        }
        
        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1.8rem;
        }
        
        .social-links a {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 45px;
            height: 45px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transition: var(--transition);
            font-size: 1.2rem;
            border: 1px solid rgba(255,215,0,0.3);
            color: white;
        }
        
        .social-links a:hover {
            background: var(--secondary);
            color: var(--dark);
            transform: translateY(-5px);
            border-color: transparent;
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 2.5rem;
            border-top: 1px solid rgba(255, 215, 0, 0.2);
            color: #aaa;
            font-size: 1rem;
            position: relative;
            z-index: 2;
        }
        
        /* ===== RESPONSIVE ===== */
        @media (max-width: 992px) {
            .events-hero h1 { font-size: 3rem; }
            .events-hero .container { padding: 2.5rem; }
        }
        
        @media (max-width: 768px) {
            .logo-image { height: 50px; }
            
            .nav-menu {
                position: fixed;
                top: 70px;
                left: -100%;
                flex-direction: column;
                background: white;
                width: 100%;
                text-align: center;
                padding: 2rem;
                box-shadow: 0 10px 30px rgba(0,0,0,0.1);
                transition: var(--transition);
                border-top: 3px solid var(--secondary);
                z-index: 999;
            }
            .nav-menu.active { left: 0; }
            .mobile-toggle { display: block; }
            
            .events-hero h1 { font-size: 2.5rem; }
            .events-hero .container { padding: 2rem; }
            .events-grid { grid-template-columns: 1fr; }
            .events-filters { flex-direction: column; align-items: center; }
            .filter-btn { width: 200px; }
        }
        
        @media (max-width: 576px) {
            .events-hero h1 { font-size: 2rem; }
            .event-title { font-size: 1.3rem; }
            .event-meta { flex-direction: column; gap: 0.8rem; }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="header-container">
            <a href="index.php" class="logo">
                <img src="bmst.jpg" alt="BMS Tennis" class="logo-image">
            </a>
            <div class="mobile-toggle" id="mobileToggle">
                <i class="fas fa-bars"></i>
            </div>
            <nav>
                <ul class="nav-menu" id="navMenu">
                    <li><a href="index.php#accueil" class="nav-link">Accueil</a></li>
                    <li><a href="index.php#club" class="nav-link">Le Club</a></li>
                    <li><a href="index.php#activites" class="nav-link">Activités</a></li>
                    <li><a href="index.php#equipes" class="nav-link">Équipes</a></li>
                    <li><a href="index.php#enseignants" class="nav-link">Enseignants</a></li>
                    <li><a href="index.php#bureau" class="nav-link">Bureau</a></li>
                    <li><a href="index.php#infrastructures" class="nav-link">Infrastructures</a></li>
                    <li><a href="index.php#inscription" class="nav-link">Inscription</a></li>
                    <li><a href="index.php#contact" class="nav-link">Contact</a></li>
                    <li><a href="admin.php" class="nav-link admin-link"><i class="fas fa-lock"></i> Admin</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <section class="events-hero">
        <div class="container">
            <h1>Nos Événements</h1>
            <p>Tournois, animations, soirées : toute la vie du club</p>
        </div>
    </section>

    <section class="section-padding">
        <div class="container">
            <div class="events-filters">
                <button class="filter-btn active" onclick="filterEvents('all')">Tous</button>
                <button class="filter-btn" onclick="filterEvents('futur')">À venir</button>
                <button class="filter-btn" onclick="filterEvents('passe')">Passés</button>
            </div>

            <div id="eventsGrid" class="events-grid">
                <!-- Les événements seront chargés ici -->
            </div>
        </div>
    </section>

    <footer>
        <div class="container">
            <div class="footer-content">
                <div class="footer-column">
                    <h3>BMS Tennis</h3>
                    <p>Un club dynamique et convivial depuis 1999.</p>
                    <div class="social-links">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                        <a href="#"><i class="fab fa-instagram"></i></a>
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                
                <div class="footer-column">
                    <h3>Liens Rapides</h3>
                    <ul class="footer-links">
                        <li><a href="index.php#accueil">Accueil</a></li>
                        <li><a href="index.php#club">Le Club</a></li>
                        <li><a href="index.php#activites">Activités</a></li>
                        <li><a href="evenements.php">Événements</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Informations</h3>
                    <ul class="footer-links">
                        <li><a href="index.php#inscription">Tarifs</a></li>
                        <li><a href="#">Règlement intérieur</a></li>
                        <li><a href="#">Mentions légales</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Contact</h3>
                    <ul class="contact-info">
                        <li><i class="fas fa-map-marker-alt"></i> 62 Avenue de Bruxelles, 93150 Le Blanc Mesnil</li>
                        <li><i class="fas fa-phone-alt"></i> 06 23 85 18 56</li>
                        <li><i class="fas fa-envelope"></i> bms.tennis@free.fr</li>
                        <li><i class="fas fa-clock"></i> Lun-Ven: 10h-22h<br>Sam-Dim: 9h-19h</li>
                    </ul>
                </div>
            </div>
            
            <div class="footer-bottom">
                <p>&copy; 2026 BMS Tennis - Tous droits réservés.</p>
            </div>
        </div>
    </footer>

    <script>
        // Gestion des événements avec localStorage
        let events = [];

        // Charger les événements
        function loadEvents() {
            const savedEvents = localStorage.getItem('bmsEvents');
            if (savedEvents) {
                events = JSON.parse(savedEvents);
            } else {
                // Événements par défaut
                events = [
                    {
                        id: 1,
                        title: "Tournoi interne d'hiver",
                        date: "2026-03-15",
                        dateFin: "2026-03-16",
                        description: "Tournoi ouvert à tous les membres du club. Plusieurs catégories : simple hommes, simple dames, double mixte.",
                        heure: "9h-19h",
                        participants: "48 participants",
                        lieu: "Courts couverts",
                        image: "event1.jpg",
                        imagePosition: 30
                    },
                    {
                        id: 2,
                        title: "Soirée de gala du club",
                        date: "2026-04-05",
                        description: "Soirée annuelle avec dîner, remise des prix et animations. Tenue de soirée souhaitée.",
                        heure: "19h30",
                        lieu: "Club house",
                        image: "event2.jpg",
                        imagePosition: 30
                    },
                    {
                        id: 3,
                        title: "Stage vacances de printemps",
                        date: "2026-04-20",
                        dateFin: "2026-04-24",
                        description: "Stage intensif pour les jeunes de 8 à 16 ans. Perfectionnement technique et matchs.",
                        heure: "10h-17h",
                        participants: "Places limitées",
                        lieu: "Tous les courts",
                        image: "event3.jpg",
                        imagePosition: 30
                    },
                    {
                        id: 4,
                        title: "Open BMS Tennis",
                        date: "2026-05-10",
                        dateFin: "2026-05-12",
                        description: "Tournoi ouvert aux clubs de la région. Tableaux hommes et femmes. Dotations importantes.",
                        heure: "8h-20h",
                        participants: "Tableaux de 32",
                        lieu: "Tous les courts",
                        image: "event4.jpg",
                        imagePosition: 30
                    },
                    {
                        id: 5,
                        title: "Journée portes ouvertes",
                        date: "2026-06-01",
                        description: "Venez découvrir le club, ses installations et ses enseignants. Initiations gratuites pour tous.",
                        heure: "10h-18h",
                        lieu: "Club house",
                        image: "event5.jpg",
                        imagePosition: 30
                    },
                    {
                        id: 6,
                        title: "Challenge interclubs",
                        date: "2026-06-20",
                        dateFin: "2026-06-22",
                        description: "Rencontre amicale entre clubs de la région. Équipes de 6 joueurs.",
                        heure: "9h-18h",
                        participants: "Matchs amicaux",
                        lieu: "Courts extérieurs",
                        image: "event6.jpg",
                        imagePosition: 30
                    }
                ];
                saveEvents();
            }
            displayEvents('all');
        }

        // Sauvegarder les événements
        function saveEvents() {
            localStorage.setItem('bmsEvents', JSON.stringify(events));
        }

        // Afficher les événements
        function displayEvents(filter) {
            const grid = document.getElementById('eventsGrid');
            const today = new Date().toISOString().split('T')[0];
            
            // Mettre à jour les statuts en fonction de la date
            events = events.map(event => {
                if (event.date < today) {
                    event.statut = 'passe';
                } else {
                    event.statut = 'futur';
                }
                return event;
            });
            
            let filteredEvents = events;
            if (filter === 'futur') {
                filteredEvents = events.filter(e => e.statut === 'futur');
            } else if (filter === 'passe') {
                filteredEvents = events.filter(e => e.statut === 'passe');
            }
            
            // Trier par date (les plus récents d'abord)
            filteredEvents.sort((a, b) => new Date(b.date) - new Date(a.date));
            
            if (filteredEvents.length === 0) {
                grid.innerHTML = `
                    <div class="no-events">
                        <i class="fas fa-calendar-times"></i>
                        <h3>Aucun événement ${filter === 'futur' ? 'à venir' : filter === 'passe' ? 'passé' : ''}</h3>
                        <p>Revenez plus tard ou consultez nos activités régulières.</p>
                    </div>
                `;
                return;
            }
            
            grid.innerHTML = filteredEvents.map(event => {
                const dateObj = new Date(event.date);
                const dateFormatee = dateObj.toLocaleDateString('fr-FR', { 
                    day: 'numeric', 
                    month: 'long', 
                    year: 'numeric' 
                });
                
                let dateRange = dateFormatee;
                if (event.dateFin) {
                    const dateFinObj = new Date(event.dateFin);
                    const dateFinFormatee = dateFinObj.toLocaleDateString('fr-FR', { 
                        day: 'numeric', 
                        month: 'long' 
                    });
                    dateRange = `Du ${dateFormatee.split(' ')[0]} au ${dateFinFormatee} ${dateFormatee.split(' ')[2]}`;
                }
                
                // Appliquer la position personnalisée de l'image
                const imageStyle = event.imagePosition ? 
                    `style="object-position: center ${event.imagePosition}%;"` : 
                    `style="object-position: center 30%;"`;
                
                return `
                    <div class="event-card">
                        <div class="event-image">
                            <img src="${event.image || 'default-event.jpg'}" alt="${event.title}" ${imageStyle}>
                            <div class="event-badge badge-${event.statut}">
                                ${event.statut === 'futur' ? 'À venir' : 'Passé'}
                            </div>
                        </div>
                        <div class="event-content">
                            <span class="event-date"><i class="far fa-calendar-alt"></i> ${dateRange}</span>
                            <h3 class="event-title">${event.title}</h3>
                            <p class="event-description">${event.description}</p>
                            <div class="event-meta">
                                ${event.heure ? `<span><i class="fas fa-clock"></i> ${event.heure}</span>` : ''}
                                ${event.lieu ? `<span><i class="fas fa-map-marker-alt"></i> ${event.lieu}</span>` : ''}
                                ${event.participants ? `<span><i class="fas fa-users"></i> ${event.participants}</span>` : ''}
                            </div>
                        </div>
                    </div>
                `;
            }).join('');
        }

        // Filtrer les événements
        function filterEvents(filter) {
            document.querySelectorAll('.filter-btn').forEach(btn => {
                btn.classList.remove('active');
            });
            event.target.classList.add('active');
            displayEvents(filter);
        }

        // Initialisation
        document.addEventListener('DOMContentLoaded', loadEvents);

        // Mobile menu
        const mobileToggle = document.getElementById('mobileToggle');
        const navMenu = document.getElementById('navMenu');
        
        mobileToggle.addEventListener('click', () => {
            navMenu.classList.toggle('active');
            mobileToggle.innerHTML = navMenu.classList.contains('active') 
                ? '<i class="fas fa-times"></i>' 
                : '<i class="fas fa-bars"></i>';
        });
        
        document.querySelectorAll('.nav-link').forEach(link => {
            link.addEventListener('click', () => {
                if (window.innerWidth <= 768) {
                    navMenu.classList.remove('active');
                    mobileToggle.innerHTML = '<i class="fas fa-bars"></i>';
                }
            });
        });
    </script>
</body>
</html>