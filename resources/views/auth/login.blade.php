<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Админ нэвтрэх</title>
    <style>
        /* Бүхэлдээ төвлөрсөн контент */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            font-family: Arial, sans-serif;
            margin: 0;
            background-color: #f4f6f9;
        }
        
        /* Нэвтрэх картын загвар */
        .login-container {
            width: 100%;
            max-width: 400px;
            padding: 20px;
            background-color: white;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            border-radius: 8px;
            text-align: center;
        }

        /* Гарчигны загвар */
        .login-container h2 {
            margin-bottom: 20px;
            color: #333;
        }

        /* Формаас текст болон зайны тохиргоо */
        .login-container form div {
            margin-bottom: 15px;
            text-align: left;
        }

        /* Оролтын талбарын загвар */
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        /* Товчлуурын загвар */
        button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        
        /* Хулгана товч дээр ирэхэд товчлуурын өнгө */
        button:hover {
            background-color: #45a049;
        }

        /* Алдаа мессеж */
        .error-message {
            color: red;
            font-size: 14px;
            margin-top: 10px;
        }
        
        /* "Намайг сана" */
        label {
            font-size: 14px;
            color: #555;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <h2>Админ нэвтрэх</h2>
        <form action="{{ route('login') }}" method="POST">
            @csrf
            <div>
                <label for="email">И-мэйл:</label>
                <input type="email" name="email" id="email" required>
            </div>
            <div>
                <label for="password">Нууц үг:</label>
                <input type="password" name="password" id="password" required>
            </div>
            <div>
                <label>
                    <input type="checkbox" name="remember"> Намайг сана
                </label>
            </div>
            <div>
                <button type="submit">Нэвтрэх</button>
            </div>
            @if ($errors->any())
                <div class="error-message">
                    <p>{{ $errors->first() }}</p>
                </div>
            @endif
        </form>
    </div>
</body>
</html>
