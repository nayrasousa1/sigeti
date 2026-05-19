<?php

namespace App\Controllers\Admin;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Message;
<<<<<<< HEAD
use App\Models\Role\Permission;
use App\Models\Role\Role;
use App\Models\School;

class RoleController extends Controller
{

    public function __construct()
    {
        parent::__construct("App");

        Auth::requirePermission(\App\Core\Permission::VIEW_ROLES);
=======
use App\Core\Permission;
use App\Models\Role\Role;

class RoleController extends Controller
{
    public function __construct()
    {
        parent::__construct("App");
        Auth::requirePermission(Permission::VIEW_ROLES);
>>>>>>> 5f166a56c073184db2b85b8d6a6f24614a85a289
    }

    public function index(): void
    {
<<<<<<< HEAD
        Auth::requirePermission(\App\Core\Permission::VIEW_ROLES);

        $roles = Role::all();

        echo $this->view->render("admin/role/index", [
            "roles" => $roles
        ]);
=======
        $roles = (new Role())->orderBy("name", "ASC")->get();

        echo $this->view->render("admin/role/index", [
            "roles" => $roles,
        ]);

        clear_old();
>>>>>>> 5f166a56c073184db2b85b8d6a6f24614a85a289
    }

    public function create(): void
    {
<<<<<<< HEAD
        Auth::requirePermission(\App\Core\Permission::CREATE_ROLE);

        echo $this->view->render("admin/role/create");
=======
        Auth::requirePermission(Permission::CREATE_ROLE);

        echo $this->view->render("admin/role/create");
        clear_old();
>>>>>>> 5f166a56c073184db2b85b8d6a6f24614a85a289
    }

    public function store(?array $data): void
    {
<<<<<<< HEAD
        Auth::requirePermission(\App\Core\Permission::CREATE_ROLE);

        $this->validateCsrfToken($data, "admin/role/create");

        $newrole = new Role();

        try {
            $newrole->fill([
                "name" => $data["name"],
                "description" => $data["description"],
            ]);

            $errors = array_merge(
                $newrole->validate($data),
            );

            if ($errors) {

                flash_old($data);

                foreach ($errors as $error) {
                    Message::warning($error);
                }
                redirect("admin/perfis/cadastrar");
            }

            $newrole->save();

        } catch (\InvalidArgumentException $invalidArgumentException) {
            Message::error($invalidArgumentException->getMessage());
            redirect("admin/perfis/cadastrar");
=======
        Auth::requirePermission(Permission::CREATE_ROLE);

        $this->validateCsrfToken($data, "/admin/perfis/cadastrar");

        $newRole = new Role();

        try {
            $newRole->fill([
                "name" => $data["name"],
                "description" => $data["description"] ?? null,
                "is_protected" => 0,
            ]);

            $errors = array_merge(
                $newRole->validate($data),
                $newRole->validateBusinessRule()
            );

            if ($errors) {
                flash_old($data);
                foreach ($errors as $error) {
                    Message::warning($error);
                }
                redirect("/admin/perfis/cadastrar");
                return;
            }

            $newRole->save();

        } catch (\InvalidArgumentException $invalidArgumentException) {
            Message::error($invalidArgumentException->getMessage());
            redirect("/admin/perfis/cadastrar");
>>>>>>> 5f166a56c073184db2b85b8d6a6f24614a85a289
            return;
        }

        Message::success("Perfil cadastrado com sucesso.");
<<<<<<< HEAD
        redirect("admin/perfis/cadastrar" . $newrole->getId());
=======
        redirect("/admin/perfis/editar/" . $newRole->getId());
>>>>>>> 5f166a56c073184db2b85b8d6a6f24614a85a289
    }

    public function edit(?array $data): void
    {
<<<<<<< HEAD
        Auth::requirePermission(\App\Core\Permission::EDIT_ROLE);

        $role = Role::find($data["id"]);

        if (!$role) {
            Message::error("Esse perfil não existe!");
            redirect("/admin/perfis");
            return;
        }
         $roles = Role::all();
        echo $this->view->render("admin/role/edit", [
            "roles" => $roles,
            "role" => $role
        ]);
=======
        Auth::requirePermission(Permission::EDIT_ROLE);

        $role = Role::find((int)$data["id"]);

        if (!$role) {
            Message::warning("Perfil não encontrado ou não existe.");
            redirect("/admin/perfis");
            return;
        }

        echo $this->view->render("admin/role/edit", [
            "role" => $role,
        ]);

        clear_old();
>>>>>>> 5f166a56c073184db2b85b8d6a6f24614a85a289
    }

    public function update(?array $data): void
    {
<<<<<<< HEAD
        Auth::requirePermission(\App\Core\Permission::EDIT_ROLE);

        $role = Role::find($data["id"]);

        if (!$role) {
            Message::error("Esse perfil não existe!");
=======
        Auth::requirePermission(Permission::EDIT_ROLE);

        $this->validateCsrfToken($data, "/admin/perfis/editar/" . $data["id"]);

        $role = Role::find((int)$data["id"]);

        if (!$role) {
            Message::warning("Perfil não encontrado ou não existe.");
>>>>>>> 5f166a56c073184db2b85b8d6a6f24614a85a289
            redirect("/admin/perfis");
            return;
        }

<<<<<<< HEAD
        $errors = $role->validate($data);

        if ($errors) {
            foreach ($errors as $error) {
                Message::warning($error);
            }
            redirect("/admin/perfil/editar/" . $role->getId());

        }
        if ($role->getRoleByName($data["name"])) {
            Message::warning("Já existe um perfil com esse nome");
            redirect("/admin/perfis/editar/" . $role->getId());
            return;
        }
        try {

            $role->fill([
                "name" => $data["name"],
                "description" => $data["description"] ?? null
            ]);

=======
        if ($role->isProtected()) {
            Message::warning("Este perfil é protegido e não pode ser editado.");
            redirect("/admin/perfis");
            return;
        }

        try {
            $role->fill([
                "name" => $data["name"],
                "description" => $data["description"] ?? null,
            ]);

            $errors = array_merge(
                $role->validate($data),
                $role->validateBusinessRule($role->getId())
            );

            if ($errors) {
                flash_old($data);
                foreach ($errors as $error) {
                    Message::warning($error);
                }
                redirect("/admin/perfis/editar/" . $role->getId());
                return;
            }

>>>>>>> 5f166a56c073184db2b85b8d6a6f24614a85a289
            $role->save();

        } catch (\InvalidArgumentException $invalidArgumentException) {
            Message::error($invalidArgumentException->getMessage());
            redirect("/admin/perfis/editar/" . $role->getId());
            return;
        }
<<<<<<< HEAD
        Message::success("perfil atualizada com sucesso!");
        redirect("/admin/perfis/editar/" . $role->getId());
    }
=======

        Message::success("Perfil atualizado com sucesso.");
        redirect("/admin/perfis/editar/" . $role->getId());
    }

    public function destroy(?array $data): void
    {
        Auth::requirePermission(Permission::DELETE_ROLE);

        $this->validateCsrfToken($data, "/admin/perfis");

        $role = Role::find((int)$data["id"]);

        if (!$role) {
            Message::error("Perfil não encontrado ou não existe.");
            redirect("/admin/perfis");
            return;
        }

        if ($role->isProtected()) {
            Message::warning("Este perfil é protegido e não pode ser excluído.");
            redirect("/admin/perfis");
            return;
        }

        if ($role->existsUsers()) {
            Message::warning("Este perfil possui usuários vinculados e não pode ser excluído.");
            redirect("/admin/perfis");
            return;
        }

        try {
            $role->delete();
        } catch (\InvalidArgumentException $invalidArgumentException) {
            Message::error($invalidArgumentException->getMessage());
            redirect("/admin/perfis");
            return;
        }

        Message::success("Perfil excluído em segurança com sucesso.");
        redirect("/admin/perfis");
    }
>>>>>>> 5f166a56c073184db2b85b8d6a6f24614a85a289
}