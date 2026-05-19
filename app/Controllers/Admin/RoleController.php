<?php

namespace App\Controllers\Admin;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Message;
use App\Models\Role\Permission;
use App\Models\Role\Role;
use App\Models\School;

class RoleController extends Controller
{

    public function __construct()
    {
        parent::__construct("App");

        Auth::requirePermission(\App\Core\Permission::VIEW_ROLES);
    }

    public function index(): void
    {
        Auth::requirePermission(\App\Core\Permission::VIEW_ROLES);

        $roles = Role::all();

        echo $this->view->render("admin/role/index", [
            "roles" => $roles
        ]);
    }

    public function create(): void
    {
        Auth::requirePermission(\App\Core\Permission::CREATE_ROLE);

        echo $this->view->render("admin/role/create");
    }

    public function store(?array $data): void
    {
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
            return;
        }

        Message::success("Perfil cadastrado com sucesso.");
        redirect("admin/perfis/cadastrar" . $newrole->getId());
    }

    public function edit(?array $data): void
    {
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
    }

    public function update(?array $data): void
    {
        Auth::requirePermission(\App\Core\Permission::EDIT_ROLE);

        $role = Role::find($data["id"]);

        if (!$role) {
            Message::error("Esse perfil não existe!");
            redirect("/admin/perfis");
            return;
        }

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

            $role->save();

        } catch (\InvalidArgumentException $invalidArgumentException) {
            Message::error($invalidArgumentException->getMessage());
            redirect("/admin/perfis/editar/" . $role->getId());
            return;
        }
        Message::success("perfil atualizada com sucesso!");
        redirect("/admin/perfis/editar/" . $role->getId());
    }
}