<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Loại tin</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <style>
        .hidden {
            display: none;
        }
    </style>
</head>
<body class="bg-gray-100 p-4">
    <div class="max-w-3xl mx-auto bg-white rounded shadow p-4">
        <h1 class="text-xl font-bold mb-4">Quản lý Loại tin</h1>
        <form id="searchForm" method="POST" class="mb-4">
            <input type="text" id="searchInput" name="search_term" placeholder="Tìm kiếm theo tên loại tin" class="w-full px-4 py-2 border rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
            <button type="submit" name="search_loaitin" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Tìm kiếm</button>
        </form>
        <div id="dataTable" class="overflow-x-auto">
            <table class="w-full border-collapse border border-gray-300">
                <thead>
                    <tr>
                        <th class="px-4 py-2 border border-gray-300">Mã Loại Tin</th>
                        <th class="px-4 py-2 border border-gray-300">Tên Loại Tin</th>
                        <th class="px-4 py-2 border border-gray-300">Thao Tác</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $servername = "localhost";
                    $username = "user";
                    $password = "123";
                    $dbname = "toasoan";
                    $conn = new mysqli($servername, $username, $password, $dbname);
                    if ($conn->connect_error) {
                        die("Kết nối thất bại: " . $conn->connect_error);
                    }
                    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['search_loaitin'])) {
                        $search_term = $_POST['search_term'];

                        $sql = "SELECT * FROM loaitin WHERE TenLT LIKE '%$search_term%'";
                    } else {
                        $sql = "SELECT * FROM loaitin";
                    }
                    $result = $conn->query($sql);
                    if ($result->num_rows > 0) {
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td class='px-4 py-2 border border-gray-300'>" . $row["MaLT"] . "</td>";
                            echo "<td class='px-4 py-2 border border-gray-300'>" . $row["TenLT"] . "</td>";
                            echo "<td class='px-4 py-2 border border-gray-300'>";
                            echo "<form method='POST'>";
                            echo "<input type='hidden' name='malt' value='" . $row["MaLT"] . "'>";
                            echo "<button type='submit' name='edit_loaitin' class='bg-green-500 text-white px-2 py-1 rounded hover:bg-green-600 mr-2'>Sửa</button>";
                            echo "<button type='submit' name='delete_loaitin' class='bg-red-500 text-white px-2 py-1 rounded hover:bg-red-600'>Xóa</button>";
                            echo "</form>";
                            echo "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3' class='px-4 py-2 border border-gray-300'>Không có dữ liệu</td></tr>";
                    }

                    ?>

                    <?php
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
        <div class="mt-4">
            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600" onclick="showAddForm()">Thêm loại tin</button>
        </div>
        <div id="addForm" class="hidden mt-4">
            <h2 class="text-xl font-bold mb-2">Thêm Loại tin mới</h2>
            <form action="" method="POST">
                <input type="text" name="malt" placeholder="Mã loại tin" class="w-full px-4 py-2 border rounded-md mb-2">
                <input type="text" name="tenlt" placeholder="Tên loại tin" class="w-full px-4 py-2 border rounded-md mb-2">
                <button type="submit" name="add_loaitin" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Thêm</button>
                <button type="button" onclick="hideAddForm()" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Hủy</button>
            </form>
        </div>

        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['edit_loaitin'])) {
            $malt = $_POST['malt'];
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql = "SELECT * FROM loaitin WHERE MaLT='$malt'";
            $result = $conn->query($sql);
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                echo "<div class='mt-4'>";
                echo "<h2 class='text-xl font-bold mb-2'>Sửa Loại tin</h2>";
                echo "<form action='' method='POST'>";
                echo "<input type='hidden' name='malt' value='" . $row["MaLT"] . "'>";
                echo "<input type='text' name='tenlt' value='" . $row["TenLT"] . "' placeholder='Tên loại tin' class='w-full px-4 py-2 border rounded-md mb-2'>";
                echo "<button type='submit' name='update_loaitin' class='bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600'>Cập nhật</button>";
                echo "<button type='button' onclick='hideEditForm()' class='bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600'>Hủy</button>";
                echo "</form>";
                echo "</div>";
            } else {
                echo "Không tìm thấy thông tin loại tin";
            }
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_loaitin'])) {
            $malt = $_POST['malt'];
            $tenlt = $_POST['tenlt'];
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql = "UPDATE loaitin SET TenLT='$tenlt' WHERE MaLT='$malt'";
            if ($conn->query($sql) === TRUE) {
                echo "Cập nhật thành công";
                echo '<meta http-equiv="refresh" content="0">';
            } else {
                echo "Lỗi: " . $sql . "<br>" . $conn->error;
            }
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_loaitin'])) {
            $malt = $_POST['malt'];
            $tenlt = $_POST['tenlt'];
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql = "INSERT INTO loaitin (MaLT, TenLT) VALUES ('$malt', '$tenlt')";
            if ($conn->query($sql) === TRUE) {
                echo "Thêm thành công";
                echo '<meta http-equiv="refresh" content="0">';
            } else {
                echo "Lỗi: " . $sql . "<br>" . $conn->error;
            }
        }
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['delete_loaitin'])) {
            $malt = $_POST['malt'];
            $conn = new mysqli($servername, $username, $password, $dbname);
            $sql = "DELETE FROM loaitin WHERE MaLT='$malt'";
            if ($conn->query($sql) === TRUE) {
                echo "Xóa thành công";
                echo '<meta http-equiv="refresh" content="0">';
            } else {
                echo "Lỗi: " . $sql . "<br>" . $conn->error;
            }
        }
        ?>
        <script>
            function showAddForm() {
                document.getElementById('addForm').classList.remove('hidden');
                document.getElementById('dataTable').classList.add('hidden');
                document.getElementById('searchForm').classList.add('hidden');
            }
            function hideAddForm() {
                document.getElementById('addForm').classList.add('hidden');
                document.getElementById('dataTable').classList.remove('hidden');
                document.getElementById('searchForm').classList.remove('hidden');
            }
        </script>
    </div>
</body>
</html>