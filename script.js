$(document).ready(function() {
    $('.phone').mask('(00)00000-0000');
});

// CADASTRAR
$(document).on('submit', '#saveStudent', function(ev) {
    ev.preventDefault();

    let formData = new FormData(this);
    formData.append('save', true);

    $.ajax({
        type: "POST",
        url: "code.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            let res = $.parseJSON(response);

            if (res.status == 422) {
                $('#errorMessage').removeClass('d-none');
                $('#errorMessage').text(res.message);
            } else if (res.status == 200) {
                $('#errorMessage').addClass('d-none');
                $('#studentAddModal').modal('hide');
                $('#saveStudent')[0].reset();

                alertify.set('notifier', 'position', 'top-right');
                alertify.success(res.message);

                $('#myTable').load(location.href + " #myTable");
            } else if (res.status == 500) {
                alert(res.message);
            }
        }
    });
});

// BUSCA OS DADOS QUE SERÃO EDITADOS
$(document).on('click', '.editStudentBtn', function() {
    let student_id = $(this).val();

    $.ajax({
        type: "GET",
        url: "code.php?student_id=" + student_id,
        success: function(response) {
            let res = $.parseJSON(response);

            if (res.status == 404) {
                alert(res.message);
            } else if (res.status == 200) {
                $('#student_id').val(res.data.id);
                $('#name').val(res.data.name);
                $('#email').val(res.data.email);
                $('#phone').val(res.data.phone);
                $('#course').val(res.data.course);

                $('#studentEditModal').modal('show');
            }
        }
    });
});

// ATUALIZAR
$(document).on('submit', '#updateStudent', function(ev) {
    ev.preventDefault();

    let formData = new FormData(this);
    formData.append('update', true);

    $.ajax({
        type: "POST",
        url: "code.php",
        data: formData,
        processData: false,
        contentType: false,
        success: function(response) {
            let res = $.parseJSON(response);

            if (res.status == 422) {
                $('#errorMessageUpdate').removeClass('d-none');
                $('#errorMessageUpdate').text(res.message);
            } else if (res.status == 200) {
                $('#errorMessageUpdate').addClass('d-none');
                $('#studentEditModal').modal('hide');
                $('#updateStudent')[0].reset();

                alertify.set('notifier', 'position', 'top-right');
                alertify.success(res.message);

                $('#myTable').load(location.href + " #myTable");
            } else if (res.status == 500) {
                alert(res.message);
            }
        }
    });
});

// DETALHES
$(document).on('click', '.viewStudentBtn', function() {
    let student_id = $(this).val();

    $.ajax({
        type: "GET",
        url: "code.php?student_id=" + student_id,
        success: function(response) {
            let res = $.parseJSON(response);

            if (res.status == 404) {
                alert(res.message);
            } else if (res.status == 200) {
                $('#view_name').text(res.data.name);
                $('#view_email').text(res.data.email);
                $('#view_phone').text(res.data.phone);
                $('#view_course').text(res.data.course);

                $('#studentViewModal').modal('show');
            }
        }
    });
});

// EXCLUIR
$(document).on('click', '.deleteStudentBtn', function(ev) {
    ev.preventDefault();

    if (confirm("Realmente deseja excluir o Estudante?")) {
        let student_id = $(this).val();

        $.ajax({
            type: "POST",
            url: "code.php",
            data: {
                'delete_student': true,
                'student_id': student_id
            },
            success: function(response) {
                let res = $.parseJSON(response);

                if (res.status == 500) {
                    alert(res.message);
                } else {
                    alertify.set('notifier', 'position', 'top-right');
                    alertify.success(res.message);

                    $('#myTable').load(location.href + " #myTable");
                }
            }
        });
    }
});