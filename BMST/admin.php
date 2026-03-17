<?php
session_start();

// Configuration de sécurité
define('ADMIN_PASSWORD', 'bms2026');
define('MAX_LOGIN_ATTEMPTS', 5);
define('LOGIN_TIMEOUT', 900); // 15 minutes

// Initialisation du compteur de tentatives
if (!isset($_SESSION['login_attempts'])) {
    $_SESSION['login_attempts'] = 0;
    $_SESSION['last_attempt_time'] = time();
}

// Vérification du timeout
if (time() - $_SESSION['last_attempt_time'] > LOGIN_TIMEOUT) {
    $_SESSION['login_attempts'] = 0;
}

// Génération d'un token CSRF
if (!isset($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

// Fonction pour échapper les sorties HTML
function h($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

// Traitement de la connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['login'])) {
    // Vérification du nombre de tentatives
    if ($_SESSION['login_attempts'] >= MAX_LOGIN_ATTEMPTS) {
        $error = "Trop de tentatives. Réessayez dans 15 minutes.";
    } else {
        // Validation basique
        if (isset($_POST['password']) && is_string($_POST['password'])) {
            if ($_POST['password'] === ADMIN_PASSWORD) {
                $_SESSION['admin_logged_in'] = true;
                $_SESSION['login_attempts'] = 0;
                $_SESSION['user_agent'] = $_SERVER['HTTP_USER_AGENT'];
                $_SESSION['ip_address'] = $_SERVER['REMOTE_ADDR'];
            } else {
                $_SESSION['login_attempts']++;
                $_SESSION['last_attempt_time'] = time();
                $error = "Mot de passe incorrect";
            }
        }
    }
}

// Vérification de session valide
if (isset($_SESSION['admin_logged_in'])) {
    // Vérification supplémentaire (user agent et IP)
    if ($_SESSION['user_agent'] !== $_SERVER['HTTP_USER_AGENT'] || 
        $_SESSION['ip_address'] !== $_SERVER['REMOTE_ADDR']) {
        session_destroy();
        header('Location: admin.php');
        exit;
    }
}

// Déconnexion sécurisée
if (isset($_GET['logout']) && $_GET['logout'] === '1') {
    $_SESSION = array();
    if (ini_get("session.use_cookies")) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params["path"], $params["domain"],
            $params["secure"], $params["httponly"]
        );
    }
    session_destroy();
    header('Location: admin.php');
    exit;
}

// Si pas connecté, afficher formulaire de connexion
if (!isset($_SESSION['admin_logged_in'])) {
    ?>
    <!DOCTYPE html>
    <html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Connexion Admin - BMS Tennis</title>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <style>
            body {
                font-family: 'Poppins', sans-serif;
                background: linear-gradient(135deg, #1a4d80, #2a6eb0);
                height: 100vh;
                display: flex;
                align-items: center;
                justify-content: center;
                margin: 0;
            }
            .login-box {
                background: white;
                padding: 3rem;
                border-radius: 20px;
                box-shadow: 0 20px 40px rgba(0,0,0,0.2);
                text-align: center;
                max-width: 400px;
                width: 90%;
            }
            .login-box h1 {
                color: #1a4d80;
                margin-bottom: 1rem;
                font-size: 1.8rem;
            }
            .login-box input {
                width: 100%;
                padding: 1rem;
                margin: 1rem 0;
                border: 2px solid #e2e8f0;
                border-radius: 10px;
                font-size: 1rem;
                font-family: 'Poppins', sans-serif;
            }
            .login-box button {
                background: linear-gradient(135deg, #1a4d80, #2a6eb0);
                color: white;
                border: none;
                padding: 1rem 2rem;
                border-radius: 50px;
                font-size: 1rem;
                cursor: pointer;
                width: 100%;
                font-family: 'Poppins', sans-serif;
                font-weight: 600;
                transition: all 0.3s ease;
            }
            .login-box button:hover {
                transform: translateY(-3px);
                box-shadow: 0 10px 20px -5px #1a4d80;
            }
            .login-box button:disabled {
                opacity: 0.5;
                cursor: not-allowed;
            }
            .error {
                color: #dc2626;
                margin-top: 1rem;
                font-size: 0.9rem;
            }
            .attempts {
                color: #666;
                font-size: 0.8rem;
                margin-top: 1rem;
            }
        </style>
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    </head>
    <body>
        <div class="login-box">
            <h1><i class="fas fa-lock"></i> Administration</h1>
            <form method="POST" autocomplete="off">
                <input type="password" name="password" placeholder="Mot de passe" required 
                       <?php echo $_SESSION['login_attempts'] >= MAX_LOGIN_ATTEMPTS ? 'disabled' : ''; ?>>
                <input type="hidden" name="login" value="1">
                <button type="submit" <?php echo $_SESSION['login_attempts'] >= MAX_LOGIN_ATTEMPTS ? 'disabled' : ''; ?>>
                    Se connecter
                </button>
                <?php if (isset($error)): ?>
                    <div class="error"><?php echo h($error); ?></div>
                <?php endif; ?>
                <?php if ($_SESSION['login_attempts'] > 0): ?>
                    <div class="attempts">
                        Tentatives : <?php echo $_SESSION['login_attempts']; ?>/<?php echo MAX_LOGIN_ATTEMPTS; ?>
                    </div>
                <?php endif; ?>
            </form>
        </div>
    </body>
    </html>
    <?php
    exit;
}

// Traitement de l'upload d'image
function handleImageUpload($file) {
    $targetDir = 'uploads/';
    if (!file_exists($targetDir)) {
        mkdir($targetDir, 0755, true);
    }
    
    // Vérifications de sécurité
    $allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
    $maxFileSize = 5 * 1024 * 1024; // 5MB
    
    if (!in_array($file['type'], $allowedTypes)) {
        return ['success' => false, 'error' => 'Type de fichier non autorisé'];
    }
    
    if ($file['size'] > $maxFileSize) {
        return ['success' => false, 'error' => 'Fichier trop volumineux (max 5MB)'];
    }
    
    // Générer un nom de fichier sécurisé
    $extension = pathinfo($file['name'], PATHINFO_EXTENSION);
    $fileName = time() . '_' . bin2hex(random_bytes(8)) . '.' . $extension;
    $targetFilePath = $targetDir . $fileName;
    
    if (move_uploaded_file($file['tmp_name'], $targetFilePath)) {
        return ['success' => true, 'path' => $targetFilePath];
    }
    
    return ['success' => false, 'error' => 'Erreur lors de l\'upload'];
}

// Traitement AJAX pour l'upload
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_FILES['eventImage'])) {
    header('Content-Type: application/json');
    
    // Vérification du token CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        echo json_encode(['success' => false, 'error' => 'Token CSRF invalide']);
        exit;
    }
    
    $result = handleImageUpload($_FILES['eventImage']);
    echo json_encode($result);
    exit;
}

// Traitement pour sauvegarder les événements
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_events'])) {
    // Vérification du token CSRF
    if (!isset($_POST['csrf_token']) || $_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        http_response_code(403);
        exit('Token CSRF invalide');
    }
    
    // Décoder et valider les données
    $eventsData = json_decode($_POST['events_data'], true);
    if (json_last_error() !== JSON_ERROR_NONE) {
        http_response_code(400);
        exit('Données invalides');
    }
    
    // Sauvegarder dans un fichier
    file_put_contents('events_backup.json', json_encode($eventsData, JSON_PRETTY_PRINT));
    
    echo 'OK';
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - BMS Tennis</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #1a4d80;
            --primary-light: #2a6eb0;
            --secondary: #ffd700;
            --accent: #ffaa00;
            --light-bg: #f0f7ff;
            --dark: #0a1a2a;
            --gray: #4a5568;
            --gray-light: #e2e8f0;
            --transition: all 0.3s ease;
            --shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.1);
        }
        
        * { margin: 0; padding: 0; box-sizing: border-box; }
        
        body {
            font-family: 'Poppins', sans-serif;
            line-height: 1.6;
            color: var(--dark);
            background: var(--light-bg);
        }
        
        .admin-container {
            max-width: 1200px;
            margin: 100px auto 2rem;
            padding: 0 1.5rem;
        }
        
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            background: white;
            padding: 1.5rem 2rem;
            border-radius: 20px;
            box-shadow: var(--shadow);
        }
        
        .admin-header h1 {
            color: var(--primary);
            font-size: 2rem;
        }
        
        .admin-header h1 i {
            color: var(--secondary);
            margin-right: 1rem;
        }
        
        .btn {
            display: inline-block;
            padding: 0.8rem 2rem;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            transition: var(--transition);
            border: none;
            cursor: pointer;
            font-size: 1rem;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary), var(--primary-light));
            color: white;
        }
        
        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px -5px var(--primary);
        }
        
        .btn-secondary {
            background: var(--secondary);
            color: var(--dark);
        }
        
        .btn-secondary:hover {
            background: var(--accent);
            transform: translateY(-3px);
        }
        
        .btn-danger {
            background: #dc2626;
            color: white;
        }
        
        .btn-danger:hover {
            background: #b91c1c;
            transform: translateY(-3px);
        }
        
        .btn-logout {
            background: var(--gray);
            color: white;
            margin-left: 1rem;
        }
        
        .btn-save {
            background: #10b981;
            color: white;
            margin-right: 1rem;
        }
        
        .btn-save:hover {
            background: #059669;
        }
        
        .form-container {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            margin-bottom: 2rem;
            box-shadow: var(--shadow);
        }
        
        .form-container h2 {
            color: var(--primary);
            margin-bottom: 1.5rem;
            padding-bottom: 1rem;
            border-bottom: 2px solid var(--gray-light);
        }
        
        .form-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 1.5rem;
        }
        
        .form-group {
            margin-bottom: 1.5rem;
        }
        
        .form-group.full-width {
            grid-column: span 2;
        }
        
        .form-group label {
            display: block;
            font-weight: 600;
            margin-bottom: 0.5rem;
            color: var(--dark);
        }
        
        .form-group input,
        .form-group textarea,
        .form-group select {
            width: 100%;
            padding: 0.8rem 1rem;
            border: 2px solid var(--gray-light);
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
            transition: var(--transition);
        }
        
        .form-group input:focus,
        .form-group textarea:focus,
        .form-group select:focus {
            outline: none;
            border-color: var(--secondary);
        }
        
        .form-group textarea {
            min-height: 120px;
            resize: vertical;
        }
        
        .file-input-wrapper {
            position: relative;
            overflow: hidden;
            display: inline-block;
            width: 100%;
        }
        
        .file-input-wrapper input[type=file] {
            font-size: 100px;
            position: absolute;
            left: 0;
            top: 0;
            opacity: 0;
            cursor: pointer;
        }
        
        .file-input-button {
            background: var(--light-bg);
            border: 2px dashed var(--primary);
            padding: 1rem;
            text-align: center;
            border-radius: 10px;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .file-input-button:hover {
            background: var(--secondary);
            border-color: var(--secondary);
        }
        
        .file-input-button i {
            color: var(--primary);
            margin-right: 0.5rem;
        }
        
        .image-preview {
            margin-top: 1rem;
            max-width: 300px;
            border-radius: 10px;
            display: none;
            position: relative;
        }
        
        .image-preview img {
            width: 100%;
            border-radius: 10px;
            border: 2px solid var(--secondary);
        }
        
        .image-position-control {
            margin-top: 1rem;
            display: none;
        }
        
        .position-slider {
            width: 100%;
            margin: 0.5rem 0;
        }
        
        .position-value {
            display: inline-block;
            background: var(--primary);
            color: white;
            padding: 0.2rem 0.5rem;
            border-radius: 5px;
            font-size: 0.8rem;
        }
        
        .events-list {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: var(--shadow);
        }
        
        .events-list h2 {
            color: var(--primary);
            margin-bottom: 1.5rem;
        }
        
        .event-item {
            display: grid;
            grid-template-columns: auto 1fr auto auto;
            gap: 1.5rem;
            align-items: center;
            padding: 1.5rem;
            border-bottom: 2px solid var(--gray-light);
        }
        
        .event-item:last-child {
            border-bottom: none;
        }
        
        .event-thumb {
            width: 80px;
            height: 80px;
            border-radius: 10px;
            overflow: hidden;
        }
        
        .event-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .event-info h3 {
            color: var(--primary);
            margin-bottom: 0.3rem;
        }
        
        .event-info p {
            color: var(--gray);
            font-size: 0.9rem;
        }
        
        .event-info i {
            color: var(--secondary);
            width: 20px;
            margin-right: 0.3rem;
        }
        
        .event-actions {
            display: flex;
            gap: 0.8rem;
        }
        
        .btn-icon {
            width: 40px;
            height: 40px;
            border-radius: 10px;
            display: flex;
            align-items: center;
            justify-content: center;
            background: var(--light-bg);
            color: var(--primary);
            border: none;
            cursor: pointer;
            transition: var(--transition);
        }
        
        .btn-icon:hover {
            background: var(--primary);
            color: white;
            transform: translateY(-2px);
        }
        
        .btn-icon.delete:hover {
            background: #dc2626;
        }
        
        .event-badge {
            padding: 0.3rem 1rem;
            border-radius: 50px;
            font-size: 0.9rem;
            font-weight: 600;
        }
        
        .badge-futur {
            background: var(--secondary);
            color: var(--dark);
        }
        
        .badge-passe {
            background: var(--gray);
            color: white;
        }
        
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0,0,0,0.5);
            z-index: 2000;
            align-items: center;
            justify-content: center;
        }
        
        .modal.active {
            display: flex;
        }
        
        .modal-content {
            background: white;
            padding: 2rem;
            border-radius: 20px;
            max-width: 400px;
            text-align: center;
        }
        
        .modal-content h3 {
            color: var(--primary);
            margin-bottom: 1rem;
        }
        
        .modal-actions {
            display: flex;
            gap: 1rem;
            justify-content: center;
            margin-top: 2rem;
        }
        
        .alert {
            padding: 1rem;
            border-radius: 10px;
            margin-bottom: 1rem;
            display: none;
        }
        
        .alert.success {
            background: #d1fae5;
            color: #065f46;
            border: 1px solid #10b981;
            display: block;
        }
        
        .alert.error {
            background: #fee2e2;
            color: #991b1b;
            border: 1px solid #dc2626;
            display: block;
        }
        
        @media (max-width: 768px) {
            .admin-header {
                flex-direction: column;
                gap: 1rem;
                text-align: center;
            }
            .form-grid {
                grid-template-columns: 1fr;
            }
            .form-group.full-width {
                grid-column: span 1;
            }
            .event-item {
                grid-template-columns: 1fr;
                text-align: center;
            }
            .event-thumb {
                margin: 0 auto;
            }
        }
    </style>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="admin-container">
        <div id="alertMessage" class="alert"></div>
        
        <div class="admin-header">
            <h1><i class="fas fa-crown"></i> Administration BMS Tennis</h1>
            <div>
                <button onclick="showAddForm()" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nouvel événement
                </button>
                <button onclick="saveAllEvents()" class="btn btn-save">
                    <i class="fas fa-save"></i> Sauvegarder tout
                </button>
                <a href="evenements.php" class="btn btn-secondary">
                    <i class="fas fa-eye"></i> Voir les événements
                </a>
                <a href="?logout=1" class="btn btn-logout">
                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                </a>
            </div>
        </div>

        <div id="eventForm" class="form-container" style="display: none;">
            <h2 id="formTitle">Ajouter un événement</h2>
            <input type="hidden" id="csrfToken" value="<?php echo $_SESSION['csrf_token']; ?>">
            <form onsubmit="saveEvent(event)">
                <input type="hidden" id="eventId" value="">
                
                <div class="form-grid">
                    <div class="form-group full-width">
                        <label>Titre de l'événement</label>
                        <input type="text" id="eventTitle" required placeholder="Ex: Tournoi interne d'hiver">
                    </div>
                    
                    <div class="form-group full-width">
                        <label>Description</label>
                        <textarea id="eventDescription" required placeholder="Décrivez l'événement..."></textarea>
                    </div>
                    
                    <div class="form-group">
                        <label>Date de début</label>
                        <input type="date" id="eventDate" required>
                    </div>
                    
                    <div class="form-group">
                        <label>Date de fin (optionnel)</label>
                        <input type="date" id="eventEndDate">
                    </div>
                    
                    <div class="form-group">
                        <label>Horaire</label>
                        <input type="text" id="eventTime" placeholder="Ex: 9h-19h">
                    </div>
                    
                    <div class="form-group">
                        <label>Lieu</label>
                        <input type="text" id="eventLocation" placeholder="Ex: Club house, courts...">
                    </div>
                    
                    <div class="form-group">
                        <label>Participants / Places</label>
                        <input type="text" id="eventParticipants" placeholder="Ex: 48 participants">
                    </div>
                    
                    <div class="form-group">
                        <label>Image</label>
                        <div class="file-input-wrapper">
                            <div class="file-input-button" onclick="document.getElementById('fileInput').click()">
                                <i class="fas fa-cloud-upload-alt"></i> Choisir une image
                            </div>
                            <input type="file" id="fileInput" accept="image/jpeg,image/png,image/gif,image/webp" onchange="previewImage(this)">
                        </div>
                        <input type="hidden" id="eventImage" value="">
                        
                        <div id="imagePositionControl" class="image-position-control">
                            <label>Position verticale de l'image <span class="position-value" id="positionDisplay">30%</span></label>
                            <input type="range" id="imagePosition" class="position-slider" min="0" max="100" value="30" oninput="updateImagePosition(this.value)">
                            <p style="font-size: 0.8rem; color: var(--gray);">Ajustez pour centrer les visages (0% = haut, 100% = bas)</p>
                        </div>
                        
                        <div id="imagePreview" class="image-preview">
                            <img src="" alt="Aperçu" id="previewImg">
                        </div>
                    </div>
                </div>
                
                <div style="display: flex; gap: 1rem; margin-top: 2rem;">
                    <button type="submit" class="btn btn-primary">Enregistrer</button>
                    <button type="button" onclick="hideForm()" class="btn btn-secondary">Annuler</button>
                </div>
            </form>
        </div>

        <div class="events-list">
            <h2><i class="fas fa-calendar-alt"></i> Gestion des événements</h2>
            <div id="eventsList"></div>
        </div>
    </div>

    <div id="deleteModal" class="modal">
        <div class="modal-content">
            <h3>Confirmer la suppression</h3>
            <p>Êtes-vous sûr de vouloir supprimer cet événement ?</p>
            <div class="modal-actions">
                <button onclick="confirmDelete()" class="btn btn-danger">Supprimer</button>
                <button onclick="closeModal()" class="btn btn-secondary">Annuler</button>
            </div>
        </div>
    </div>

    <script>
        let events = [];
        let deleteId = null;
        const csrfToken = document.getElementById('csrfToken').value;

        function showAlert(message, type) {
            const alert = document.getElementById('alertMessage');
            alert.className = 'alert ' + type;
            alert.textContent = message;
            alert.style.display = 'block';
            setTimeout(() => {
                alert.style.display = 'none';
            }, 3000);
        }

        function updateImagePosition(value) {
            document.getElementById('positionDisplay').textContent = value + '%';
            const preview = document.getElementById('previewImg');
            if (preview.src) {
                preview.style.objectPosition = `center ${value}%`;
            }
        }

        function previewImage(input) {
            const preview = document.getElementById('imagePreview');
            const previewImg = document.getElementById('previewImg');
            const positionControl = document.getElementById('imagePositionControl');
            const file = input.files[0];
            
            if (file) {
                const allowedTypes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp'];
                if (!allowedTypes.includes(file.type)) {
                    showAlert('Type de fichier non autorisé', 'error');
                    return;
                }
                
                if (file.size > 5 * 1024 * 1024) {
                    showAlert('Fichier trop volumineux (max 5MB)', 'error');
                    return;
                }
                
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    preview.style.display = 'block';
                    positionControl.style.display = 'block';
                    
                    const position = document.getElementById('imagePosition').value;
                    previewImg.style.objectPosition = `center ${position}%`;
                    
                    document.getElementById('eventImage').value = e.target.result;
                }
                reader.readAsDataURL(file);
            }
        }

        function loadEvents() {
            const savedEvents = localStorage.getItem('bmsEvents');
            if (savedEvents) {
                events = JSON.parse(savedEvents);
                displayEventsList();
            } else {
                events = [
                    {
                        id: 1,
                        title: "Tournoi interne d'hiver",
                        date: "2026-03-15",
                        dateFin: "2026-03-16",
                        description: "Tournoi ouvert à tous les membres du club.",
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
                        description: "Soirée annuelle avec dîner et animations.",
                        heure: "19h30",
                        lieu: "Club house",
                        image: "event2.jpg",
                        imagePosition: 30
                    }
                ];
                saveEvents();
                displayEventsList();
            }
        }

        function saveEvents() {
            localStorage.setItem('bmsEvents', JSON.stringify(events));
        }

        function saveAllEvents() {
            fetch('admin.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: 'save_events=1&csrf_token=' + encodeURIComponent(csrfToken) + 
                      '&events_data=' + encodeURIComponent(JSON.stringify(events))
            })
            .then(response => {
                if (response.ok) {
                    showAlert('Tous les événements ont été sauvegardés sur le serveur', 'success');
                } else {
                    throw new Error('Erreur lors de la sauvegarde');
                }
            })
            .catch(error => {
                showAlert('Erreur : ' + error.message, 'error');
            });
        }

        function displayEventsList() {
            const today = new Date().toISOString().split('T')[0];
            
            events = events.map(event => {
                event.statut = event.date < today ? 'passe' : 'futur';
                return event;
            });
            
            events.sort((a, b) => new Date(b.date) - new Date(a.date));
            
            const list = document.getElementById('eventsList');
            
            if (events.length === 0) {
                list.innerHTML = '<p style="text-align: center; padding: 2rem;">Aucun événement.</p>';
                return;
            }
            
            list.innerHTML = events.map(event => {
                const dateObj = new Date(event.date);
                const dateFormatee = dateObj.toLocaleDateString('fr-FR', { day: 'numeric', month: 'long', year: 'numeric' });
                
                return `
                    <div class="event-item">
                        <div class="event-thumb">
                            <img src="${event.image || 'default-event.jpg'}" alt="${event.title}">
                        </div>
                        <div class="event-info">
                            <h3>${event.title.replace(/</g, '&lt;').replace(/>/g, '&gt;')}</h3>
                            <p><i class="fas fa-calendar"></i> ${dateFormatee}</p>
                            <span class="event-badge badge-${event.statut}">
                                ${event.statut === 'futur' ? 'À venir' : 'Passé'}
                            </span>
                        </div>
                        <div class="event-actions">
                            <button onclick="editEvent(${event.id})" class="btn-icon">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button onclick="showDeleteModal(${event.id})" class="btn-icon delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    </div>
                `;
            }).join('');
        }

        function showAddForm() {
            document.getElementById('formTitle').textContent = 'Ajouter un événement';
            document.getElementById('eventId').value = '';
            document.getElementById('eventTitle').value = '';
            document.getElementById('eventDescription').value = '';
            document.getElementById('eventDate').value = '';
            document.getElementById('eventEndDate').value = '';
            document.getElementById('eventTime').value = '';
            document.getElementById('eventLocation').value = '';
            document.getElementById('eventParticipants').value = '';
            document.getElementById('eventImage').value = '';
            document.getElementById('imagePosition').value = '30';
            document.getElementById('positionDisplay').textContent = '30%';
            document.getElementById('imagePreview').style.display = 'none';
            document.getElementById('imagePositionControl').style.display = 'none';
            document.getElementById('eventForm').style.display = 'block';
        }

        function editEvent(id) {
            const event = events.find(e => e.id === id);
            if (event) {
                document.getElementById('formTitle').textContent = 'Modifier l\'événement';
                document.getElementById('eventId').value = event.id;
                document.getElementById('eventTitle').value = event.title || '';
                document.getElementById('eventDescription').value = event.description || '';
                document.getElementById('eventDate').value = event.date || '';
                document.getElementById('eventEndDate').value = event.dateFin || '';
                document.getElementById('eventTime').value = event.heure || '';
                document.getElementById('eventLocation').value = event.lieu || '';
                document.getElementById('eventParticipants').value = event.participants || '';
                document.getElementById('eventImage').value = event.image || '';
                document.getElementById('imagePosition').value = event.imagePosition || 30;
                document.getElementById('positionDisplay').textContent = (event.imagePosition || 30) + '%';
                
                if (event.image) {
                    const preview = document.getElementById('imagePreview');
                    const previewImg = document.getElementById('previewImg');
                    previewImg.src = event.image;
                    previewImg.style.objectPosition = `center ${event.imagePosition || 30}%`;
                    preview.style.display = 'block';
                    document.getElementById('imagePositionControl').style.display = 'block';
                }
                
                document.getElementById('eventForm').style.display = 'block';
            }
        }

        function saveEvent(e) {
            e.preventDefault();
            
            const eventId = document.getElementById('eventId').value;
            const eventData = {
                id: eventId ? parseInt(eventId) : Date.now(),
                title: document.getElementById('eventTitle').value,
                description: document.getElementById('eventDescription').value,
                date: document.getElementById('eventDate').value,
                dateFin: document.getElementById('eventEndDate').value || null,
                heure: document.getElementById('eventTime').value || null,
                lieu: document.getElementById('eventLocation').value || null,
                participants: document.getElementById('eventParticipants').value || null,
                image: document.getElementById('eventImage').value || 'default-event.jpg',
                imagePosition: parseInt(document.getElementById('imagePosition').value) || 30
            };
            
            if (eventId) {
                const index = events.findIndex(e => e.id === parseInt(eventId));
                if (index !== -1) {
                    events[index] = { ...events[index], ...eventData };
                }
            } else {
                events.push(eventData);
            }
            
            saveEvents();
            hideForm();
            displayEventsList();
            showAlert('Événement enregistré avec succès', 'success');
        }

        function hideForm() {
            document.getElementById('eventForm').style.display = 'none';
        }

        function showDeleteModal(id) {
            deleteId = id;
            document.getElementById('deleteModal').classList.add('active');
        }

        function closeModal() {
            document.getElementById('deleteModal').classList.remove('active');
            deleteId = null;
        }

        function confirmDelete() {
            if (deleteId) {
                events = events.filter(e => e.id !== deleteId);
                saveEvents();
                displayEventsList();
                closeModal();
                showAlert('Événement supprimé', 'success');
            }
        }

        document.addEventListener('DOMContentLoaded', loadEvents);
    </script>
</body>
</html>