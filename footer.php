<?php
// Pastikan tidak ada output sebelum ini agar footer bisa menempel
?>

    <footer class="footer mt-auto py-4 animate__animated animate__fadeInUp">
        <div class="container">
            <div class="d-flex justify-content-between align-items-center">
                <span class="footer-text"><em>© Yefta Bryant Joe Grado</em></span>
                <ul class="nav">
                    <li class="nav-item">
                        <a class="nav-link footer-link" target="_blank" href="https://blogbugabagi.blogspot.com">
                            Artificial Intelligence
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </footer>

    <style>
        /* Ensure the body and html take full height */
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        /* Main content grows to push footer down */
        .container {
            flex: 1 0 auto;
        }

        /* Footer Styling */
        .footer {
            background: linear-gradient(135deg, #2c3e50, #3498db);
            color: #fff;
            flex-shrink: 0;
            box-shadow: 0 -4px 15px rgba(0, 0, 0, 0.2);
            transition: all 0.3s ease;
        }

        .footer:hover {
            box-shadow: 0 -6px 20px rgba(0, 0, 0, 0.3);
        }

        .footer-text {
            font-style: italic;
            font-size: 1.1rem;
            transition: all 0.3s ease;
        }

        .footer-text:hover {
            color: #f1c40f;
        }

        .footer-link {
            color: #fff !important;
            font-weight: 500;
            padding: 0.5rem 1rem !important;
            position: relative;
            transition: all 0.3s ease;
        }

        .footer-link::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: 0;
            left: 50%;
            background-color: #f1c40f;
            transition: all 0.3s ease;
            transform: translateX(-50%);
        }

        .footer-link:hover::after {
            width: 100%;
        }

        .footer-link:hover {
            color: #f1c40f !important;
            transform: translateY(-2px);
        }
    </style>

</body>
</html>