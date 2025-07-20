<?php
session_start();
// Check if the user is logged in, if not, redirect to the login page
if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EDUSTUDS - Home</title>
  
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700&family=Inter:wght@300;400;600;700&family=Pacifico&display=swap" rel="stylesheet">
    <style>
        
        html, body {
            margin: 0;
            padding: 0;
            width: 100%;
            overflow-x: hidden;
            font-family: 'Inter', sans-serif;
            color: #706e6e;
            background-color: #FFFFFF; 
            scroll-behavior: smooth;
        }

        
        .main {
            position: relative;
            width: 100%;
            height: 100vh; 
            overflow: hidden;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            text-align: center;
        }

        .dashboard {
            position: absolute;
            top: 50%;
            left: 50%;
            min-width: 100%;
            min-height: 100%;
            width: auto;
            height: auto;
            transform: translate(-50%, -50%);
            object-fit: cover;
            z-index: -1; 
            filter: brightness(0.8);
        }

        
        nav {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px 5%;
            background: rgba(255, 255, 255, 0.85); 
            z-index: 10;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05); 
        }

        nav .logo {
            color: #1A293A; 
            font-family: 'Pacifico', cursive; /* Curvy font for logo */
            font-size: 2em; /* Slightly larger for impact */
            font-weight: 700;
            text-decoration: none;
            letter-spacing: 1px;
            text-shadow: none; /* Removed glow */
        }

        nav ul {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
            /* Added for better responsiveness to prevent items from being pushed off-screen */
            flex-wrap: wrap; 
            justify-content: flex-end; /* Align items to the right */
        }

        nav ul li {
            margin-left: 30px;
            /* Added to prevent the list item from shrinking and hiding the button text */
            flex-shrink: 0;
        }

        nav ul li a {
            color: #1A293A; /* Dark blue links */
            text-decoration: none;
            font-size: 1.1em;
            font-weight: 600;
            padding: 5px 10px;
            border-radius: 5px;
            transition: all 0.3s ease;
        }

        nav ul li a:hover {
            background-color: #E0E7FF; /* Very light blue background on hover */
            color: #1A293A; /* Dark blue text on hover */
            box-shadow: 0 0 10px rgba(0,0,0,0.1); /* Subtle shadow */
        }

        /* Content in Main Section */
        .content {
            position: relative;
            z-index: 1;
            color: #1A293A; /* Dark blue text */
            animation: fadeInSlideUp 1s ease-out forwards;
            opacity: 0; /* Start hidden for animation */
            transform: translateY(20px);
        }

        .content h1 {
            font-family: 'Pacifico', cursive; /* Curvy font for main heading */
            font-size: 5.5em; /* Slightly larger for impact */
            font-weight: 700; /* Adjusted for Pacifico's natural weight */
            margin-bottom: 20px;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.1); /* Subtle shadow, no glow */
        }

        .content a {
            display: inline-block;
            background-color: #4A90E2; /* Accent blue button */
            color: #FFFFFF; /* White text on button */
            padding: 18px 40px;
            text-decoration: none;
            border-radius: 50px;
            font-size: 1.3em;
            font-weight: 700;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(74, 144, 226, 0.3); /* Subtle shadow */
        }

        .content a:hover {
            background-color: #3A7ECB; /* Slightly darker blue on hover */
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(74, 144, 226, 0.5); /* More pronounced shadow */
        }

        /* Keyframe Animations (kept same) */
        @keyframes fadeInSlideUp {
            from {
                opacity: 0;
                transform: translateY(50px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInScale {
            from {
                opacity: 0;
                transform: scale(0.9);
            }
            to {
                opacity: 1;
                transform: scale(1);
            }
        }

        /* Exhibition Gallery Section */ 
        .gallery-section { 
            padding: 80px 5%; 
            background-color: #F8F8F8; /* Very light grey, almost white */ 
            text-align: center; 
        } 

        .heading { 
            margin-bottom: 60px; 
            animation: fadeInSlideUp 1s ease-out 0.8s forwards; /* Delayed animation */ 
            opacity: 0; 
        } 

        .heading h2 { 
            font-family: 'Pacifico', cursive; /* Curvy font for gallery heading */
            font-size: 3em; /* Adjusted size */
            font-weight: 700; /* Adjusted for Pacifico's natural weight */
            color: #1A293A; /* Dark blue heading */ 
            text-transform: none; /* Removed uppercase */
            letter-spacing: normal; /* Removed letter spacing */
            text-shadow: 0 0 5px rgba(0,0,0,0.1); /* Subtle shadow, no glow */ 
            position: relative; 
            display: inline-block; 
        } 

        .heading h2::after, 
        .heading h2::before { 
            content: ''; 
            position: absolute; 
            width: 50px; 
            height: 3px; 
            background-color: #4A90E2; /* Accent blue lines */ 
            top: 50%; 
            transform: translateY(-50%); 
        } 
        .heading h2::before { left: -70px; } 
        .heading h2::after { right: -70px; } 


        /* Flex Properties for Image Gallery */ 
        .flex_properties { 
            display: grid; 
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); /* Responsive grid for images */ 
            gap: 30px; /* Space between images */ 
            max-width: 1200px;
            margin: 0 auto; /* Center the grid */
        } 

        .flexBox { 
            background-color: #FFFFFF; /* White background for image boxes */ 
            border-radius: 15px; 
            overflow: hidden; 
            box-shadow: 0 4px 15px rgba(0,0,0,0.1); /* Subtle shadow */ 
            position: relative; 
            cursor: pointer; 
            transition: transform 0.4s ease, box-shadow 0.4s ease; 
            animation: fadeInScale 0.8s ease-out forwards; /* Individual image box animation */ 
            opacity: 0; /* Start hidden for animation */ 
        } 

        /* Stagger animation for gallery images (kept same) */ 
        .flexBox:nth-child(1) { animation-delay: 0.1s; } 
        .flexBox:nth-child(2) { animation-delay: 0.2s; } 
        .flexBox:nth-child(3) { animation-delay: 0.3s; } 
        .flexBox:nth-child(4) { animation-delay: 0.4s; } 
        .flexBox:nth-child(5) { animation-delay: 0.5s; } 
        .flexBox:nth-child(6) { animation-delay: 0.6s; } 
        .flexBox:nth-child(7) { animation-delay: 0.7s; } 
        .flexBox:nth-child(8) { animation-delay: 0.8s; } 
        .flexBox:nth-child(9) { animation-delay: 0.9s; } 
        .flexBox:nth-child(10) { animation-delay: 1.0s; } 
        .flexBox:nth-child(11) { animation-delay: 1.1s; } 
        .flexBox:nth-child(12) { animation-delay: 1.2s; } 


        .flexBox:hover { 
            transform: translateY(-10px) scale(1.03); 
            box-shadow: 0 8px 25px rgba(0,0,0,0.2); /* More pronounced, but not glowing */ 
        } 

        .flexBox img { 
            width: 100%; 
            height: 250px; /* Fixed height for consistent gallery look */ 
            object-fit: cover; /* Ensures images fill their space */ 
            display: block; 
            transition: transform 0.4s ease; 
        } 

        .flexBox:hover img { 
            transform: scale(1.1); /* Zoom effect on hover */ 
        } 

        /* Image Overlay Effect */ 
        .flexBox::before { 
            content: ''; 
            position: absolute; 
            top: 0; 
            left: 0; 
            width: 100%; 
            height: 100%; 
            background: linear-gradient(to top, rgba(0,0,0,0.3), rgba(0,0,0,0)); /* Lighter dark overlay */ 
            opacity: 0; 
            transition: opacity 0.4s ease; 
            z-index: 1; 
        } 

        .flexBox:hover::before { 
            opacity: 1; 
        } 

        /* Responsive Adjustments (kept mostly same, adjusted font sizes for new font) */ 
        @media (max-width: 1024px) { 
            .content h1 { 
                font-size: 4.8em; /* Adjusted for Pacifico */
            } 
            .content a { 
                font-size: 1.2em; 
                padding: 15px 35px; 
            } 
            .heading h2 { 
                font-size: 2.8em; /* Adjusted for Pacifico */
            } 
            .heading h2::before, 
            .heading h2::after { 
                width: 40px; 
                left: -60px; 
                right: -60px; 
            } 
            .flex_properties { 
                grid-template-columns: repeat(auto-fit, minmax(250px, 1fr)); 
                gap: 25px; 
            } 
        } 

        @media (max-width: 768px) { 
            nav { 
                flex-direction: column; 
                padding: 15px 5%; 
            } 
            nav .logo { 
                margin-bottom: 15px; 
                font-size: 1.8em;
            } 
            nav ul { 
                width: 100%; 
                justify-content: space-around; 
                margin-top: 10px; 
            } 
            nav ul li { 
                margin-left: 0; 
            } 
            nav ul li a { 
                font-size: 1em; 
                padding: 8px 0; 
            } 
            .content h1 { 
                font-size: 3.8em; /* Adjusted for Pacifico */
            } 
            .content a { 
                font-size: 1.1em; 
                padding: 12px 30px; 
            } 
            .heading h2 { 
                font-size: 2.2em; /* Adjusted for Pacifico */
            } 
            .heading h2::before, 
            .heading h2::after { 
                display: none; /* Hide side lines on smaller screens */ 
            } 
            .flex_properties { 
                grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); 
                gap: 20px; 
            } 
            .flexBox img { 
                height: 200px; /* Smaller image height */ 
            } 
        } 
        @media (max-width: 480px) { 
            body { 
                padding: 0; 
            } 
            nav { 
                padding: 10px 5%; 
            } 
            nav .logo { 
                font-size: 1.5em; 
            } 
            nav ul { 
                flex-wrap: wrap; 
                justify-content: center; 
                margin-top: 5px; 
            } 
            nav ul li { 
                margin: 5px 10px; 
            } 
            nav ul li a { 
                font-size: 0.9em; 
            } 
            .main { 
                height: 80vh; /* Shorter main section on tiny screens */ 
            } 
            .content h1 { 
                font-size: 3em; /* Adjusted for Pacifico */
                margin-bottom: 20px; 
            } 
            .content a { 
                font-size: 1em; 
                padding: 10px 25px; 
            } 
            .gallery-section { 
                padding: 40px 5%; 
            } 
            .heading h2 { 
                font-size: 2em; /* Adjusted for Pacifico */
                margin-bottom: 40px; 
            } 
            .flex_properties { 
                grid-template-columns: 1fr; /* Single column layout for gallery */ 
                gap: 15px; 
            } 
            .flexBox img { 
                height: 180px; 
            } 
        }

        .streak-container {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            background-color: #f7f7f7;
            border-radius: 10px;
            padding: 10px 20px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            font-family: Arial, sans-serif;
            color: #333;
        }

        .streak-icon {
            font-size: 39px;
            margin-right: 10px;
        }

        #streak-counter {
            font-size: 33px;
            font-weight: bold;
        }

        /* Styling for the Logout button */
        .logout-button {
            background-color: #dc3545; /* Red color for danger/logout */
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1.1em;
            font-weight: 600;
            transition: background-color 0.3s ease;
            text-decoration: none; /* Ensure no underline */
            display: inline-block; /* Allows padding and margin */
        }

        .logout-button:hover {
            background-color: #c82333; /* Darker red on hover */
        }
    </style>
</head>
<body>
    <section class="main">
        <video autoplay loop muted class="dashboard">
            <source src="/img&video/project_Dasboard.mp4" type="video/mp4">
            Your browser does not support the video tag.
        </video>

        <nav>
            <a href="#" class="logo">EDUSTUDS</a>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
                  
            <ul> 
                <li><a href="ChatBot.html" style = "font-size: 39px; text-decoration: none; margin-left: auto;">🤖</a></li>    
                <li>
                    <a href="explore-page-subjects.html"  id="subject-link">Subjects</a>
                </li>
                <li>
                    <a href="aboutus-intern.html">About</a>
                </li>
                <li >
                    <a href="conctpage.html">Contact Us</a>
                </li>
                <li>
                    <a href="logout.php" class="logout-button">Logout</a>
                </li>
            </ul>
        </nav>

        <div class="content">
            <h1>WELCOME</h1>
            <a href="explore-page-subjects.html" id = "explore-link">Explore</a>
            <br><br><br>
            <div class="content">
   
                <div class="streak-container">
                    <span class="streak-icon">🔥</span>
                    <span id="streak-counter">0-Day Streak</span>
                </div>

                <script>
                document.addEventListener('DOMContentLoaded', () => {
                    const streakCounterElement = document.getElementById('streak-counter');
                    const streakKey = 'dailyStreakCount';
                    const lastActiveKey = 'lastActiveDate';

                    function updateStreakDisplay(streakCount) {
                        streakCounterElement.textContent = `${streakCount}-Day Streak`;
                    }

                    function loadStreak() {
                        let streakCount = parseInt(localStorage.getItem(streakKey)) || 0;
                        let lastActiveDate = localStorage.getItem(lastActiveKey);
                        const today = new Date().toLocaleDateString('en-US');

                        if (lastActiveDate === today) {
                            // Already updated today
                        } else if (lastActiveDate) {
                            const yesterday = new Date();
                            yesterday.setDate(yesterday.getDate() - 1);
                            const yesterdayString = yesterday.toLocaleDateString('en-US');
                            if (lastActiveDate !== yesterdayString) {
                                streakCount = 0;
                            }
                        }
                        updateStreakDisplay(streakCount);
                    }

                    function addStreak() {
                        const today = new Date().toLocaleDateString('en-US');
                        let lastActiveDate = localStorage.getItem(lastActiveKey);

                        if (lastActiveDate === today) {
                            return; // Only once per day
                        }

                        let streakCount = parseInt(localStorage.getItem(streakKey)) || 0;
                        streakCount++;
                        localStorage.setItem(streakKey, streakCount);
                        localStorage.setItem(lastActiveKey, today);
                        updateStreakDisplay(streakCount);
                    }

                    loadStreak();

                    
                    const subjectLink = document.getElementById('subject-link');
                    if (subjectLink) {
                        subjectLink.addEventListener('click', addStreak);
                    }
                    const quizLink = document.getElementById('quiz-link');
                    if (quizLink) {
                        quizLink.addEventListener('click', addStreak);
                    }
                    const exploreLink = document.getElementById('explore-link');
                    if (exploreLink) {
                        exploreLink.addEventListener('click', addStreak);
                    }

                    // --- Debugging for Logout Button Visibility ---
                    const logoutButton = document.querySelector('.logout-button');
                    if (logoutButton) {
                        console.log('Logout button found in DOM.');
                        // You can add more checks here, e.g., for computed style
                        // const computedStyle = window.getComputedStyle(logoutButton);
                        // console.log('Logout button display:', computedStyle.display);
                        // console.log('Logout button visibility:', computedStyle.visibility);
                        // console.log('Logout button opacity:', computedStyle.opacity);
                    } else {
                        console.log('Logout button NOT found in DOM.');
                    }
                    // --- End Debugging ---

                });
                </script>
            </div>
        </div>
    </section>

    <section class="gallery-section">
        <div class="heading">
            <h2>--- Exhibition Gallery ---</h2>
        </div>

        <div class="flex_properties">
            <div class="flexBox"><img src="/img&video/20250523_15405PMByGPSMapCamera.jpg" alt="Galaxy image 1"></div>
            <div class="flexBox"><img src="/img&video/20250519_13202pmByGPSMapCamera.jpg" alt="Galaxy image 2"></div>
            <div class="flexBox"><img src="/img&video/20250521_13956PMByGPSMapCamera.jpg" alt="Galaxy image 3"></div>
            <div class="flexBox"><img src="/img&video/20250522_10016PMByGPSMapCamera.jpg" alt="Galaxy image 4"></div>
            <div class="flexBox"><img src="/img&video/20250528_115007amByGPSMapCamera.jpg" alt="Galaxy image5"></div>
            <div class="flexBox"><img src="/img&video/20250526_12447pmByGPSMapCamera.jpg" alt="Galaxy image 6"></div>
            <div class="flexBox"><img src="/img&video/1000073884.jpg" alt="Galaxy image 7"></div>
            <div class="flexBox"><img src="/img&video/1000073484.jpg" alt="Galaxy image 8"></div>
            <div class="flexBox"><img src="/img&video/1000072885.jpg" alt="Galaxy image 9"></div>
            <div class="flexBox"><img src="/img&video/1000072670.jpg" alt="Galaxy image 10"></div>
            <div class="flexBox"><img src="/img&video/1000072494.jpg" alt="Galaxy image 11"></div>
            <div class="flexBox"><img src="/img&video/1000072462.jpg" alt="Galaxy image 11"></div>
        </div>
    </section>

    <script>
        
        document.addEventListener('DOMContentLoaded', () => {
            console.log('Exhibition Gallery section loaded.');
            
        });
    </script>
</body>
</html>
