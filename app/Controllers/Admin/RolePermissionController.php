<?php

namespace App\Controllers\Admin;

use App\Core\Auth;
use App\Core\Controller;
use App\Core\Message;
use App\Core\Permission;
<<<<<<< HEAD
=======
use App\Models\Role\Permission as PermissionModel;
>>>>>>> 5f166a56c073184db2b85b8d6a6f24614a85a289
use App\Models\Role\Role;
use App\Models\Role\RolePermission;

class RolePermissionController extends Controller
{
<<<<<<< HEAD

    public function __construct()
    {
        parent::__construct("App");

        Auth::requirePermission(Permission::MANAGE_ROLE_PERMISSION);
    }


    public function edit(?array $data): void
    {
        Auth::requirePermission(\App\Core\Permission::EDIT_ROLE);

        $role = Role::find($data["id"]);

        $permissions = new \App\Models\Role\Permission();



        $permissions = $permissions->groupedByGroup();

        $currentPermissions =  RolePermission::permissionIdsByRole($role->getId());

        if (!$role) {
            Message::error("Esse perfil não existe!");
=======
    public function __construct()
    {
        parent::__construct("App");
        Auth::requirePermission(Permission::MANAGE_ROLE_PERMISSIONS);
    }

    public function edit(?array $data): void
    {
        $role = Role::find((int)$data["id"]);

        if (!$role) {
            Message::warning("Perfil não encontrado ou não existe.");
>>>>>>> 5f166a56c073184db2b85b8d6a6f24614a85a289
            redirect("/admin/perfis");
            return;
        }

<<<<<<< HEAD
=======
        $permissions = (new PermissionModel())->groupedByGroup();
        $currentPermissions = RolePermission::permissionIdsByRole($role->getId());

>>>>>>> 5f166a56c073184db2b85b8d6a6f24614a85a289
        echo $this->view->render("admin/role/permissions", [
            "role" => $role,
            "permissions" => $permissions,
            "currentPermissions" => $currentPermissions,
        ]);

        clear_old();
    }

    public function update(?array $data): void
    {
<<<<<<< HEAD
        Auth::requirePermission(\App\Core\Permission::EDIT_ROLE);

        $permissionId = $data["id"];

        $this->validateCsrfToken($data, "/admin/perfis/editar" . $permissionId . "/permissions");

        $role = Role::find($data["id"]);

        $permissionIds = array_map("intval", $data["permissions"] ??[]);

         if($role->isProtected()){
             Message::warning("O perfil é protegido e não pode ser alterado!");
             redirect("/admin/perfis/editar" . $permissionId);
             return;
         }

        try {

            if (!$role) {
                Message::error("Esse perfil não existe!");
                redirect("/admin/perfis");
                return;
            }

            RolePermission::syncPermissions($role->getId(), $permissionIds);

        } catch (\InvalidArgumentException $invalidArgumentException) {
            Message::error($invalidArgumentException->getMessage());
            redirect("/admin/perfis/editar/" . $permissionId);
            return;
        }
        Message::success("perfil atualizado com sucesso!");
        redirect("/admin/perfis/editar/" . $permissionId);

    }



=======
        $this->validateCsrfToken($data, "/admin/perfis/" . $data["id"] . "/permissoes");

        $role = Role::find((int)$data["id"]);

        if (!$role) {
            Message::warning("Perfil não encontrado ou não existe.");
            redirect("/admin/perfis");
            return;
        }

        if ($role->isProtected()) {
            Message::warning("As permissões deste perfil são protegidas e não podem ser alteradas.");
            redirect("/admin/perfis");
            return;
        }

        $permissionIds = array_map('intval', $data["permissions"] ?? []);

        try {
            RolePermission::syncPermissions($role->getId(), $permissionIds);
        } catch (\InvalidArgumentException $invalidArgumentException) {
            Message::error($invalidArgumentException->getMessage());
            redirect("/admin/perfis/" . $role->getId() . "/permissoes");
            return;
        }

        Message::success("Permissões atualizadas com sucesso.");
        redirect("/admin/perfis/" . $role->getId() . "/permissoes");
    }
>>>>>>> 5f166a56c073184db2b85b8d6a6f24614a85a289
}