<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BMS Tennis - Club de Tennis Associatif</title>
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
        
        h2 {
            font-size: 2.5rem;
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            position: relative;
            padding-bottom: 0.5rem;
            display: inline-block;
        }
        
        h2::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100px;
            height: 4px;
            background: linear-gradient(90deg, var(--secondary), var(--accent));
            border-radius: 4px;
        }
        
        .section-header {
            text-align: center;
            margin-bottom: 3rem;
        }
        
        .section-header h2::after {
            left: 50%;
            transform: translateX(-50%);
            width: 150px;
        }
        
        .section-header p {
            font-size: 1.2rem;
            color: var(--gray);
            max-width: 700px;
            margin: 1rem auto 0;
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
            letter-spacing: 0.5px;
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
        
        .btn-secondary {
            background: linear-gradient(135deg, var(--secondary), var(--accent));
            color: var(--dark);
        }
        
        .btn-secondary:hover {
            background: linear-gradient(135deg, var(--accent), var(--secondary));
            transform: translateY(-3px);
            box-shadow: 0 15px 25px -8px var(--secondary);
        }
        
        .btn-accent {
            background: white;
            color: var(--primary);
            border: 2px solid var(--secondary);
        }
        
        .btn-accent:hover {
            background: var(--secondary);
            color: var(--dark);
            transform: translateY(-3px);
        }

        /* Bouton de réservation */
        .btn-reservation {
            background: linear-gradient(135deg, #ffee00, #ffc400);
            color: white;
            padding: 0.6rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.95rem;
            white-space: nowrap;
            transition: var(--transition);
            border: 2px solid transparent;
        }
        
        .btn-reservation:hover {
            background: linear-gradient(135deg, #efff0b, #ffbb00);
            transform: translateY(-3px);
            box-shadow: 0 10px 20px -5px #10b981;
            border-color: var(--secondary);
        }
        
        .btn-reservation i {
            margin-right: 0.5rem;
        }
        
        .text-center {
            text-align: center;
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
        }
        
        .logo-image:hover {
            transform: scale(1.05);
            filter: drop-shadow(0 4px 8px var(--secondary));
        }
        
        /* DÉCALAGE DU LOGO VERS LA GAUCHE */
        .logo {
            margin-left: -5rem; /* Décale le logo vers la gauche pour créer de l'espace */
        }
        
        .nav-menu {
            display: flex;
            gap: 1.5rem;
            list-style: none;
            margin-right: 0;
            align-items: center;
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
        
        .mobile-toggle {
            display: none;
            font-size: 1.8rem;
            cursor: pointer;
            color: var(--primary);
            margin-right: 0;
        }
        
        /* ===== HERO SECTION ===== */
        .hero {
            color: white;
            padding: 12rem 0 8rem;
            margin-top: 70px;
            position: relative;
            overflow: hidden;
            background: linear-gradient(145deg, var(--dark), #0d2b44);
        }

        .hero-collage {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 1;
            display: grid;
            grid-template-columns: repeat(8, 1fr);
            grid-template-rows: repeat(6, 1fr);
            gap: 4px;
            transform: rotate(1deg) scale(1.05);
            opacity: 0.9;
        }

        .hero-collage-item {
            background-size: cover;
            background-repeat: no-repeat;
            width: 100%;
            height: 100%;
            transition: all 0.5s ease;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.5);
            border: 2px solid rgba(255, 215, 0, 0.3);
        }

        .hero-collage-item:nth-child(1) {
            grid-column: 1 / 4;
            grid-row: 1 / 4;
            clip-path: polygon(0% 0%, 100% 0%, 90% 100%, 0% 85%);
            background-position: 30% 25%;
            background-image: url('7.jpeg');
        }
        .hero-collage-item:nth-child(2) {
            grid-column: 4 / 6;
            grid-row: 1 / 3;
            clip-path: polygon(10% 0%, 100% 0%, 100% 100%, 0% 80%);
            background-position: 50% 30%;
            background-image: url('2.jpeg');
        }
        .hero-collage-item:nth-child(3) {
            grid-column: 6 / 9;
            grid-row: 1 / 3;
            clip-path: polygon(0% 0%, 100% 0%, 100% 100%, 15% 90%);
            background-position: 40% 25%;
            background-image: url('12.jpeg');
        }
        .hero-collage-item:nth-child(4) {
            grid-column: 5 / 8;
            grid-row: 3 / 5;
            clip-path: polygon(20% 0%, 100% 10%, 95% 100%, 0% 90%);
            background-position: 70% 35%;
            background-image: url('14.jpeg');
        }
        .hero-collage-item:nth-child(5) {
            grid-column: 1 / 4;
            grid-row: 4 / 7;
            clip-path: polygon(0% 10%, 100% 0%, 85% 100%, 0% 100%);
            background-position: 45% 40%;
            background-image: url('16.jpeg');
        }
        .hero-collage-item:nth-child(6) {
            grid-column: 4 / 6;
            grid-row: 5 / 7;
            clip-path: polygon(10% 0%, 100% 15%, 90% 100%, 0% 85%);
            background-position: 30% 60%;
            background-image: url('18.jpeg');
        }
        .hero-collage-item:nth-child(7) {
            grid-column: 6 / 8;
            grid-row: 5 / 7;
            clip-path: polygon(0% 20%, 100% 0%, 100% 100%, 20% 90%);
            background-position: 20% 45%;
            background-image: url('29.jpeg');
        }
        .hero-collage-item:nth-child(8) {
            grid-column: 8 / 9;
            grid-row: 3 / 5;
            clip-path: polygon(0% 0%, 100% 25%, 80% 100%, 0% 100%);
            background-position: 80% 25%;
            background-image: url('19.jpeg');
        }

        .hero-collage-item:hover {
            transform: scale(1.05) translateY(-5px);
            z-index: 50;
            border-color: var(--secondary);
            box-shadow: 0 25px 35px -5px var(--secondary);
            filter: brightness(1.15) saturate(1.2);
        }

        .hero .container {
            position: relative;
            z-index: 60;
            background: rgba(10, 26, 42, 0.7);
            backdrop-filter: blur(8px);
            padding: 3.5rem;
            border-radius: 30px;
            max-width: 950px;
            margin-left: auto;
            margin-right: auto;
            border: 1px solid rgba(255, 215, 0, 0.3);
            box-shadow: 0 30px 50px rgba(0,0,0,0.7), 0 0 0 2px rgba(255,215,0,0.2) inset;
            text-align: center;
        }

        .hero .container:hover {
            transform: translateY(-5px);
            border-color: var(--secondary);
        }

        .hero h1 {
            font-size: 3.8rem;
            margin-bottom: 1.5rem;
            background: linear-gradient(135deg, #ffffff 0%, var(--secondary) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 2px 2px 10px rgba(0,0,0,0.5);
        }

        .hero p {
            font-size: 1.3rem;
            margin-bottom: 2rem;
            color: rgba(255,255,255,0.95);
            text-shadow: 2px 2px 4px rgba(0,0,0,0.5);
        }
        
        .hero-buttons {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            margin-top: 2.5rem;
        }
        
        /* ===== ABOUT SECTION ===== */
        .about-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 4rem;
            align-items: center;
        }
        
        .about-stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 1.5rem;
            margin-top: 2rem;
        }
        
        .stat {
            text-align: center;
            padding: 1.5rem;
            border-radius: 20px;
            background: white;
            box-shadow: var(--shadow);
            border-bottom: 4px solid var(--secondary);
            transition: var(--transition);
        }
        
        .stat:hover {
            transform: translateY(-5px);
            border-bottom-color: var(--primary);
        }
        
        .stat-number {
            font-size: 2.5rem;
            font-weight: 800;
            color: var(--primary);
            margin-bottom: 0.3rem;
        }
        
        .stat-label {
            color: var(--gray);
            font-weight: 600;
        }
        
        .about-image {
            position: relative;
            border-radius: var(--border-radius);
            overflow: hidden;
            height: 400px;
        }
        
        .about-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center 40%;
            border-radius: var(--border-radius);
            transition: var(--transition);
        }
        
        .about-image:hover img {
            transform: scale(1.02);
        }
        
        /* ===== ACTIVITIES SECTION ===== */
        .activities {
            background: linear-gradient(135deg, #e6f0ff, #d4e4ff);
        }
        
        .activities-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 2rem;
        }
        
        .activity-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .activity-card.clickable {
            cursor: pointer;
        }
        
        .activity-card.clickable:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-hover);
            border: 2px solid var(--secondary);
        }
        
        .activity-image {
            height: 200px;
            overflow: hidden;
        }
        
        .activity-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center 30%;
            transition: var(--transition);
        }
        
        .activity-card:hover .activity-image img {
            transform: scale(1.1);
        }
        
        .activity-content {
            padding: 1.5rem;
            flex: 1;
        }
        
        .activity-content h3 {
            color: var(--primary);
            font-size: 1.3rem;
            margin-bottom: 0.8rem;
        }
        
        .activity-content h3 i {
            color: var(--secondary);
            margin-right: 0.5rem;
        }
        
        .activity-content p {
            color: var(--gray);
            margin-bottom: 1rem;
        }
        
        .activity-contact {
            background: var(--light-bg);
            padding: 1rem;
            border-radius: 10px;
            margin-top: 1rem;
            font-size: 0.9rem;
            border-left: 4px solid var(--secondary);
        }
        
        .activity-contact i {
            color: var(--primary);
            margin-right: 0.5rem;
        }
        
        /* ===== TEAMS SECTION - NOUVEAU DESIGN ===== */
        .teams-grid {
            display: grid;
            grid-template-columns: 1fr;
            gap: 2.5rem;
        }
        
        .team-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow);
        }
        
        .team-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            padding: 1.5rem;
            text-align: center;
        }
        
        .team-header h3 {
            margin: 0;
            color: white;
            font-size: 1.8rem;
        }
        
        .team-content {
            padding: 2.5rem;
        }
        
        /* NOUVEAU : Disposition horizontale pour les joueurs */
        .players-grid {
            display: grid;
            grid-template-columns: repeat(5, 1fr);
            gap: 1.5rem;
            margin-bottom: 2.5rem;
        }
        
        .player-card {
            background: var(--light-bg);
            border-radius: 15px;
            overflow: hidden;
            text-align: center;
            transition: var(--transition);
            border: 2px solid transparent;
            height: 100%;
            display: flex;
            flex-direction: column;
        }
        
        .player-card:hover {
            transform: translateY(-5px);
            border-color: var(--secondary);
            box-shadow: var(--shadow);
        }
        
        .player-image {
            width: 100%;
            height: 220px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            background-color: var(--light-bg);
        }
        
        .player-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center 20%;
            transition: var(--transition);
        }
        
        .player-card:hover .player-image img {
            transform: scale(1.05);
        }
        
        .player-info {
            padding: 1.2rem;
            flex: 1;
            display: flex;
            flex-direction: column;
        }
        
        .player-info h4 {
            color: var(--primary);
            font-size: 1.1rem;
            margin-bottom: 0.5rem;
        }
        
        .player-info p {
            color: var(--gray);
            font-size: 0.9rem;
            margin-bottom: 0.5rem;
        }
        
        .player-rank {
            display: inline-block;
            background: var(--primary);
            color: white;
            padding: 0.2rem 1rem;
            border-radius: 50px;
            font-size: 0.8rem;
            margin-top: 0.5rem;
            align-self: center;
        }
        
        .team-palmares {
            background: var(--light-bg);
            padding: 1.5rem;
            border-radius: 15px;
            margin-top: 1rem;
        }
        
        .team-palmares h4 {
            color: var(--primary);
            font-size: 1.3rem;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        
        .team-palmares h4 i {
            color: var(--secondary);
        }
        
        .team-list {
            list-style: none;
        }
        
        .team-list li {
            padding: 1rem 0;
            border-bottom: 2px dashed var(--gray-light);
            display: flex;
            justify-content: space-between;
            align-items: center;
            font-size: 1.1rem;
        }
        
        .team-list li:last-child {
            border-bottom: none;
        }
        
        .team-list li span:last-child {
            background: var(--secondary);
            color: var(--dark);
            padding: 0.3rem 1.5rem;
            border-radius: 50px;
            font-weight: 600;
            font-size: 0.9rem;
        }
        
        /* ===== TEACHERS SECTION ===== */
        .teachers-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 2rem;
        }
        
        .teacher-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow);
            transition: var(--transition);
        }
        
        .teacher-card:hover {
            transform: translateY(-10px);
            box-shadow: var(--shadow-hover);
        }
        
        .teacher-image {
            height: 280px;
            overflow: hidden;
        }
        
        .teacher-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center 20%;
            transition: var(--transition);
        }
        
        .teacher-card:hover .teacher-image img {
            transform: scale(1.05);
        }
        
        .teacher-content {
            padding: 1.5rem;
            text-align: center;
        }
        
        .teacher-content h3 {
            color: var(--primary);
            font-size: 1.2rem;
            margin-bottom: 0.3rem;
        }
        
        .teacher-content p {
            color: var(--secondary);
            font-weight: 600;
        }
        
        /* ===== BUREAU SECTION ===== */
        .bureau-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: start;
        }
        
        .bureau-list {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            box-shadow: var(--shadow);
            border-left: 8px solid var(--secondary);
        }
        
        .bureau-list h4 {
            color: var(--primary);
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
        }
        
        .bureau-list ul {
            list-style: none;
        }
        
        .bureau-list ul li {
            padding: 0.8rem 0;
            border-bottom: 2px solid var(--gray-light);
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .bureau-list ul li:last-child {
            border-bottom: none;
        }
        
        .bureau-list ul li span:first-child {
            font-weight: 600;
        }
        
        .bureau-list ul li span:last-child {
            background: var(--primary);
            color: white;
            padding: 0.3rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
        }
        
        .president-badge {
            background: var(--secondary) !important;
            color: var(--dark) !important;
        }
        
        /* ===== INFRASTRUCTURES SECTION ===== */
        .infrastructure {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
        }
        
        .infrastructure h2,
        .infrastructure h3 {
            color: white;
            -webkit-text-fill-color: white;
        }
        
        .infrastructure h2::after {
            background: var(--secondary);
        }
        
        .infrastructure-content {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 3rem;
            align-items: center;
        }
        
        .facilities-list {
            list-style: none;
        }
        
        .facilities-list li {
            padding: 0.8rem 0;
            display: flex;
            align-items: center;
            gap: 1rem;
            border-bottom: 1px solid rgba(255,255,255,0.2);
        }
        
        .facilities-list i {
            color: var(--secondary);
            font-size: 1.3rem;
            background: rgba(255,255,255,0.1);
            padding: 0.5rem;
            border-radius: 50%;
        }
        
        /* ===== CARROUSEL ===== */
        .carousel-container {
            position: relative;
            width: 100%;
            border-radius: var(--border-radius);
            overflow: hidden;
            box-shadow: var(--shadow);
        }
        
        .carousel-slide {
            display: none;
            width: 100%;
            height: 350px;
            object-fit: cover;
            object-position: center;
        }
        
        .carousel-slide.active {
            display: block;
        }
        
        .carousel-btn {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            background: rgba(0, 0, 0, 0.6);
            color: white;
            border: none;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: var(--transition);
            border: 2px solid var(--secondary);
            font-size: 1.2rem;
            z-index: 10;
        }
        
        .carousel-btn:hover {
            background: var(--secondary);
            color: var(--dark);
        }
        
        .carousel-btn.prev {
            left: 10px;
        }
        
        .carousel-btn.next {
            right: 10px;
        }
        
        .carousel-dots {
            position: absolute;
            bottom: 10px;
            left: 50%;
            transform: translateX(-50%);
            display: flex;
            gap: 8px;
            z-index: 10;
        }
        
        .dot {
            width: 10px;
            height: 10px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.5);
            cursor: pointer;
            border: 1px solid var(--secondary);
            transition: var(--transition);
        }
        
        .dot.active {
            background: var(--secondary);
            transform: scale(1.2);
        }
        
        .infrastructure-image {
            position: relative;
        }
        
        .infrastructure-image::before {
            content: '';
            position: absolute;
            top: -15px;
            right: -15px;
            width: 100%;
            height: 100%;
            border: 4px solid var(--secondary);
            border-radius: var(--border-radius);
            z-index: 1;
        }
        
        .infrastructure-image .carousel-container {
            position: relative;
            z-index: 2;
        }
        
        /* ===== PRICING SECTION ===== */
        .pricing-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
            gap: 2rem;
            margin-top: 2rem;
        }
        
        .pricing-card {
            background: white;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: var(--shadow);
            text-align: center;
            transition: var(--transition);
            border: 2px solid transparent;
        }
        
        .pricing-card:hover {
            transform: translateY(-10px);
            border-color: var(--secondary);
            box-shadow: var(--shadow-hover);
        }
        
        .pricing-card.populaire {
            border-color: var(--secondary);
            transform: scale(1.02);
        }
        
        .pricing-header {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
            padding: 1.5rem;
        }
        
        .pricing-header h3 {
            color: white;
            font-size: 1.5rem;
            margin-bottom: 0.3rem;
        }
        
        .pricing-header p {
            font-size: 0.9rem;
            opacity: 0.9;
        }
        
        .price {
            font-size: 3rem;
            font-weight: 800;
            margin: 1.5rem 0;
            color: var(--primary);
        }
        
        .price span {
            font-size: 1rem;
            color: var(--gray);
        }
        
        .pricing-features {
            padding: 0 1.5rem 1.5rem;
        }
        
        .pricing-features ul {
            list-style: none;
        }
        
        .pricing-features li {
            padding: 0.5rem 0;
            border-bottom: 2px dashed var(--gray-light);
        }
        
        .pricing-features li:last-child {
            border-bottom: none;
        }
        
        .pricing-features i {
            color: var(--secondary);
            margin-right: 0.5rem;
        }
        
        /* ===== FOOTER ===== */
        footer {
            background: linear-gradient(145deg, var(--dark), #0b1f30);
            color: white;
            padding: 4rem 0 2rem;
        }
        
        .footer-content {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
            gap: 2rem;
            margin-bottom: 3rem;
        }
        
        .footer-column h3 {
            color: white;
            font-size: 1.2rem;
            margin-bottom: 1.5rem;
            position: relative;
            padding-bottom: 0.5rem;
        }
        
        .footer-column h3::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 40px;
            height: 3px;
            background: var(--secondary);
            border-radius: 3px;
        }
        
        .footer-links {
            list-style: none;
        }
        
        .footer-links li {
            margin-bottom: 0.8rem;
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
            align-items: center;
            gap: 0.8rem;
            margin-bottom: 0.8rem;
            color: #ccc;
        }
        
        .contact-info i {
            color: var(--secondary);
            width: 20px;
        }
        
        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }
        
        .social-links a {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            transition: var(--transition);
            border: 1px solid rgba(255,215,0,0.3);
            color: white;
            text-decoration: none;
        }
        
        .social-links a:hover {
            background: var(--secondary);
            color: var(--dark);
            transform: translateY(-3px);
        }
        
        .footer-bottom {
            text-align: center;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 215, 0, 0.2);
            color: #aaa;
        }
        
        /* ===== RESPONSIVE ===== */
        @media (max-width: 992px) {
            .hero h1 { font-size: 3rem; }
            .about-content,
            .infrastructure-content,
            .bureau-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }
            .players-grid {
                grid-template-columns: repeat(3, 1fr);
            }
        }
        
        @media (max-width: 768px) {
            .hero h1 { font-size: 2.5rem; }
            .hero .container { padding: 2rem; }
            
            .logo-image { height: 50px; }
            
            /* Ajustement du logo sur mobile */
            .logo {
                margin-left: 0; /* Annule la marge négative sur mobile */
            }
            
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
                z-index: 999;
                border-top: 3px solid var(--secondary);
            }
            .nav-menu.active { left: 0; }
            .mobile-toggle { display: block; }
            
            .btn-reservation {
                display: inline-block;
                margin-top: 1rem;
            }
            
            .hero-buttons { flex-direction: column; }
            .about-stats { grid-template-columns: repeat(2, 1fr); }
            .activities-grid { grid-template-columns: 1fr; }
            .pricing-grid { grid-template-columns: 1fr; }
            .players-grid {
                grid-template-columns: repeat(2, 1fr);
            }
            
            .carousel-slide { height: 250px; }
            .about-image { height: 300px; }
        }
        
        @media (max-width: 576px) {
            .hero h1 { font-size: 2rem; }
            h2 { font-size: 2rem; }
            .about-stats { grid-template-columns: 1fr; }
            .players-grid {
                grid-template-columns: 1fr;
            }
            .carousel-slide { height: 200px; }
            .about-image { height: 250px; }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <div class="container header-container">
            <a href="index.php" class="logo">
                <img src="bmst.jpg" alt="BMS Tennis" class="logo-image">
            </a>
            <div class="mobile-toggle" id="mobileToggle">
                <i class="fas fa-bars"></i>
            </div>
            <nav>
                <ul class="nav-menu" id="navMenu">
                    <li><a href="#accueil" class="nav-link">Accueil</a></li>
                    <li><a href="#club" class="nav-link">Le Club</a></li>
                    <li><a href="#activites" class="nav-link">Activités</a></li>
                    <li><a href="#equipes" class="nav-link">Équipes</a></li>
                    <li><a href="#enseignants" class="nav-link">Enseignants</a></li>
                    <li><a href="#bureau" class="nav-link">Bureau</a></li>
                    <li><a href="#infrastructures" class="nav-link">Infrastructures</a></li>
                    <li><a href="#inscription" class="nav-link">Inscription</a></li>
                    <li><a href="#contact" class="nav-link">Contact</a></li>
                    <li><a href="https://tenup.fft.fr/club/57930057/reservations" target="_blank" class="btn-reservation"><i class="fas fa-calendar-check"></i> Réserver un terrain</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <!-- HERO SECTION -->
    <section class="hero" id="accueil">
        <div class="hero-collage">
            <div class="hero-collage-item"></div>
            <div class="hero-collage-item"></div>
            <div class="hero-collage-item"></div>
            <div class="hero-collage-item"></div>
            <div class="hero-collage-item"></div>
            <div class="hero-collage-item"></div>
            <div class="hero-collage-item"></div>
            <div class="hero-collage-item"></div>
        </div>
        <div class="container">
            <h1>Bienvenue au BMS Tennis</h1>
            <p>Rejoignez l'un des clubs de tennis les plus dynamiques de la région avec plus de 300 membres actifs, des installations modernes et un programme d'entraînement pour tous les niveaux.</p>
            <div class="hero-buttons">
                <a href="#inscription" class="btn btn-primary">S'inscrire maintenant</a>
                <a href="#club" class="btn btn-secondary">Découvrir le club</a>
            </div>
        </div>
    </section>

    <!-- SECTION CLUB -->
    <section id="club" class="section-padding">
        <div class="container">
            <div class="about-content">
                <div>
                    <h2>Le Club</h2>
                    <p style="font-size: 1.2rem; margin-bottom: 1.5rem;">Fondé en 1999, le BMS Tennis est un club associatif dynamique qui a pour vocation de promouvoir la pratique du tennis pour tous.</p>
                    <p style="color: var(--gray); margin-bottom: 2rem;">Nous proposons une large gamme d'activités adaptées à tous les âges et tous les niveaux, du débutant au compétiteur confirmé.</p>
                    
                    <div class="about-stats">
                        <div class="stat">
                            <div class="stat-number">300+</div>
                            <div class="stat-label">Licenciés</div>
                        </div>
                        <div class="stat">
                            <div class="stat-number">10</div>
                            <div class="stat-label">Terrains</div>
                        </div>
                        <div class="stat">
                            <div class="stat-number">8</div>
                            <div class="stat-label">Enseignants</div>
                        </div>
                    </div>
                </div>
                
                <div class="about-image">
                    <img src="34.jpeg" alt="Terrains de tennis BMS">
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION ACTIVITÉS -->
    <section id="activites" class="section-padding activities">
        <div class="container">
            <div class="section-header">
                <h2>Nos Activités</h2>
                <p>Découvrez toutes nos activités pour adultes et jeunes</p>
            </div>
            
            <div class="activities-grid">
                <div class="activity-card">
                    <div class="activity-image">
                        <img src="cours.jpg" alt="Cours collectifs">
                    </div>
                    <div class="activity-content">
                        <h3><i class="fas fa-users"></i> Cours Collectifs</h3>
                        <p>Des séances en petits groupes pour progresser à son rythme.</p>
                        <div class="activity-contact">
                            <i class="fas fa-phone"></i> Renseignements : 06 23 85 18 56
                        </div>
                    </div>
                </div>
                
                <div class="activity-card">
                    <div class="activity-image">
                        <img src="cours2.jpg" alt="Cours particuliers">
                    </div>
                    <div class="activity-content">
                        <h3><i class="fas fa-user-graduate"></i> Cours Particuliers</h3>
                        <p>Accompagnement personnalisé avec un coach dédié pour atteindre vos objectifs.</p>
                    </div>
                </div>
                
                <div class="activity-card">
                    <div class="activity-image">
                        <img src="ecole.jpg" alt="École de tennis">
                    </div>
                    <div class="activity-content">
                        <h3><i class="fas fa-child"></i> École de Tennis</h3>
                        <p>Pour les jeunes de 5 à 18 ans, apprentissage progressif et compétitions.</p>
                        <div class="activity-contact">
                            <i class="fas fa-phone"></i> Renseignements : 06 23 85 18 56
                        </div>
                    </div>
                </div>
                
                <div class="activity-card">
                    <div class="activity-image">
                        <img src="stages.jpg" alt="Stages">
                    </div>
                    <div class="activity-content">
                        <h3><i class="fas fa-calendar-alt"></i> Stages Vacances</h3>
                        <p>Stages intensifs pendant les vacances scolaires pour progresser en s'amusant.</p>
                        <div class="activity-contact">
                            <i class="fas fa-phone"></i> Renseignements : 06 23 85 18 56
                        </div>
                    </div>
                </div>
                
                <div class="activity-card clickable" onclick="window.location.href='evenements.php'">
                    <div class="activity-image">
                        <img src="event2.jpg" alt="Événements">
                    </div>
                    <div class="activity-content">
                        <h3><i class="fas fa-trophy"></i> Événements</h3>
                        <p>Tournois internes, soirées, animations conviviales pour tous les membres.</p>
                        <div style="color: var(--primary); font-weight: 600; margin-top: 1rem;">
                            <i class="fas fa-arrow-right"></i> Cliquez pour voir nos événements
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION ÉQUIPES - NOUVELLE DISPOSITION -->
    <section id="equipes" class="section-padding">
        <div class="container">
            <div class="section-header">
                <h2>Équipe Compétition</h2>
                <p>Notre équipe représente le club dans les championnats régionaux et nationaux</p>
            </div>
            
            <div class="teams-grid">
                <div class="team-card">
                    <div class="team-header">
                        <h3>Équipe Masculine Pro A</h3>
                    </div>
                    <div class="team-content">
                        <!-- Grille horizontale des joueurs -->
                        <div class="players-grid">
                            <div class="player-card">
                                <div class="player-image">
                                    <img src="manarino.jpg" alt="manarino">
                                </div>
                                <div class="player-info">
                                    <h4>Adrian Manarino</h4>
                                    <p>43e Mondial</p>
                                    <span class="player-rank">N°5 Français</span>
                                </div>
                            </div>
                            
                            <div class="player-card">
                                <div class="player-image">
                                    <img src="muller.jpg" alt="muller">
                                </div>
                                <div class="player-info">
                                    <h4>Alexandre Müller</h4>
                                    <p>90e Mondial</p>
                                    <span class="player-rank">N°10 Français</span>
                                </div>
                            </div>
                            
                            <div class="player-card">
                                <div class="player-image">
                                    <img src="2.jpeg" alt="halys">
                                </div>
                                <div class="player-info">
                                    <h4>Quentin Halys</h4>
                                    <p>111e Mondial</p>
                                    <span class="player-rank">N°14 Français</span>
                                </div>
                            </div>
                            
                            <div class="player-card">
                                <div class="player-image">
                                    <img src="29.jpeg" alt="tatlot">
                                </div>
                                <div class="player-info">
                                    <h4>Johan Tatlot</h4>
                                    <p>226e (2018)</p>
                                    <span class="player-rank">N°57 Français</span>
                                </div>
                            </div>
                            
                            <div class="player-card">
                                <div class="player-image">
                                    <img src="7.jpeg" alt="loic">
                                </div>
                                <div class="player-info">
                                    <h4>Loic N-T</h4>
                                    <p>Classement -15</p>
                                    <span class="player-rank">ex N°97</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Palmarès -->
                        <div class="team-palmares">
                            <h4><i class="fas fa-trophy"></i> Palmarès récent</h4>
                            <ul class="team-list">
                                <li><span>Champion de France Nationale 1</span><span>2022</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION ENSEIGNANTS -->
    <section id="enseignants" class="section-padding">
        <div class="container">
            <div class="section-header">
                <h2>Nos Enseignants</h2>
                <p>Une équipe pédagogique expérimentée pour vous accompagner</p>
            </div>
            
            <div class="teachers-grid">
                <div class="teacher-card">
                    <div class="teacher-image">
                        <img src="Jerome.jpeg" alt="Jérôme Almagrida">
                    </div>
                    <div class="teacher-content">
                        <h3>Jérôme Almagrida</h3>
                        <p>Directeur Sportif</p>
                    </div>
                </div>
                
                <div class="teacher-card">
                    <div class="teacher-image">
                        <img src="raphael.jpg" alt="Raphael Mellin">
                    </div>
                    <div class="teacher-content">
                        <h3>Raphael Mellin</h3>
                        <p>Assistant Moniteur</p>
                    </div>
                </div>
                
                <div class="teacher-card">
                    <div class="teacher-image">
                        <img src="Gary.jpg" alt="Gary Lugassy">
                    </div>
                    <div class="teacher-content">
                        <h3>Gary Lugassy</h3>
                        <p>Entraineur</p>
                    </div>
                </div>

                <div class="teacher-card">
                    <div class="teacher-image">
                        <img src="Arnaud.jpeg" alt="Arnaud Mascarin">
                    </div>
                    <div class="teacher-content">
                        <h3>Arnaud Mascarin</h3>
                        <p>Entraineur</p>
                    </div>
                </div>
                
                <div class="teacher-card">
                    <div class="teacher-image">
                        <img src="julien2.jpg" alt="Julien Tremblais">
                    </div>
                    <div class="teacher-content">
                        <h3>Julien Tremblais</h3>
                        <p>Entraineur</p>
                    </div>
                </div>

                <div class="teacher-card">
                    <div class="teacher-image">
                        <img src="dom2.jpg" alt="Dominique">
                    </div>
                    <div class="teacher-content">
                        <h3>Dominique Capisul</h3>
                        <p>Entraineur</p>
                    </div>
                </div>
                
                <div class="teacher-card">
                    <div class="teacher-image">
                        <img src="Dimitry.jpg" alt="Dimitry Negzaoui">
                    </div>
                    <div class="teacher-content">
                        <h3>Dimitry Negzaoui</h3>
                        <p>Entraineur jeunes</p>
                    </div>
                </div>
                
                <div class="teacher-card">
                    <div class="teacher-image">
                        <img src="nevena.jpg" alt="Nevena Stefanovic">
                    </div>
                    <div class="teacher-content">
                        <h3>Nevena Stefanovic</h3>
                        <p>DE Stagiaire</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION BUREAU -->
    <section id="bureau" class="section-padding" style="background: var(--light-bg);">
        <div class="container">
            <div class="section-header">
                <h2>Le Bureau</h2>
                <p>L'équipe qui fait vivre le BMS Tennis au quotidien</p>
            </div>
            
            <div class="bureau-content">
                <div class="bureau-list">
                    <h4>Composition 2025-2026</h4>
                    <ul>
                        <li><span>Frédéric Martin</span><span class="president-badge">Président</span></li>
                        <li><span>Christian Miller</span><span>Vice-président</span></li>
                        <li><span>Arnaud Mascarin</span><span>Directeur Général</span></li>
                        <li><span>Alain Salengue</span><span>Secrétaire Général</span></li>
                        <li><span>Michael Grunberg</span><span>Trésorier Général</span></li>
                        <li><span>Sebastien Lenglet</span><span>Membre</span></li>
                        <li><span>Eric Marin</span><span>Membre</span></li>
                        <li><span>Jean Christophe Vives</span><span>Membre</span></li>
                        <li><span>Nicolas Tersinet</span><span>Membre</span></li>
                        <li><span>Benoit Chillon</span><span>Membre</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION INFRASTRUCTURES -->
    <section id="infrastructures" class="section-padding infrastructure">
        <div class="container">
            <div class="infrastructure-content">
                <div>
                    <h2>Infrastructures</h2>
                    <p style="margin-bottom: 2rem;">Un site exceptionnel pour pratiquer le tennis dans les meilleures conditions.</p>
                    
                    <h3 style="font-size: 1.5rem;">Site Principal</h3>
                    <ul class="facilities-list">
                        <li><i class="fas fa-check-circle"></i> 2 courts Béton couverts</li>
                        <li><i class="fas fa-check-circle"></i> 2 courts Terre battue couverts</li>
                        <li><i class="fas fa-check-circle"></i> 3 courts Résine couverts</li>
                        <li><i class="fas fa-check-circle"></i> 3 courts Terre battue extérieur</li>
                        <li><i class="fas fa-check-circle"></i> Salle de musculation</li>
                    </ul>
                </div>
                
                <div class="infrastructure-image">
                    <div class="carousel-container">
                        <img class="carousel-slide active" src="terrain1.jpg" alt="Terrain 1">
                        <img class="carousel-slide" src="terrain2.jpg" alt="Terrain 2">
                        <img class="carousel-slide" src="terrain3.jpg" alt="Terrain 3">
                        <img class="carousel-slide" src="terrain4.jpg" alt="Terrain 4">
                        <img class="carousel-slide" src="terrain567.jpg" alt="Terrain 5">
                        <img class="carousel-slide" src="ok2.jpg" alt="Terrain 5">
                        <img class="carousel-slide" src="32.jpeg" alt="Terrain 6">
                        
                        <button class="carousel-btn prev" onclick="changeSlide(-1)"><i class="fas fa-chevron-left"></i></button>
                        <button class="carousel-btn next" onclick="changeSlide(1)"><i class="fas fa-chevron-right"></i></button>
                        
                        <div class="carousel-dots">
                            <span class="dot active" onclick="currentSlide(0)"></span>
                            <span class="dot" onclick="currentSlide(1)"></span>
                            <span class="dot" onclick="currentSlide(2)"></span>
                            <span class="dot" onclick="currentSlide(3)"></span>
                            <span class="dot" onclick="currentSlide(4)"></span>
                            <span class="dot" onclick="currentSlide(5)"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- SECTION INSCRIPTION -->
    <section id="inscription" class="section-padding">
        <div class="container">
            <div class="section-header">
                <h2>Tarifs 2026</h2>
                <p>Adhésion + Licence Tennis</p>
            </div>
            
            <div class="pricing-grid">
                <div class="pricing-card">
                    <div class="pricing-header">
                        <h3>Adultes</h3>
                        <p>À partir de 19 ans</p>
                    </div>
                    <div class="price">237€ <span>/an</span></div>
                    <div class="pricing-features">
                        <ul>
                            <li><i class="fas fa-check"></i> Accès aux courts</li>
                            <li><i class="fas fa-check"></i> Licence FFT incluse</li>
                            <li><i class="fas fa-check"></i> Participation compétitions</li>
                        </ul>
                    </div>
                    <div style="padding: 0 1.5rem 2rem;">
                        <a href="#contact" class="btn btn-primary" style="width: 100%;">Contact</a>
                    </div>
                </div>
                
                <div class="pricing-card populaire">
                    <div class="pricing-header" style="background: linear-gradient(135deg, var(--secondary), var(--accent));">
                        <h3 style="color: var(--dark);">Jeunes</h3>
                        <p style="color: var(--dark);">8 à 18 ans</p>
                    </div>
                    <div class="price">147€ <span>/an</span></div>
                    <div class="pricing-features">
                        <ul>
                            <li><i class="fas fa-check"></i> Accès aux courts</li>
                            <li><i class="fas fa-check"></i> Licence FFT incluse</li>
                            <li><i class="fas fa-check"></i> École de tennis</li>
                        </ul>
                    </div>
                    <div style="padding: 0 1.5rem 2rem;">
                        <a href="#contact" class="btn btn-secondary" style="width: 100%;">Contact</a>
                    </div>
                </div>
                
                <div class="pricing-card">
                    <div class="pricing-header">
                        <h3>Enfants</h3>
                        <p>Jusqu'à 7 ans</p>
                    </div>
                    <div class="price">117€ <span>/an</span></div>
                    <div class="pricing-features">
                        <ul>
                            <li><i class="fas fa-check"></i> Accès aux courts</li>
                            <li><i class="fas fa-check"></i> Licence FFT incluse</li>
                            <li><i class="fas fa-check"></i> Mini-tennis</li>
                        </ul>
                    </div>
                    <div style="padding: 0 1.5rem 2rem;">
                        <a href="#contact" class="btn btn-primary" style="width: 100%;">Contact</a>
                    </div>
                </div>
            </div>
            
            <div class="text-center" style="margin-top: 3rem;">
                <p style="font-size: 1.2rem; margin-bottom: 1rem;">Inscriptions ouvertes toute l'année</p>
                <a href="#contact" class="btn btn-accent">Contactez-nous : 06 23 85 18 56</a>
            </div>
        </div>
    </section>

    <!-- FOOTER -->
    <footer id="contact">
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
                        <li><a href="#accueil">Accueil</a></li>
                        <li><a href="#club">Le Club</a></li>
                        <li><a href="#activites">Activités</a></li>
                        <li><a href="evenements.php">Événements</a></li>
                        <li><a href="https://tenup.fft.fr/club/57930057/reservations" target="_blank">Réserver un terrain</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Informations</h3>
                    <ul class="footer-links">
                        <li><a href="#inscription">Tarifs</a></li>
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
        
        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if(target) {
                    window.scrollTo({
                        top: target.offsetTop - 80,
                        behavior: 'smooth'
                    });
                }
            });
        });

        // Carousel
        let slideIndex = 0;
        const slides = document.querySelectorAll('.carousel-slide');
        const dots = document.querySelectorAll('.dot');
        let autoPlayInterval;

        function showSlide(index) {
            if (index >= slides.length) slideIndex = 0;
            if (index < 0) slideIndex = slides.length - 1;
            
            slides.forEach(slide => slide.classList.remove('active'));
            dots.forEach(dot => dot.classList.remove('active'));
            
            slides[slideIndex].classList.add('active');
            dots[slideIndex].classList.add('active');
        }

        function changeSlide(n) {
            slideIndex += n;
            showSlide(slideIndex);
            resetAutoPlay();
        }

        function currentSlide(n) {
            slideIndex = n;
            showSlide(slideIndex);
            resetAutoPlay();
        }

        function nextSlide() {
            slideIndex++;
            showSlide(slideIndex);
        }

        function startAutoPlay() {
            autoPlayInterval = setInterval(nextSlide, 3000);
        }

        function resetAutoPlay() {
            clearInterval(autoPlayInterval);
            startAutoPlay();
        }

        if (slides.length > 0) {
            showSlide(0);
            startAutoPlay();
        }
    </script>
</body>
</html>