<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Registro | Traquinagem Kids</title>
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet"/>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}"/>
  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Inter', sans-serif;
    }

    body {
      background: linear-gradient(145deg, #fdf6f9, #f0faff);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
    }

    .login-container {
      background: #fff;
      padding: 3rem;
      border-radius: 16px;
      box-shadow: 0 8px 20px rgba(0,0,0,0.05);
      width: 100%;
      max-width: 400px;
    }

    .login-form h2 {
      font-size: 1.8rem;
      margin-bottom: 0.5rem;
      color: #333;
    }

    .login-form p {
      margin-bottom: 2rem;
      color: #666;
      font-size: 0.95rem;
    }

    label {
      display: block;
      margin: 1rem 0 0.3rem;
      color: #444;
      font-weight: 500;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 0.75rem 1rem;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 1rem;
      outline: none;
      transition: border 0.3s;
    }

    input:focus {
      border-color: #dc017b;
    }

    .form-options {
      margin: 1rem 0;
      display: flex;
      justify-content: flex-end;
      font-size: 0.85rem;
    }

    .form-options a {
      color: #dc017b;
      text-decoration: none;
    }

    button {
      width: 100%;
      padding: 0.8rem;
      background: #dc017b;
      border: none;
      border-radius: 8px;
      color: white;
      font-size: 1rem;
      font-weight: bold;
      cursor: pointer;
      transition: background 0.3s;
    }

    button:hover {
      background: #c1006d;
    }

    .signup {
      text-align: center;
      margin-top: 1.5rem;
      font-size: 0.9rem;
    }

    .signup a {
      color: #00b2ff;
      text-decoration: none;
      font-weight: 500;
    }

    .social-login {
      margin-top: 1.5rem;
      text-align: center;
    }

    .social-button {
      display: flex;
      align-items: center;
      justify-content: center;
      gap: 10px;
      text-decoration: none;
      border-radius: 8px;
      padding: 0.6rem 1rem;
      font-weight: 500;
      margin-top: 0.8rem;
      transition: all 0.3s;
    }

    .google-btn {
      background: #fff;
      border: 1px solid #ccc;
      color: #333;
    }

    .facebook-btn {
      background: #3b5998;
      color: white;
    }

    .google-btn:hover {
      background: #f7f7f7;
    }

    .facebook-btn:hover {
      background: #2d4373;
    }

    .error {
      color: red;
      font-size: 0.8rem;
      margin-top: 0.2rem;
    }
  </style>
</head>
<body>
  <div class="login-container">
    <form method="POST" action="{{ route('register') }}" class="login-form">
      @csrf

      <h2>Crie sua conta 👋</h2>
      <p>Cadastre-se para começar a comprar na <strong>Traquinagem Kids</strong></p>

      <label for="name">Nome</label>
      <input type="text" name="name" id="name" value="{{ old('name') }}" placeholder="Seu nome completo" required autofocus />
      @error('name')
        <div class="error">{{ $message }}</div>
      @enderror

      <label for="email">E-mail</label>
      <input type="email" name="email" id="email" value="{{ old('email') }}" placeholder="seuemail@email.com" required />
      @error('email')
        <div class="error">{{ $message }}</div>
      @enderror

      <label for="password">Senha</label>
      <input type="password" name="password" id="password" placeholder="••••••••" required />
      @error('password')
        <div class="error">{{ $message }}</div>
      @enderror

      <label for="password_confirmation">Confirmar Senha</label>
      <input type="password" name="password_confirmation" id="password_confirmation" placeholder="••••••••" required />

      <button type="submit">Registrar</button>

      <div class="social-login">
        <div style="margin: 1rem 0; color: #888;">ou cadastre-se com</div>

        <a href="" class="social-button google-btn">
          <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="Google" style="width: 20px;">
          Registrar com Google
        </a>

        <a href="" class="social-button facebook-btn">
          <img src="https://www.svgrepo.com/show/475647/facebook-color.svg" alt="Facebook" style="width: 20px; filter: brightness(0) invert(1);">
          Registrar com Facebook
        </a>
      </div>

      <p class="signup">Já tem conta? <a href="{{ route('login') }}">Entrar agora</a></p>
    </form>
  </div>
</body>
</html>
