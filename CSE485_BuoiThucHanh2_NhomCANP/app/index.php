<!-- Routing là gì? Định tuyến/Điều hướng -->
<!-- Phân tích xem: URL của người dùng > Muốn gì -->
<!-- Ví dụ: Trang chủ, Quản lý bài viết hay Thêm bài viết -->
<!-- Chuyển quyền cho Controller tương ứng điều khiển tiếp -->
<!-- URL của tôi thiết kế luôn có dạng: -->

<!-- http://localhost/btth02v2/index.php?controller=A&action=B -->
<!-- http://localhost/btth02v2/index.php -->
<!-- http://localhost/btth02v2/index.php?controller=home&action=index -->

<!-- Controller là tên của FILE controller mà chúng ta sẽ gọi -->
<!-- Action là tên cả HÀM trong FILE controller mà chúng ta gọi -->

<?php
// B1: Bắt giá trị controller và action
$controller = isset($_GET['controller'])?   $_GET['controller']:'home';
$action     = isset($_GET['action'])?       $_GET['action']:'index';

// B2: Chuẩn hóa tên trước khi gọi
$controller = ucfirst($controller);
$controller .= 'Controller';
$controllerPath = 'controllers/'.$controller.'.php';

// B3. Để gọi nó Controller
if(!file_exists($controllerPath)){
    die('Lỗi! Controller này không tồn tại');
}
require_once($controllerPath);
// B4. Tạo đối tượng và gọi hàm của Controller
$myObj = new $controller();  //controller=home > new HomeController()
$myObj->$action(); //action=index > index()


// index.php

// Kết nối cơ sở dữ liệu
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "btth01_cse485";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Kết nối thất bại: " . $conn->connect_error);
}

// Xác định controller và action
$controller = isset($_GET['controller']) ? $_GET['controller'] : 'login';
$action = isset($_GET['action']) ? $_GET['action'] : 'showForm';

// Nạp controller
switch ($controller) {
    case 'login':
        require_once 'controllers/login.php';
        $loginController = new LoginController($conn);
        break;
<<<<<<< HEAD:CSE485_BuoiThucHanh2_NhomCANP/app/index.php
    case 'ArticleController':
            require_once 'controllers/login.php';
            $loginController = new LoginController($conn);
            break;
=======
>>>>>>> 342b362e51794a912690b08b676e9dcdf1f728e1:CSE485_BuoiThucHanh2_NhomCANP/index.php
    // Thêm các controller khác ở đây
    default:
        require_once 'controllers/login.php';
        $loginController = new LoginController($conn);
        break;
}

// Gọi action tương ứng
if (method_exists($loginController, $action)) {
    $loginController->$action();
} else {
    echo "Action không tồn tại!";
}
<<<<<<< HEAD:CSE485_BuoiThucHanh2_NhomCANP/app/index.php

include(__DIR__ . '/views/author/author_view.php');
?>
=======
>>>>>>> 342b362e51794a912690b08b676e9dcdf1f728e1:CSE485_BuoiThucHanh2_NhomCANP/index.php
