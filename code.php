<?php

require 'dbcon.php';

if(isset($_POST['delete_student']))
{
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $query = "DELETE FROM students WHERE id = '$student_id'";
    $query_run = mysqli_query($con, $query);

    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Xóa sinh viên thành công'
        ];
        echo json_encode($res);
        return false;
    }
    else{
        $res = [
            'status' => 500,
            'message' => 'Xóa sinh viên không thành công'
        ];
        echo json_encode($res);
        return false;
    }
}


if(isset($_GET['student_id']))
{
    $student_id = mysqli_real_escape_string($con, $_GET['student_id']);
    $query = "SELECT * FROM students WHERE id = '$student_id'";
    $query_run = mysqli_query($con, $query);

    if(mysqli_num_rows($query_run) == 1)
    {
        $student = mysqli_fetch_array($query_run);
        $res = [
            'status' => 200,
            'message' => 'Tìm thấy sinh viên bằng id nhập vào',
            'data' => $student
        ];
        echo json_encode($res);
        return false;
    }else{
        $res = [
            'status' => 404,
            'message' => 'Không tìm thấy học sinh'
        ];
        echo json_encode($res);
        return false;
    }
}


if(isset($_POST['save_student']))
{
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $course = mysqli_real_escape_string($con, $_POST['course']);

    if($name == null || $email == null || $phone == null || $course == null)
    {
        $res = [
            'status' => 422,
            'message' => 'Các trường dữ liệu trống'
        ];
        echo json_encode($res);
        return false;
    }
    $query ="INSERT INTO students (name, email, phone, course) VALUES ('$name', '$email', '$phone', '$course')";
    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Tạo sinh viên thành công'
        ];
        echo json_encode($res);
        return false;
    }
    else{
        $res = [
            'status' => 500,
            'message' => 'Tạo sinh viên không thành công'
        ];
        echo json_encode($res);
        return false;
    }
}

if(isset($_POST['update_student']))
{
    $student_id = mysqli_real_escape_string($con, $_POST['student_id']);
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $course = mysqli_real_escape_string($con, $_POST['course']);

    if($name == null || $email == null || $phone == null || $course == null)
    {
        $res = [
            'status' => 422,
            'message' => 'Các trường dữ liệu trống'
        ];
        echo json_encode($res);
        return false;
    }
    $query ="UPDATE students SET name = '$name', email = '$email', phone = '$phone', course = '$course' WHERE id = '$student_id'";
    $query_run = mysqli_query($con, $query);
    if($query_run)
    {
        $res = [
            'status' => 200,
            'message' => 'Cập nhật sinh viên thành công'
        ];
        echo json_encode($res);
        return false;
    }
    else{
        $res = [
            'status' => 500,
            'message' => 'Tạo sinh viên không thành công'
        ];
        echo json_encode($res);
        return false;
    }
}
?>