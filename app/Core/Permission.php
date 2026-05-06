<?php

namespace App\Core;

class Permission extends AbstractModel
{

    protected string $table = "permission";

    protected string $primaryKey = "id";

    //CHAMADOS

    public const OPEN_TICKET = "abrir_chamado";

    public const VIEW_MY_TICKET = "ver_meus_chamado";

    public const VIEW_ALL_TICKET = "ver_todas_chamados";

    public const COMMENT_TICKET = "comentar_chamado";

    public const ATTACH_FILE_TICKET = "anexar_arquivos_chamado";

    public const CONFIRM_RESOLUTION = "confirmar_resolução";

    public const REOPEN_TICKET = "reabrir_chamado";

    public const ASSIGN_TICKET = "retribuir_chamado";

    public const TAKE_TICKET = "assumir_chamado";

    public const EDIT_TICKET = "editar_chamado";

    public const CLOSE_TICKET = "fechar_chamado";

    public const ARCHIVE_TICKET = "arquivar_chamado";

    public const DELETE_TICKET = "excluir_chamado";

    public const VIEW_TICKET_HISTORY = "ver_historíco_chamado";

    public const VIEW_MY_ASSIGNED_TICKET = "ver_chamados_atribuidos_a_mim";


    //COMENTARIO


    public const EDIT_OWN_COMMENT = "editar_proprio_comentario";

    public const DELETE_OWN_COMMENT = "excluir_proprio_comentario";

    public const DELETE_ANY_COMMENT = "excluir_qualquer_comentario";


    //ANEXOS

    public const DELETE_OWN_ATTACHMENT = "excluir_proprio_anexos";

    public const DELETE_ANY_ATTACHMENT = "excluir_qualquer_anexo";

    public const DOWNLOAD_ATTACHMENT = "baixar_anexo";


    //DASHBOAD

    public const VIEW_REQUESTER_DASHBOARD = "ver_dashboard_solicitante";

    public const VIEW_TECHNICIAN_DASHBOARD = "ver_dashboard_tecnico";

    public const VIEW_MANAGER_DASHBOARD = "ver_dashboard_gestor";


    //RELATORIOS

    public const VIEW_REPORTS = "ver _relatorios";

    public const EXPORT_REPORTS = "exportar _relatorios";


    //USUARIOS

    public const VIEW_USERS = "ver _usuarios";

    public const CREATE_USER = "criar _usuario";
_
    public const EDIT_USER = "editar _usuario";

    public const TOGGLE_USER_STATUS = "ativar _inativar _usuario";

    public const DELETE_USER = "excluir_usuario";

    public const RESERT_USER_PASSWORD = "redefinir_senha_usuario";

    public const VIEW_USER_LAST_ACCESS = "ver_ultimo_acesso_usuario";


    //PERFIS

    public const VIEW_ROLES = "ver_perfis";

    public const CREATE_ROLE = "criar_perfil";

    public const EDIT_ROLE = "editar_perfil";

    public const DELETE_ROLE = "excluir_perfil";

    public const MANAGE_ROLE_PERMISSION = "gerenciar_permissoes_perfil";


    //DEPARTAMENTO

    public const VIEW_DEPARTMENTS = "ver_departamentos";

    public const CREATE_DEPARTMENT = "criar_departamento";

    public const EDIT_DEPARTMENT = "editar_departamento";

    public const DELETE_DEPARTMENT = "excluir_departamento";

    public const LINK_USER_DEPARTMENT = "vincular_usuario_departamento";

    public const UNLINK_USER_DEPARTMENT = "desvincular_usuario_departamento";


    //CATEGORIA

    public const VIEW_CATEGORIES = "ver_categorias";

    public const CREATE_CATEGORY = "criar_categoria";

    public const EDIT_CATEGORY = "editar_categoria";

    public const DELETE_CATEGORY = "excluir_categoria";


    //ESCOLA

    public const VIEW_SCHOOLS = "ver_escola";

    public const CREATE_SCHOOL = "criar_escola";

    public const EDIT_SCHOOL = "editar_escola";

    public const DELETE_SCHOOL = "excluir_escola";


    //PERFIL PESSOAL

    public const EDIT_OWN_PROFILE = "editar_proprio_perfil";

    public const CHANGE_OWN_PASSWORD = "alterar_propria_senha";


    //SISTENA

    public const VIEW_SYSTEM_LOG = "ver_log_sistema";

    public const MANAGE_SESSIONS = "gerenciar_sessoes";

}