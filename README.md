Lancer le serveur PHP intégré :

php -S localhost:8000

Ouvrir dans le navigateur :

    http://localhost:8000/index.php

⚙️ Usage

    Connexion
    Rendez-vous sur auth.php, saisissez un nom d’utilisateur (aucune vérif pour l’exemple) et un mot de passe.

    Création
    Sur la page d’accueil (index.php), remplissez :

        Titre

        Description

        Date de clôture

        Questions + options (ajout dynamiques)

    Liste des sondages
    Cliquez sur Mes sondages pour voir tous vos sondages, puis sur Voir/Voter.

    Participation
    Cochez vos réponses, cliquez sur Voter : les résultats s’affichent immédiatement.

    Export CSV
    Accédez à results.php?format=csv&id=<poll_id> pour télécharger un fichier CSV des résultats.

📁 Arborescence

gosondage/
├── css/
│   └── style.css
├── data/                ← fichiers JSON de sondages
├── img/                 ← icônes et captures
├── js/
│   ├── create.js        ← ajout dynamique questions/options
│   └── vote.js          ← AJAX vote + rendu résultats
├── about.php            ← page À propos
├── auth.php             ← formulaire de login
├── create.php           ← création JSON + redirection
├── index.php            ← page de création de sondage
├── logout.php           ← déconnexion
├── sondage.php          ← page de vote (avec clôture)
├── sondage_list.php     ← liste des sondages
├── vote.php             ← API AJAX pour le vote
├── results.php          ← API JSON / CSV des résultats
└── README.md

👯 Contribuer

    Forkez ce dépôt

    Créez une branche :

git checkout -b feature/ma-fonctionnalite

Committez vos changements :

    git commit -m "Ajout de X"

    Pushez sur votre fork et ouvrez une Pull Request.

📄 Licence

Ce projet est distribué sous la licence MIT. Voir LICENSE pour plus de détails.
👤 Auteurs

    KABA SAKHO – github.com

    Hajar BITARI – github.com/

    Merci d’utiliser GoSondage pour vos enquêtes et sondages rapides ! 🎉


