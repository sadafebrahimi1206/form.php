<?php

// چک می‌شود که فرم ارسال شده باشد یا خیر
if (isset($_POST['submit'])) {

  // انواع مجاز فایل‌ها
  $allowedTypes = array('jpg', 'png', 'gif', 'pdf');

  // حداکثر حجم فایل مجاز به بایت
  $maxSize = 5 * 1024 * 1024;

  // اطلاعات فایل آپلود شده
  $fileName = $_FILES['file']['name'];  // نام فایل
  $fileSize = $_FILES['file']['size'];  // اندازه فایل
  $fileType = $_FILES['file']['type'];  // نوع فایل
  $fileTmp = $_FILES['file']['tmp_name'];  // مسیر موقت فایل
  $fileError = $_FILES['file']['error'];  // خطای آپلود

  // استخراج پسوند فایل و تبدیل به حروف کوچک
  $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

  // چک می‌شود که پسوند فایل مجاز باشد
  if (in_array($fileExtension, $allowedTypes)) {

    // چک می‌شود که حجم فایل مجاز باشد
    if ($fileSize <= $maxSize) {

      // چک می‌شود که خطایی در آپلود فایل رخ نداده باشد
      if ($fileError === 0) {

        // فایل معتبر است، می‌توانید اقدام به ذخیره یا پردازش آن کنید

        // انتقال فایل به مسیر مشخص شده
        move_uploaded_file($fileTmp, 'uploads/' . $fileName);

        // نمایش پیغام موفقیت آمیز
        echo "فایل با موفقیت آپلود شد.";
      } else {
        // نمایش پیغام خطا در آپلود فایل
        echo "خطا در آپلود فایل.";
      }
    } else {
      // نمایش پیغام در صورت عدم مطابقت حجم فایل با حد مجاز
      echo "حجم فایل باید کمتر از " . $maxSize / (1024 * 1024) . " مگابایت باشد.";
    }
  } else {
    // نمایش پیغام در صورت عدم مطابقت پسوند فایل با انواع مجاز
    echo "فرمت فایل مجاز نیست. فقط فایل‌های با فرمت " . implode(', ', $allowedTypes) . " مجاز است.";
  }
}
?>

<!DOCTYPE html>
<html>

<head>
  <title>آپلود فایل</title>
</head>

<body>
  <!-- فرم آپلود فایل -->
  <form method="POST" enctype="multipart/form-data">
    <!-- المان ورودی فایل -->
    <input type="file" name="file" required>
    <!-- دکمه ارسال فرم -->
    <input type="submit" name="submit" value="آپلود فایل">
  </form>


</body>

</html>