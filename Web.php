<?php
$servername = "localhost";
$username = "user"; 
$password = "123"; 
$dbname = "toasoan"; 

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
  die("Kết nối không thành công: " . $conn->connect_error);
}

$postSuccess = false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $loaiTin = $_POST["category"];
  $tieuDe = $_POST["title"];
  $nguonThongTin = $_POST["source"];
  $noiDung = mysqli_real_escape_string($conn, $_POST["content"]);

  $targetDir = "uploads/images/";
  $imageFileName = basename($_FILES["image"]["name"]);
  $imageTargetPath = $targetDir . $imageFileName;
  move_uploaded_file($_FILES["image"]["tmp_name"], $imageTargetPath);

  $targetDir = "uploads/videos/";
  $videoFileName = basename($_FILES["video"]["name"]);
  $videoTargetPath = $targetDir . $videoFileName;
  move_uploaded_file($_FILES["video"]["tmp_name"], $videoTargetPath);

  $sql = "INSERT INTO BanTinHienTruong (LoaiTin, TieuDe, NoiDung, HinhAnh, Video, NgayTao, NguonThongTin) 
          VALUES ('$loaiTin', '$tieuDe', '$noiDung', '$imageTargetPath', '$videoTargetPath', CURDATE(), '$nguonThongTin')";

  if ($conn->query($sql) === TRUE) {
    $postSuccess = true;
  } else {
    echo "Lỗi: " . $sql . "<br>" . $conn->error;
  }
}

$sql = "SELECT * FROM loaitin";
$result = $conn->query($sql);

$options = "";
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $options .= "<option value='" . $row["MaLT"] . "'>" . $row["TenLT"] . "</option>";
  }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Đăng tải bài viết</title>
<link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
<style>
  .format-controls {
    display: flex;
    align-items: center;
  }

  .format-controls button {
    margin-right: 5px;
  }
  .tag {
    display: inline-block;
    background-color: #edf2f7;
    color: #4a5568;
    padding: 0.25rem 0.5rem;
    margin: 0.25rem;
    border-radius: 0.25rem;
    border: 1px solid #CBD5E0;
  }

  .tag button {
    font-weight: bold;
    margin-left: 0.5rem;
    cursor: pointer;
    background-color: transparent;
    color: #e53e3e; 
    border: none;
  }

  .tag button:hover {
    color: #c53030; 
  }

  .wide-form {
    width: 80%; 
    margin: 0 auto;
  }
  .success-message {
    display: none;
    background-color: #d1e7dd;
    border-color: #badbcc;
    color: #0f5132;
    padding: 0.75rem 1.25rem;
    margin-top: 1rem;
    border: 1px solid transparent;
    border-radius: 0.25rem;
  }
</style>
</head>
<body>
<form action="" method="post" enctype="multipart/form-data" class="wide-form max-w-4xl mx-auto p-8 bg-gray-100 rounded-md shadow-md">
  <label for="category" class="block font-bold mb-2 text-lg">Loại Tin:</label>
  <div id="selectedCategories" class="mb-4"></div>
  <select id="category" name="category" class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500">
    <?php echo $options; ?>
  </select>
  <button type="button" id="addCategory" class="mt-2 px-3 py-1 rounded-md bg-blue-500 text-white hover:bg-blue-700">Thêm</button>
  <br>

  <label for="title" class="block font-bold mb-2 text-lg">Tiêu đề:</label>
  <input type="text" id="title" name="title" required class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500">

  <label for="source" class="block font-bold mb-2 text-lg mt-4">Nguồn thông tin:</label>
  <input type="text" id="source" name="source" required class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500">

  <label for="content" class="block font-bold mb-2 text-lg">Nội dung:</label>
  <div class="format-controls mb-4">
    <button type="button" onclick="wrapText('bold')" class="px-3 py-2 rounded-md bg-blue-500 text-white hover:bg-blue-700 mr-2">In đậm</button>
    <button type="button" onclick="wrapText('italic')" class="px-3 py-2 rounded-md bg-green-500 text-white hover:bg-green-700 mr-2">In nghiêng</button>
    <button type="button" onclick="wrapText('underline')" class="px-3 py-2 rounded-md bg-gray-500 text-white hover:bg-gray-700 mr-2">Gạch chân</button>
    <button type="button" onclick="changeColor()" class="px-3 py-2 rounded-md bg-purple-500 text-white hover:bg-purple-700">Đổi màu</button>
  </div>
  <textarea id="content" name="content" required class="w-full px-3 py-2 rounded-md border border-gray-300 focus:outline-none focus:ring-1 focus:ring-blue-500"></textarea>

  <label for="image" class="block font-bold mb-2 text-lg">Chọn hình ảnh:</label>
  <input type="file" id="image" name="image" accept="image/*" multiple class="hidden">
  <div id="imageThumbnails" class="flex flex-wrap justify-start"></div>
  <label for="image" class="mt-2 px-3 py-1 rounded-md bg-blue-500 text-white hover:bg-blue-700 cursor-pointer">Chọn ảnh</label>

  <label for="video" class="block font-bold mb-2 text-lg mt-4">Chọn video:</label>
  <input type="file" id="video" name="video" accept="video/*" multiple class="hidden">
  <div id="videoThumbnails" class="flex flex-wrap justify-start"></div>
  <label for="video" class="mt-2 px-3 py-1 rounded-md bg-blue-500 text-white hover:bg-blue-700 cursor-pointer">Chọn video</label>
  <div>
    <button type="submit" class="mt-4 px-4 py-2 rounded-md bg-blue-500 text-white hover:bg-blue-700">Đăng bài</button>
  </div>
  
  <div id="successMessage" class="success-message">
    Đăng bài thành công
  </div>
</form>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    var addCategoryButton = document.getElementById("addCategory");
    var selectedCategories = document.getElementById("selectedCategories");

    addCategoryButton.addEventListener("click", function() {
      var categorySelect = document.getElementById("category");
      var selectedOption = categorySelect.options[categorySelect.selectedIndex];

      if (selectedOption) {
        var categoryName = selectedOption.text;
        var tag = document.createElement("div");
        tag.classList.add("tag");
        tag.textContent = categoryName;

        var closeButton = document.createElement("button");
        closeButton.textContent = "x";
        closeButton.classList.add("ml-2", "text-red-600", "font-bold");
        closeButton.addEventListener("click", function() {
          tag.remove();
        });

        tag.appendChild(closeButton);
        selectedCategories.appendChild(tag);
      }
    });
  });

  document.getElementById("image").addEventListener("change", function(event) {
    var thumbnailsContainer = document.getElementById("imageThumbnails");
    thumbnailsContainer.innerHTML = "";

    var files = event.target.files;
    for (var i = 0; i < files.length; i++) {
      var file = files[i];
      var thumbnail = document.createElement("div");
      thumbnail.classList.add("thumbnail");

      var img = document.createElement("img");
      img.src = URL.createObjectURL(file);

      thumbnail.appendChild(img);
      thumbnailsContainer.appendChild(thumbnail);
    }
  });

  document.getElementById("video").addEventListener("change", function(event) {
    var thumbnailsContainer = document.getElementById("videoThumbnails");
    thumbnailsContainer.innerHTML = "";

    var files = event.target.files;
    for (var i = 0; i < files.length; i++) {
      var file = files[i];
      var thumbnail = document.createElement("div");
      thumbnail.classList.add("thumbnail");

      var video = document.createElement("video");
      video.src = URL.createObjectURL(file);
      video.controls = true;

      thumbnail.appendChild(video);
      thumbnailsContainer.appendChild(thumbnail);
    }
  });

  function wrapText(tag) {
    var textarea = document.getElementById("content");
    var start = textarea.selectionStart;
    var end = textarea.selectionEnd;
    var selectedText = textarea.value.substring(start, end);

    switch (tag) {
      case 'bold':
        selectedText = "<b>" + selectedText + "</b>";
        break;
      case 'italic':
        selectedText = "<i>" + selectedText + "</i>";
        break;
      case 'underline':
        selectedText = "<u>" + selectedText + "</u>";
        break;
      default:
        break;
    }

    var newText = textarea.value.substring(0, start) + selectedText + textarea.value.substring(end);
    textarea.value = newText;
  }

  function changeColor() {
    var color = prompt("Nhập màu bạn muốn (tên màu hoặc mã hex):", "blue");
    if (color != null && color !== "") {
      var textarea = document.getElementById("content");
      var start = textarea.selectionStart;
      var end = textarea.selectionEnd;
      var selectedText = textarea.value.substring(start, end);
      selectedText = "<span style='color:" + color + "'>" + selectedText + "</span>";
      var newText = textarea.value.substring(0, start) + selectedText + textarea.value.substring(end);
      textarea.value = newText;
    }
  }

  <?php if ($postSuccess): ?>
  var successMessage = document.getElementById("successMessage");
  successMessage.style.display = "block";
  <?php endif; ?>
</script>
</body>
</html>
