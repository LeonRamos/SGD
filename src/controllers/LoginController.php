<?php

//require_once UTIL_PATH . 'Session.php';

class LoginController
{
    private $db; // PDO

    public function __construct()
    {
        // Obtener conexión PDO desde el Singleton DB
        $this->db = DB::getInstance()->getConnection();
    }

    public function showLoginForm()
    {
        require VIEW_PATH . 'auth/login.php';
    }

    public function login()
    {
        Session::start();

        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            return;
        }

        $email    = $_POST['email'] ?? null;
        $password = $_POST['password'] ?? null;

        if (empty($email) || empty($password)) {
            Session::set('login_warning', 'Tienes que ingresar tu correo y tu contraseña.');
            header('Location: login.php');
            exit;
        }

        $query = "SELECT * FROM usuario WHERE usuario_email = :email LIMIT 1";
        $stmt  = $this->db->prepare($query);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();

        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user) {
            Session::set('login_error', 'El correo que ingresaste no existe.');
            header('Location: login.php');
            exit;
        }

        if ($user['estatus'] === 'Baja') {
            Session::set('login_error', 'Tu cuenta ha sido desactivada.');
            header('Location: login.php');
            exit;
        }

        if (!password_verify($password, $user['usuario_password'])) {
            Session::set('login_error', 'La contraseña no coincide con los registros.');
            header('Location: login.php');
            exit;
        }

        // Login correcto
        $this->initializeSession($user);

        // Redirección por rol
        if ($user['rol_id'] == 3) {
            header('Location: client_home.php?page=dashboard');
        } else {
            header('Location: admin_home.php?page=dashboard');
        }
        exit;
    }

    private function initializeSession(array $user)
    {
        Session::set('user_id',    $user['usuario_id']);
        Session::set('user_name',  $user['usuario_nombre']);
        Session::set('user_role',  $user['rol_id']);
        Session::set('user_genre', $user['usuario_genero']);
        Session::set('user_avatar', $user['usuario_foto']);

        if ($user['rol_id'] != 3) {
            Session::set('user_area', $user['areaAdscripcion_id']);

            if (!empty($user['sindicato_id']) && $user['sindicato_id'] !== 'No Sindicalizado') {
                Session::set('user_union', $user['sindicato_id']);
            }
        }
    }

    public function logout()
    {
        Session::start();
        Session::destroy();
        header('Location: login.php');
        exit;
    }
}
