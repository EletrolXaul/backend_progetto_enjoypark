<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EnjoyPark - Server Status</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
        }
        
        .container {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-radius: 20px;
            padding: 40px;
            text-align: center;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(255, 255, 255, 0.2);
            max-width: 500px;
            width: 90%;
        }
        
        .logo {
            font-size: 4rem;
            margin-bottom: 20px;
            animation: bounce 2s infinite;
        }
        
        .title {
            font-size: 2.5rem;
            font-weight: bold;
            margin-bottom: 10px;
            background: linear-gradient(45deg, #fff, #f0f0f0);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
        }
        
        .status {
            font-size: 1.5rem;
            margin-bottom: 30px;
            color: #4ade80;
            font-weight: 600;
        }
        
        .info-grid {
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 20px;
            margin-bottom: 30px;
        }
        
        .info-card {
            background: rgba(255, 255, 255, 0.1);
            padding: 15px;
            border-radius: 10px;
            border: 1px solid rgba(255, 255, 255, 0.1);
        }
        
        .info-label {
            font-size: 0.9rem;
            opacity: 0.8;
            margin-bottom: 5px;
        }
        
        .info-value {
            font-size: 1.1rem;
            font-weight: 600;
        }
        
        .timestamp {
            font-size: 0.9rem;
            opacity: 0.7;
            margin-bottom: 20px;
        }
        
        .api-link {
            display: inline-block;
            background: rgba(255, 255, 255, 0.2);
            color: white;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 25px;
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.3s ease;
            font-weight: 500;
        }
        
        .api-link:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
        }
        
        @keyframes bounce {
            0%, 20%, 50%, 80%, 100% {
                transform: translateY(0);
            }
            40% {
                transform: translateY(-10px);
            }
            60% {
                transform: translateY(-5px);
            }
        }
        
        @media (max-width: 600px) {
            .info-grid {
                grid-template-columns: 1fr;
            }
            .title {
                font-size: 2rem;
            }
        }
    </style>
    <script>
        function updateTime() {
            const now = new Date();
            document.getElementById('current-time').textContent = now.toLocaleString('it-IT');
        }
        
        setInterval(updateTime, 1000);
        window.onload = updateTime;
    </script>
</head>
<body>
    <div class="container">
        <div class="logo">🎢</div>
        <h1 class="title">EnjoyPark</h1>
        <div class="status">✅ SERVER ONLINE</div>
        
        <div class="info-grid">
            <div class="info-card">
                <div class="info-label">Laravel</div>
                <div class="info-value">{{ app()->version() }}</div>
            </div>
            <div class="info-card">
                <div class="info-label">PHP</div>
                <div class="info-value">{{ PHP_VERSION }}</div>
            </div>
            <div class="info-card">
                <div class="info-label">Ambiente</div>
                <div class="info-value">{{ app()->environment() }}</div>
            </div>
            <div class="info-card">
                <div class="info-label">Timezone</div>
                <div class="info-value">{{ config('app.timezone') }}</div>
            </div>
        </div>
        
        <div class="timestamp">
            Ultimo aggiornamento: <span id="current-time"></span>
        </div>
    </div>
</body>
</html>