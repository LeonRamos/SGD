<?php

// ===============================
// BASE PATH (una sola vez)
// ===============================
if (!defined('BASE_PATH')) {
    define('BASE_PATH', realpath(__DIR__ . '/..'));
}

// ===============================
// TIMEZONE
// ===============================
date_default_timezone_set('America/Mexico_City');

// ===============================
// PATHS
// ===============================
define('CONTROLLER_PATH', BASE_PATH . '/controllers/');
define('MODEL_PATH',      BASE_PATH . '/models/');
define('UTIL_PATH',       BASE_PATH . '/utils/');
define('VIEW_PATH',       BASE_PATH . '/views/');
define('SERVER_PATH',     BASE_PATH . '/server/');

// ===============================
// CORE INCLUDES
// ===============================
require_once SERVER_PATH . 'DB.php';

// ===============================
// UTILS / MODALS
// ===============================
require_once UTIL_PATH . 'Modal.php';
require_once UTIL_PATH . 'ModalAddDocumento.php';
require_once UTIL_PATH . 'ModalEditCommissions.php';
require_once UTIL_PATH . 'ModalDeleteCommissions.php';
require_once UTIL_PATH . 'ModalAddComision.php';
require_once UTIL_PATH . 'ModalEditDocumento.php';
require_once UTIL_PATH . 'ModalAddLicencias.php';
require_once UTIL_PATH . 'ModalEditLicencias.php';
require_once UTIL_PATH . 'ModalDeleteLicencias.php';
require_once UTIL_PATH . 'ModalAddUser.php';
require_once UTIL_PATH . 'ModalEditUser.php';
require_once UTIL_PATH . 'Alert.php';
require_once UTIL_PATH . 'ModalAddTimeByTime.php';
require_once UTIL_PATH . 'ModalUploadFileTimeByTime.php';
require_once UTIL_PATH . 'ModalDeleteTimeByTime.php';

// ===============================
// APP INFO
// ===============================
define('APP_NAME', 'SGDRH');
