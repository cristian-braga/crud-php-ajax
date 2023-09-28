<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">
    <!-- AlertifyJS -->
    <link rel="stylesheet" href="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/css/alertify.min.css" />
    <title>CRUD Estudantes</title>
</head>

<body>
    <div class="container mt-3">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="text-center">
                            ESTUDANTES
                            <button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#studentAddModal">Cadastrar</button>
                        </h4>
                    </div>
                    <div class="card-body">
                        <table id="myTable" class="table table-striped text-center">
                            <thead class="table-dark">
                                <tr>
                                    <th>Id</th>
                                    <th>Nome</th>
                                    <th>Curso</th>
                                    <th>Email</th>
                                    <th>Telefone</th>
                                    <th>Ações</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                include 'dbcon.php';

                                $query = "SELECT * FROM students ORDER BY id ASC";
                                $query_run = mysqli_query($conn, $query);

                                if (mysqli_num_rows($query_run) > 0) {
                                    foreach ($query_run as $student) {
                                ?>
                                <tr>
                                    <td><?= $student['id'] ?></td>
                                    <td><?= $student['name'] ?></td>
                                    <td><?= $student['course'] ?></td>
                                    <td><?= $student['email'] ?></td>
                                    <td><?= $student['phone'] ?></td>
                                    <td>
                                        <button class="viewStudentBtn btn btn-outline-info btn-sm" value="<?= $student['id'] ?>">Detalhes</button>
                                        <button class="editStudentBtn btn btn-outline-warning btn-sm" value="<?= $student['id'] ?>">Editar</button>
                                        <button class="deleteStudentBtn btn btn-outline-danger btn-sm" value="<?= $student['id'] ?>">Excluir</button>
                                    </td>
                                </tr>
                                <?php
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Add -->
    <div class="modal fade" id="studentAddModal" tabindex="-1" aria-labelledby="studentAddLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="studentAddLabel">CADASTRAR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="saveStudent">
                    <div class="modal-body">
                        <div id="errorMessage" class="alert alert-warning d-none"></div>
                        <div class="mb-3">
                            <label for="">Nome completo</label>
                            <input type="text" name="name" class="form-control" placeholder="Digite o nome completo">
                        </div>
                        <div class="mb-3">
                            <label for="">Curso</label>
                            <input type="text" name="course" class="form-control" placeholder="Digite o curso">
                        </div>
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="text" name="email" class="form-control" placeholder="Email para contato">
                        </div>
                        <div class="mb-3">
                            <label for="">Telefone</label>
                            <input type="text" name="phone" class="form-control phone" placeholder="(00)00000-0000">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Edit -->
    <div class="modal fade" id="studentEditModal" tabindex="-1" aria-labelledby="studentEditLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="studentEditLabel">EDITAR</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form id="updateStudent">
                    <div class="modal-body">
                        <div id="errorMessageUpdate" class="alert alert-warning d-none"></div>
                        <input type="hidden" name="student_id" id="student_id">
                        <div class="mb-3">
                            <label for="">Nome completo</label>
                            <input type="text" name="name" id="name" class="form-control" placeholder="Digite o nome completo">
                        </div>
                        <div class="mb-3">
                            <label for="">Curso</label>
                            <input type="text" name="course" id="course" class="form-control" placeholder="Digite o curso">
                        </div>
                        <div class="mb-3">
                            <label for="">Email</label>
                            <input type="text" name="email" id="email" class="form-control" placeholder="Email para contato">
                        </div>
                        <div class="mb-3">
                            <label for="">Telefone</label>
                            <input type="text" name="phone" id="phone" class="form-control phone" placeholder="(00)00000-0000">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">Salvar</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- View -->
    <div class="modal fade" id="studentViewModal" tabindex="-1" aria-labelledby="studentViewLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="studentViewLabel">DETALHES</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="">Nome completo</label>
                        <p id="view_name" class="form-control"></p>
                    </div>
                    <div class="mb-3">
                        <label for="">Curso</label>
                        <p id="view_course" class="form-control"></p>
                    </div>
                    <div class="mb-3">
                        <label for="">Email</label>
                        <p id="view_email" class="form-control"></p>
                    </div>
                    <div class="mb-3">
                        <label for="">Telefone</label>
                        <p id="view_phone" class="form-control"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>

    <!-- jQuery e Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- AlertifyJS -->
    <script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>
    <!-- AJAX -->
    <script src="script.js"></script>
</body>

</html>