<?php
include 'dbcon.php';

if (isset($_POST['save'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);

    if ($name == NULL || $email == NULL || $phone == NULL || $course == NULL) {
        $res = [
            'status' => 422,
            'message' => 'Todos os campos são obrigatórios!'
        ];

        echo json_encode($res);

        return;
    }

    $query = "INSERT INTO students (name, email, phone, course) VALUES ('$name', '$email', '$phone', '$course')";

    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Estudante cadastrado com sucesso!'
        ];

        echo json_encode($res);

        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Falha ao cadastrar estudante.'
        ];

        echo json_encode($res);

        return;
    }
}

if (isset($_GET['student_id'])) {
    $student_id = mysqli_real_escape_string($conn, $_GET['student_id']);

    $query = "SELECT * FROM students WHERE id = '$student_id'";

    $query_run = mysqli_query($conn, $query);

    if (mysqli_num_rows($query_run) == 1) {
        $student = mysqli_fetch_array($query_run);

        $res = [
            'status' => 200,
            'data' => $student
        ];

        echo json_encode($res);

        return;
    } else {
        $res = [
            'status' => 404,
            'message' => 'Estudante não existe.'
        ];

        echo json_encode($res);

        return;
    }
}

if (isset($_POST['update'])) {
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $course = mysqli_real_escape_string($conn, $_POST['course']);

    if ($name == NULL || $email == NULL || $phone == NULL || $course == NULL) {
        $res = [
            'status' => 422,
            'message' => 'Todos os campos são obrigatórios!'
        ];

        echo json_encode($res);

        return;
    }

    $query = "UPDATE students SET name = '$name', email = '$email', phone = '$phone', course = '$course' WHERE id = '$student_id'";

    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Estudante editado com sucesso!'
        ];

        echo json_encode($res);

        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Falha ao editar estudante.'
        ];

        echo json_encode($res);

        return;
    }
}

if (isset($_POST['delete_student'])) {
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);

    $query = "DELETE FROM students WHERE id = '$student_id'";

    $query_run = mysqli_query($conn, $query);

    if ($query_run) {
        $res = [
            'status' => 200,
            'message' => 'Estudante excluído com sucesso!'
        ];

        echo json_encode($res);

        return;
    } else {
        $res = [
            'status' => 500,
            'message' => 'Falha ao excluir estudante.'
        ];

        echo json_encode($res);

        return;
    }
}