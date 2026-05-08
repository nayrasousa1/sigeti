<?php

namespace App\Models\Department;

use App\Core\AbstractModel;
use App\Models\User;
use InvalidArgumentException;


class UserDepartment extends AbstractModel
{
    protected string $table = "user_departments";

    protected string $primaryKey = "id";

    public const MORNING = "manha";

    public const AFTERNOON = "tarde";

    public const NIGHT = "noite";

    public const WHOLE = "integral";

    public const NOT_APPLICABLE = "nao_aplicavel";

    public const SHIFTS = [
        self::MORNING,
        self::AFTERNOON,
        self::NIGHT,
        self::WHOLE,
        self::NOT_APPLICABLE,
    ];

    protected array $fillable = [
        "user_id",
        "department_id",
        "shift",
    ];

    protected array $required = [
        "user_id" => "O campo USUÁRIO é obrigatório.",
        "department" => "O campo DEPARTAMENTO é obrigatorio.",
        "shift" => "O campo TURNO é obrigatorio.",
    ];

    protected bool $timestamps = true;

    protected bool $softDelete = true;

    public function getId(): int
    {
        return $this->attributes["id"];
    }


    public function setUserId(int $userId): void
    {
        if ($userId < 1) {
            throw new \InvalidArgumentException("O ID do usuario é inválido.");
        }

        $this->attributes["role_id"] = $userId;
    }

    public function getUserId(): int
    {
        return $this->attributes["user_id"];
    }

    public function setDepartmentId(int $departmentId): void
    {
        if ($departmentId < 1) {
            throw new \InvalidArgumentException("O ID do departamento é inválido.");
        }
        $this->attributes["department_id"] = $departmentId;
    }

    public function getDepartmentId(): int
    {
        return $this->attributes["department_id"];
    }

    public function setShift(?string $shift): void
    {
        $shift = $shift ?? self::NOT_APPLICABLE;

        if (!in_array($shift, self::SHIFTS)) {
            throw new \InvalidArgumentException("O TURNO não é válido.");
        }

        $this->attributes["shift"] = $shift;
    }

    public function getShift(): string
    {
        return $this->attributes["shift"];
    }

    public function department(): ?Department
    {
        return Department::find($this->getDepartmentId());
    }


    public function user(): ?User
    {
        return User::find($this->getUserId());
    }


    public static function linksByUser(int $userId): array
    {
        return (new static())
            ->where("user_id", "=", $userId)
            ->get();
    }


    public static function validateDepartments(array $links): array
    {
        $validLinks = [];

        foreach ($links as $link) {
            $departmentId = $link["department_id"] ?? 0;

            if (Department::find((int)$departmentId)) {
                $validLinks[] = $link;
            }
        }

        return $validLinks;
    }

    public static function validateDepartmentLinks(array $links): array
    {
        if (empty($links)) {
            return ["Vincule o usuário a pelo menos um departamento."];
        }

        $links = self::validateDepartments($links);

        if (empty($links)) {
            return ["Nenhum departamento válido foi informado."];
        }

        return [];
    }
}