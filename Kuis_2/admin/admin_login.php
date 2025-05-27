<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>gudangnet - Login</title>
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background-color: #f5f5f5;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .login-container {
            background: white;
            padding: 2.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0,0,0,0.1);
            width: 400px;
        }

        .login-header {
            text-align: center;
            margin-bottom: 1.5rem;
        }

        .login-header h1 {
            color: #2c3e50;
            font-size: 1.8rem;
            margin-bottom: 1rem;
        }

        .role-selection {
            display: flex;
            gap: 1.5rem;
            justify-content: center;
            margin-bottom: 2rem;
        }

        .role-option {
            font-weight: 600;
            color: #555;
            display: flex;
            align-items: center;
        }

        .role-option input {
            margin-right: 0.5rem;
            cursor: pointer;
        }

        .welcome-message {
            text-align: center;
            color: #7f8c8d;
            margin-bottom: 2rem;
            font-size: 1rem;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-group label {
            display: block;
            margin-bottom: 0.5rem;
            color: #34495e;
            font-weight: 500;
        }

        .form-group input {
            width: 100%;
            padding: 0.8rem;
            border: 2px solid #ecf0f1;
            border-radius: 6px;
            font-size: 1rem;
            transition: border-color 0.3s ease;
        }

        .form-group input:focus {
            outline: none;
            border-color: #3498db;
        }

        .login-button {
            width: 100%;
            padding: 1rem;
            background-color: #27ae60;
            color: white;
            border: none;
            border-radius: 6px;
            font-size: 1rem;
            font-weight: 600;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .login-button:hover {
            background-color: #219a52;
        }

        .version-footer {
            text-align: center;
            margin-top: 2rem;
            color: #95a5a6;
            font-size: 0.85rem;
        }
    </style>
</head>
<body>
    <div class="login-container">
        <form action="proses_login.php" method="POST">
            <div class="login-header">
                <h1>LOGIN</h1>
                <div class="role-selection">
                    <label class="role-option">
                        <input type="radio" name="role" value="Customer" required />
                        Customer
                    </label>
                    <label class="role-option">
                        <input type="radio" name="role" value="Admin" required />
                        Admin
                    </label>
                </div>
            </div>

            <div class="welcome-message">
                Hi, Welcome to gudangnet.
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input id="email" type="email" name="email" placeholder="Enter your email" required />
            </div>

            <div class="form-group">
                <label for="password">Password</label>
                <input id="password" type="password" name="password" placeholder="Enter password" required />
            </div>

            <button type="submit" class="login-button">LOGIN</button>
        </form>

        <div class="version-footer">
            1.0.0 | Dikembangkan oleh Kelompok 3
        </div>
    </div>
</body>
</html>
