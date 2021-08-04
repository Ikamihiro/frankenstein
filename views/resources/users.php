<div class="p-5 pt-3">
    <div class="row">
        <!-- Form User -->
        <div class="col-12 pb-0 pb-md-3">
            <div class="accordion" id="accordionUser">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="formUserHead">
                        <button id="btnUserFormAccordion" class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#formUserCollapse" aria-expanded="true" aria-controls="formUserCollapse">
                            Deseja cadastrar um novo usuário?
                        </button>
                    </h2>
                    <div id="formUserCollapse" class="accordion-collapse collapse" aria-labelledby="formUserHead" data-bs-parent="#accordionUser">
                        <div class="accordion-body">
                            <form id="formUser">
                                <input type="hidden" id="action" value="create">
                                <input type="hidden" id="userId">

                                <div class="mb-3">
                                    <label for="document" class="form-label">CPF</label>
                                    <input type="text" class="form-control" id="document" required>
                                </div>
                                <div class="mb-3">
                                    <label for="firstName" class="form-label">Nome</label>
                                    <input type="text" class="form-control" id="firstName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="lastName" class="form-label">Sobrenome</label>
                                    <input type="text" class="form-control" id="lastName" required>
                                </div>
                                <div class="mb-3">
                                    <label for="phone" class="form-label">Telefone</label>
                                    <input type="text" class="form-control" id="phone" required>
                                </div>
                                <div class="mb-3">
                                    <label for="birthDate" class="form-label">Data de nascimento</label>
                                    <input type="date" class="form-control" id="birthDate" required>
                                </div>
                                <button type="submit" id="submitFormUserButton" class="btn btn-primary">
                                    Salvar
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- List Users -->
        <div class="col-12">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">CPF</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Sobrenome</th>
                        <th scope="col">Telefone</th>
                        <th width="150" scope="col">Ações</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($users as $key => $user) { ?>
                        <tr>
                            <td><?php echo $key + 1; ?></td>
                            <td><?php echo $user->document; ?></td>
                            <td><?php echo $user->first_name; ?></td>
                            <td><?php echo $user->last_name; ?></td>
                            <td><?php echo $user->phone; ?></td>
                            <td>
                                <button class="btn btn-sm btn-warning text-dark mx-1 editButton" data-id="<?php echo $user->id; ?>">
                                    Editar
                                </button>
                                <button class="btn btn-sm btn-danger mx-1 deleteButton" data-id="<?php echo $user->id; ?>">
                                    Excluir
                                </button>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.3/jquery.validate.min.js" integrity="sha512-37T7leoNS06R80c8Ulq7cdCDU5MNQBwlYoy1TX/WUsLFC2eYNqtKlV0QjH7r8JpG/S0GUMZwebnVFLPd6SU5yg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
    function setUserAtForm(user) {
        $("#action").val('update');
        $("#userId").val(user.id);
        $("#document").val(user.document);
        $("#firstName").val(user.first_name);
        $("#lastName").val(user.last_name);
        $("#phone").val(user.phone);
        $("#birthDate").val(user.birth_date);

        $("#btnUserFormAccordion").toggleClass("collapsed");
        $("#formUserCollapse").toggleClass("show");
    }

    $("#formUser").on('submit', function(e) {
        e.preventDefault();

        let action = $("#action").val() == 'create' ?
            'POST' :
            'PUT';
        let url = $("#action").val() == 'create' ?
            '/api/user' :
            '/api/user/' + $("#userId").val();

        console.log(action, url);

        let newUser = {
            document: $("#document").val(),
            first_name: $("#firstName").val(),
            last_name: $("#lastName").val(),
            phone: $("#phone").val(),
            birth_date: $("#birthDate").val(),
        };

        $.ajax({
            url: url,
            type: action,
            dataType: 'JSON',
            data: JSON.stringify(newUser),
            success: (data, textStatus, jqxhr) => {
                document.location.reload(true);
                alert('Usuário inserido com sucesso!');
            },
            error: (jqxhr, textStatus, errorThrown) => {
                alert(textStatus);
            },
        });
    });

    $(".editButton").click(function() {
        console.log("Editando um usuário...");
        let userId = $(this).attr('data-id');

        $.ajax({
            url: '/api/user/' + userId,
            type: 'GET',
            dataType: 'JSON',
            success: (data, textStatus, jqxhr) => {
                setUserAtForm(data);
            },
            error: (jqxhr, textStatus, errorThrown) => {
                alert(textStatus);
            },
        });
    });

    $(".deleteButton").click(function() {
        console.log("Excluindo um usuário...");
        let userId = $(this).attr('data-id');

        $.ajax({
            url: '/api/user/' + userId,
            type: 'DELETE',
            dataType: 'JSON',
            success: (data, textStatus, jqxhr) => {
                document.location.reload(true);
                alert('Usuário excluído com sucesso!');
            },
            error: (jqxhr, textStatus, errorThrown) => {
                alert(textStatus);
            },
        });
    });
</script>